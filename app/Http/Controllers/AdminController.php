<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function exportTable($table_name){


        $arr_table_name = [
            'purchase_orders',
            'users',
            'pohs',
            'positions',
            'departments',
            'religions',
            'hour_meter_prices',
            'mines',
            'absensi_employees',
            'statuses',
            'database_statuses',
            'roasters',
            'companies',
            'vehicles',
            'coal_types',
            'locations',
            'brands',
            'brand_types',
            'employee_absens',
            'units',
            'vehicle_problems',
            'vehicle_breakdown_details',
            'user_details',
            'user_education',
            'vehicle_tracks',
            'vehicle_hms',
            'user_religions',
            'user_addresses',
            'vehicle_statuses',
            'user_healths',
            'hour_meters',
            'pits',
            'user_experiences',
            'over_burden_operators',
            'over_burdens',
            'over_burden_lists',
            'employee_salaries',
            'over_burden_notes',
            'employees',
            'haulings',
            'hauling_setups',
            'employee_roasters',
            'employee_companies',
            'over_burden_flits',
            'group_vehicles',
            'employee_total_hm_months',
            'status_absens',
            'payment_groups',
            'galeries',
            'user_privileges',
            'privileges',
            'user_licenses',
            'user_dependents',
            'atribut_sizes',
            'safety_employees',
            'coal_froms',
            'employee_tonases',
            'payments',
            'employee_payments',
            'employee_hour_meter_days'
        ];

        /*

        foreach($arr_table_name as $tb_name){
            $tables = DB::getSchemaBuilder()->getColumnListing($tb_name);
            $data = DB::table($tb_name)->get();

            if($data->count()  > 0){
                $text_column = '';
            foreach($tables as $column){
                $text_column = $text_column.','.$column;
            }

            $text_column = ltrim($text_column, ',');
            rtrim($text_column, ", ");
            echo 'insert into '.$tb_name.' ('.$text_column.') VALUES </br>';
            
            foreach($data as $dt){
                $text_data_column = '';
                foreach($tables as $column){
                    $text_data_column = $text_data_column.',"'.$dt->$column.'"';
                    
                }
                $text_data_column = ltrim($text_data_column, ',');
                echo "(".$text_data_column."),</br>";
               
            }
            }
            

            


        }
        die;


        */

        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV'];
       
        foreach($arr_table_name as $tb_name){
            $createSpreadsheet = new spreadsheet();
            $createSheet = $createSpreadsheet->getActiveSheet();
            $tables = DB::getSchemaBuilder()->getColumnListing($tb_name);

            $row = 0;
            foreach($tables as $table){
                $createSheet->setCellValue($abjads[$row].'4', $table);  
                $row++; 

                $data = DB::table($tb_name)->get();

                if($data->count()  > 0){
                    
                    $column = 5;
                    
                    foreach($data as $cd){
                        $row_c = 0;
                        foreach($tables as $table){
                            $createSheet->setCellValue($abjads[$row_c].$column, $cd->$table);  
                            $row_c++;
                        }
                        $column++;
                    } 
                }
            }
            $crateWriter = new Xls($createSpreadsheet);
            $name = 'file/data/'.$tb_name.'-'.rand(99,9999).'-file.xlsx';
            $crateWriter->save($name);
            // return response()->download($name);

        }
        die;

       
       
       
        // ======================================                                   EXTRACT TO EXCELL
        $createSpreadsheet = new spreadsheet();
        $createSpreadsheet->setActiveSheetIndex(1);
        $createSpreadsheet->getActiveSheet()->setTitle('Second tab');
        $createSheet = $createSpreadsheet->getActiveSheet();
        // -----------------------------------------------------------------------nama column
    
        
        $tables = DB::getSchemaBuilder()->getColumnListing($table_name);
        $data = DB::table($table_name)->get();
        $row = 0;
        foreach($tables as $table_column){
            $createSheet->setCellValue($abjads[$row].'4', $table_column);           
            $row++;
        }
        
        
        
        

        if($data->count() > 0){
            $column = 5;
            foreach($data as $item){
                $row = 0;
                foreach($tables as $table_column){
                    $createSheet->setCellValue($abjads[$row].$column, $item->$table_column);           
                    $row++;
                }

                $column++;
            }
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/extrack-karyawan-'.rand(99,9999).'-file.xlsx';
        $crateWriter->save($name);
        return response()->download($name);
        // foreach()
        dd($tables);


    }
    public function index()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'listEmployee'
        ];

        return view('superadmin.index', [
            'title'         => 'Beranda',
            'layout'        => $layout
        ]);
    }
    public function indexHR()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'listEmployee'
        ];
        return view('hr.index', [
            'title'         => 'Beranda HR',
            'layout'        => $layout
        ]);
    }

    public function listEmployee()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => false,
            'javascript_form'       => false,
            'active'                        => 'listEmployee'
        ];

        return view('hr.listEmployee', [
            'title'         => 'List Employee',
            'layout'       => $layout
        ]);
    }

}
