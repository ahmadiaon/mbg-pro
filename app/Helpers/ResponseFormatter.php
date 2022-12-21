<?php

namespace App\Helpers;
use Carbon\Carbon;

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
  
  public static function toDate($data = null){
    $date_end = explode(" ", $data);
    $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $result = $date_end[2]."-".array_search($date_end[1], $months)."-".$date_end[0];
    $result = Carbon::createFromFormat('Y-m-d',  $result); 
    return $result;
  }

  public static function getMonthName($data = null){
    $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $result = $months[$data];
      
    return $result;
  }
  public static function getNumArray($index, $array){
    return array_search($index, $array);
  }

  public static function toFloat($data){
    $data = str_replace(',','.', $data);
    $data = (float)$data;
    return $data;
  }

  public static function toJson($data, $message = "success"){
    return response()->json(['code'=>200, 'message'=>$message,'data' => $data], 200);
  }

  public static function getEndDay($year_month){
    $datetime = Carbon::createFromFormat('Y-m', $year_month);
    $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
    return $day_month;
  }
  public static function toUUID($uuid){
    return strtoupper(str_replace(' ','-',str_replace('.','-',str_replace('/','-',$uuid ))) );
  }

  public static function toUuidLower($uuid){
    return strtolower(str_replace(' ','-',str_replace('.','-',str_replace('/','-',$uuid ))) );
  }

  public static function countMonthLongWork($date1, $date2){
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    return $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
  }

  public static function countDayLongWork($date1, $date2){
    $startTimeStamp = strtotime($date1);
    $endTimeStamp = strtotime($date2);
    $timeDiff = abs($endTimeStamp - $startTimeStamp);

    $numberDays = $timeDiff/86400;  // 86400 seconds in one day

    // and you might want to convert to integer
    return $numberDays = intval($numberDays) + 1;
  }

  public static function excelToDate($date){

    if(gettype($date) == 'string'){
      return $date;
    }else{
      $miliseconds = ($date - (25567 + 2)) * 86400 * 1000;
      $seconds = $miliseconds / 1000;
      return  date("Y-m-d", $seconds);
    }
  }
}