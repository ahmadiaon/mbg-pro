<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\AbsensiEmployee;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class AbsensiExcellController extends Controller
{
    public function index()
    {
        
        return view('excell.index', [
            'title'         => 'Excel'
        ]);
    }
    function ekstrackAbsen($year, $month, $date, $id, $absensi){
        $timeA = false; //from 00 to 6
        $timeB = false; //from 06 to 12
        $timeC = false; //from 12 to 17
        $timeD = false; //from 17 to 24
        $statusAbsen;

        $dates = $year.'-'.$month.'-'.$date;

        $ketAbsensi;
        $hourEvening = array();
        $hourMorning = array();
        $length = Str::length( $absensi);
        $absens = str_split( $absensi, 5);

        foreach( $absens as $absen){
            $hour = str_split( $absen, 2);
            $hourInt    =  (int)$hour[0];
            if(( $hourInt >= 00) && ( $hourInt <= 5) ){
                $timeA = true;
            }else if(($hourInt >= 6)&&($hourInt <= 12) ){
                $timeB = true;
            }else if(($hourInt >=13)&&($hourInt <= 16) ){
                $timeC = true;
            }else if(( $hourInt >= 17) && ( $hourInt <= 23) ){
                $timeD = true;
            }

            
            if($timeD && $timeA){
                $statusAbsen = 'DS';
            }else if($timeC || $timeB){
                $statusAbsen = 'TA';
            }else if(!$timeA && $timeD){
                $statusAbsen = 'TA';
            }else if($timeA && !$timeD){
                $statusAbsen = 'TA';
            }else if(!$timeA && !$timeD){
                $statusAbsen = 'TC';
            }else{
                $statusAbsen = "unknown";
            }
            //sore true
            //pagi true
        }
        // dd($hourEvening);
        // AbsensiEmployee::create([
        //     'employee_id'   => $id,
        //     'date'      => $dates,
        //     'status'    => $statusAbsen,
        //     'cek_log'   => $absensi
        // ]);
        return   $statusAbsen;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'uploaded_file' => 'required'
        ]);
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A1', 'nama');

        

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'F', $column_limit );
            $startcount = 2;
            $data = array();

            $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH'];

            $tanggal = $sheet->getCell( 'C' . 3 )->getValue();
            $splitTanggal =  str_split( $tanggal, 1);

            //2022-07-01 ~ 2022-07-31
            //2022-07-01 ~ 2022-07-31


            $date_start =  $splitTanggal[8].$splitTanggal[9];
            $date_end   =  $splitTanggal[21].$splitTanggal[22] ;
            $month_start = $splitTanggal[5].$splitTanggal[6] ;
            $month_end   =$splitTanggal[18].$splitTanggal[19] ;
            $year_start = $splitTanggal[0].$splitTanggal[1].$splitTanggal[2].$splitTanggal[3];
            $year_end  = $splitTanggal[13].$splitTanggal[14].$splitTanggal[15].$splitTanggal[16];

            $month = 7;
            $year = 2022;

            // dd($year_end);
            // list tanggal 
            
            $tanggalAbsensi = array();

            $employees = array();
            $employees_count = (count($row_range) - 4)/2;
            $i= 5;

            // foreach employees
            for ($j=0; $j<$employees_count ;$j++ ) {
                $employeeName = $sheet->getCell( 'K' . $i )->getValue();
                $columnNow = $j + 2;
                $createSheet->setCellValue('A'.$columnNow, $employeeName);
                $absensies = array();
                $k=1;
                foreach($abjads as $abjad){
                    if($sheet->getCell(  $abjad . $i+1  )->getValue() > 0){
                        $absensi = $sheet->getCell( $abjad . $i+1 )->getValue();
                        $id = $sheet->getCell( 'C' . $i )->getValue();
                        $statusAbsen = AbsensiExcellController::ekstrackAbsen($year, $month,$k,  $id,  $absensi);
                        
                        $createSheet->setCellValue($abjads[$k+1].$columnNow, $statusAbsen.'  data : '.$absensi);
                        
                        $absensies[] = [
                            'tanggal' => $k,
                            'value'     =>  $sheet->getCell( $abjad . $i+1 )->getValue(),
                            'length'  =>  $statusAbsen
                        ];
                    }
                    $k++;
                }
                $employees[]=[
                    'id'    =>$sheet->getCell( 'C' . $i )->getValue(),
                    'name' => $employeeName,
                    'absensi'   => $absensies
                ];
                $i = $i+2;

            }
            $crateWriter = new Xls($createSpreadsheet);
            $crateWriter->save('employee.xlsx');
            dd( $employees);

            return $tanggal;
            foreach ( $row_range as $row ) {
                $data[] = [
                    'CustomerName' =>$sheet->getCell( 'A' . $row )->getValue(),
                    'Gender' => $sheet->getCell( 'B' . $row )->getValue(),
                    'Address' => $sheet->getCell( 'C' . $row )->getValue(),
                    'City' => $sheet->getCell( 'D' . $row )->getValue(),
                    'PostalCode' => $sheet->getCell( 'E' . $row )->getValue(),
                    'Country' =>$sheet->getCell( 'F' . $row )->getValue(),
                ];
                $startcount++;
            }
            return $data;
            DB::table('tbl_customer')->insert($data);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        
        return back()->withSuccess('Great! Data has been successfully uploaded.');
        return $request;
        return view('excell.index', [
            'title'         => 'Excel'
        ]);
    }
}
