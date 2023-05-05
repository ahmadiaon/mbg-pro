<?php

namespace App\Helpers;

use App\Models\CoalFrom;
use App\Models\Company;
use App\Models\Department;
use App\Models\Dictionary;
use App\Models\Employee\Employee;
use App\Models\Payment\PaymentGroup;
use App\Models\Poh;
use App\Models\Position;
use App\Models\Religion;
use App\Models\Safety\AtributSize;
use App\Models\StatusAbsen;
use App\Models\UserDetail\UserDetail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

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



  public static function toJson($data, $message = "success")
  {
    return response()->json(['code' => 200, 'message' => $message, 'data' => $data], 200);
  }

  public static function getEndDay($year_month)
  {
    $datetime = Carbon::createFromFormat('Y-m', $year_month);
    $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
    return $day_month;
  }
  public static function toUUID($uuid)
  {
    $uuid = ResponseFormatter::isString($uuid);
    return strtoupper(str_replace(' ', '-', str_replace('.', '-', str_replace('/', '-', $uuid))));
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
      $arr_employee_talent[$item->employee_uuid]->$name_col = $item->document_path;
    }

    return $arr_employee_talent;
  }

  public static function numberToAlfhabet($letters)
  {
    $alphabet = range('A', 'Z');

    return $alphabet[$letters];
  }



  public static function setAllSession()
  {
    $arr_employees = Employee::data_employee();
    $arr_employees = $arr_employees->keyBy(function ($item) {
      return strval($item->nik_employee);
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

    session()->put('data_employees', $arr_employees);
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




    $arr_status_recruitment = AtributSize::all();
    $data_atribut_size = [];
    foreach ($arr_status_recruitment as $item) {
      $data_atribut_size[$item->size][$item->uuid] = $item;
      $data_atribut_size['all'][$item->uuid] = $item;
    }
    $arr_status_recruitment = $arr_status_recruitment->keyBy(function ($item) {
      return strval($item->uuid);
    });
    session()->put('data_st', $arr_status_recruitment);

    $data_employee_talents = self::data_employee_talent();


    $employees = DB::getSchemaBuilder()->getColumnListing('employees');
    $user_details = DB::getSchemaBuilder()->getColumnListing('user_details');

    $arr_payment_group = PaymentGroup::all();
    $arr_payment_group = $arr_payment_group->keyBy(function ($item) {
      return strval($item->uuid);
    });


    $data_database = [
      'table_schema' => [
        'employees' => $employees,
        'user_details' => $user_details,
      ],
      'data_employees' => $arr_employees,
      'data_employee_talents' => $data_employee_talents,
      'data_departments' => $arr_departments,
      'data_coal_froms' => $arr_coal_from,
      'data_positions' => $arr_position,
      'data_companies' => $arr_companies,
      'data_company_obj' => $arr_companies_obj,
      'data_atribut_sizes' => $data_atribut_size,
      'data_religions' => $arr_religion,
      'data_pohs' => $arr_pohs,
      'data_dictionaries' => $arr_dictionary,
      'data_status_absens' => $arr_status_absens,
      'data_math_status_absens' => $arr_math_status_absens,
      'data_payment_groups' => $arr_payment_group,
    ];
    session()->put('data_database', $data_database);
    return $data_database;
    // return ResponseFormatter::toJson($data_database, 'data_database');
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
}
