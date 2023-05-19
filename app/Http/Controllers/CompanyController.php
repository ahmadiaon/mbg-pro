<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\CoalFrom;
use App\Models\CoalType;
use App\Models\Company;
use App\Models\Dictionary as ModelsDictionary;
use App\Models\Privilege\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PSpell\Dictionary;

class CompanyController extends Controller
{
    public function index()
    {
        // return 'aa';
        $coal_types = CoalType::all();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'company'
        ];

        // $companies = Company::all();

        // foreach($companies as $item_companies){
        //     Privilege::updateOrCreate(['uuid' => 'company_privilege_'.$item_companies->uuid ], ['privilege' =>'company_privilege_'.$item_companies->uuid  ]);
        // }
        return view('company.index', [
            'title'         => 'Perusahaan',
            'coal_types'    => $coal_types,
            'layout'    => $layout,
        ]);

    }

    public function anyData()
    {
        $data = Company::join('coal_types', 'coal_types.uuid', 'companies.coal_type_uuid')->orderBy('updated_at', 'asc')
            ->get([
                'companies.*',
                'coal_types.type_name as calorie'
            ]);

        // dd($data);
        return Datatables::of($data)
            ->make(true);
    }

    public function store(Request $request)
    {
        $validateData = $request->all();
        // return ResponseFormatter::toJson($validateData, 'Data Stored');
        if (empty($validateData['uuid'])) {
            $validateData['uuid'] = ResponseFormatter::toUUID($validateData['company']);
        }
        if (!empty($validateData['default_price'])) {
            CoalFrom::updateOrCreate(['uuid' => $validateData['uuid']], [
                'company_uuid'  => $validateData['uuid'],
                'coal_from' => $validateData['long_company'],
                'hauling_price' => $validateData['default_price']
            ]);
        }



        $strore = Company::updateOrCreate(['uuid' => $request->uuid], $validateData);
        Privilege::updateOrCreate(['uuid' => 'company_privilege_'.$strore->uuid ], ['privilege' =>'company_privilege_'.$strore->uuid  ]);
        $strore = ModelsDictionary::updateOrCreate(
            ['database' => $request->uuid],
            [
                'excel' => $request->uuid,
                'data_type' => 'uuid',
                'table' => 'companies'
            ]
        );

        $arr_companies = Company::all();
        ResponseFormatter::setAllSession();
        $request->session()->put('data_companies', $arr_companies);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

    public function export()
    {
        $arr_data = Company::join('coal_types', 'coal_types.uuid', 'companies.coal_type_uuid')
            ->join('coal_froms', 'coal_froms.uuid', 'companies.uuid')
            ->get();
        dd($arr_data);
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A1', 'Database :');

        $createSheet->setCellValue('B1', 'Perusahaan');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'Kode Perusahaan');
        $createSheet->setCellValue('C5', 'Nama Perusahaan');
        $createSheet->setCellValue('D5', 'Kalorie Batu');
        $createSheet->setCellValue('E5', 'Harga Hauling');

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/database-perusahaan-' . rand(99, 9999) . 'file.xls';
        $row = 6;
        $each = 1;
        foreach ($arr_data as $item) {
            $createSheet->setCellValue('A' . $row, $each);
            $createSheet->setCellValue('B' . $row, $item->company);
            $createSheet->setCellValue('C' . $row, $item->long_company);
            $createSheet->setCellValue('D' . $row, $item->type_name);
            $createSheet->setCellValue('E' . $row, $item->type_name);
            $each++;
            $row++;
        }
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function import(Request $request)
    {
        $the_file = $request->file('uploaded_file');
        try {
            $createSpreadsheet = new spreadsheet();
            $createSheet = $createSpreadsheet->getActiveSheet();
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];
            $no_employee = 6;

            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                $data['uuid'] = $data['company'] = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue());
                $data['coal_type_uuid'] = ResponseFormatter::toUUID($sheet->getCell('D' . $no_employee)->getValue());
                $data['long_company'] = $sheet->getCell('C' . $no_employee)->getValue();
                $data['use_start'] = '2000-01-01';
                if (!empty($data)) {
                    $store = Company::updateOrCreate(['uuid' => $data['uuid']], $data);
                }
                Privilege::updateOrCreate(['uuid' => 'company_privilege_'.$store->uuid ], ['privilege' =>'company_privilege_'.$store->uuid  ]);
                $no_employee++;
            }
        } catch (Exception $e) {
            $error_code = $e;
            return back()->with('messageErr', 'file eror!');
        }
        return back();
    }

    public function delete(Request $request)
    {
        $store = Company::where('uuid', $request->uuid)->delete();

        return response()->json(['code' => 200, 'message' => 'Data Deleted', 'data' => $store], 200);
    }

    public function show(Request $request)
    {
        $data = Company::where('uuid', $request->uuid)->get()->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }



    public function indexPayrol()
    {
        $hour_meter_prices = Company::all();
        // dd($hour_meter_prices);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'mobilisasi'
        ];
        return view('hour_meter_price.payrol.index', [
            'title'         => 'Status Absen',
            'hour_meter_prices' => $hour_meter_prices,
            'layout'    => $layout
        ]);
    }
    public function storePayrol(Request $request)
    {
        $validatedData = $request->validate([
            'uuid'      => '',
            'name' => '',
            'value' => '',
            'key_excel' => '',
            'use_start'      => '',
            'use_end'      => ''
        ]);
        if (!$validatedData['uuid']) {
            $validatedData['uuid'] = "hmp-" . Str::uuid();
        }
        $store = Company::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return response()->json(['code' => 200, 'message' => 'Data Stored', 'data' => $store], 200);
    }
    public function showPayrol($uuid)
    {
        $status_absen = Company::where('uuid', $uuid)->first();

        return response()->json(['code' => 200, 'message' => 'Data get', 'data' => $status_absen], 200);
    }
}
