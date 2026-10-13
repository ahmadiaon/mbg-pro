<?php

namespace App\Console\Commands;

use App\Models\DatabaseData;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Throwable;

class AuditEmployeeImport extends Command
{
    protected $signature = 'employee:import-audit
        {file : Path to the review workbook}
        {--json= : Optional JSON report output path}';

    protected $description = 'Audit the employee EAV workbook without writing database data';

    public function handle(): int
    {
        $path = $this->argument('file');
        if (!is_file($path)) {
            $this->error("Workbook tidak ditemukan: {$path}");
            return self::FAILURE;
        }

        try {
            $spreadsheet = IOFactory::load($path);
            $report = $this->audit($spreadsheet);
        } catch (Throwable $exception) {
            $this->error('Workbook gagal dibaca: ' . $exception->getMessage());
            return self::FAILURE;
        }

        $this->line('Mode: DRY-RUN (tidak ada perubahan database)');
        $this->line('Database audit: koneksi Laravel mbg (legacy), bukan mbg_hr EAV Prisma');
        $this->line('Total NRP: ' . $report['summary']['total_nrp']);
        foreach ($report['summary']['counts'] as $label => $count) {
            $this->line(sprintf('%-30s %d', $label . ':', $count));
        }

        foreach ($report['issues'] as $issue) {
            $this->warn(sprintf('[%s] %s', $issue['type'], $issue['message']));
        }

        if ($jsonPath = $this->option('json')) {
            file_put_contents($jsonPath, json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->info("Laporan JSON: {$jsonPath}");
        }

        return self::SUCCESS;
    }

    private function audit($spreadsheet): array
    {
        $requiredSheets = [
            'STATUS KERJA USULAN',
            'KONTRAK USULAN',
            'IDENTITAS USULAN',
        ];
        $issues = [];
        $sheets = $spreadsheet->getSheetNames();
        foreach ($requiredSheets as $sheet) {
            if (!in_array($sheet, $sheets, true)) {
                $issues[] = [
                    'type' => 'MISSING_SHEET',
                    'message' => "Sheet wajib tidak ditemukan: {$sheet}",
                ];
            }
        }
        if ($issues) {
            return [
                'summary' => ['total_nrp' => 0, 'counts' => ['missing_sheets' => count($issues)]],
                'issues' => $issues,
            ];
        }

        $statusRows = $this->sheetRows($spreadsheet->getSheetByName('STATUS KERJA USULAN'));
        $contractRows = $this->sheetRows($spreadsheet->getSheetByName('KONTRAK USULAN'));
        $identityRows = $this->sheetRows($spreadsheet->getSheetByName('IDENTITAS USULAN'));
        $statusByNrp = $this->indexByNrp($statusRows, 'STATUS KERJA USULAN', $issues);
        $contractByNrp = $this->indexByNrp($contractRows, 'KONTRAK USULAN', $issues);
        $identityByNrp = $this->indexByNrp($identityRows, 'IDENTITAS USULAN', $issues);
        $nrps = array_values(array_unique(array_merge(
            array_keys($statusByNrp),
            array_keys($contractByNrp),
            array_keys($identityByNrp),
        )));

        $this->validateRows($statusByNrp, 'STATUS KERJA USULAN', [
            'PROJECT STATUS USULAN', 'DEPARTEMEN USULAN', 'LOKASI KERJA USULAN', 'JABATAN USULAN', 'STATUS',
        ], $issues);
        $this->validateRows($contractByNrp, 'KONTRAK USULAN', [
            'PERUSAHAAN KONTRAK', 'JABATAN KONTRAK', 'STATUS KONTRAK', 'TANGGAL MULAI',
        ], $issues);
        $this->validateRows($identityByNrp, 'IDENTITAS USULAN', ['NIK KTP USULAN'], $issues);

        $this->validateDuplicateNrp($statusRows, 'STATUS KERJA USULAN', $issues);
        $this->validateDuplicateNrp($contractRows, 'KONTRAK USULAN', $issues);
        $this->validateDuplicateNrp($identityRows, 'IDENTITAS USULAN', $issues);

        $existingNrps = $this->existingNrps();
        $newNrps = array_values(array_diff($nrps, $existingNrps));
        $missingSource = array_values(array_diff($existingNrps, $nrps));

        $masterChecks = [
            ['table' => 'PROJECT', 'column' => 'PROJECT STATUS USULAN'],
            ['table' => 'DEPARTEMEN', 'column' => 'DEPARTEMEN USULAN'],
            ['table' => 'JABATAN', 'column' => 'JABATAN USULAN'],
            ['table' => 'PERUSAHAAN', 'column' => 'PERUSAHAAN KONTRAK'],
        ];
        $missingMasters = [];
        foreach ($masterChecks as $masterCheck) {
            $table = $masterCheck['table'];
            $column = $masterCheck['column'];
            $values = array_values(array_unique(array_filter(array_map(
                fn ($row) => $this->clean($row[$column] ?? null),
                $statusByNrp + $contractByNrp,
            ))));
            $known = $this->knownMasterNames($table);
            $missing = array_values(array_diff($values, $known));
            if ($missing) {
                $missingMasters[$table] = $missing;
                $issues[] = [
                    'type' => 'MISSING_MASTER',
                    'message' => "{$table}: " . implode(', ', $missing),
                    'values' => $missing,
                ];
            }
        }

        return [
            'summary' => [
                'total_nrp' => count($nrps),
                'counts' => [
                    'status_rows' => count($statusRows),
                    'contract_rows' => count($contractRows),
                    'identity_rows' => count($identityRows),
                    'new_nrps' => count($newNrps),
                    'database_nrps_not_in_workbook' => count($missingSource),
                    'issues' => count($issues),
                    'missing_masters' => count($missingMasters),
                ],
            ],
            'missing_masters' => $missingMasters,
            'new_nrps' => $newNrps,
            'database_nrps_not_in_workbook' => $missingSource,
            'issues' => $issues,
        ];
    }

    private function sheetRows($sheet): array
    {
        $rows = $sheet->toArray(null, true, true, true);
        if (!$rows) return [];
        $headerRow = array_shift($rows);
        $headers = [];
        foreach ($headerRow as $column => $value) {
            $headers[$column] = trim((string) $value);
        }
        $result = [];
        foreach ($rows as $row) {
            $mapped = [];
            foreach ($headers as $column => $header) {
                if ($header !== '') $mapped[$header] = is_string($row[$column] ?? null) ? trim($row[$column]) : ($row[$column] ?? null);
            }
            if (($mapped['NRP'] ?? '') !== '') $result[] = $mapped;
        }
        return $result;
    }

    private function indexByNrp(array $rows, string $sheet, array &$issues): array
    {
        $indexed = [];
        foreach ($rows as $row) {
            $nrp = trim((string) ($row['NRP'] ?? ''));
            if ($nrp === '') continue;
            if (isset($indexed[$nrp])) {
                $issues[] = ['type' => 'DUPLICATE_NRP', 'message' => "{$sheet}: NRP duplikat {$nrp}"];
                continue;
            }
            $indexed[$nrp] = $row;
        }
        return $indexed;
    }

    private function validateDuplicateNrp(array $rows, string $sheet, array &$issues): void
    {
        $seen = [];
        foreach ($rows as $row) {
            $nrp = trim((string) ($row['NRP'] ?? ''));
            if ($nrp !== '' && isset($seen[$nrp])) {
                $issues[] = ['type' => 'DUPLICATE_NRP', 'message' => "{$sheet}: NRP duplikat {$nrp}"];
            }
            $seen[$nrp] = true;
        }
    }

    private function validateRows(array $rows, string $sheet, array $required, array &$issues): void
    {
        foreach ($rows as $nrp => $row) {
            foreach ($required as $field) {
                if ($this->clean($row[$field] ?? null) === '') {
                    $issues[] = ['type' => 'MISSING_FIELD', 'message' => "{$sheet} {$nrp}: field {$field} kosong"];
                }
            }
        }
    }

    private function existingNrps(): array
    {
        $table = DatabaseData::query()
            ->where('code_table_data', 'KARYAWAN')
            ->where('code_field_data', 'NRP')
            ->whereNull('date_end')
            ->pluck('value_data')
            ->map(fn ($value) => $this->clean($value))
            ->all();
        return array_values(array_unique($table));
    }

    private function knownMasterNames(string $table): array
    {
        $field = match ($table) {
            'PROJECT' => 'NAMA-PROJECT-PENDEK',
            'DEPARTEMEN' => 'DEPARTEMEN',
            'JABATAN' => 'JABATAN',
            'PERUSAHAAN' => 'NAMA-PERUSAHAAN-PENDEK',
            default => null,
        };
        if (!$field) return [];
        return DatabaseData::query()
            ->where('code_table_data', $table)
            ->where('code_field_data', $field)
            ->whereNull('date_end')
            ->pluck('value_data')
            ->map(fn ($value) => $this->clean($value))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    private function clean($value): string
    {
        return Str::upper(trim((string) ($value ?? '')));
    }
}
