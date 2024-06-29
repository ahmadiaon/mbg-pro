<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeCuti;
use App\Models\Employee\EmployeeCutiGroup;
use App\Models\Employee\EmployeeCutiSetup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeCutiController extends Controller
{
    public function webIndex()
    {
        return view('app.manage.roaster-kerja.index', [
            'title'         => 'Roaster Kerja'
        ]);
    }
    public function index()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-cuti'
        ];

        $group_names = EmployeeCutiGroup::join('employee_cuti_setups', 'employee_cuti_setups.group_cuti_uuid', 'employee_cuti_groups.uuid')
            ->groupBy(
                'employee_cuti_groups.uuid',
                'employee_cuti_groups.name_group_cuti',
            )
            ->get([
                'employee_cuti_groups.uuid',
                'employee_cuti_groups.name_group_cuti',
            ]);

        // dd($group_names);

        // return 'a';
        $employee_setup_cutis = EmployeeCutiSetup::join('employees', 'employees.uuid', 'employee_cuti_setups.employee_uuid')
            ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->whereNull('employees.date_end')
            ->whereNull('employee_cuti_setups.date_end')
            ->whereNull('user_details.date_end')
            ->get([
                'user_details.name',
                'employee_cuti_setups.*'
            ]);
        // return view('datatableshow', [ 'data'         => $employee_setup_cutis]);

        $employee_cuti = [];
        $date_half_year_prev = Carbon::today()->subDay(180);
        $date_half_year_next =  Carbon::today()->addDay(180);

        foreach ($employee_setup_cutis as $employee_setup_cuti) {
            $isLoop = true;
            $date_cuti_employe = [];
            $date_works = $employee_setup_cuti->date_start_work;
            $date_work = Carbon::createFromFormat('Y-m-d', $date_works);
            $count_ = 1;
            $day_new_work = 0;
            while ($isLoop) {
                // dd($employee_setup_cuti);
                $date_ = (int)$employee_setup_cuti->roaster_uuid + $day_new_work;
                $long_cuti = $date_ + 13;
                $day_new_work = $long_cuti + 1;

                $date_start_cuti = Carbon::createFromFormat('Y-m-d', $date_works)->addDay(($date_));
                $date_end_cuti = Carbon::createFromFormat('Y-m-d', $date_works)->addDay($long_cuti);

                if (($date_work > $date_half_year_prev) && ($date_work < $date_half_year_next)) {
                    $date_cuti_employe[] = $date_start_cuti->format('Y-m-d') . ' sd ' . $date_end_cuti->format('Y-m-d');
                }

                if ($date_work > $date_half_year_next) {
                    $isLoop = false;
                }

                $date_work = Carbon::createFromFormat('Y-m-d', $date_works)->addDay($day_new_work);
                $count_++;
            }
            $employee_cuti[$employee_setup_cuti->employee_uuid] = $date_cuti_employe;
        }
        // return view('datatableshow', [ 'data'         => $employee_cuti]);
        // dd($employeeee);

        return view('employee.cuti.index', [
            'title'         => 'Karyawan Cuti',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'nik_employee' => '',
            'employees_schedule_cuti' => $employee_cuti,
            'employee_cuti_groups' => $group_names,
        ]);
    }

    public function webExport(Request $request)
    {

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();


        $fields = [
            'name'=>'NAMA KARYAWAN',
            'jabatan'=>'JABATAN',
            'date_start_work'=>'TANGGAL AWAL BEKERJA',
            'roaster_code'=>'ROASTER CUTI',
            'date_schedule_start_cuti'=>'TANGGAL JADWAL AWAL CUTI',
            'date_schedule_end_cuti'=>'TANGGAL JADWAL AKHIR CUTI',
            'date_real_start_cuti'=>'TANGGAL REALISASI AWAL CUTI',
            'date_real_end_cuti'=>'TANGGAL REALISASI AKHIR CUTI',
            'kompensasi_cuti'=>'KOMPENSASI CUTI',
            'fasilitas_cuti'=>'FASILITAS CUTI',
            'value_money_cuti'=>'NILAI FASILITAS',
            'nrp_job_pendding'=>'NRP JOB PENDDING',
            'name_job_pendding'=>'NAMA JOB PENDING',
            'doc_job_pendding'=>'FILE JOB PENDING',
            'nrp_atasan_langsung'=>'NRP ATASAN LANGSUNG',
            'name_atasan_langsung'=>'NAMA ATASAN LANGSUNG',
            'nrp_hr_acc'=>'NRP HR ACC',
            'name_hr_acc'=>'NAMA HR ACC',
            'nrp_manajer'=>'NRP MANAJER',
            'name_manajer'=>'NAMA MANAJER',
        ];

        $createSheet->setCellValue('A2', 'Excel');
        $createSheet->setCellValue('A1', 'NO.');

        // foreach($){

        // }


        $crateWriter = new Xls($createSpreadsheet);
        $file_name = 'Cuti Karyawan-' . rand(99, 9999) . 'file.xls';
        $name = 'file/absensi/' . $file_name;
        $crateWriter->save($name);


        return ResponseFormatter::ResponseJson($file_name, 'file export', 200);
    }

    public function show($uuid)
    {
        $data = EmployeeCuti::where('uuid', $uuid)->first();

        return ResponseFormatter::toJson($data, 'show data employee cuti');
    }

    public function anyDataWarning(Request $request)
    {
        // return ResponseFormatter::toJson('sss', $request->date['year']);
        //nik
        $data_database = session('data_database');
        $group_names = EmployeeCutiGroup::all();
        $date_today_ =  Carbon::createFromFormat('Y-m-d',  ResponseFormatter::getDateToday());
        // $date_today_ =  Carbon::createFromFormat('Y-m-d',  '2023-05-20');

        $cuti = [];
        $employee_cuti = [];
        $date_half_year_prev = Carbon::createFromFormat('Y-m-d', $request->date['year'] . '-' . $request->date['month'] . '-01');
        $date_half_year_prev->subDay(180);
        $date_half_year_next =  Carbon::createFromFormat('Y-m-d', $request->date['year'] . '-' . $request->date['month'] . '-01');
        $date_half_year_next->addDay(180);
        $data_cuti = [];
        // return 'a';
        $employee_setup_cutis = EmployeeCutiSetup::join('employees', 'employees.uuid', 'employee_cuti_setups.employee_uuid')
            ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->whereNull('employees.date_end')
            ->whereNull('employee_cuti_setups.date_end')
            ->whereNull('user_details.date_end')
            ->get([
                'user_details.name',
                'employee_cuti_setups.*'
            ]);
        $data_employee_cuti = EmployeeCuti::all();
        //   if(!empty($request->nik_employee)){            
        //       $employee_setup_cutis = EmployeeCutiSetup::join('employees', 'employees.uuid', 'employee_cuti_setups.employee_uuid')
        //       ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
        //       ->whereNull('employees.date_end')
        //       ->whereNull('user_details.date_end')
        //       ->where('employees.nik_employee', $request->nik_employee)
        //       ->get([
        //           'user_details.name',
        //           'employee_cuti_setups.*'
        //       ]);      

        //       $data_employee_cuti = EmployeeCuti::join('employee_cuti_setups','employee_cuti_setups.employee_uuid', 'employee_cutis.employee_uuid')
        //       ->where('employee_cuti_setups.employee_uuid', $request->nik_employee)
        //       ->get([
        //           'employee_cutis.*'
        //       ]);
        //   }

        //   if(!empty($request->filter['group_cuti_uuid'])){
        $employee_setup_cutis = EmployeeCutiSetup::join('employees', 'employees.uuid', 'employee_cuti_setups.employee_uuid')
            ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->whereNull('employees.date_end')
            ->whereNull('employee_cuti_setups.date_end')
            ->whereNull('user_details.date_end')
            //   ->where('employee_cuti_setups.group_cuti_uuid', $request->filter['group_cuti_uuid'])
            ->get([
                'user_details.name',
                'employee_cuti_setups.*'
            ]);

        $data_employee_cuti = EmployeeCuti::join('employee_cuti_setups', 'employee_cuti_setups.employee_uuid', 'employee_cutis.employee_uuid')
            //   ->where('employee_cuti_setups.group_cuti_uuid', $request->filter['group_cuti_uuid'])
            ->get([
                'employee_cutis.*'
            ]);
        //   }

        $date_timeline = [
            'start' => $date_half_year_prev,
            'end' => $date_half_year_next
        ];

        // $date_today = 
        $all_data_row_cuti = [];
        $warning_cuti = [];

        foreach ($employee_setup_cutis as $employee_setup_cuti) {
            /*
                  loop employees:
  
              */
            $isLoop = true;
            $date_cuti_employe = [];
            $date_works = $employee_setup_cuti->date_start_work;
            $date_work = Carbon::createFromFormat('Y-m-d', $date_works);
            $count_ = 1;
            $day_new_work = 0;
            while ($isLoop) {
                // dd($employee_setup_cuti);
                $date_ = (int)$employee_setup_cuti->roaster_uuid + $day_new_work;
                $long_cuti = $date_ + 13;
                $day_new_work = $long_cuti + 1;

                $date_start_cuti = Carbon::createFromFormat('Y-m-d', $date_works)->addDay(($date_));
                $date_end_cuti = Carbon::createFromFormat('Y-m-d', $date_works)->addDay($long_cuti);
                if (($date_work > $date_half_year_prev) && ($date_work < $date_half_year_next)) {
                    $data_cuti = [
                        'x' => $employee_setup_cuti->name,
                        'y' => [
                            $date_start_cuti, $date_end_cuti
                        ]
                    ];
                    $cuti[] = $data_cuti;
                    $date_cuti_employe[] = $date_start_cuti->format('Y-m-d') . ' sd ' . $date_end_cuti->format('Y-m-d');
                }
                if ($date_start_cuti->format('Y-m-d') < $date_today_->format('Y-m-d')) {
                    $date_come = $date_end_cuti->format('Y-m-d');
                    $monitoring_cuti_status = 'Harus Cuti';
                    if ($date_end_cuti->format('Y-m-d') > $date_today_->format('Y-m-d')) {
                        $date_come = null;
                        $monitoring_cuti_status = 'Sedang Cuti';
                    }
                    $data_row_cuti = [
                        'uuid' => $employee_setup_cuti->employee_uuid . '-' . $date_start_cuti->format('Y-m-d'),
                        'employee_uuid' => $employee_setup_cuti->employee_uuid,
                        'nik_employee' => $employee_setup_cuti->employee_uuid,
                        'date_schedule_start_cuti' => $date_start_cuti->format('Y-m-d'),
                        'date_schedule_end_cuti' => $date_end_cuti->format('Y-m-d'),
                        'date_real_start_cuti' => $date_start_cuti->format('Y-m-d'),
                        'date_real_end_cuti' => $date_end_cuti->format('Y-m-d'),
                        'long_cuti' => 14,
                        'value_money_cuti' => 2500000,
                        'date_come_cuti' =>  $date_come,
                    ];

                    $all_data_row_cuti[] = $data_row_cuti;
                    $data_row_cuti['monitoring_cuti'] = $monitoring_cuti_status;
                    if ($date_start_cuti->format('Y-m-d') >  $date_half_year_prev->format('Y-m-d')) {
                        $warning_cuti[$employee_setup_cuti->employee_uuid][$data_row_cuti['uuid']] =  $data_row_cuti;
                    }
                }


                if ($date_work > $date_half_year_next) {
                    $isLoop = false;
                } else {
                }
                $date_work = Carbon::createFromFormat('Y-m-d', $date_works)->addDay($day_new_work);
                $count_++;
            }
            $employee_cuti[$employee_setup_cuti->employee_uuid] = $date_cuti_employe;
        }

        // return ResponseFormatter::toJson($warning_cuti, 'hasil');

        $data_real_cuti_timeline = [];
        $arr_warning = [];
        foreach ($data_employee_cuti as $item_data_employee_cuti) {
            if ($item_data_employee_cuti->date_real_start_cuti > $date_half_year_prev->format('Y-m-d')) {

                $data_real_cuti_timeline[] = [
                    'x' => $data_database['data_employees'][$item_data_employee_cuti->employee_uuid]['name'],
                    'y' => [
                        $item_data_employee_cuti->date_real_start_cuti, $item_data_employee_cuti->date_real_end_cuti,
                    ]
                ];

                if (empty($item_data_employee_cuti->date_come_cuti)) {
                    $warning_cuti[$item_data_employee_cuti->employee_uuid][$item_data_employee_cuti->uuid]['monitoring_cuti'] = 'Harus Balik';
                    if ($item_data_employee_cuti['date_real_end_cuti'] > $date_today_->format('Y-m-d')) {
                        $warning_cuti[$item_data_employee_cuti->employee_uuid][$item_data_employee_cuti->uuid]['monitoring_cuti'] = 'Sedang Cuti';
                    }
                } elseif (!empty($item_data_employee_cuti->date_come_cuti)) {
                    $warning_cuti[$item_data_employee_cuti->employee_uuid][$item_data_employee_cuti->uuid]['monitoring_cuti'] = 'Selesai';
                }
            }
        }

        foreach ($warning_cuti as $item_warning_cuti) {
            foreach ($item_warning_cuti as $i_item_warning_cuti) {
                if ($i_item_warning_cuti['monitoring_cuti'] != 'Selesai') {
                    $arr_warning[] = $i_item_warning_cuti;
                }
            }
        }

        // EmployeeCuti::insert(
        //     $all_data_row_cuti,
        // );


        $data = [
            'arr_warning' => $arr_warning,
            'warning_cuti' => $warning_cuti,
        ];

        return ResponseFormatter::toJson($data, 'data warning');
    }

    public function anyDataTimeLine(Request $request)
    {

        //tanggal mulai ditentukan
        //nik
        $data_database = session('data_database');
        $group_names = EmployeeCutiGroup::all();
        $date_today_ =  Carbon::createFromFormat('Y-m-d',  ResponseFormatter::getDateToday());

        $cuti = [];
        $employee_cuti = [];
        $date_half_year_prev = Carbon::createFromFormat('Y-m-d', $request->date['year'] . '-' . $request->date['month'] . '-01');
        $date_half_year_prev->subDay(180);
        $date_half_year_next =  Carbon::createFromFormat('Y-m-d', $request->date['year'] . '-' . $request->date['month'] . '-01');
        $date_half_year_next->addDay(180);
        $data_cuti = [];
        // return 'a';
        $employee_setup_cutis = EmployeeCutiSetup::join('employees', 'employees.uuid', 'employee_cuti_setups.employee_uuid')
            ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->whereNull('employees.date_end')
            ->whereNull('user_details.date_end')
            ->whereNull('employee_cuti_setups.date_end')
            ->get([
                'user_details.name',
                'employee_cuti_setups.*'
            ]);
        $data_employee_cuti = EmployeeCuti::all();
        if (!empty($request->nik_employee)) {
            $employee_setup_cutis = EmployeeCutiSetup::join('employees', 'employees.uuid', 'employee_cuti_setups.employee_uuid')
                ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
                ->whereNull('employees.date_end')
                ->whereNull('user_details.date_end')
                ->where('employees.nik_employee', $request->nik_employee)
                ->get([
                    'user_details.name',
                    'employee_cuti_setups.*'
                ]);

            $data_employee_cuti = EmployeeCuti::join('employee_cuti_setups', 'employee_cuti_setups.employee_uuid', 'employee_cutis.employee_uuid')
                ->where('employee_cuti_setups.employee_uuid', $request->nik_employee)
                ->get([
                    'employee_cutis.*'
                ]);
        }

        if (!empty($request->filter['group_cuti_uuid'])) {
            $employee_setup_cutis = EmployeeCutiSetup::join('employees', 'employees.uuid', 'employee_cuti_setups.employee_uuid')
                ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
                ->whereNull('employees.date_end')
                ->whereNull('user_details.date_end')
                ->whereNull('employee_cuti_setups.date_end')
                ->where('employee_cuti_setups.group_cuti_uuid', $request->filter['group_cuti_uuid'])
                ->get([
                    'user_details.name',
                    'employee_cuti_setups.*'
                ]);

            $data_employee_cuti = EmployeeCuti::join('employee_cuti_setups', 'employee_cuti_setups.employee_uuid', 'employee_cutis.employee_uuid')
                ->where('employee_cuti_setups.group_cuti_uuid', $request->filter['group_cuti_uuid'])
                ->get([
                    'employee_cutis.*'
                ]);
        }

        $date_timeline = [
            'start' => $date_half_year_prev,
            'end' => $date_half_year_next
        ];

        // $date_today = 
        $all_data_row_cuti = [];
        $warning_cuti = [];

        foreach ($employee_setup_cutis as $employee_setup_cuti) {
            /*
                loop employees:

            */
            $isLoop = true;
            $date_cuti_employe = [];
            $date_works = $employee_setup_cuti->date_start_work;
            $date_work = Carbon::createFromFormat('Y-m-d', $date_works);
            $count_ = 1;
            $day_new_work = 0;
            while ($isLoop) {
                // dd($employee_setup_cuti);
                $date_ = (int)$employee_setup_cuti->roaster_uuid + $day_new_work;
                $long_cuti = $date_ + 13;
                $day_new_work = $long_cuti + 1;

                $date_start_cuti = Carbon::createFromFormat('Y-m-d', $date_works)->addDay(($date_));
                $date_end_cuti = Carbon::createFromFormat('Y-m-d', $date_works)->addDay($long_cuti);
                if (($date_work > $date_half_year_prev) && ($date_work < $date_half_year_next)) {
                    $data_cuti = [
                        'x' => $employee_setup_cuti->name,
                        'y' => [
                            $date_start_cuti, $date_end_cuti
                        ]
                    ];
                    $cuti[] = $data_cuti;
                    $date_cuti_employe[] = $date_start_cuti->format('Y-m-d') . ' sd ' . $date_end_cuti->format('Y-m-d');
                }
                if ($date_start_cuti->format('Y-m-d') < $date_today_->format('Y-m-d')) {
                    $date_come = $date_end_cuti->format('Y-m-d');
                    $monitoring_cuti_status = 'Harus Cuti';
                    if ($date_end_cuti->format('Y-m-d') > $date_today_->format('Y-m-d')) {
                        $date_come = null;
                        $monitoring_cuti_status = 'Sedang Cuti';
                    }
                    $data_row_cuti = [
                        'uuid' => $employee_setup_cuti->employee_uuid . '-' . $date_start_cuti->format('Y-m-d'),
                        'employee_uuid' => $employee_setup_cuti->employee_uuid,
                        'date_schedule_start_cuti' => $date_start_cuti->format('Y-m-d'),
                        'date_schedule_end_cuti' => $date_end_cuti->format('Y-m-d'),
                        'date_real_start_cuti' => $date_start_cuti->format('Y-m-d'),
                        'date_real_end_cuti' => $date_end_cuti->format('Y-m-d'),
                        'long_cuti' => 14,
                        'value_money_cuti' => 2500000,
                        'date_come_cuti' =>  $date_come,
                    ];

                    $all_data_row_cuti[] = $data_row_cuti;
                    $data_row_cuti['monitoring_cuti'] = $monitoring_cuti_status;
                    $warning_cuti[$employee_setup_cuti->employee_uuid][$data_row_cuti['uuid']] =  $data_row_cuti;
                }


                if ($date_work > $date_half_year_next) {
                    $isLoop = false;
                } else {
                }
                $date_work = Carbon::createFromFormat('Y-m-d', $date_works)->addDay($day_new_work);
                $count_++;
            }
            $employee_cuti[$employee_setup_cuti->employee_uuid] = $date_cuti_employe;
        }


        $data_real_cuti_timeline = [];
        foreach ($data_employee_cuti as $item_data_employee_cuti) {
            if ($item_data_employee_cuti->date_real_start_cuti > $date_half_year_prev->format('Y-m-d')) {
                $data_real_cuti_timeline[] = [
                    'x' => $data_database['data_employees'][$item_data_employee_cuti->employee_uuid]['name'],
                    'y' => [
                        $item_data_employee_cuti->date_real_start_cuti, $item_data_employee_cuti->date_real_end_cuti,
                    ]
                ];
                $warning_cuti[$item_data_employee_cuti->employee_uuid][$item_data_employee_cuti->uuid]['monitoring_cuti'] = 'Selesai';
                if (empty($item_data_employee_cuti->date_come_cuti)) {
                    $warning_cuti[$item_data_employee_cuti->employee_uuid][$item_data_employee_cuti->uuid]['monitoring_cuti'] = 'Harus Balik';
                    if ($item_data_employee_cuti['date_real_end_cuti'] > $date_today_->format('Y-m-d')) {
                        $warning_cuti[$item_data_employee_cuti->employee_uuid][$item_data_employee_cuti->uuid]['monitoring_cuti'] = 'Sedang Cuti';
                    }
                }
            }
        }

        // EmployeeCuti::insert(
        //     $all_data_row_cuti,
        // );


        $data = [
            'data_cuti' => $data_cuti,
            'warning_cuti' => $warning_cuti,
            'employees_schedule_cuti' => $employee_cuti,
            'employee_cuti_groups' => $group_names,
            'cutis' => $cuti,
            'data_database' => $data_database,
            'data_employee_cuti' => $data_employee_cuti,
            'date_timeline' => $date_timeline,
            'data_real_cuti_timeline' => $data_real_cuti_timeline,
            'filter'    => $request->all(),
            'date_month' => $date_half_year_prev->format('m'),
            'all_data_row_cuti' => $all_data_row_cuti,
        ];

        return ResponseFormatter::toJson($data, $request->date['year']);
    }

    public function anyData(Request $request)
    {

        $employeeee = Employee::join('user_details', 'user_details.uuid', '=', 'employees.user_detail_uuid')
            ->leftJoin('positions', 'positions.uuid', '=', 'employees.position_uuid')
            ->leftJoin('departments', 'departments.uuid', '=', 'employees.department_uuid')
            ->join('employee_cutis', 'employee_cutis.employee_uuid', 'employees.nik_employee')
            ->whereNull('employees.date_end')
            ->whereNull('user_details.date_end')
            ->whereYear('employee_cutis.date_real_start_cuti', $request->date['year'])
            ->whereMonth('employee_cutis.date_real_start_cuti', $request->date['month'])
            ->get();


        return DataTables::of($employeeee)
            ->make(true);

        return ResponseFormatter::toJson($employeeee, 'bbb');
    }

    public function import(Request $request)
    {
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

            $no_employee = 6;
            $employees = [];

            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                $date_row = 3;

                $employee_uuid = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue());
                $date = ResponseFormatter::excelToDate($sheet->getCell('F' . $no_employee)->getValue());
                $group_cuti_uuid = ResponseFormatter::toUUID($sheet->getCell('G' . $no_employee)->getValue());

                $store_group_cuti = EmployeeCutiGroup::updateOrCreate(['uuid' => $group_cuti_uuid], ['name_group_cuti' => $sheet->getCell('G' . $no_employee)->getValue()]);

                $employee_cuti_setup = [
                    'employee_uuid'  => $employee_uuid,
                    'roaster_uuid' =>  $sheet->getCell('E' . $no_employee)->getValue(),
                    'date_start_work'    => $date,
                    'group_cuti_uuid'    => $store_group_cuti->uuid,
                    'date_start'    => $date,
                ];
                $store_group_cuti = EmployeeCutiSetup::updateOrCreate(['uuid' => $employee_uuid], $employee_cuti_setup);
                $no_employee++;
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();



        $employee_cutis = EmployeeCutiSetup::all();

        $employee_setup_cutis = EmployeeCutiSetup::join('employees', 'employees.uuid', 'employee_cuti_setups.employee_uuid')
            ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->get([
                'user_details.name',
                'employee_cuti_setups.*'
            ]);

        $cuti = [];
        $work = [];
        $date_today = Carbon::today();
        $date_half_year_prev = Carbon::today()->subDay(180);
        $date_half_year_next =  Carbon::today()->addDay(180);

        foreach ($employee_setup_cutis as $employee_setup_cuti) {
            $isLoop = true;


            while ($isLoop) {
                $date_work = $employee_setup_cuti->date_start_work;
                $date_start_work = Carbon::createFromFormat('Y-m-d', $date_work);
                $date_end_work = $date_start_work->addDay(70);
                // dd($date_end_work);
                $ret = [
                    'date_prev' => $date_half_year_prev,
                    'date_now'  => $date_today,
                    'date_next' => $date_half_year_next,
                    'date_start_work'   => $date_start_work,
                    'date_end_work' => $date_end_work
                ];

                // dd($ret);
                if (($date_work > $date_half_year_prev) && ($date_work < $date_half_year_next)) {
                    $employee_setup_cuti->date_start_work;
                    $cuti[] = [
                        'x' => $employee_setup_cuti->name,
                        'y' => [
                            $date_start_work, $date_end_work
                        ]
                    ];
                    dd($cuti);
                }
                return 'a';
            }
        }
        dd($employee_cutis);
        // return 'aaa';
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

            $no_employee = 6;
            $employees = [];

            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                $date_row = 3;

                $employee_uuid = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue());
                $roaster_uuid = ResponseFormatter::toUUID($sheet->getCell('E' . $no_employee)->getValue());
                $date_start_work = ResponseFormatter::excelToDate($sheet->getCell('F' . $no_employee)->getValue());

                $employee_setup_cutis = [
                    'employee_uuid'  => $employee_uuid,
                    'roaster_uuid' =>  $roaster_uuid,
                    // 'date_start_work'   => 

                    // 'date_out'    => $date
                ];

                // EmployeeCuti::updateOrCreate(['uuid'=> $employee_uuid ],$employee_out);

                $no_employee++;
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }

    public function store(Request $request)
    {

        $validatedData = $request->all();
        $arr_schedule_cuti = explode(' sd ', $validatedData['schedule_cuti']);

        $data_database = session('data_database');

        if (!empty($validatedData['uuid'])) {
            $data_prev = EmployeeCuti::where('employee_cutis.uuid', $validatedData['uuid'])->get()->first();
            $employee_uuid_old = $validatedData['employee_uuid'];
            $validatedData['employee_uuid'] = $data_database['data_employees'][$validatedData['employee_uuid']]['machine_id'];

            $startDate = new \DateTime($data_prev['date_real_start_cuti']);
            $endDate = new \DateTime($data_prev['date_real_end_cuti']);



            for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
                $validatedData['date'] = $date->format('Y-m-d');
                $validatedData['uuid']  = $validatedData['date'] . '-' . $validatedData['employee_uuid'];
                $store = EmployeeAbsen::where('uuid', $validatedData['uuid'])->delete();
            }

            $validatedData['employee_uuid'] = $employee_uuid_old;
            EmployeeCuti::where('uuid', $validatedData['uuid'])->delete();
        }

        $validatedData['uuid'] = $validatedData['employee_uuid'] . '-' . $arr_schedule_cuti[0];
        $validatedData['date_schedule_start_cuti'] = $arr_schedule_cuti[0];
        $validatedData['date_schedule_end_cuti'] = $arr_schedule_cuti[1];

        $store = EmployeeCuti::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        // store absen
        $startDate = new \DateTime($validatedData['date_real_start_cuti']);
        $endDate = new \DateTime($validatedData['date_real_end_cuti']);
        $validatedData['edited'] = 'edited';

        $validatedData['status_absen_uuid'] = 'OFF';
        $validatedData['employee_uuid'] = $data_database['data_employees'][$validatedData['employee_uuid']]['machine_id'];


        for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
            $validatedData['date'] = $date->format('Y-m-d');
            $validatedData['uuid']  = $validatedData['date'] . '-' . $validatedData['employee_uuid'];
            $store = EmployeeAbsen::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
            $validatedData['store'][] = $validatedData['date'];
        }


        return ResponseFormatter::toJson($validatedData, 'Data Stored employee cuti');
        $group_cuti_uuid =  ResponseFormatter::toUUID($request->group_cuti_name);

        $storeGroupEmployeeCuti = EmployeeCutiGroup::updateOrCreate(['uuid' => $group_cuti_uuid], ['name_group_cuti' => $request->group_cuti_name]);

        $strore = EmployeeCutiSetup::updateOrCreate(
            ['uuid' => $request->employee_uuid],
            [
                'employee_uuid' => $request->employee_uuid,
                'roaster_uuid' => $request->roaster_uuid,
                'date_start_work' => $request->date_start_work,
                'group_cuti_uuid' => $storeGroupEmployeeCuti->uuid,

                'date_start'    => $request->date_start,
                'date_end'    => $request->date_end,
            ]
        );

        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

    public function delete(Request $request)
    {
        $validatedData = $request->all();
        $data_database = session('data_database');
        $data_prev = EmployeeCuti::where('employee_cutis.uuid', $validatedData['uuid'])->get()->first();
        $validatedData['employee_uuid'] = $data_database['data_employees'][$data_prev['employee_uuid']]['machine_id'];

        $startDate = new \DateTime($data_prev['date_real_start_cuti']);
        $endDate = new \DateTime($data_prev['date_real_end_cuti']);

        for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
            $validatedData['date'] = $date->format('Y-m-d');
            $validatedData['uuid']  = $validatedData['date'] . '-' . $validatedData['employee_uuid'];
            $store = EmployeeAbsen::where('uuid', $validatedData['uuid'])->delete();
        }
        $store = EmployeeCuti::where('uuid', $request->uuid)->delete();


        return ResponseFormatter::toJson($store, 'Data Employee Cuti');
    }
}
