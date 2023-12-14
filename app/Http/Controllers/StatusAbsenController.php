<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\StatusAbsen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class StatusAbsenController extends Controller
{
    public function indexPayrol()
    {
        // return 'aa';
        $status_absen = StatusAbsen::all();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'database-status-absen'
        ];
        return view('status_absen.index', [
            'title'         => 'Status Absen',
            'status_absen' => $status_absen,
            'layout'    => $layout
        ]);
    }

    public function exportDB()
    {
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        $row_ = 1;
        foreach ($tables as $name_table) {
            if ($name_table != 'migrations') {

                $columns = DB::getSchemaBuilder()->getColumnListing($name_table);
                $data_table = DB::table($name_table)->get();
                // dd($data_table);
                $header = 'INSERT INTO ' . $name_table . '(';
                if (!empty(count($data_table))) {
                    foreach ($columns as $name_columns) {
                        $header = $header . "`" . $name_columns . "`|";
                    }
                    $header = substr_replace($header, "", -1);
                    $header =  $header . ') VALUES ';
                    $createSheet->setCellValue('B' . $row_, $header);
                }

                $row_++;
                $content = "";
                foreach ($data_table as $item_data_table) {
                    $item_data_table = (array)$item_data_table;
                    $content = "(";
                    foreach ($columns as $name_columns) {
                        if(!empty($item_data_table[$name_columns])){
                            $content =  $content . "'" . $item_data_table[$name_columns] . "'|";
                        }else{
                            $content = $content . 'null'.'|';
                        }

                        
                    }
                    $content = substr_replace($content, "", -1);
                    $content = $content . ')|';
                    $createSheet->setCellValue('B' . $row_, $content);
                    $row_++;
                }
                if (!empty(count($data_table))) {
                    $content = substr_replace($content, "", -1);
                    $content = $content . ';';
                    $createSheet->setCellValue('B' . ($row_ - 1), $content);
                }
            }

            $row_++;
        }
        // dd($tables);
        $crateWriter = new Xlsx($createSpreadsheet);
        $name = 'file/absensi/export-karyawan-' . rand(99, 9999) . 'file.xlsx';
        $crateWriter->save($name);
        return response()->download($name);
    }
    public function anyData()
    {
        $data = StatusAbsen::orderBy('updated_at', 'asc')->get();

        return Datatables::of($data)
            ->addColumn('action', function ($model) {
                $uuid = $model->uuid;
                $delete = "'" . $uuid . "'";
                return '
            <div class="form-inline"> 
                <button onclick="edit(' . $delete . ')" type="button" class="btn btn-outline-primary mr-1">
                <i class="icon-copy ion-wrench"></i>
                </button>
                <button onclick="deletePrivilege(' . $delete . ')"  type="button" class="btn btn-outline-danger">
                <i class="icon-copy ion-trash-b"></i> 
                </button>
            </div>';
            })
            ->make(true);
    }

    public function export()
    {
        $arr_data = StatusAbsen::all();
        // dd($arr_data);
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A1', 'Database :');

        $createSheet->setCellValue('B1', 'Status Absen');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'Kode');
        $createSheet->setCellValue('C5', 'Deskripsi');
        $createSheet->setCellValue('D5', 'Perhitungan');

        $crateWriter = new Xlsx($createSpreadsheet);
        $name = 'file/absensi/database-status-absen-' . rand(99, 9999) . 'file.xlsx';
        $row = 6;
        $each = 1;
        foreach ($arr_data as $item) {
            $createSheet->setCellValue('A' . $row, $each);
            $createSheet->setCellValue('B' . $row, $item->status_absen_code);
            $createSheet->setCellValue('C' . $row, $item->status_absen_description);
            $createSheet->setCellValue('D' . $row, $item->math);
            $each++;
            $row++;
        }
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function import(Request $request)
    {
        $the_file = $request->file('uploaded_file');
        try {
            $createSpreadsheet = new spreadsheet();
            $createSheet = $createSpreadsheet->getActiveSheet();
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];
            $no_employee = 6;

            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                $data['status_absen_code'] = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue());
                $data['uuid'] = $data['status_absen_code'];
                $data['status_absen_description'] = $sheet->getCell('C' . $no_employee)->getValue();
                $data['math'] = $sheet->getCell('D' . $no_employee)->getValue();
                $data['date_start'] = '2000-01-01';
                if (!empty($data)) {
                    $store = StatusAbsen::updateOrCreate(['uuid' => $data['uuid']], $data);
                }
                $no_employee++;
            }
        } catch (Exception $e) {
            $error_code = $e;
            return back()->with('messageErr', 'file eror!');
        }
        return back();
    }

    public function storePayrol(Request $request)
    {
        $validatedData = $request->al();
        $validatedData['uuid'] = ResponseFormatter::toUUID($validatedData['status_absen_code']);
        $store = StatusAbsen::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return response()->json(['code' => 200, 'message' => 'Data Stored', 'data' => $store], 200);
    }
    public function showPayrol($uuid)
    {
        $status_absen = StatusAbsen::where('uuid', $uuid)->first();

        return response()->json(['code' => 200, 'message' => 'Data get', 'data' => $status_absen], 200);
    }
    public function delete(Request $request)
    {
        $data = ['deleted_at' => Carbon::now('Asia/Jakarta')];
        $store = StatusAbsen::where('uuid', $request->uuid)->delete();

        return response()->json(['code' => 200, 'message' => 'Data Deleted', 'data' => $store], 200);
    }
}
