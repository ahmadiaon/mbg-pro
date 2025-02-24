<?php

namespace App\Models\Employee;

use App\Helpers\ResponseFormatter;
use App\Models\DatabaseData;
use App\Models\Support\DatabaseDataKehadiran;
use App\Models\Support\DatabaseDataPersetujuan;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EmployeeAbsen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    static public function findClosestShift($dateToFind, $shiftData)
    {
        // Ubah tanggal yang akan dicari ke format DateTime agar mudah untuk dibandingkan
        $dateToFind = new DateTime($dateToFind);
        $closestDate = null;
        $closestShift = null;

        foreach ($shiftData as $date => $shiftInfo) {
            $currentDate = new DateTime($date);

            // Pastikan hanya tanggal yang lebih kecil atau sama dengan tanggal yang dicari
            if ($currentDate <= $dateToFind) {
                // Jika belum ada closestDate, atau jika currentDate lebih mendekati ke dateToFind, update
                if (!$closestDate || $currentDate > $closestDate) {
                    $closestDate = $currentDate;
                    $closestShift = $shiftInfo;
                }
            }
        }

        return $closestShift; // Nilai shift terdekat yang ditemukan
    }


    public static function storeAbsensiesGeneral($__DATA_ABSENSIES)
    {

        /*
            'uuid' => $employee_uuid . '-' . ResponseFormatter::excelToDate($abjad),
            'employee_uuid'  => $employee_uuid,
            'date' => $abjad,
            'status_absen_uuid'     => null,
            'cek_log'       =>  $absensi,

            'late_points' => 0,
            'late_minutes' => 0,
            'working_hours' => 0,
            'entry' => null,
            'exit' => null,
            'mid' => null,
            'shift' => null,

            $__DATA_ABSENSIES['NRP']['DATE'] = [
                ''
            ]

        
        */
        $data_return = [];

        // 4. MENDAPATKAN SHIFT KARYAWAN
        $Q_DATA_SHIFT = DatabaseData::where('code_table_data', 'DATA-SHIFT-KARYAWAN')
            ->whereNull('date_end')
            ->where('code_field_data', 'NRP')
            ->get();

        $DATA_SHIFT_KARYAWAN = [];
        foreach ($Q_DATA_SHIFT  as $I_DATA_SHIFT) {
            $DATA_SHIFT_KARYAWAN[$I_DATA_SHIFT->code_data]['NRP'] = $I_DATA_SHIFT->value_data;
        }

        $Q_DATA_SHIFT = DatabaseData::where('code_table_data', 'DATA-SHIFT-KARYAWAN')
            ->whereNull('date_end')
            ->where('code_field_data', 'SHIFT')
            ->get();

        foreach ($Q_DATA_SHIFT  as $I_DATA_SHIFT) {
            $DATA_SHIFT_KARYAWAN[$I_DATA_SHIFT->code_data]['SHIFT'] = $I_DATA_SHIFT->value_data;
            $DATA_SHIFT_KARYAWAN[$I_DATA_SHIFT->code_data]['DATE'] = $I_DATA_SHIFT->date_start;
        }

        $DATA_SHIFT = [];
        foreach ($DATA_SHIFT_KARYAWAN as $I_DATA_SHIFT_KARYAWAN) {
            $DATA_SHIFT[$I_DATA_SHIFT_KARYAWAN['NRP']][$I_DATA_SHIFT_KARYAWAN['DATE']] = $I_DATA_SHIFT_KARYAWAN['SHIFT'];
        }

        foreach ($__DATA_ABSENSIES as $_DATA_ABSENSIES) {
            foreach ($_DATA_ABSENSIES as $DATA_ABSENSIES) {
                if (empty($DATA_ABSENSIES['shift'])) {
                    $DATA_ABSENSIES['shift'] = 'S1';

                    if (!empty($DATA_SHIFT[$DATA_ABSENSIES['employee_uuid']])) {
                        $DATA_ABSENSIES['shift'] = EmployeeAbsen::findClosestShift($DATA_ABSENSIES['date'], $DATA_SHIFT[$DATA_ABSENSIES['employee_uuid']]);

                        if (!empty($DATA_SHIFT[$DATA_ABSENSIES['employee_uuid']][$DATA_ABSENSIES['date']])) {
                            $DATA_ABSENSIES['shift'] = $DATA_SHIFT[$DATA_ABSENSIES['employee_uuid']][$DATA_ABSENSIES['date']];
                        }
                    }
                }

                // CLEAR NULL INDEX
                $DATA_ABSENSIES = array_filter($DATA_ABSENSIES);
                $data_return[] = $DATA_ABSENSIES;
                if (!empty($DATA_ABSENSIES['status_absen_uuid'])) {

                    if ($DATA_ABSENSIES['status_absen_uuid'] != "-") {
                        $store = EmployeeAbsen::updateOrCreate(
                            [
                                'employee_uuid'  => $DATA_ABSENSIES['employee_uuid'],
                                'date' => ResponseFormatter::excelToDate($DATA_ABSENSIES['date']),
                            ],
                            $DATA_ABSENSIES
                        );
                    }
                }
            }
        }
        return $data_return;
    }


    public static function storeAbsen($data)
    {
        $period = CarbonPeriod::create($data['date_start'], $data['date_end']);

        foreach ($period as $date) {
            if ($data['status_absen_uuid'] != '-') {
                $store_employee_absen = EmployeeAbsen::updateOrCreate(
                    [
                        'employee_uuid'  => $data['NRP'],
                        'date' => $date->toDateString() . PHP_EOL,
                    ],
                    [
                        'uuid' => $date->toDateString() . PHP_EOL . '-' . $data['NRP'],
                        'status_absen_uuid'     => $data['status_absen_uuid'],
                        'shift'     => 'S1',
                    ]
                );
            }
        }
    }


    static function getAbsen($date_start, $date_end)
    {
        $Q_data_absensi = EmployeeAbsen::where('employee_absens.date', '>=',  $date_start)
            ->where('employee_absens.date', '<=',  $date_end)
            ->get();
    }

    function getAbsenEmployee(Request $request)
    {

        $filter_absen = $request->default_filter_absensi;
        $auth_login = $request->header('x-auth-login');
        $filter_absen['auth_login'] = $auth_login;
        $user = User::where('auth_login', $auth_login)->first();
        $filter_absen['nik_employee'] = $user->nik_employee;

        $data_to_return['data_ketidakhadiran'] = [];
        $NRP = null;
        $data_absen_return = [];
        // return ResponseFormatter::ResponseJson($filter_absen, 'All Absensi Data', 200);

        $Q_data_absensi = EmployeeAbsen::where('employee_absens.date', '>=',  $filter_absen['date_start'])
            ->where('employee_absens.date', '<=',  $filter_absen['date_end']);


        if (!empty($filter_absen['from'])) {
            $filter_absen['KARYAWAN'] = [$NRP];
            $Q_data_absensi = $Q_data_absensi->where('employee_absens.employee_uuid', $filter_absen['nik_employee']);
        }

        $Q_data_absensi = $Q_data_absensi->get(['employee_uuid', 'absen_description', 'cek_log', 'date', 'entry', 'mid', 'exit', 'late_minutes', 'late_points', 'shift', 'status_absen_uuid', 'working_hours', 'uuid']);

        foreach ($Q_data_absensi as $absensi) {
            $arr_data_absen[$absensi->employee_uuid][$absensi->date] = $absensi;
        }
        $data_to_return['data_absensi'][$filter_absen['nik_employee']] = [];
        if (!empty($arr_data_absen[$filter_absen['nik_employee']])) {
            $data_to_return['data_absensi'][$filter_absen['nik_employee']] = $arr_data_absen[$filter_absen['nik_employee']];
        }
        if (!empty($filter_absen['KARYAWAN'])) {
            foreach ($filter_absen['KARYAWAN'] as $I_karyawan) {
                if (!empty($arr_data_absen[$I_karyawan])) {
                    $data_to_return['data_absensi'][$I_karyawan] = $arr_data_absen[$I_karyawan];
                }
            }
        }

        $data_data_ketidakhadiran = [];
        $data_to_return['data_ketidakhadiran'] = [];
        $data_data_ketidakhadiran =  DatabaseDataKehadiran::getData($filter_absen); //[nrp][code]


        // return ResponseFormatter::ResponseJson($data_data_ketidakhadiran, 'All Absensi Data', 200);
        if (!empty($data_data_ketidakhadiran[$filter_absen['nik_employee']])) {
            $data_to_return['data_ketidakhadiran'] =  array_merge($data_to_return['data_ketidakhadiran'], $data_data_ketidakhadiran[$filter_absen['nik_employee']]);
        }

        if ($data_data_ketidakhadiran) {
            foreach ($filter_absen['KARYAWAN'] as $I_karyawan) {
                if (!empty($data_data_ketidakhadiran[$I_karyawan])) {
                    $data_to_return['data_ketidakhadiran'] =  array_merge($data_to_return['data_ketidakhadiran'], $data_data_ketidakhadiran[$I_karyawan]);
                }
            }
        }

        $data_to_return['data_persetujuan'] = DatabaseDataPersetujuan::getDataPersetujuan('KEHADIRAN', null);

        // return ResponseFormatter::ResponseJson(count($data_to_return['data_absensi']), 'All Absensi Data', 200);
        return ResponseFormatter::ResponseJson($data_to_return, 'All Absensi Dataaaaaaaaaaa', 200);

        return ResponseFormatter::ResponseJson(json_encode($data_to_return), 'All Absensi Data', 200);
    }
}
