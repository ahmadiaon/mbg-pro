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

  public static function toJson($data, $message = "success"){
    return response()->json(['code'=>200, 'message'=>$message,'data' => $data], 200);
  }

  public static function getEndDay($year_month){
    $datetime = Carbon::createFromFormat('Y-m', $year_month);
    $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
    return $day_month;
  }
  public static function toUUID($uuid){
    return strtoupper(str_replace(' ','-',str_replace('.','-',$uuid )) );
  }

  public static function toUuidLower($uuid){
    return strtolower(str_replace(' ','-',str_replace('.','-',$uuid )) );
  }


}