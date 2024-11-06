<?php

namespace App\Helpers;

use App\Models\Aktivity\Aktivity;
use App\Models\CoalFrom;
use App\Models\Company;
use App\Models\Department;
use App\Models\Dictionary;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeOut;
use App\Models\Payment\PaymentGroup;
use App\Models\Poh;
use App\Models\Position;
use App\Models\Premi;
use App\Models\Religion;
use App\Models\Safety\AtributSize;
use App\Models\StatusAbsen;
use App\Models\Support\DataSource;
use App\Models\UserDetail\UserDetail;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ResponseFormatter
{
  protected static $response = [
    'meta' => [
      'code' => 200,
      'status' => 'success',
      'message' => null
    ],
    'data' => null
  ];

  public static function isString($string)
  {
    $string = preg_replace('/[^A-Za-z0-9\-_&]/', ' ', $string);
    return $string;
  }

  public static function dateToArray($dateString)
  {
    $date = Carbon::parse($dateString);

    return $dateArray = [
      'year' => $date->year,
      'month' => $date->month,
      'day' => $date->day
    ];
  }

  public static function convertToDate($value)
  {
    // Check if the value is a string and in the format yyyy-mm-dd
    if (is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
      return $value; // It's already in yyyy-mm-dd format
    }

    // If the value is a number, convert it to yyyy-mm-dd
    if (is_numeric($value)) {
      // Convert the number to a Carbon instance, assuming the number is an Excel serial date
      // Adjust the base date if needed; this example assumes it's an Excel date.
      $date = Carbon::createFromFormat('Y-m-d', '1899-12-30')->addDays($value);
      return $date->format('Y-m-d');
    }

    // If the value is not valid, return null or throw an exception
    return null;
  }

  public static function monthSort($stringMonth)
  {
    $months = [
      "Januari" => 1,
      "Februari" => 2,
      "Maret" => 3,
      "April" => 4,
      "Mei" => 5,
      "Juni" => 6,
      "Juli" => 7,
      "Agustus" => 8,
      "September" => 9,
      "Oktober" =>  10,
      "November" => 11,
      "Desember" => 12,
    ];

    return $months[$stringMonth];
  }

  public static function abjads()
  {
    $abjads = [];

    // Single letters A to Z
    foreach (range('A', 'Z') as $char) {
      $abjads[] = $char;
    }

    // Double letters AA to ZZ
    foreach (range('A', 'Z') as $first) {
      foreach (range('A', 'Z') as $second) {
        $abjads[] = $first . $second;
      }
    }

    return $abjads;
  }

  public static function getDateToday()
  {
    return Carbon::today()->isoFormat('Y-MM-DD');
  }

  public static function isFormulaExcell($getOldCalculatedValue, $getValue)
  {
    if (gettype($getValue) == 'string') {
      return $getOldCalculatedValue;
    } else {
      return $getValue;
    }
  }
  public static function createIndexArray($array, $key)
  {
    $data = [];
    foreach ($array as $item) {
      $data[$item->$key] = $item;
    }
    return $data;
  }

  public static function success($data = null, $message = null)
  {
    self::$response['meta']['message'] = $message;
    self::$response['data'] = $data;

    return response()->json(self::$response, self::$response['meta']['code']);
  }

  public static function error($data = null, $message = null, $code = 400)
  {
    self::$response['meta']['status'] = 'error';
    self::$response['meta']['code'] = $code;
    self::$response['meta']['message'] = $message;
    self::$response['data'] = $data;

    return response()->json(self::$response, self::$response['meta']['code']);
  }

  public static function toDate($data = null)
  {
    $date_end = explode(" ", $data);
    $months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $result = $date_end[2] . "-" . array_search($date_end[1], $months) . "-" . $date_end[0];
    $result = Carbon::createFromFormat('Y-m-d',  $result);
    return $result;
  }

  public static function getTIme($data = null)
  {
    if ($data) {
      $cls_date =  Carbon::parse($data);
      $timeOnly = $cls_date->format('H:i');
      return $timeOnly;
    }
    return $time = null;
  }

  public static function excelToDateArray($date = null)
  {


    if ($date != null) {
      if ($date == '') {
        return null;
      }
      if (gettype($date) == 'string') {
        $cls_date = new DateTime($date);
        $return = $cls_date->format('Y-m-d');
      } else {
        $miliseconds = ($date - (25567 + 2)) * 86400 * 1000;
        $seconds = $miliseconds / 1000;
        $return = date("Y-m-d", $seconds);
      }
      $result = Carbon::createFromFormat('Y-m-d',  $return);
      $date = [
        'year' => $result->isoFormat('Y'),
        'month' => $result->isoFormat('MM'),
        'day' => $result->isoFormat('DD'),
      ];
      return $date;
    } else {
      return null;
    }
  }

  public static function getMonthName($data = null)
  {
    $data = (int)$data;
    $months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $result = $months[$data];

    return $result;
  }
  public static function getNumArray($index, $array)
  {
    return array_search($index, $array);
  }

  public static function getDatesBetween($startDate, $endDate)
  {
    // Pastikan tanggal dalam format Carbon
    $start = Carbon::parse($startDate);
    $end = Carbon::parse($endDate);

    // Tambahkan satu hari pada tanggal akhir untuk memastikan tanggal akhir juga disertakan
    $end = $end->addDay();

    // Buat DatePeriod
    $interval = new DateInterval('P1D'); // Interval 1 hari
    $datePeriod = new DatePeriod($start, $interval, $end);

    // Array untuk menyimpan hasil tanggal
    $dates = [];

    // Loop melalui DatePeriod dan ambil tanggal (day)
    foreach ($datePeriod as $date) {
      $dates[] = $date->format('Y-m-d'); // Atau gunakan 'd' untuk hanya mendapatkan hari
    }

    return $dates;
  }

  public static function toFloat($data)
  {

    $data = str_replace(',', '.', $data);
    $data = (float)$data;
    return $data;
  }

  public static function toNumber($data)
  {

    $data = preg_replace("/[^0-9]/", "", $data);
    $data = (int)$data;
    return $data;
  }

  public static function ResponseJson($data, $message, $code)
  {
    if (empty($data)) {
      return response()->json(['code' => 204, 'message' => "data not found", 'data' => null], $code);
    }
    return response()->json(['code' => $code, 'message' => $message, 'data' => $data], $code);
  }



  public static function toJson($data, $message = "success")
  {
    return response()->json(['code' => 200, 'message' => $message, 'data' => $data], 200);
  }

  public static function getEndDay($year_month)
  {
    $datetime = Carbon::createFromFormat('Y-m-d', $year_month . '-01');
    $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
    return $day_month;
  }
  public static function getEndDayFromDate($year_month)
  {
    $datetime = Carbon::parse('2024-07-15');
    $day_month = Carbon::parse($year_month)->endOfMonth()->isoFormat('YYYY-MM-DD');
    return $day_month;
  }
  public static function getStartDayFromDate($year_month)
  {
    // Parse the provided year and month and get the first day of the month
    $first_day_month = Carbon::parse($year_month)->startOfMonth()->isoFormat('YYYY-MM-DD');
    return $first_day_month;
  }

  public static function toUUID($uuid)
  {
    $uuid = ResponseFormatter::isString($uuid);
    return strtoupper(str_replace(' ', '-', str_replace('.', '-', str_replace('/', '-',  str_replace('_', '-',  $uuid)))));
  }

  public static function toUuidLower($uuid)
  {
    $uuid = ResponseFormatter::isString($uuid);
    return strtolower(str_replace(' ', '_', str_replace('.', '_', str_replace('/', '_', $uuid))));
  }

  public static function data_employee_talent()
  {
    $employee_talent = UserDetail::join('employees', 'employees.user_detail_uuid', 'user_details.uuid')
      ->leftJoin('user_healths', 'user_healths.user_detail_uuid', 'user_details.uuid')
      ->leftJoin('user_addresses', 'user_addresses.user_detail_uuid', 'user_details.uuid')
      ->leftJoin('user_education', 'user_education.user_detail_uuid', 'user_details.uuid')
      ->leftJoin('user_licenses', 'user_licenses.user_detail_uuid', 'user_details.uuid')
      ->leftJoin('user_dependents', 'user_dependents.user_detail_uuid', 'user_details.uuid')
      ->where('employees.employee_status', 'talent')
      ->whereNotNull('user_details.name')
      ->get();

    $arr_employee_talent = [];

    foreach ($employee_talent as $item) {
      $arr_employee_talent[$item->nik_employee]  = $item;
    }

    $employee_document = Employee::join('employee_documents', 'employee_documents.employee_uuid', 'employees.nik_employee')
      ->where('employees.employee_status', 'talent')
      ->get('employee_documents.*');

    foreach ($employee_document as $item) {
      $name_col = $item->document_table_name;
      if (!empty($arr_employee_talent[$item->employee_uuid])) {
        $arr_employee_talent[$item->employee_uuid]->$name_col = $item->document_path;
      }
    }

    return $arr_employee_talent;
  }

  public static function numberToAlfhabet($letters)
  {
    $alphabet = range('A', 'Z');

    return $alphabet[$letters];
  }


  public static function toValueRupiah($value_rupiah)
  {
    $integer_value = ResponseFormatter::toNumber($value_rupiah);
    $hasil_rupiah = "Rp " . number_format($integer_value, 0, ',', '.');
    return $hasil_rupiah;
  }


  public static function setAllSessionWeb()
  {
    $data_datatable_database = [];
    // $arr_employees = Employee::data_employee();

    // foreach($arr_employees->first()->toArray() as $index_first=>$item_arr_employees){
    //   $data_datatable_database['database']['data-schema']['employees'][] = $index_first;
    // }
    // $data_datatable_database['database']['data-schema']['employees'][] = 'full_name';


    // $arr_employees = Employee::data_employee();

    // $arr_employees = $arr_employees->keyBy(function ($item) {
    //   return strval($item->nik_employee);
    // });










    $data_employee_out = EmployeeOut::all();
    $data_employee_out = $data_employee_out->keyBy(function ($item) {
      return strval($item->employee_uuid);
    });

    $arr_religion = Religion::all();
    $arr_religion = $arr_religion->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $arr_status_absens = StatusAbsen::all();
    $arr_status_absens = $arr_status_absens->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $arr_math_status_absens = StatusAbsen::groupBy('math')->get('math');
    $arr_math_status_absens = $arr_math_status_absens->keyBy(function ($item) {
      return strval($item->math);
    });


    $arr_coal_from = CoalFrom::all();
    $arr_coal_from = $arr_coal_from->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $arr_dictionary = Dictionary::all();
    $arr_dictionary = $arr_dictionary->keyBy(function ($item) {
      return strval($item->database);
    });



    $data_arr_company_coal_from = [];
    foreach ($arr_coal_from as $item_arr_status_absens) {
      $data_arr_company_coal_from[$item_arr_status_absens->company_uuid][$item_arr_status_absens->uuid] = $item_arr_status_absens;
    }

    $arr_companies = Company::all();
    $arr_companies_obj = $arr_companies->keyBy(function ($item) {
      return strval($item->uuid);
    });
    foreach ($arr_companies_obj as $item_arr_companies) {
      if ($item_arr_companies->uuid != "MBLE") {
        $item_arr_companies->coal_from = $data_arr_company_coal_from[$item_arr_companies->uuid];
      }
    }

    // session()->put('data_employees', $arr_employees);
    session()->put('data_companies', $arr_companies);

    $arr_position = Position::all();
    $arr_position = $arr_position->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $arr_departments = Department::all();
    $arr_departments = $arr_departments->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $arr_pohs = Poh::all();
    $arr_pohs = $arr_pohs->keyBy(function ($item) {
      return strval($item->uuid);
    });


    $employees = DB::getSchemaBuilder()->getColumnListing('employees');
    $user_details = DB::getSchemaBuilder()->getColumnListing('user_details');
    $atribut_sizes = DB::getSchemaBuilder()->getColumnListing('atribut_sizes');
    $data_sources = DB::getSchemaBuilder()->getColumnListing('data_sources');

    // foreach ($arr_employees as $employee) {
    //   $employee->full_name = $employee->nik_employee . " | " . $employee->name . " | " . $employee->company_uuid . " | " . $employee->site_uuid;
    //   foreach ($data_datatable_database['database']['data-schema']['employees'] as $item_schema) {
    //     $data_datatable_database['database']['data-table']['employees'][$employee->nik_employee][$item_schema] = [
    //       'code_data' => $employee->nik_employee,
    //       'description' => $employee[$item_schema],
    //       'field' => $item_schema,
    //       'table_name' => 'employees',
    //       'type_data' => 'data',
    //       'value_field' => $employee[$item_schema],
    //     ];
    //   }
    // }
    // $data_datatable_database['database']['data-schema']['employees'] = [];


    /*
    uuid = code_data,
    name_atribut = description
    size = table_name
    *field = data,
    value_atribut = value_data,

    */
    $arr_status_recruitment = AtributSize::all();
    $data_atribut_size = [];
    $data_table_field = [];

    foreach ($arr_status_recruitment as $item_status_recruitment) {
      $data_datatable_database['database']['data-table'][$item_status_recruitment->size][$item_status_recruitment->size . "-" . $item_status_recruitment->uuid]['CODE'] = [
        'code_data' => $item_status_recruitment->size . "-" . $item_status_recruitment->uuid,
        'description' => $item_status_recruitment->name_atribut,
        'field' => 'data-atribut-size',
        'table_name' => $item_status_recruitment->size,
        'type_data' => 'data',
        'value_field' => $item_status_recruitment->uuid,
      ];
      $data_datatable_database['database']['data-table'][$item_status_recruitment->size][$item_status_recruitment->size . "-" . $item_status_recruitment->uuid]['DESCRIPTION'] = [
        'code_data' => $item_status_recruitment->size . "-" . $item_status_recruitment->uuid,
        'description' => $item_status_recruitment->name_atribut,
        'field' => 'data-atribut-size',
        'table_name' => $item_status_recruitment->size,
        'type_data' => 'data',
        'value_field' => $item_status_recruitment->name_atribut,
      ];
      $data_datatable_database['database']['data-table'][$item_status_recruitment->size][$item_status_recruitment->size . "-" . $item_status_recruitment->uuid]['VALUE'] = [
        'code_data' => $item_status_recruitment->size . "-" . $item_status_recruitment->uuid,
        'description' => $item_status_recruitment->name_atribut,
        'field' => 'data-atribut-size',
        'table_name' => $item_status_recruitment->size,
        'type_data' => 'data',
        'value_field' => $item_status_recruitment->value_atribut,
      ];
    }



    $arr_aktivity = Aktivity::all();
    $data_datatable_database['database']['data-table']['test-one'] = $arr_aktivity->where('field', 'GROUP-FORM');
    $search = [
      'field' => 'GROUP-FORM',
      'key' => 'code_data'
    ];

    foreach ($data_datatable_database['database']['data-table']['test-one'] as $data_search) {
      $data_datatable_database['database']['data-search'][$search['field']][$data_search->value_field][] = $data_search->code_data;
    }


    foreach ($arr_aktivity as $aktivity) {
      $data_datatable_database['database']['data-table'][$aktivity->table_name][$aktivity->code_data][$aktivity->field] = $aktivity;
      $data_table_field[$aktivity->type_data][$aktivity->table_name][$aktivity->code_data][] = $aktivity->field;
    }

    $arr_data_source = DataSource::all();

    foreach ($arr_data_source as $data_source) {
      $data_datatable_database['database']['data-table']['data_sources'][$data_source->table_source][$data_source->source_code] = $data_source;
    }

    foreach ($arr_status_recruitment as $item) {
      $data_atribut_size[$item->size][$item->uuid] = $item;
      $data_atribut_size['all'][$item->uuid] = $item;
      // $data_datatable_database['database']['data-table'][$item->size][$item->uuid] = $item;
    }
    foreach ($data_atribut_size as $uuid_item_table => $item_table) {
      // $data_datatable_database['database']['data-schema'][$uuid_item_table] = $atribut_sizes;
    }
    $arr_status_recruitment = $arr_status_recruitment->keyBy(function ($item) {
      return strval($item->uuid);
    });
    session()->put('data_st', $arr_status_recruitment);

    $data_employee_talents = self::data_employee_talent();



    $arr_payment_group = PaymentGroup::all();
    $arr_payment_group = $arr_payment_group->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $data_premis = Premi::all();
    $data_premis = $data_premis->keyBy(function ($item) {
      return strval($item->uuid);
    });

    // $data_datatable_database['database']['data-table']['employees'] = $arr_employees;

    foreach ($data_datatable_database['database']['data-table'] as $table_name => $table) {

      foreach ($table as $code_item => $item_table) {
        $arr_item_table = $item_table;
        if (gettype($item_table) == 'object') {
          $arr_item_table = $item_table->toArray();
        }
        foreach ($arr_item_table as $field_table => $value_table) {
          $data_datatable_database['database']['data-schema'][$table_name][] = $field_table;
        }
        break;
      }
    }
    // foreach ($data_datatable_database['database']['data-table']['tb_activity'] as $table_name => $table_structure) {
    //   foreach($table_structure as $index_table_fields=>$table_fields){
    //     $data_datatable_database['database']['data-schema-detail'][$table_name][$index_table_fields] = [
    //       'field' => $table_fields->field,
    //       'type_data' => $table_fields->value_field
    //     ]; 
    //     if($table_fields->value_field == 'from_table'){
    //       if(!empty($data_datatable_database['database']['data-table']['data_sources'][$table_name.'-'.$table_fields->field])){
    //         $table_reference = $data_datatable_database['database']['data-table']['data_sources'][$table_name.'-'.$table_fields->field]['table_name'];
    //         $data_datatable_database['database']['data-schema-detail'][$table_name][$index_table_fields]['table_reference'] = $table_reference;
    //         // foreach($data_datatable_database['database']['data-table']['data_sources'][$table_fields->table_name] as $data_table_reference){
    //         //   $data_datatable_database['database']['data-table-reference'][$table_fields->table_name][$table_reference][] = $data_table_reference;
    //         // }            
    //       }          
    //     }
    //   }      
    // }


    //grouping data if from table
    foreach ($data_datatable_database['database']['data-table']['tb_activity'] as $table_name => $table_field) {
      $data_datatable_database['database']['table'][$table_name] = $table_field;
      foreach ($table_field as $index_data_source => $field) {
        if ($field->value_field == 'from_table') {
          $data_datatable_database['database']['table'][$table_name . '-' . $index_data_source] = $field;
          if (!empty($data_datatable_database['database']['data-table']['data_sources'][$table_name . '-' . $index_data_source])) {
            $data_datatable_database['database']['data-table']['table_field'][$table_name . '-' . $data_datatable_database['database']['data-table']['data_sources'][$table_name . '-' . $index_data_source]] = 'xxx';
          }
        }
      }
    }


    $data_datatable_database['database']['data-schema'] = array_merge($data_datatable_database['database']['data-schema'], $data_table_field['table']['table_field']);
    $data_database = [
      'table_schema' => [
        'employees' => $employees,
        'user_details' => $user_details,
        'atribut_sizes' => $atribut_sizes,
        'data_sources' => $data_sources,
        'data_table_field' => $data_table_field
      ],
      // 'data_employees' => $arr_employees,
      // 'count_employee' => $arr_employees->count(),
      'data_employee_out' => $data_employee_out,
      'data_employee_talents' => $data_employee_talents,
      'data_departments' => $arr_departments,
      'data_coal_froms' => $arr_coal_from,
      'data_positions' => $arr_position,
      'data_companies' => $arr_companies,
      'data_company_obj' => $arr_companies_obj,
      'data_atribut_sizes' => $data_atribut_size,
      'data_religions' => $arr_religion,
      'data_pohs' => $arr_pohs,
      'data_premis' => $data_premis,
      'data_dictionaries' => $arr_dictionary,
      'data_status_absens' => $arr_status_absens,
      'data_math_status_absens' => $arr_math_status_absens,
      'data_payment_groups' => $arr_payment_group,
      'data_datatable_database' => $data_datatable_database
    ];
    // dd($data_database);
    session()->put('data_database', $data_database);
    return $data_database;
    // return ResponseFormatter::toJson($data_database, 'data_database');
  }

  public static function setAllSession()
  {
    $data_datatable_database = [];
    $arr_employees = Employee::data_employee();

    foreach ($arr_employees->first()->toArray() as $index_first => $item_arr_employees) {
      $data_datatable_database['database']['data-schema']['employees'][] = $index_first;
    }
    $data_datatable_database['database']['data-schema']['employees'][] = 'full_name';


    // $arr_employees = Employee::data_employee();

    $arr_employees = $arr_employees->keyBy(function ($item) {
      return strval($item->nik_employee);
    });










    $data_employee_out = EmployeeOut::all();
    $data_employee_out = $data_employee_out->keyBy(function ($item) {
      return strval($item->employee_uuid);
    });

    $arr_religion = Religion::all();
    $arr_religion = $arr_religion->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $arr_status_absens = StatusAbsen::all();
    $arr_status_absens = $arr_status_absens->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $arr_math_status_absens = StatusAbsen::groupBy('math')->get('math');
    $arr_math_status_absens = $arr_math_status_absens->keyBy(function ($item) {
      return strval($item->math);
    });


    $arr_coal_from = CoalFrom::all();
    $arr_coal_from = $arr_coal_from->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $arr_dictionary = Dictionary::all();
    $arr_dictionary = $arr_dictionary->keyBy(function ($item) {
      return strval($item->database);
    });



    $data_arr_company_coal_from = [];
    foreach ($arr_coal_from as $item_arr_status_absens) {
      $data_arr_company_coal_from[$item_arr_status_absens->company_uuid][$item_arr_status_absens->uuid] = $item_arr_status_absens;
    }

    $arr_companies = Company::all();
    $arr_companies_obj = $arr_companies->keyBy(function ($item) {
      return strval($item->uuid);
    });
    foreach ($arr_companies_obj as $item_arr_companies) {
      if ($item_arr_companies->uuid != "MBLE") {
        $item_arr_companies->coal_from = $data_arr_company_coal_from[$item_arr_companies->uuid];
      }
    }

    // session()->put('data_employees', $arr_employees);
    session()->put('data_companies', $arr_companies);

    $arr_position = Position::all();
    $arr_position = $arr_position->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $arr_departments = Department::all();
    $arr_departments = $arr_departments->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $arr_pohs = Poh::all();
    $arr_pohs = $arr_pohs->keyBy(function ($item) {
      return strval($item->uuid);
    });


    $employees = DB::getSchemaBuilder()->getColumnListing('employees');
    $user_details = DB::getSchemaBuilder()->getColumnListing('user_details');
    $atribut_sizes = DB::getSchemaBuilder()->getColumnListing('atribut_sizes');
    $data_sources = DB::getSchemaBuilder()->getColumnListing('data_sources');

    foreach ($arr_employees as $employee) {
      $employee->full_name = $employee->nik_employee . " | " . $employee->name . " | " . $employee->company_uuid . " | " . $employee->site_uuid;
      foreach ($data_datatable_database['database']['data-schema']['employees'] as $item_schema) {
        $data_datatable_database['database']['data-table']['employees'][$employee->nik_employee][$item_schema] = [
          'code_data' => $employee->nik_employee,
          'description' => $employee[$item_schema],
          'field' => $item_schema,
          'table_name' => 'employees',
          'type_data' => 'data',
          'value_field' => $employee[$item_schema],
        ];
      }
    }
    $data_datatable_database['database']['data-schema']['employees'] = [];


    /*
    uuid = code_data,
    name_atribut = description
    size = table_name
    *field = data,
    value_atribut = value_data,

    */
    $arr_status_recruitment = AtributSize::all();
    $data_atribut_size = [];
    $data_table_field = [];

    foreach ($arr_status_recruitment as $item_status_recruitment) {
      $data_datatable_database['database']['data-table'][$item_status_recruitment->size][$item_status_recruitment->size . "-" . $item_status_recruitment->uuid]['CODE'] = [
        'code_data' => $item_status_recruitment->size . "-" . $item_status_recruitment->uuid,
        'description' => $item_status_recruitment->name_atribut,
        'field' => 'data-atribut-size',
        'table_name' => $item_status_recruitment->size,
        'type_data' => 'data',
        'value_field' => $item_status_recruitment->uuid,
      ];
      $data_datatable_database['database']['data-table'][$item_status_recruitment->size][$item_status_recruitment->size . "-" . $item_status_recruitment->uuid]['DESCRIPTION'] = [
        'code_data' => $item_status_recruitment->size . "-" . $item_status_recruitment->uuid,
        'description' => $item_status_recruitment->name_atribut,
        'field' => 'data-atribut-size',
        'table_name' => $item_status_recruitment->size,
        'type_data' => 'data',
        'value_field' => $item_status_recruitment->name_atribut,
      ];
      $data_datatable_database['database']['data-table'][$item_status_recruitment->size][$item_status_recruitment->size . "-" . $item_status_recruitment->uuid]['VALUE'] = [
        'code_data' => $item_status_recruitment->size . "-" . $item_status_recruitment->uuid,
        'description' => $item_status_recruitment->name_atribut,
        'field' => 'data-atribut-size',
        'table_name' => $item_status_recruitment->size,
        'type_data' => 'data',
        'value_field' => $item_status_recruitment->value_atribut,
      ];
    }



    $arr_aktivity = Aktivity::all();
    $data_datatable_database['database']['data-table']['test-one'] = $arr_aktivity->where('field', 'GROUP-FORM');
    $search = [
      'field' => 'GROUP-FORM',
      'key' => 'code_data'
    ];

    foreach ($data_datatable_database['database']['data-table']['test-one'] as $data_search) {
      $data_datatable_database['database']['data-search'][$search['field']][$data_search->value_field][] = $data_search->code_data;
    }


    foreach ($arr_aktivity as $aktivity) {
      $data_datatable_database['database']['data-table'][$aktivity->table_name][$aktivity->code_data][$aktivity->field] = $aktivity;
      $data_table_field[$aktivity->type_data][$aktivity->table_name][$aktivity->code_data][] = $aktivity->field;
    }

    $arr_data_source = DataSource::all();

    foreach ($arr_data_source as $data_source) {
      $data_datatable_database['database']['data-table']['data_sources'][$data_source->table_source][$data_source->source_code] = $data_source;
    }

    foreach ($arr_status_recruitment as $item) {
      $data_atribut_size[$item->size][$item->uuid] = $item;
      $data_atribut_size['all'][$item->uuid] = $item;
      // $data_datatable_database['database']['data-table'][$item->size][$item->uuid] = $item;
    }
    foreach ($data_atribut_size as $uuid_item_table => $item_table) {
      // $data_datatable_database['database']['data-schema'][$uuid_item_table] = $atribut_sizes;
    }
    $arr_status_recruitment = $arr_status_recruitment->keyBy(function ($item) {
      return strval($item->uuid);
    });
    session()->put('data_st', $arr_status_recruitment);

    $data_employee_talents = self::data_employee_talent();



    $arr_payment_group = PaymentGroup::all();
    $arr_payment_group = $arr_payment_group->keyBy(function ($item) {
      return strval($item->uuid);
    });

    $data_premis = Premi::all();
    $data_premis = $data_premis->keyBy(function ($item) {
      return strval($item->uuid);
    });

    // $data_datatable_database['database']['data-table']['employees'] = $arr_employees;

    foreach ($data_datatable_database['database']['data-table'] as $table_name => $table) {

      foreach ($table as $code_item => $item_table) {
        $arr_item_table = $item_table;
        if (gettype($item_table) == 'object') {
          $arr_item_table = $item_table->toArray();
        }
        foreach ($arr_item_table as $field_table => $value_table) {
          $data_datatable_database['database']['data-schema'][$table_name][] = $field_table;
        }
        break;
      }
    }
    // foreach ($data_datatable_database['database']['data-table']['tb_activity'] as $table_name => $table_structure) {
    //   foreach($table_structure as $index_table_fields=>$table_fields){
    //     $data_datatable_database['database']['data-schema-detail'][$table_name][$index_table_fields] = [
    //       'field' => $table_fields->field,
    //       'type_data' => $table_fields->value_field
    //     ]; 
    //     if($table_fields->value_field == 'from_table'){
    //       if(!empty($data_datatable_database['database']['data-table']['data_sources'][$table_name.'-'.$table_fields->field])){
    //         $table_reference = $data_datatable_database['database']['data-table']['data_sources'][$table_name.'-'.$table_fields->field]['table_name'];
    //         $data_datatable_database['database']['data-schema-detail'][$table_name][$index_table_fields]['table_reference'] = $table_reference;
    //         // foreach($data_datatable_database['database']['data-table']['data_sources'][$table_fields->table_name] as $data_table_reference){
    //         //   $data_datatable_database['database']['data-table-reference'][$table_fields->table_name][$table_reference][] = $data_table_reference;
    //         // }            
    //       }          
    //     }
    //   }      
    // }


    //grouping data if from table
    foreach ($data_datatable_database['database']['data-table']['tb_activity'] as $table_name => $table_field) {
      $data_datatable_database['database']['table'][$table_name] = $table_field;
      foreach ($table_field as $index_data_source => $field) {
        if ($field->value_field == 'from_table') {
          $data_datatable_database['database']['table'][$table_name . '-' . $index_data_source] = $field;
          if (!empty($data_datatable_database['database']['data-table']['data_sources'][$table_name . '-' . $index_data_source])) {
            $data_datatable_database['database']['data-table']['table_field'][$table_name . '-' . $data_datatable_database['database']['data-table']['data_sources'][$table_name . '-' . $index_data_source]] = 'xxx';
          }
        }
      }
    }


    $data_datatable_database['database']['data-schema'] = array_merge($data_datatable_database['database']['data-schema'], $data_table_field['table']['table_field']);
    $data_database = [
      'table_schema' => [
        'employees' => $employees,
        'user_details' => $user_details,
        'atribut_sizes' => $atribut_sizes,
        'data_sources' => $data_sources,
        'data_table_field' => $data_table_field
      ],
      'data_employees' => $arr_employees,
      'count_employee' => $arr_employees->count(),
      'data_employee_out' => $data_employee_out,
      'data_employee_talents' => $data_employee_talents,
      'data_departments' => $arr_departments,
      'data_coal_froms' => $arr_coal_from,
      'data_positions' => $arr_position,
      'data_companies' => $arr_companies,
      'data_company_obj' => $arr_companies_obj,
      'data_atribut_sizes' => $data_atribut_size,
      'data_religions' => $arr_religion,
      'data_pohs' => $arr_pohs,
      'data_premis' => $data_premis,
      'data_dictionaries' => $arr_dictionary,
      'data_status_absens' => $arr_status_absens,
      'data_math_status_absens' => $arr_math_status_absens,
      'data_payment_groups' => $arr_payment_group,
      'data_datatable_database' => $data_datatable_database
    ];
    // dd($data_database);
    session()->put('data_database', $data_database);
    return $data_database;
    // return ResponseFormatter::toJson($data_database, 'data_database');
  }

  public static function foreachData($obj_data)
  {
    $data = [];
    if (!empty($obj_data)) {
      foreach ($obj_data as $item_data) {
        $data[$item_data->uuid] = $item_data->toArray();
      }
    }

    return $data;
  }

  public static function tableList()
  {
    $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

    $table_field = [];
    foreach ($tables as $name_table) {
      if ($name_table != 'migrations') {
        $columns = DB::getSchemaBuilder()->getColumnListing($name_table);
        $table_field[$name_table] = $columns;
      }
    }

    session()->put('table_field', $table_field);
    return $table_field;
    dd(session('table_field'));
    dd($table_field);
  }

  public static function countMonthLongWork($date1, $date2)
  {
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    return $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
  }

  public static function countDayLongWork($date1, $date2)
  {
    $startTimeStamp = strtotime($date1);
    $endTimeStamp = strtotime($date2);
    $timeDiff = abs($endTimeStamp - $startTimeStamp);

    $numberDays = $timeDiff / 86400;  // 86400 seconds in one day

    // and you might want to convert to integer
    return $numberDays = intval($numberDays) + 1;
  }

  public static function excelToDate($date)
  {
    if ($date != null) {
      if ($date == '') {
        return null;
      }
      if (gettype($date) == 'string') {
        $cls_date = new DateTime($date);
        return $cls_date->format('Y-m-d');
      } else {
        $miliseconds = ($date - (25567 + 2)) * 86400 * 1000;
        $seconds = $miliseconds / 1000;
        return  date("Y-m-d", $seconds);
      }
    } else {
      return null;
    }
  }

  public static function to2Digit($num)
  {
    $loading_tongkang_first = [
      'main-table' => [
        'DIBUAT-OLEH' => [
          'SOURCE_TYPE' => 'tables',
          'SOURCE' => 'employees',
          'VALUE' =>  'MBLE-005',
        ],
        'UNIT' => [
          [
            'UNIT' => [
              'SOURCE_TYPE' => 'tables',
              'SOURCE' => 'vehicles',
              'VALUE' =>  'DZ-005',
            ],
            'CONTROLLER' => [
              'SOURCE_TYPE' => 'tables',
              'SOURCE' => 'employees',
              'VALUE' =>  'MBLE-006',
            ]
          ],
          [
            'UNIT' => [
              'SOURCE_TYPE' => 'tables',
              'SOURCE' => 'vehicles',
              'VALUE' =>  'EX-001',
            ],
            'CONTROLLER' => [
              'SOURCE_TYPE' => 'tables',
              'SOURCE' => 'employees',
              'VALUE' =>  'MBLE-007',
            ]
          ],
        ]
      ]
    ];
    return str_pad($num, 2, "0", STR_PAD_LEFT);
  }

  public static function addDate($currentDate, $countAddDay)
  {
    $date = Carbon::createFromFormat('Y-m-d', $currentDate);
    $newDate = $date->addDays($countAddDay - 1);
    return $newDate->toDateString();
  }
}


/*
Border::BORDER_DASHDOT
Border::BORDER_DASHDOTDOT
Border::BORDER_DASHED
Border::BORDER_DOTTED
Border::BORDER_DOUBLE
Border::BORDER_HAIR
Border::BORDER_MEDIUM
Border::BORDER_MEDIUMDASHDOT
Border::BORDER_MEDIUMDASHDOTDOT
Border::BORDER_MEDIUMDASHED
Border::BORDER_NONE
Border::BORDER_SLANTDASHDOT
Border::BORDER_THICK
Border::BORDER_THIN


example_xxx = {
  'LOADING-TONGKANG-FIRST':{

  }
}

*/
