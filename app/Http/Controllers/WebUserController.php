<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\DatabaseData;
use App\Models\Privilege\UserPrivilege;
use App\Models\User;
use App\Models\UserDetail\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class WebUserController extends Controller
{
    public static function sessionUserAuthentication($auth)
    {

        $storeEmployee = User::where('auth_login', $auth)->first();
        // return $auth;
        $NRP = $storeEmployee->employee_uuid;
        $O_KARYAWAN = [];
        $A_DIVISI = [];

        $Q_all_DIVISI = DatabaseData::where('code_table_data', 'DIVISI')
            ->whereNull('date_end')
            ->get();

        foreach ($Q_all_DIVISI as $I_DIVISI) {
            $A_DIVISI[] = $I_DIVISI->code_data;
        }


        // return ResponseFormatter::toUUID($NRP);
        $Q_user_details = DatabaseData::where('code_table_data', 'IDENTITAS-KARYAWAN')
            ->where('code_data', ResponseFormatter::toUUID($NRP))
            ->where('code_field_data', 'NAMA-KARYAWAN')
            ->whereNull('date_end')
            ->first();

        $Q_KARYAWAN = DatabaseData::where('code_table_data', 'KARYAWAN')
            ->where('code_data', ResponseFormatter::toUUID($NRP))
            ->whereNull('date_end')
            ->get();

        foreach ($Q_KARYAWAN as $I_KARYAWAN) {
            $O_KARYAWAN[$I_KARYAWAN->code_field_data] = $I_KARYAWAN->value_data;
        }



        $storeEmployee->user_details = ['name' => $Q_user_details->value_data];

        $Q_user_feture = DatabaseData::where('code_table_data', 'KARYAWAN-ACCESS-FEATURE')
            ->where('code_data', 'like', ResponseFormatter::toUUID($NRP) . '%')
            ->where('code_field_data', 'FEATURE')
            ->get();
        $arr_data_feature = [];
        foreach ($Q_user_feture as $data_user_feture) {
            if (!in_array($data_user_feture->value_data, $arr_data_feature)) {
                $arr_data_feature[] =  $data_user_feture->value_data;
            }
        }

        $Q_user_perusahaan = DatabaseData::where('code_table_data', 'KARYAWAN-AKSES-PERUSAHAAN')
            ->where('code_data', 'like', ResponseFormatter::toUUID($NRP) . '%')
            ->where('code_field_data', 'AKSES-PERUSAHAAN')
            ->get();
        $arr_data_perusahaan = [];
        foreach ($Q_user_perusahaan as $data_user_perusahaan) {
            if (!in_array($data_user_perusahaan->value_data, $arr_data_perusahaan)) {
                $arr_data_perusahaan[] =  $data_user_perusahaan->value_data;
            }
        }

        $Q_user_details = DatabaseData::where('code_table_data', 'KARYAWAN')
            ->where('code_data', ResponseFormatter::toUUID($NRP))
            ->where('code_field_data', 'PERUSAHAAN')
            ->whereNull('date_end')
            ->first();

        if ($Q_user_details) {
            $arr_data_perusahaan[] = $Q_user_details->value_data;
        }

        $Q_user_department = DatabaseData::where('code_table_data', 'KARYAWAN-AKSES-DEPARTMENT')
            ->where('code_data', 'like', ResponseFormatter::toUUID($NRP) . '%')
            ->where('code_field_data', 'AKSES-DEPARTMENT')
            ->get();
        $arr_data_department = [];
        foreach ($Q_user_department as $data_user_department) {
            // $arr_data_department[] =$data_user_department->value_data;

            if (!in_array($data_user_department->value_data, $arr_data_department)) {
                $arr_data_department[] =  $data_user_department->value_data;
            }
        }

        $Q_user_details = DatabaseData::where('code_table_data', 'KARYAWAN')
            ->where('code_data', ResponseFormatter::toUUID($NRP))
            ->where('code_field_data', 'DEPARTEMEN')
            ->whereNull('date_end')
            ->first();

        if ($Q_user_details) {
            $arr_data_department[] = $Q_user_details->value_data;
        }

        $Q_user_project = DatabaseData::where('code_table_data', 'KARYAWAN-AKSES-PROJECT')
            ->where('code_data', 'like', ResponseFormatter::toUUID($NRP) . '%')
            ->where('code_field_data', 'AKSES-PROJECT')
            ->get();
        $arr_data_projects = [];
        foreach ($Q_user_project as $data_user_project) {
            // $arr_data_projects[] = $data_user_project->value_data;

            if (!in_array($data_user_project->value_data, $arr_data_projects)) {
                $arr_data_projects[] =  $data_user_project->value_data;
            }
        }



        $arr_data_project = [];
        $arr_data_projects = array_unique($arr_data_projects);
        foreach ($arr_data_projects as $data_user_project) {
            $arr_data_project[] = $data_user_project;
        }

        $Q_user_details = DatabaseData::where('code_table_data', 'KARYAWAN')
            ->where('code_data', ResponseFormatter::toUUID($NRP))
            ->where('code_field_data', 'PROJECT')
            ->whereNull('date_end')
            ->first();

        if ($Q_user_details) {
            $arr_data_project[] = $Q_user_details->value_data;
        }

        $Q_user_divisi = DatabaseData::where('code_table_data', 'KARYAWAN-AKSES-DIVISI')
            ->where('code_data', 'like', ResponseFormatter::toUUID($NRP) . '%')
            ->where('code_field_data', 'AKSES-DIVISI')
            ->get();
        $arr_data_divisi = [];
        foreach ($Q_user_divisi as $data_user_divisi) {
            // $arr_data_divisi[] =$data_user_divisi->value_data;

            if (!in_array($data_user_divisi->value_data, $arr_data_divisi)) {
                $arr_data_divisi[] =  $data_user_divisi->value_data;
            }
        }



        $arr_data_perusahaan[] = $O_KARYAWAN['PERUSAHAAN'];
        $arr_data_department[] = $O_KARYAWAN['DEPARTEMEN'];
        $data_kekaryawanan['PROJECT'][] = $O_KARYAWAN['PROJECT'];
        $data_kekaryawanan['DIVISI'][] = $O_KARYAWAN['DIVISI'];
      



        $Q_table_kekaryawanan = DatabaseData::where('code_table_data', 'KARYAWAN')->where('code_data', ResponseFormatter::toUUID($NRP))
            ->whereNull('date_end')->get();

        $data_kekaryawanan = [];
        foreach ($Q_table_kekaryawanan as $I_kekaryawanan) {
            $data_kekaryawanan[$I_kekaryawanan->code_field_data] = $I_kekaryawanan->value_data;
        }

        
        $storeEmployee->profile = $data_kekaryawanan;

        $storeEmployee->user_privileges = [$storeEmployee->role => true];
        $storeEmployee->feature = array_unique($arr_data_feature);
        $storeEmployee->PERUSAHAAN = array_unique($arr_data_perusahaan);
        $storeEmployee->DEPARTEMEN = array_unique($arr_data_department);
        $storeEmployee->PROJECT = array_unique($arr_data_project);
        $storeEmployee->DIVISI = array_unique($arr_data_divisi);

        $storeEmployee->PERUSAHAAN = array_merge([$data_kekaryawanan['PERUSAHAAN']], $storeEmployee->PERUSAHAAN);
        $storeEmployee->DEPARTEMEN = array_merge([$data_kekaryawanan['DEPARTEMEN']], $storeEmployee->DEPARTEMEN);
        $storeEmployee->PROJECT = array_merge([$data_kekaryawanan['PROJECT']], $storeEmployee->PROJECT);
        $storeEmployee->DIVISI = array_merge([$data_kekaryawanan['DIVISI']], $storeEmployee->DIVISI);

        $storeEmployee->PERUSAHAAN = array_unique($storeEmployee->PERUSAHAAN);
        $storeEmployee->DEPARTEMEN = array_unique($storeEmployee->DEPARTEMEN);
        $storeEmployee->PROJECT = array_unique($storeEmployee->PROJECT);
        $storeEmployee->DIVISI = array_unique($storeEmployee->DIVISI);

        $storeEmployee->PERUSAHAAN = array_values($storeEmployee->PERUSAHAAN);
        $storeEmployee->DEPARTEMEN = array_values($storeEmployee->DEPARTEMEN);
        $storeEmployee->PROJECT = array_values($storeEmployee->PROJECT);
        $storeEmployee->DIVISI = array_values($storeEmployee->DIVISI);
        


        return $storeEmployee;
    }

    public function login(Request $request)
    {
        $dataUser = User::where('nik_employee', ResponseFormatter::toUUID($request->nik_employee))->first();

        $isValid = false;
        if ($dataUser) {
            if (Hash::check($request->pin, $dataUser->pin)) {
                $isValid = true;
            }
            if (Hash::check($request->nik_number, $dataUser->password)) {
                $isValid = true;
            }
            // return $isValid;
            if ($isValid) {
                $token = Str::random(60);
                $storeEmployee = User::updateOrCreate(
                    ['id'   => $dataUser->id],
                    ['auth_login' => $token]
                );

                $storeEmployee = $this->sessionUserAuthentication($token);


                $grade = DatabaseData::where('code_table_data', 'KONTRAK-KARYAWAN')->where('code_field_data', 'GRADE')->where('code_data', ResponseFormatter::toUUID($request->nik_employee))->whereNull('date_end')->first();

                $storeEmployee->GRADE = $grade->value_data;
                if($storeEmployee->GRADE > 1){
                    $storeEmployee->FIELD_LEVEL = 2;
                }
                if(in_array('HR', $storeEmployee->feature)){
                    $storeEmployee->FIELD_LEVEL = 3;
                }


        
                session()->flush();
                session(['user_authentication' => $storeEmployee]);

                return $storeEmployee;
                if (!empty($storeEmployee->pin)) {
                    return redirect()->intended('/web/menu');
                } else {
                    return redirect()->intended('/web/menu');
                }



                // Session::put('user_authentication', $storeEmployee);

                return ResponseFormatter::ResponseJson([
                    'status' => 'success',
                    'data'  => session('user_authentication')
                ], 'Validasi Login Sukses', 200);
            }
        }
        return back()->with('isError', 'Login Failed!');



        if ($dataUser) {
            if (Hash::check($request->password, $dataUser->password)) {
                $token = Str::random(60);
                $storeEmployee = User::updateOrCreate(
                    ['id'   => $dataUser->id],
                    ['auth_login' => $token]
                );
                $storeEmployee = User::where('auth_login', $token)->first();
                $userDetail = UserDetail::where('uuid', $storeEmployee->nik_employee)->first();
                $storeEmployee->user_details = $userDetail;

                $user_privileges = UserPrivilege::where_nik_employee($storeEmployee->nik_employee);

                $storeEmployee->user_privileges = $user_privileges;

                session()->put('user_authentication', $storeEmployee);

                return redirect()->intended('/web/menu');
                return $storeEmployee;
            }
        }
        return back()->with('isError', 'Login Failed!');
    }


    public function logout()
    {
        if (!empty(session('user_authentication'))) {
            $storeEmployee = User::updateOrCreate(
                ['id'   => session('user_authentication')->id],
                ['auth_login' => null]
            );
        }
        return view('app.login');
    }

    public function profile()
    {
        // dd(session()->all());
        // return DatabaseController::getDataFull('KARYAWAN','MBLE-0422003');
        return view('app.user.profile', [
            'title'         => 'Login'
        ]);
    }

    public function user()
    {
        // UserController::localStorageWeb();
        return view('app.user.user', [
            'title'         => 'User'
        ]);
    }

    public function manageIndexUser()
    {

        return view('app.manage.user.indexManageUser');
    }

    public function manageImportUser(Request $request)
    {
        $the_file = $request->file('uploaded_file');
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $no_employee = 2;
            while ($sheet->getCell('A' . $no_employee)->getValue() != null) {
                $NRP = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue());
                $NIK_KTP = $sheet->getCell('E' . $no_employee)->getValue();
                User::updateOrCreate([
                    'uuid' => $NRP,
                    'employee_uuid' => $NRP,
                    'nik_employee' => $NRP,

                ], [
                    'password' => Hash::make($NIK_KTP),
                    'role' => 'employee'
                ]);

                $no_employee++;
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return ResponseFormatter::ResponseJson($request->all(), 'imprt user', 200);
    }

    public function storeUser(Request $request)
    {
        /*
            1. declaration
                1. nik_employee
                2. new pin
                3. new ktp
            2. Update
            3. 


            card employee

            //database local

            1. nik_employee
            2. name
            3. position
            4. departement
            5. company
            6. picture

            nik = {
                nik, => nik_employee_with_space
                name, => user_details->name
                position, => positions->position
                department, => departments->department
                company, => companies->company
                picture, => user_details->photo_path
            }

            bagaiaman dengan filter departement?
            => ambil hanya niknya,
            bagaimana dengan data yang dari database lain?
            => langsung/codenya lalu di view yang nyari ? 
            ==> langsung description yang di local
            



            privilege
            jika karyawan biasa === 0
            jika karyawan memiliki privilege > 0
        */
    }
}
