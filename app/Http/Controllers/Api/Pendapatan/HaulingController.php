<?php

namespace App\Http\Controllers\Api\Pendapatan;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Hauling;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class HaulingController extends Controller
{
    public function store(Request $request)
    {

        $users = User::where('auth_login', $request->header('auth_login'))->first();
        $Q_latest_id_hauling = Hauling::orderBy('id', 'DESC')->first();
        // $Q_latest_id_hauling = Hauling::get();
        $data_form = [];


        foreach ($request->data as $field) {
            $data_form[$field['name']] = $field['value'];
        }

        $date = ResponseFormatter::toDate($data_form['tanggal_berangkat']);
        if (!$Q_latest_id_hauling) {
            $year = (string)$date->year;
            $id_hauling = $year[2] . $year[3] . ResponseFormatter::to2Digit($date->month) . ResponseFormatter::to2Digit($date->day) . '1';

            $data_form['datetime_creater'] = new Carbon();
            $data_form['code_data_creater'] = $users->employee_uuid;
        } elseif (!$data_form['id_hauling']) {
            $id_hauling = (int)$Q_latest_id_hauling->id_hauling + 1;
            $data_form['id_hauling'] = $id_hauling;
            $data_form['datetime_creater'] = new Carbon();
            $data_form['code_data_creater'] = $users->employee_uuid;
        } else {
            $data_form['code_data_editor'] = $users->employee_uuid;
            $data_form['datetime_editor'] = new Carbon();
        }

        $data_form['uuid'] = $data_form['id_hauling'];
        $data_form['tanggal_waktu_berangkat'] = ResponseFormatter::toDate($data_form['tanggal_berangkat'])->format('Y-m-d') . " " . $data_form['jam_berangkat'] . ":00";
        $data_form['tanggal_waktu_tiba'] = ResponseFormatter::toDate($data_form['tanggal_tiba'])->format('Y-m-d') . " " . $data_form['jam_tiba'] . ":00";

        $Q_store = Hauling::updateOrCreate(['uuid' => $data_form['uuid']], $data_form);


        return ResponseFormatter::ResponseJson($Q_store, 'store hauling', 200);
    }

    public function export(Request $request)
    {


        // $datetime = Carbon::createFromFormat('Y-m', $year . '-' . $month);
        // $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');

        $abjads = ResponseFormatter::abjads();

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A4', 'Nama');
        $createSheet->setCellValue('B4', 'NIK');
        $createSheet->setCellValue('C4', 'JABATAN');


        // merge kode batu
        $createSheet->mergeCells('K1:N1');
        // MERGE TANGGAL DATA
        $createSheet->mergeCells('K2:N2');
        // MERGE PEMILIK BATU        
        $createSheet->mergeCells('O1:R2');



        $createSheet->setCellValue('K1', 'LA-PD');
        $createSheet->setCellValue('K2', '22 November 2024');
        $createSheet->setCellValue('O1', 'PT. KBU');



        $styleArray_employee = array(
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'FF5733'
                ]
            ],
        );

        $style_border_thin = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $style_border_thin_OUTLINE = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $style_border_standart = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $style_text_center = array(
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        );

        $style_text_BOLD = array(
            'font' => [
                'bold' => true,
            ],
        );
        $style_text_UNBOLD = array(
            'font' => [
                'bold' => false,
            ],
        );

        $style_text_TIMES_NEW_ROMAN = array(
            'font' => [
                'size' => 12,
                'name' => 'Times New Roman',
            ],
        );

        $style_text_SIZE_18 = array(
            'font' => [
                'size' => 18,
            ],
        );

        $style_text_justify_wrap = array(
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY, // Justify text
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true, // Wrap text
            ],
        );

        
        $createSheet->getStyle('A1:R52')->applyFromArray($style_text_TIMES_NEW_ROMAN);






        $createSheet->getStyle('O1:O2')->applyFromArray($styleArray_employee);
        $createSheet->getStyle('O1:O2')->applyFromArray($style_text_center);
        $createSheet->getStyle('K1:R2')->applyFromArray($style_border_standart);
        $createSheet->getStyle('K1:R2')->applyFromArray($style_text_center);



        // BERITA ACARA HARIAN HASIL TIMBANGAN BATUBARA

        // MERGE

        $createSheet->mergeCells('A4:R4');
        $createSheet->mergeCells('A5:R5');


        $createSheet->setCellValue('A4', 'BERITA ACARA HARIAN');
        $createSheet->setCellValue('A5', 'HASIL TIMBANGAN BATUBARA');

        $createSheet->getStyle('A4:A5')->applyFromArray($style_text_center);
        $createSheet->getStyle('A4:A5')->applyFromArray($style_text_BOLD);


        // pada hari ini

        $createSheet->setCellValue('A7', 'Pada Hari ini');
        $createSheet->setCellValue('A8', 'Tanggal');

        $createSheet->setCellValue('D7', ': Selasa,');
        $createSheet->setCellValue('D8', ': 12 Februari 2024');


        $createSheet->setCellValue('A10', 'Kami yang bertandatangan dibawah ini, masing-masing:');


        $createSheet->setCellValue('B13', 'NRP');

        $createSheet->mergeCells('B12:D12');
        $createSheet->mergeCells('B13:D13');
        $createSheet->mergeCells('B14:D14');
        $createSheet->mergeCells('B15:D15');

        $createSheet->mergeCells('E12:J12');
        $createSheet->mergeCells('K12:Q12');


        $createSheet->mergeCells('E13:J13');
        $createSheet->mergeCells('K13:Q13');

        $createSheet->mergeCells('E14:J14');
        $createSheet->mergeCells('K14:Q14');

        $createSheet->mergeCells('E15:J15');
        $createSheet->mergeCells('K15:Q15');


        $createSheet->setCellValue('B14', 'Nama');

        $createSheet->setCellValue('B15', 'Jabatan');
        $createSheet->setCellValue('E12', 'Shift 1');
        $createSheet->setCellValue('K12', 'Shift 2');

        // value shift 1
        $createSheet->setCellValue('E13', 'MBLE-0422003');
        $createSheet->setCellValue('E14', 'Ahmadi');
        $createSheet->setCellValue('E15', 'IT Officer');

        // value shift 2
        $createSheet->setCellValue('K13', 'MBLE-0422004');
        $createSheet->setCellValue('K14', 'Udin Petot');
        $createSheet->setCellValue('K15', 'Admin Bridge');


        $createSheet->getStyle('B12:Q15')->applyFromArray($style_border_thin);
        $createSheet->getStyle('B12:Q15')->applyFromArray($style_text_BOLD);        
        $createSheet->getStyle('E13:Q15')->applyFromArray($style_text_UNBOLD);



        $createSheet->mergeCells('A17:R18');
        $createSheet->setCellValue('A17', 'Menerangkan dengan sebenarnya, telah melakukan penimbangan batubara pada areal Box Curvert Jembatan Timbangan Site Paring Lahung, dengan hasil sebagai berikut:');

        $createSheet->getStyle('A17:R18')->applyFromArray($style_text_justify_wrap);


        $createSheet->mergeCells('B20:I20');
        $createSheet->mergeCells('J20:Q20');


        $createSheet->mergeCells('B21:D21');
        $createSheet->mergeCells('B22:D22');

        $createSheet->mergeCells('E21:I21');
        $createSheet->mergeCells('E22:I22');

        $createSheet->mergeCells('J21:L21');
        $createSheet->mergeCells('J22:L22');

        $createSheet->mergeCells('M21:Q21');
        $createSheet->mergeCells('M22:Q22');


        $createSheet->mergeCells('B24:D24');
        $createSheet->mergeCells('B25:D25');
        $createSheet->mergeCells('B26:D26');

        $createSheet->mergeCells('E24:M24');
        $createSheet->mergeCells('E25:M25');
        $createSheet->mergeCells('E26:M26');

        $createSheet->setCellValue('B20', 'Awal Penimbangan');
        $createSheet->setCellValue('J20', 'Akhir Penimbangan');
        $createSheet->setCellValue('B21', 'Hari, Tanggal');
        $createSheet->setCellValue('B22', 'Pukul');

        
        $createSheet->getStyle('B20:Q20')->applyFromArray($style_text_center); 
        $createSheet->getStyle('B20:Q20')->applyFromArray($style_text_BOLD); 


        $createSheet->setCellValue('E21', 'Senin, 20 Januari 2024');
        $createSheet->setCellValue('E22', '08:00');


        $createSheet->setCellValue('J21', 'Hari, Tanggal');
        $createSheet->setCellValue('J22', 'Pukul');

        $createSheet->setCellValue('M21', 'Senin, 20 Januari 2024');
        $createSheet->setCellValue('M22', '08:00');

        $createSheet->getStyle('B20:Q22')->applyFromArray($style_border_thin);


        $createSheet->setCellValue('B24', 'Pemilik Batu');
        $createSheet->setCellValue('B25', 'Kode Batu');
        $createSheet->setCellValue('B26', 'Jenis Batu');

        $createSheet->setCellValue('E24', 'PT. KBU');
        $createSheet->setCellValue('E25', 'LA-PD');
        $createSheet->setCellValue('E26', 'RAW');

        $createSheet->getStyle('B24:M26')->applyFromArray($style_border_thin);


        // GRAND TOTAL

        $createSheet->setCellValue('B28', 'No. ');
        $createSheet->setCellValue('B29', '1');
        $createSheet->setCellValue('B30', '2');
        $createSheet->setCellValue('B32', 'GRAND TOTAL');
        $createSheet->setCellValue('C28', 'SHIFT');         
        $createSheet->setCellValue('C29', 'Shift 1');
        $createSheet->setCellValue('C30', 'Shift 2');
        $createSheet->setCellValue('I28', 'RITASE');                
        $createSheet->setCellValue('I29', '1');
        $createSheet->setCellValue('I30', '2');
        $createSheet->setCellValue('K28', 'TONASE');        
        $createSheet->setCellValue('K29', '2349,67');
        $createSheet->setCellValue('K30', '134,42');
        $createSheet->setCellValue('M28', 'LOKASI STOKPILE');            
        $createSheet->setCellValue('M29', 'Stokpile 4');
        $createSheet->setCellValue('M30', 'Stokpile 4');            
        $createSheet->setCellValue('I32', '32');
        $createSheet->setCellValue('I33', '30234,86');      
        $createSheet->setCellValue('M32', 'Rit');
        $createSheet->setCellValue('M33', 'MT');

        
        $createSheet->mergeCells('C28:H28');
        $createSheet->mergeCells('C29:H29');
        $createSheet->mergeCells('C30:H30');
        $createSheet->mergeCells('C31:H31');
        $createSheet->mergeCells('I28:J28');
        $createSheet->mergeCells('I29:J29');
        $createSheet->mergeCells('I30:J30');        
        $createSheet->mergeCells('I31:J31');
        $createSheet->mergeCells('K28:L28');
        $createSheet->mergeCells('K29:L29');
        $createSheet->mergeCells('K30:L30');        
        $createSheet->mergeCells('K31:L31');
        $createSheet->mergeCells('M28:Q28');
        $createSheet->mergeCells('M29:Q29');
        $createSheet->mergeCells('M30:Q30');
        $createSheet->mergeCells('M31:Q31');
        $createSheet->mergeCells('M32:Q32');
        $createSheet->mergeCells('M33:Q33');
        $createSheet->mergeCells('I32:L32');
        $createSheet->mergeCells('I33:L33');
        $createSheet->mergeCells('B32:H33');
        
        $createSheet->getStyle('B28:Q33')->applyFromArray($style_border_thin);
        $createSheet->getStyle('B28:Q33')->applyFromArray($style_text_BOLD);        
        $createSheet->getStyle('B29:Q31')->applyFromArray($style_text_UNBOLD);      
        $createSheet->getStyle('B32:Q33')->applyFromArray($style_text_SIZE_18); 
        $createSheet->getStyle('B32:Q33')->applyFromArray($style_text_center);

        
        $createSheet->setCellValue('A35', 'Demikian Berita Acara ini kami buat dengan sebenarnya untuk dipergunakan sebagaimana mestinya');
        $createSheet->mergeCells('A35:R35');

        $createSheet->setCellValue('A37', 'Paring Lahung, Minggu 21 Januari 2024');   
        $createSheet->mergeCells('A37:R37');      
        $createSheet->getStyle('A37:R37')->applyFromArray($style_text_BOLD); 
        $createSheet->getStyle('A37:R37')->applyFromArray($style_text_center);  


        
        $createSheet->setCellValue('A38', 'dibuat oleh');
        $createSheet->setCellValue('E38', 'diperiksa oleh');
        $createSheet->setCellValue('J38', 'diketahui oleh');
        $createSheet->setCellValue('A42', 'AHMADI');
        $createSheet->setCellValue('A43', 'Admin Timbangan');
        $createSheet->setCellValue('E42', 'BAHRUNI');
        $createSheet->setCellValue('E43', 'Foreman Hauling');
        $createSheet->setCellValue('J42', 'SUKANA');
        $createSheet->setCellValue('J43', 'Head Port');

        $createSheet->mergeCells('A38:D38');        
        $createSheet->mergeCells('E38:I38');
        $createSheet->mergeCells('J38:R38');  

        
        $createSheet->mergeCells('A39:D41');      
        $createSheet->mergeCells('E39:I41');
        $createSheet->mergeCells('J39:N41');         
        $createSheet->mergeCells('O39:R41');  

        $createSheet->mergeCells('A42:D42');      
        $createSheet->mergeCells('E42:I42');
        $createSheet->mergeCells('J42:N42');         
        $createSheet->mergeCells('O42:R42');  
        
        $createSheet->mergeCells('A43:D43');      
        $createSheet->mergeCells('E43:I43');
        $createSheet->mergeCells('J43:N43');         
        $createSheet->mergeCells('O43:R43');  
        
        $createSheet->getStyle('A38:R43')->applyFromArray($style_border_thin);        
        $createSheet->getStyle('A38:R43')->applyFromArray($style_text_center);         
        $createSheet->getStyle('A42:R42')->applyFromArray($style_text_BOLD); 






























        $createSheet->getStyle('A1:R51')->applyFromArray($style_border_thin_OUTLINE);


        $createSheet->getPageMargins()->setTop(0.3);
        $createSheet->getPageMargins()->setRight(0.5);
        $createSheet->getPageMargins()->setLeft(0.5);
        $createSheet->getPageMargins()->setBottom(0);

        // HEADER Y FOOTER
        $createSheet->getPageMargins()->setHeader(0);
        $createSheet->getPageMargins()->setFooter(0);

        $row['end_row'] = 26;
        for ($i = 0; $i < $row['end_row']; $i++) {
            $createSheet->getColumnDimension($abjads[$i])->setWidth(5.1);
        }

        // Set the paper size to A4
        $createSheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);


        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/hauling/timbangan/Berita Acara Timbangan 2024-02-12 ' . '-' . rand(99, 9999) . '-file.xls';
        $crateWriter->save($name);


        return ResponseFormatter::ResponseJson($name, 'file name excel export', 200);
    }

    public function get(Request $request)
    {
        // batasi pengambilannya hanya dari jam 6 tanggal hari ini, jika hari ini jam < 6 ambil dari hari sebelumnya jam 6
        // filter shift
        //
        //today 06:00
        if ($request->id_hauling) {
            $data_request = $request->id_hauling;
        }


        if ($request->id_hauling) {
            $Q_get_data = Hauling::where('id_hauling', $request->id_hauling)->first();
            return ResponseFormatter::ResponseJson($Q_get_data, 'store hauling', 200);
        }

        $db_session = session()->get('db_local_storage');

        $data_form = [];
        foreach ($request->data as $field) {
            $data_form[$field['name']][] = $field['value'];
        }

        $date_range = explode(" - ", $data_form['filter_range'][0]);
        $dateRange = [
            'start' => ResponseFormatter::excelToDate($date_range[0]),
            'end' => ResponseFormatter::excelToDate($date_range[1]),
        ];


        $data_datatable = [
            'pemilik_batu' => [],
            'code_data_driver' => [],
            'code_data_unit' => [],
            'company_hauler' => [],
            'kode_batu' => [],
            'jenis_batu' => [],
            'kondisi_batu' => [],
            'lokasi_muat' => [],
            'lokasi_dumping' => [],
            'lokasi_stockpile' => [],
            'shifts' => [],
        ];

        $data_return = [
            'list' => [],
            'data' => [],
            'filter' => []
        ];
        $Q_data = Hauling::where('tanggal_waktu_tiba', '>=', $dateRange['start'])
            ->where('tanggal_waktu_tiba', '<=', $dateRange['end'])
            ->get();


        if ($Q_data->count() > 0) {
            foreach ($Q_data as $data) {
                $data_datatable['company_hauler'][$db_session['employees'][$data->code_data_driver]['company_uuid']][] = $data->id_hauling;
                $data_datatable['pemilik_batu'][$data->pemilik_batu][] = $data->id_hauling;
                $data_datatable['code_data_unit'][$data->code_data_unit][] = $data->id_hauling;
                $data_datatable['code_data_driver'][$data->code_data_driver][] = $data->id_hauling;
                $data_datatable['kode_batu'][$data->kode_batu][] = $data->id_hauling;
                $data_datatable['jenis_batu'][$data->jenis_batu][] = $data->id_hauling;
                $data_datatable['kondisi_batu'][$data->kondisi_batu][] = $data->id_hauling;
                $data_datatable['lokasi_muat'][$data->lokasi_muat][] = $data->id_hauling;
                $data_datatable['lokasi_dumping'][$data->lokasi_dumping][] = $data->id_hauling;
                $data_datatable['lokasi_stockpile'][$data->lokasi_stockpile][] = $data->id_hauling;

                $data_return['list'][] = $data->id_hauling;
                $data_return['data'][$data->id_hauling] = $data;

                if (ResponseFormatter::getTIme($data->tanggal_waktu_tiba) >= '17:00') {
                    $data_datatable['shifts']['Shift 2'][] = $data->id_hauling;
                } else {
                    $data_datatable['shifts']['Shift 1'][] = $data->id_hauling;
                }
            }
        }




        $data_return['filter'] = $data_datatable;


        return ResponseFormatter::ResponseJson($data_return, 'store hauling', 200);
    }

    public function delete(Request $request)
    {
        $Q_delete = Hauling::where('id_hauling', $request->data)->delete();
        return ResponseFormatter::ResponseJson($Q_delete, 'store hauling', 200);
    }
}
