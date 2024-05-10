<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use Illuminate\Http\Request;
use App\Models\Religion;
use App\Models\Department;
use App\Models\Position;
use App\Models\Company;
use App\Models\Dictionary;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeApplicant;
use App\Models\Employee\EmployeeCompany;
use App\Models\Employee\EmployeeCuti;
use App\Models\Employee\EmployeeCutiGroup;
use App\Models\Employee\EmployeeCutiSetup;
use App\Models\Employee\EmployeeDebt;
use App\Models\Employee\EmployeeDocument;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\Employee\EmployeeOut;
use App\Models\Employee\EmployeePayment;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeRoaster;
use App\Models\Employee\EmployeeSalary;
use App\Models\Employee\EmployeeTonase;
use App\Models\HourMeterPrice;
use App\Models\Premi;
use App\Models\Privilege\UserPrivilege;
use App\Models\Roaster;
use App\Models\Safety\AtributSize;
use App\Models\TaxStatus;
use App\Models\User;
use App\Models\UserDetail\UserAddress;
use App\Models\UserDetail\UserDependent;
use App\Models\UserDetail\UserDetail;
use App\Models\UserDetail\UserEducation;
use App\Models\UserDetail\UserHealth;
use App\Models\UserDetail\UserLicense;
use App\Models\UserDetail\UserReligion;
use App\Models\Variable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class EmployeeController extends Controller
{
    public function create()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-employee',
        ];

        return view('employee.create', [
            'title'         => 'Tambah Karyawan',
            'layout'    => $layout
        ]);
    }

    public function dataSession()
    {
        $table_employees = Employee::whereNull('date_end')->get();
        dd(ResponseFormatter::foreachData($table_employees));
    }

    public function index()
    { //use
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index'
        ];
        $user_nik = [
            ['nik_employee' => 'MBLE-231201', 'nik_ktp' => '3205162311790001'],
            ['nik_employee' => 'MBLE-052211002', 'nik_ktp' => '6304110601990001'],
            ['nik_employee' => 'MBLE-230922', 'nik_ktp' => '6203016705990002'],
            ['nik_employee' => 'MBLE-220727', 'nik_ktp' => '6371030401990008'],
            ['nik_employee' => 'BK/PL-200366', 'nik_ktp' => '6172023003940004'],
            ['nik_employee' => 'BK/PL-130108', 'nik_ktp' => '6303050503870004'], 
            ['nik_employee' => 'MB/HO-180049', 'nik_ktp' => '3216071111670006'],
            ['nik_employee' => 'MBLE-0422006', 'nik_ktp' => '6205051710690003'],
            ['nik_employee' => 'MBLE-0422056', 'nik_ktp' => '6303030405540002'],
            ['nik_employee' => 'MBLE-0220020110', 'nik_ktp' => '6205052706860003'],
            ['nik_employee' => 'MBLE-062304018', 'nik_ktp' => '6204041010920001'],
            ['nik_employee' => 'MB/F01-150067', 'nik_ktp' => '6205050101920014'],
            ['nik_employee' => 'MBLE-05230896', 'nik_ktp' => '6309061003730003'],
            ['nik_employee' => 'MBLE-062307029', 'nik_ktp' => '2101060301700004'],
            ['nik_employee' => 'MBLE-062308042', 'nik_ktp' => '3503080808740007'],
            ['nik_employee' => 'MBLE-052211037', 'nik_ktp' => '6205050408960012'],
            ['nik_employee' => 'MBLE-220629', 'nik_ktp' => '3507090203710004'],
            ['nik_employee' => 'MBLE-052211011', 'nik_ktp' => '6213091110800002'],
            ['nik_employee' => 'MBLE-05230171', 'nik_ktp' => '6213030712880001'],
            ['nik_employee' => 'MBLE-062304021', 'nik_ktp' => '6371030808790007'],
            ['nik_employee' => 'MBLE-052211008', 'nik_ktp' => '6204041908990004'],
            ['nik_employee' => 'MBLE-062302010', 'nik_ktp' => '6205050204990003'],
            ['nik_employee' => 'MBLE-0422062', 'nik_ktp' => '6204050503830001'],
            ['nik_employee' => 'MBLE-210431', 'nik_ktp' => '6205051501030002'],
            ['nik_employee' => 'MBLE-170175', 'nik_ktp' => '6205010702770001'],
            ['nik_employee' => 'MB/F01-150056', 'nik_ktp' => '3501111307750001'],
            ['nik_employee' => 'MBLE-05230284', 'nik_ktp' => '6213083007900001'],
            ['nik_employee' => 'MBLE-210469', 'nik_ktp' => '6204021005990002'],
            ['nik_employee' => 'MBLE-052212052', 'nik_ktp' => '6371040707830015'],
            ['nik_employee' => 'MB/F01-190179', 'nik_ktp' => '6205050401990001'],
            ['nik_employee' => 'MBLE-052211020', 'nik_ktp' => '6205052711960005'],
            ['nik_employee' => 'MBLE-231005', 'nik_ktp' => '6204032303910001'],
            ['nik_employee' => 'MBLE-230847', 'nik_ktp' => '6205050310880003'],
            ['nik_employee' => 'MBLE-062302013', 'nik_ktp' => '6205050303000006'],
            ['nik_employee' => 'MBLE-230914', 'nik_ktp' => '3506112008790001'],
            ['nik_employee' => 'MBLE-0422012', 'nik_ktp' => '6205050608650001'],
            ['nik_employee' => 'MBLE-05230174', 'nik_ktp' => '6204040610030001'],
            ['nik_employee' => 'MBLE-062307027', 'nik_ktp' => '6204042003870001'],
            ['nik_employee' => 'MBLE-062307026', 'nik_ktp' => '6204042511960001'],
            ['nik_employee' => 'MBLE-062307025', 'nik_ktp' => '6204042611960004'],
            ['nik_employee' => 'MB/F01-200232', 'nik_ktp' => '6205011112010001'],
            ['nik_employee' => 'MBLE-231009', 'nik_ktp' => '6104162112990001'],
            ['nik_employee' => 'MBLE-210426', 'nik_ktp' => '6205053012000003'],
            ['nik_employee' => 'MBLE-05230170', 'nik_ktp' => '6211022404960001'],
            ['nik_employee' => 'MBLE-062302008', 'nik_ktp' => '6203111102030003'],
            ['nik_employee' => 'BK/PL-170235', 'nik_ktp' => '6204040708010003'],
            ['nik_employee' => 'BK/PL-170184', 'nik_ktp' => '6372040310710002'],
            ['nik_employee' => 'MBLE-231111', 'nik_ktp' => '6203141006870001'],
            ['nik_employee' => 'MBLE-062308032', 'nik_ktp' => '6203111202930002'],
            ['nik_employee' => 'MBLE-0321120046', 'nik_ktp' => '6271010103960002'],
            ['nik_employee' => 'MBLE-05230786', 'nik_ktp' => '3404020201700001'],
            ['nik_employee' => 'MBLE-0322010057', 'nik_ktp' => '6205051010810010'],
            ['nik_employee' => 'MBLE-05230168', 'nik_ktp' => '5304050203940001'],
            ['nik_employee' => 'MBLE-220555', 'nik_ktp' => '6305116407010002'],
            ['nik_employee' => 'MBLE-05230790', 'nik_ktp' => '6213062707910001'],
            ['nik_employee' => 'MBLE-220737', 'nik_ktp' => '6205056802040005'],
            ['nik_employee' => 'MBET-2111010013', 'nik_ktp' => '6205060604010002'],
            ['nik_employee' => 'MBLE-220570', 'nik_ktp' => '6204055603020001'],
            ['nik_employee' => 'MBLE-220769', 'nik_ktp' => '6205056306980004'],
            ['nik_employee' => 'MBLE-220678', 'nik_ktp' => '6205054206040001'],
            ['nik_employee' => 'MBLE-220552', 'nik_ktp' => '6305026704990001'],
            ['nik_employee' => 'MBLE-05230895', 'nik_ktp' => '6402160205810001'],
            ['nik_employee' => 'MBLE-220564', 'nik_ktp' => '6204061007780008'],
            ['nik_employee' => 'MBLE-220712', 'nik_ktp' => '6205050107710059'],
            ['nik_employee' => 'MBLE-052211031', 'nik_ktp' => '6203110906060001'],
            ['nik_employee' => 'MBLE-052211042', 'nik_ktp' => '6203110702970003'],
            ['nik_employee' => 'MBLE-052211043', 'nik_ktp' => '6203111110991001'],
            ['nik_employee' => 'MBLE-220723', 'nik_ktp' => '6205051010020008'],
            ['nik_employee' => 'MBLE-220725', 'nik_ktp' => '6205061008040003'],
            ['nik_employee' => 'MBLE-210461', 'nik_ktp' => '3301120111640003'],
            ['nik_employee' => 'MBLE-220540', 'nik_ktp' => '6205051409830003'],
            ['nik_employee' => 'MBLE-220793', 'nik_ktp' => '6309125706950001'],
            ['nik_employee' => 'MBLE-220705', 'nik_ktp' => '6205050310980007'],
            ['nik_employee' => 'MBLE-062308040', 'nik_ktp' => '6409042701030003'],
            ['nik_employee' => 'MBLE-0219010015', 'nik_ktp' => '6204040110900002'],
            ['nik_employee' => 'MBLE-062302015', 'nik_ktp' => '6203112811020003'],
            ['nik_employee' => 'MBLE-220704', 'nik_ktp' => '6205052910820001'],
            ['nik_employee' => 'MBLE-062304020', 'nik_ktp' => '6205052311000003'],
            ['nik_employee' => 'MBLE-220658', 'nik_ktp' => '9206144306030001 '],
            ['nik_employee' => 'MBLE-062308033', 'nik_ktp' => '6402020505011002'],
            ['nik_employee' => 'MBLE-220770', 'nik_ktp' => '6205056910030002'],
            ['nik_employee' => 'MBLE-220695', 'nik_ktp' => '6205055106030004'],
            ['nik_employee' => 'MBLE-220696', 'nik_ktp' => '6205016801020001'],
            ['nik_employee' => 'MBLE-220604', 'nik_ktp' => '6205054902000001'],
            ['nik_employee' => 'MBLE-210447', 'nik_ktp' => '6204042809980001'],
            ['nik_employee' => 'MBLE-062308035', 'nik_ktp' => '6472010803980001'],
            ['nik_employee' => 'MBLE-220595', 'nik_ktp' => '6205052910000001'],
            ['nik_employee' => 'MBLE-220596', 'nik_ktp' => '6205052005000004'],
            ['nik_employee' => 'MBLE-062301003', 'nik_ktp' => '1108042502990002'],
            ['nik_employee' => 'MB/F01-200221', 'nik_ktp' => '6205052202030004'],
            ['nik_employee' => 'MBLE-062302007', 'nik_ktp' => '6203110507920001'],
            ['nik_employee' => 'MBLE-220699', 'nik_ktp' => '3301211605990005'],
            ['nik_employee' => 'MBLE-062302011', 'nik_ktp' => '6203111110991001'],
            ['nik_employee' => 'MBLE-062307028', 'nik_ktp' => '6205052002030006'],
            ['nik_employee' => 'MBLE-220669', 'nik_ktp' => '6213061506990001'],
            ['nik_employee' => 'MBLE-052212065', 'nik_ktp' => '1471091001990021'],
            ['nik_employee' => 'MBLE-220680', 'nik_ktp' => '6213092606770001'],
            ['nik_employee' => 'MBLE-0322010050', 'nik_ktp' => '6205052306950002'],
            ['nik_employee' => 'MBLE-170178', 'nik_ktp' => '6204060709960003'],
            ['nik_employee' => 'MB/F01-170136', 'nik_ktp' => '6205051108650002'],
            ['nik_employee' => 'MB/F01-120034', 'nik_ktp' => '3506170404950003'],
            ['nik_employee' => 'MB/F01-120032', 'nik_ktp' => '6205050510760006'],
            ['nik_employee' => 'MBLE-05230791', 'nik_ktp' => '3273140805730005'],
            ['nik_employee' => 'MBLE-220541', 'nik_ktp' => '6205061306820003'],
            ['nik_employee' => 'MBLE-0422022', 'nik_ktp' => '6303051607800004'],
            ['nik_employee' => 'MBLE-0422069', 'nik_ktp' => '3316040505970002'],
            ['nik_employee' => 'MBLE-05230172', 'nik_ktp' => '6205050610930005'],
            ['nik_employee' => 'MBLE-05230173', 'nik_ktp' => '6205051003040003'],
            ['nik_employee' => 'MBLE-0220010107', 'nik_ktp' => '6204052312830001'],
            ['nik_employee' => 'MBLE-0219120106', 'nik_ktp' => '6205061508990002'],
            ['nik_employee' => 'MBLE-230878', 'nik_ktp' => '6471042202030007'],
            ['nik_employee' => 'MBLE-062304023', 'nik_ktp' => '6471051401040004'],
            ['nik_employee' => 'MBLE-062304022', 'nik_ktp' => '6402162110730001'],
            ['nik_employee' => 'MB/PL-130096', 'nik_ktp' => '1407102312880001'],
            ['nik_employee' => 'MBLE-062307030', 'nik_ktp' => '3316020709730000	'],
            ['nik_employee' => 'MBLE-220708', 'nik_ktp' => '6205050507960003'],
            ['nik_employee' => 'MBLE-0322010052', 'nik_ktp' => '6205050203970004'],
            ['nik_employee' => 'MB/F01-110018', 'nik_ktp' => '6205051010780007'],
            ['nik_employee' => 'MBLE-0321110039', 'nik_ktp' => '6205051705950001'],
            ['nik_employee' => 'MBLE-0422066', 'nik_ktp' => '6205050212990004'],
            ['nik_employee' => 'MBLE-052211041', 'nik_ktp' => '6203112305880001'],
            ['nik_employee' => 'MBLE-052212048', 'nik_ktp' => '6205050502730001'],
            ['nik_employee' => 'MBLE-05230177', 'nik_ktp' => '6203110503881001'],
            ['nik_employee' => 'MBLE-052302812', 'nik_ktp' => '6204031905010001'],
            ['nik_employee' => 'MBLE-052212047', 'nik_ktp' => '6304150404990001'],
            ['nik_employee' => 'MBLE-220772', 'nik_ktp' => '6205012710980002'],
            ['nik_employee' => 'MBLE-052212049', 'nik_ktp' => '6203111110991001'],
            ['nik_employee' => 'MBLE-05230175', 'nik_ktp' => '6309016709770001'],
            ['nik_employee' => 'MBLE-05230281', 'nik_ktp' => '6205051006920001'],
            ['nik_employee' => 'MBLE-0322010058', 'nik_ktp' => '6205020703940002'],
            ['nik_employee' => 'MBLE-052211029', 'nik_ktp' => '6203110210060001'],
            ['nik_employee' => 'MBLE-052211024', 'nik_ktp' => '6212031208920001'],
            ['nik_employee' => 'MBLE-052211032', 'nik_ktp' => '6203110607060004'],
            ['nik_employee' => 'MBLE-052211033', 'nik_ktp' => '6203110510940002'],
            ['nik_employee' => 'MBLE-052211046', 'nik_ktp' => '6203111601030002'],
            ['nik_employee' => 'BK/PL-120059', 'nik_ktp' => '6204042903870002'],
            ['nik_employee' => 'MBLE-062302012', 'nik_ktp' => '3216062207990015'],
            ['nik_employee' => 'MB/PL-220525', 'nik_ktp' => '3205202807960001'],
            ['nik_employee' => 'MBLE-200375', 'nik_ktp' => '6271010805960002'],
            ['nik_employee' => 'MB/F01-190184', 'nik_ktp' => '6205051508570006'],
            ['nik_employee' => 'MB/F01-150058', 'nik_ktp' => '6212100107801001'],
            ['nik_employee' => 'MBLE-230887', 'nik_ktp' => '3517032111700002'],
            ['nik_employee' => 'MBLE-230890', 'nik_ktp' => '3214041511960005'],
            ['nik_employee' => 'MB/PL-210420', 'nik_ktp' => '6271011504960006'],
            ['nik_employee' => 'MB/PL-230896', 'nik_ktp' => 'password'],
            ['nik_employee' => 'MBLE-0321120048', 'nik_ktp' => '3518022802690002'],
            ['nik_employee' => 'MB/PL-220823', 'nik_ktp' => '6204042910950001'],
            ['nik_employee' => 'MB/PL-220826', 'nik_ktp' => '6204040308000001'],
            ['nik_employee' => 'MBLE-200379', 'nik_ktp' => '6205051204020003'],
            ['nik_employee' => 'MBLE-220568', 'nik_ktp' => '6205051109600004'],
            ['nik_employee' => 'MBLE-220538', 'nik_ktp' => '6408021705840001'],
            ['nik_employee' => 'MBLE-220838', 'nik_ktp' => '6204062608970004'],
            ['nik_employee' => 'MB/PL-200364', 'nik_ktp' => '6205010405990002'],
            ['nik_employee' => 'MBLE-130088', 'nik_ktp' => '6205012208750001'],
            ['nik_employee' => 'MBLE-130112', 'nik_ktp' => '6205010508940001'],
            ['nik_employee' => 'MBLE-220840', 'nik_ktp' => '6204062707860001'],
            ['nik_employee' => 'MB/PL-210468', 'nik_ktp' => '6205051706770002'],
            ['nik_employee' => 'MBLE-220526', 'nik_ktp' => '6205051106950006'],
            ['nik_employee' => 'MBLE-220644', 'nik_ktp' => '6201020101040002'],
            ['nik_employee' => 'MB/PL-220524', 'nik_ktp' => '6204060303800009'],
            ['nik_employee' => 'MBLE-220721', 'nik_ktp' => '6205051203000004'],
            ['nik_employee' => 'MB/F01-200251', 'nik_ktp' => '6205050406040009'],
            ['nik_employee' => 'MB/PL-220825', 'nik_ktp' => '6204032208010001'],
            ['nik_employee' => 'MB/PL-220824', 'nik_ktp' => '6204040506020002'],
            ['nik_employee' => 'MBLE-220827', 'nik_ktp' => '6212010612980003'],
            ['nik_employee' => 'MBLE-190333', 'nik_ktp' => '6205012508000003'],
            ['nik_employee' => 'MBLE-190340', 'nik_ktp' => '6204034808950001'],
            ['nik_employee' => 'MB/PL-210386', 'nik_ktp' => '6204040504970001'],
            ['nik_employee' => 'MBLE-052211006', 'nik_ktp' => '6205020310030002'],
            ['nik_employee' => 'MBLE-220548', 'nik_ktp' => '3302241202000001'],
            ['nik_employee' => 'MB/F01-200252', 'nik_ktp' => '6205052210020007'],
            ['nik_employee' => 'MB/PL-220527', 'nik_ktp' => '6204040408980001'],
            ['nik_employee' => 'MBLE-210456', 'nik_ktp' => '6205051607900002'],
            ['nik_employee' => 'MB/PL-220526', 'nik_ktp' => '6204051401950002'],
            ['nik_employee' => 'MB/PL-210388', 'nik_ktp' => '6204060204670001'],
            ['nik_employee' => 'MB/F01-110027', 'nik_ktp' => '6204040611870001'],
            ['nik_employee' => 'MBLE-170220', 'nik_ktp' => '6205052008990004'],
            ['nik_employee' => 'MB/PL-200368', 'nik_ktp' => '6205012005800001'],
            ['nik_employee' => 'MBLE-210436', 'nik_ktp' => '6204042101840003'],
            ['nik_employee' => 'MB/PL-220829', 'nik_ktp' => '6371020604840009'],
            ['nik_employee' => 'MB/PL-100009', 'nik_ktp' => '3509040108730002'],
            ['nik_employee' => 'MB/PL-100013', 'nik_ktp' => '6205051208790006'],
            ['nik_employee' => 'MB/PL-110035', 'nik_ktp' => '3509040403690001'],
            ['nik_employee' => 'MB/PL-120054', 'nik_ktp' => '6204062709880004'],
            ['nik_employee' => 'MB/PL-120055', 'nik_ktp' => '6204040707820031'],
            ['nik_employee' => 'MB/F01-160093', 'nik_ktp' => '6205050202960002'],
            ['nik_employee' => 'MB/PL-170209', 'nik_ktp' => '6205052905800001'],
            ['nik_employee' => 'MB/PL-170232', 'nik_ktp' => '6205051010680005'],
            ['nik_employee' => 'MBLE-180285', 'nik_ktp' => '6205050907980002'],
            ['nik_employee' => 'MB/PL-200383', 'nik_ktp' => '6204041708880001'],
            ['nik_employee' => 'MB/PL-210385', 'nik_ktp' => '6213050112020002'],
            ['nik_employee' => 'MB/PL-210387', 'nik_ktp' => '6204030503020002'],
            ['nik_employee' => 'MB/PL-220818', 'nik_ktp' => '6203011610720003'],
            ['nik_employee' => 'MBLE-230880', 'nik_ktp' => '6471032901740003'],
            ['nik_employee' => 'MB/PL-230883', 'nik_ktp' => '6213051404980002'],
            ['nik_employee' => 'MBLE-0321100022', 'nik_ktp' => '6204062308830004'],
            ['nik_employee' => 'MB/HO-080010', 'nik_ktp' => '6205051008760001'],
            ['nik_employee' => 'MB/HO-100015', 'nik_ktp' => '6205051509720001'],
            ['nik_employee' => 'MB/HO-170045', 'nik_ktp' => '6205051102880003'],
            ['nik_employee' => 'MB/F01-170124', 'nik_ktp' => '6304102310980002'],
            ['nik_employee' => 'MB/HO-190062', 'nik_ktp' => '6205055302970006'],
            ['nik_employee' => 'MB/HO-180057', 'nik_ktp' => '6205065006000003'],
            ['nik_employee' => 'MBLE-080007', 'nik_ktp' => '6205051412880003'],
            ['nik_employee' => 'MB/HO-130024', 'nik_ktp' => '6205052306650001'],
            ['nik_employee' => 'MB/HO-140036', 'nik_ktp' => '6205053011930003'],
            ['nik_employee' => 'MB/F0-150147', 'nik_ktp' => '6205052804710002'],
            ['nik_employee' => 'MB/HO-200090', 'nik_ktp' => '6205052209850002'],
            ['nik_employee' => 'MB/HO-210092', 'nik_ktp' => '6205050208620003'],
            ['nik_employee' => 'MBLE-0219070054', 'nik_ktp' => '6205050812750001'],
            ['nik_employee' => 'MB/HO-180052', 'nik_ktp' => '3507230202700002'],
            ['nik_employee' => 'MB/PL-210455', 'nik_ktp' => '3519124709970003'],
            ['nik_employee' => 'MB/HO-100014', 'nik_ktp' => '6205050106920002'],
            ['nik_employee' => 'MB/PL-110039', 'nik_ktp' => '3278031206740023'],
            ['nik_employee' => 'MB/HO-110017', 'nik_ktp' => '6205051206680003'],
            ['nik_employee' => 'MBLE-170238', 'nik_ktp' => '6205050103020006'],
            ['nik_employee' => 'MBLE-220660', 'nik_ktp' => '6204056906980001'],
            ['nik_employee' => 'MBLE-220654', 'nik_ktp' => '6205054306030002'],
            ['nik_employee' => 'MBLE-0321100014', 'nik_ktp' => '6205054610030003'],
            ['nik_employee' => 'MBLE-220787', 'nik_ktp' => '6205056011000004'],
            ['nik_employee' => 'MBLE-220659', 'nik_ktp' => '6204046107990001'],
            ['nik_employee' => 'MBLE-220653', 'nik_ktp' => '6205056911930004'],
            ['nik_employee' => 'MBLE-220522', 'nik_ktp' => '1222036301930003'],
            ['nik_employee' => 'MBLE-210422', 'nik_ktp' => '6304110211840002'],
            ['nik_employee' => 'MBLE-220639', 'nik_ktp' => '6205050801030002'],
            ['nik_employee' => 'MBLE-210416', 'nik_ktp' => '6204032707910002'],
            ['nik_employee' => 'MBLE-220557', 'nik_ktp' => '6213062904880001'],
            ['nik_employee' => 'MBLE-220594', 'nik_ktp' => '6205050602980003'],
            ['nik_employee' => 'MBLE-220719', 'nik_ktp' => '6205012712020002'],
            ['nik_employee' => 'MBLE-210489', 'nik_ktp' => '3301211605990005'],
            ['nik_employee' => 'MBLE-220767', 'nik_ktp' => '6204052502990001'],
            ['nik_employee' => 'MBLE-220717', 'nik_ktp' => '6205052501990002'],
            ['nik_employee' => 'MBLE-220771', 'nik_ktp' => '6372053004880002'],
            ['nik_employee' => 'MBET-2111010012', 'nik_ktp' => '6205052105930001'],
            ['nik_employee' => 'MBLE-220549', 'nik_ktp' => '6205051307960004'],
            ['nik_employee' => 'MBLE-210466', 'nik_ktp' => '3304050704690003'],
            ['nik_employee' => 'MBLE-210500', 'nik_ktp' => '6212030110720002'],
            ['nik_employee' => 'MBLE-210480', 'nik_ktp' => '6205012210800001'],
            ['nik_employee' => 'MBLE-220662', 'nik_ktp' => '3316044606010004'],
            ['nik_employee' => 'MBLE-210399', 'nik_ktp' => '6205052110990004'],
            ['nik_employee' => 'MBLE-220663', 'nik_ktp' => '6303055909940003'],
            ['nik_employee' => 'MBLE-220531', 'nik_ktp' => '6213092712670001'],
            ['nik_employee' => 'MBLE-220533', 'nik_ktp' => '6205051701910007'],
            ['nik_employee' => 'MBLE-220754', 'nik_ktp' => '6309042803700003'],
            ['nik_employee' => 'MBLE-220698', 'nik_ktp' => '6205052310890004'],
            ['nik_employee' => 'MBLE-220525', 'nik_ktp' => '6205050907940005'],
            ['nik_employee' => 'MBLE-170227', 'nik_ktp' => '6205020307830002'],
            ['nik_employee' => 'MBLE-0321110029', 'nik_ktp' => '3304120206690007'],
            ['nik_employee' => 'MBLE-220758', 'nik_ktp' => '6307020610970002'],
            ['nik_employee' => 'MBLE-210517', 'nik_ktp' => '3301211605990005'],
            ['nik_employee' => 'MBLE-210458', 'nik_ktp' => '3301120205660005'],
            ['nik_employee' => 'MBLE-190315', 'nik_ktp' => '1271042505930006'],
            ['nik_employee' => 'MBLE-210493', 'nik_ktp' => '3507232507720001'],
            ['nik_employee' => 'MBLE-130069', 'nik_ktp' => '6205010909910002'],
            ['nik_employee' => 'MBLE-05230787', 'nik_ktp' => '6304171709890001'],
            ['nik_employee' => 'MBLE-220642', 'nik_ktp' => '6213082404940001'],
            ['nik_employee' => 'MBLE-140116', 'nik_ktp' => '6205052511790001'],
            ['nik_employee' => 'MBLE-05230385', 'nik_ktp' => '6205060406760002'],
            ['nik_employee' => 'MBLE-140143', 'nik_ktp' => '1205170604880004'],
            ['nik_employee' => 'MB/F01-1903080', 'nik_ktp' => '6212041208980002'],
            ['nik_employee' => 'MBLE-220802', 'nik_ktp' => '6205056603030006'],
            ['nik_employee' => 'MBLE-230934', 'nik_ktp' => '6203110110990003'],
            ['nik_employee' => 'MBLE-220614', 'nik_ktp' => '6371030210760008'],
            ['nik_employee' => 'MBLE-052211016', 'nik_ktp' => '6205052708870003'],
            ['nik_employee' => 'MBLE-210434', 'nik_ktp' => '6205051410840002'],
            ['nik_employee' => 'MBLE-220761', 'nik_ktp' => '6205012009060001'],
            ['nik_employee' => 'MBLE-220762', 'nik_ktp' => '6204041310960002'],
            ['nik_employee' => 'MBLE-180296', 'nik_ktp' => '6204041310960002'],
            ['nik_employee' => 'MB/F01-100015', 'nik_ktp' => '6205020107690005'],
            ['nik_employee' => 'MB/PL-120046', 'nik_ktp' => '6204040708860003'],
            ['nik_employee' => 'MBLE-230931', 'nik_ktp' => '3322021206660002'],
            ['nik_employee' => 'MBLE-230932', 'nik_ktp' => '6205060505030002'],
            ['nik_employee' => 'MBLE-230915', 'nik_ktp' => '6271030403020004'],
            ['nik_employee' => 'MBLE-052211038', 'nik_ktp' => '6205051005060003'],
            ['nik_employee' => 'MB/F01-170121', 'nik_ktp' => '6205051707670001'],
            ['nik_employee' => 'MBLE-0422030', 'nik_ktp' => '6205055812940002'],
            ['nik_employee' => 'MBLE-0422079', 'nik_ktp' => '6310032412030001'],
            ['nik_employee' => 'MBLE-170247', 'nik_ktp' => '6213012608970002'],
            ['nik_employee' => 'MBLE-160163', 'nik_ktp' => 'password'],
            ['nik_employee' => 'MBLE-110024', 'nik_ktp' => '6213081208690001'],
            ['nik_employee' => 'MBLE-120042', 'nik_ktp' => '6201020606670004'],
            ['nik_employee' => 'MBLE-170239', 'nik_ktp' => '6371030404770025'],
            ['nik_employee' => 'MBLE-220530', 'nik_ktp' => '6205012311870002'],
            ['nik_employee' => 'MBLE-220546', 'nik_ktp' => '1207242005860002'],
            ['nik_employee' => 'MBLE-220686', 'nik_ktp' => '6474020712890005'],
            ['nik_employee' => 'MBLE-220691', 'nik_ktp' => '6204062306990004'],
            ['nik_employee' => 'MBLE-220692', 'nik_ktp' => '6204031012010001'],
            ['nik_employee' => 'MBLE-230861', 'nik_ktp' => '7371121304040003'],
            ['nik_employee' => 'MBLE-130073', 'nik_ktp' => '6204061312930001'],
            ['nik_employee' => 'MBLE-140138', 'nik_ktp' => '6205051812710002'],
            ['nik_employee' => 'MBLE-190343', 'nik_ktp' => '6205040707860002'],
            ['nik_employee' => 'MBLE-210430', 'nik_ktp' => '6212032312750002'],
            ['nik_employee' => 'MBLE-210471', 'nik_ktp' => '6205050503030001'],
            ['nik_employee' => 'MBLE-0322010063', 'nik_ktp' => '6205041211860001'],
            ['nik_employee' => 'MBLE-220607', 'nik_ktp' => '6205050302000003'],
            ['nik_employee' => 'MBLE-220703', 'nik_ktp' => '6204042404040002'],
            ['nik_employee' => 'MBLE-210428', 'nik_ktp' => '6371051509000002'],
            ['nik_employee' => 'MBLE-210432', 'nik_ktp' => '6205011902030001'],
            ['nik_employee' => 'MBLE-032110028', 'nik_ktp' => '6371022712630005'],
            ['nik_employee' => 'MBLE-210507', 'nik_ktp' => '6201020510890004'],
            ['nik_employee' => 'MBLE-220560', 'nik_ktp' => '3215050505680008'],
            ['nik_employee' => 'MBLE-220647', 'nik_ktp' => '3504082210880001'],
            ['nik_employee' => 'MBLE-0422005', 'nik_ktp' => '6205056301030002'],
            ['nik_employee' => 'MBLE-220697', 'nik_ktp' => '3304040105020001'],
            ['nik_employee' => 'MBLE-0422010', 'nik_ktp' => '6204041005030004'],
            ['nik_employee' => 'MBLE-220707', 'nik_ktp' => '3272020310020903'],
            ['nik_employee' => 'MBLE-220711', 'nik_ktp' => '6204060203980001'],
            ['nik_employee' => 'MBLE-220729', 'nik_ktp' => '1807211411000001'],
            ['nik_employee' => 'MBLE-220752', 'nik_ktp' => '6204060412960002'],
            ['nik_employee' => 'MBLE-220764', 'nik_ktp' => '6213091507820001'],
            ['nik_employee' => 'MBLE-220774', 'nik_ktp' => '6204061502040002'],
            ['nik_employee' => 'MBLE-220775', 'nik_ktp' => '3275090310930014'], 
            ['nik_employee' => 'MBLE-220776', 'nik_ktp' => '6302110301030004'],
            ['nik_employee' => 'MB/F01-200225', 'nik_ktp' => '6205050810990002'],
            ['nik_employee' => 'MBLE-220791', 'nik_ktp' => '6308041206990004'],
            ['nik_employee' => 'MBLE-220835', 'nik_ktp' => '6371012209960009'],
            ['nik_employee' => 'MBLE-230853', 'nik_ktp' => '6204050110760003'],
            ['nik_employee' => 'MBLE-230851', 'nik_ktp' => '6205020502040002'],
            ['nik_employee' => 'MBLE-230857', 'nik_ktp' => '6205050909790012'],
            ['nik_employee' => 'MBLE-230866', 'nik_ktp' => '6205051509020001'],
            ['nik_employee' => 'MBLE-230873', 'nik_ktp' => '6205050509020003'],
            ['nik_employee' => 'MBLE-230881', 'nik_ktp' => '3506062810040003'],
            ['nik_employee' => 'MBLE-080005', 'nik_ktp' => '6205050205860003'],
            ['nik_employee' => 'MBLE-100014', 'nik_ktp' => '6205052109670002'],
            ['nik_employee' => 'MBLE-100016', 'nik_ktp' => '3504102602620001'],
            ['nik_employee' => 'MBLE-210482', 'nik_ktp' => '6205050103020006'],
            ['nik_employee' => 'MBLE-120056', 'nik_ktp' => '6204042811700001'],
            ['nik_employee' => 'MBLE-130066', 'nik_ktp' => '3318042304700002'],
            ['nik_employee' => 'MBLE-130071', 'nik_ktp' => '6205012208890003'],
            ['nik_employee' => 'MBLE-130100', 'nik_ktp' => '6371030811690010'],
            ['nik_employee' => 'MBLE-140123', 'nik_ktp' => '6205050212870002'],
            ['nik_employee' => 'MBLE-230879', 'nik_ktp' => '6205052802040002'],
            ['nik_employee' => 'MBLE-190335', 'nik_ktp' => '6205050506840007'],
            ['nik_employee' => 'MBLE-0219100080', 'nik_ktp' => '6205052409830003'],
            ['nik_employee' => 'MBLE-0219110098', 'nik_ktp' => '6205052112910006'],
            ['nik_employee' => 'MBLE-200374', 'nik_ktp' => '6205051512730002'],
            ['nik_employee' => 'MBLE-200378', 'nik_ktp' => '6205050606850004'],
            ['nik_employee' => 'MBLE-200382', 'nik_ktp' => '6371031904010012'],
            ['nik_employee' => 'MBLE-210390', 'nik_ktp' => '6205011204010001 '],
            ['nik_employee' => 'MBLE-210391', 'nik_ktp' => '6205011810800001'],
            ['nik_employee' => 'MBLE-210392', 'nik_ktp' => '6205011005740001'],
            ['nik_employee' => 'MB/F01-170115', 'nik_ktp' => '6205031412910002'],
            ['nik_employee' => 'MB/F01-150060', 'nik_ktp' => '6205051109690001'],
            ['nik_employee' => 'MB/F01-150075', 'nik_ktp' => '6205052807610001'],
            ['nik_employee' => 'MBLE-220638', 'nik_ktp' => '6213051307000003'],
            ['nik_employee' => 'MB/F01-150069', 'nik_ktp' => '6205052011940002'],
            ['nik_employee' => 'MB/F01-150087', 'nik_ktp' => '6205050601810001'],
            ['nik_employee' => 'MB/F01-180156', 'nik_ktp' => '6205050305990003'],
            ['nik_employee' => 'MBLE-0220010109', 'nik_ktp' => '6205054609030003'],
            ['nik_employee' => 'MB/F01-110023', 'nik_ktp' => '6303120406890002'],
            ['nik_employee' => 'MBLE-230867', 'nik_ktp' => '6213051612000001'],
            ['nik_employee' => 'MBLE-230918', 'nik_ktp' => '6213050107020030'],
            ['nik_employee' => 'MBLE-230923', 'nik_ktp' => '3312185004880001'],
            ['nik_employee' => 'MBLE-230933', 'nik_ktp' => '3329052101760001'],
            ['nik_employee' => 'MBLE-231006', 'nik_ktp' => '6308011010740004'],
            ['nik_employee' => 'MBLE-231003', 'nik_ktp' => '3506180606690011'],
            ['nik_employee' => 'MBLE-231004', 'nik_ktp' => '6308061901910002'],
            ['nik_employee' => 'MBLE-231112', 'nik_ktp' => '3604042707740325'],
            ['nik_employee' => 'MBLE-230845', 'nik_ktp' => '6271032807960005'],
            ['nik_employee' => 'MBLE-0321100003', 'nik_ktp' => '6205052205970003'],
            ['nik_employee' => 'MBLE-220616', 'nik_ktp' => '6204060501960001'],
            ['nik_employee' => 'MBLE-220645', 'nik_ktp' => '3321010301970006'],
            ['nik_employee' => 'MBLE-220535', 'nik_ktp' => '6213050210000001'],
            ['nik_employee' => 'MBLE-220718', 'nik_ktp' => '6205010904000002'],
            ['nik_employee' => 'MBLE-230870', 'nik_ktp' => '6301030409790008'],
            ['nik_employee' => 'MBLE-230871', 'nik_ktp' => '3506252708610003 '],
            ['nik_employee' => 'MBLE-110021', 'nik_ktp' => '6213011705700002'],
            ['nik_employee' => 'MBLE-230884', 'nik_ktp' => '3327121304970002'],
            ['nik_employee' => 'MBLE-230891', 'nik_ktp' => '3275032410000012'],
            ['nik_employee' => 'BK/PL-220367', 'nik_ktp' => '6203012512950008'],
            ['nik_employee' => 'MBLE-0422083', 'nik_ktp' => '6372020611810001'],
            ['nik_employee' => 'MB/F01-190172', 'nik_ktp' => 'password'],
            ['nik_employee' => 'MB/F01-130037', 'nik_ktp' => '6205050507750009'],
            ['nik_employee' => 'MB/F01-160099', 'nik_ktp' => '6371042403750003'],
            ['nik_employee' => 'MBLE-230913', 'nik_ktp' => '3327122505030004'],
            ['nik_employee' => 'MBLE-231002', 'nik_ktp' => '6205050708670004'],
            ['nik_employee' => 'MBLE-0422084', 'nik_ktp' => '6205050803050003'],
            ['nik_employee' => 'MBLE-0422027', 'nik_ktp' => '6205055507980005'],
            ['nik_employee' => 'MBLE-0422041', 'nik_ktp' => '6204030909030003'],
            ['nik_employee' => 'MBLE-220591', 'nik_ktp' => '3312200808020001'],
            ['nik_employee' => 'MBLE-220610', 'nik_ktp' => '6203041006940002'],
            ['nik_employee' => 'MBLE-220700', 'nik_ktp' => '6205026608020001'],
            ['nik_employee' => 'MBLE-220822', 'nik_ktp' => '6205056511000003'],
            ['nik_employee' => 'MBLE-230842', 'nik_ktp' => '6205012103050001'],
            ['nik_employee' => 'MBLE-230856', 'nik_ktp' => '6304053009730001'],
            ['nik_employee' => 'MBLE-110027', 'nik_ktp' => '6205024609700001'],
            ['nik_employee' => 'MBLE-210437', 'nik_ktp' => '6205020607030001'],
            ['nik_employee' => 'MBLE-210508', 'nik_ktp' => '6205050205730005 '],
            ['nik_employee' => 'MBLE-230865', 'nik_ktp' => '6204055603020001'],
            ['nik_employee' => 'MBLE-210496', 'nik_ktp' => '6205050206030005'],
            ['nik_employee' => 'MBLE-220528', 'nik_ktp' => '6204034806850001'],
            ['nik_employee' => 'MBLE-220573', 'nik_ktp' => '6205050501000003'],
            ['nik_employee' => 'MBLE-220633', 'nik_ktp' => '6205055112860002'],
            ['nik_employee' => 'MBLE-0422002', 'nik_ktp' => '6371052212930004'],
            ['nik_employee' => 'MBLE-0422003', 'nik_ktp' => '62130828081234563'],
            ['nik_employee' => 'MBLE-220713', 'nik_ktp' => '6204040708010003'],
            ['nik_employee' => 'MBLE-220716', 'nik_ktp' => '6205010505030001'],
            ['nik_employee' => 'MBLE-220757', 'nik_ktp' => '6205025710040005'],
            ['nik_employee' => 'MBLE-220819', 'nik_ktp' => '6205020607010004'],
            ['nik_employee' => 'MBLE-05230178', 'nik_ktp' => '3175064212990008'],
            ['nik_employee' => 'MBLE-230852', 'nik_ktp' => '6307040507930003'],
            ['nik_employee' => 'MBLE-230854', 'nik_ktp' => '3504101010950004'],
            ['nik_employee' => 'MBLE-230858', 'nik_ktp' => '6205024602740001'],
            ['nik_employee' => 'MBLE-230859', 'nik_ktp' => '6205025304910001'],
            ['nik_employee' => 'MBLE-230868', 'nik_ktp' => '6304170701890002'],
            ['nik_employee' => 'MBLE-080006', 'nik_ktp' => '6205011005720001'],
            ['nik_employee' => 'MBLE-110031', 'nik_ktp' => '3509114808770009'],
            ['nik_employee' => 'MBLE-200369', 'nik_ktp' => '6205060101690002'],
            ['nik_employee' => 'MBLE-230910', 'nik_ktp' => '6472022007660004'],
            ['nik_employee' => 'MBLE-062304024', 'nik_ktp' => '6204042807770004'],
            ['nik_employee' => 'MBLE-0321100002', 'nik_ktp' => '6304084804920002'],
            ['nik_employee' => 'MB/F01-200199', 'nik_ktp' => 'password'],
            ['nik_employee' => 'MB/PL-100012', 'nik_ktp' => '6205050208700004'],
            ['nik_employee' => 'MB/F01-130045', 'nik_ktp' => '6205055612820003'],
            ['nik_employee' => 'MB/F01-170109', 'nik_ktp' => '6205054508760001'],
            ['nik_employee' => 'MBLE-230927', 'nik_ktp' => '6204044612040001'],
            ['nik_employee' => 'MB/F01-180153', 'nik_ktp' => '6205055102730003'],
            ['nik_employee' => 'MB/F01-200236', 'nik_ktp' => '6213092911020001'],
            ['nik_employee' => 'MBLE-230916', 'nik_ktp' => '6205025706050002'],
            ['nik_employee' => 'MBLE-230917', 'nik_ktp' => '6205055102030005'],
            ['nik_employee' => 'MBLE-230919', 'nik_ktp' => '6204045910990002'],
            ['nik_employee' => 'MBLE-230920', 'nik_ktp' => '6204036712010000'],
            ['nik_employee' => 'MBLE-230921', 'nik_ktp' => '6205051405920004'],
            ['nik_employee' => 'MBLE-230924', 'nik_ktp' => '6204034412010002'],
            ['nik_employee' => 'MBLE-230925', 'nik_ktp' => '6204045705060002'],
            ['nik_employee' => 'MBLE-231007', 'nik_ktp' => '6402061510820004'],
            ['nik_employee' => 'MBLE-230926', 'nik_ktp' => '6204034203030002'],
            ['nik_employee' => 'MBLE-230929', 'nik_ktp' => '3175020308820015'],
            ['nik_employee' => 'MBLE-231001', 'nik_ktp' => '3509025111050001'],
            ['nik_employee' => 'MBLE-0422077', 'nik_ktp' => '6205022904040001'],
            ['nik_employee' => 'MBLE-220666', 'nik_ktp' => '6205051106800003'],
            ['nik_employee' => 'MB/F01-150080', 'nik_ktp' => '6205050404800005'],
            ['nik_employee' => 'MBLE-170185', 'nik_ktp' => '3509040605730002'],
            ['nik_employee' => 'MBLE-130090', 'nik_ktp' => '6205011201730001'],
            ['nik_employee' => 'MBLE-230930', 'nik_ktp' => '6310091401820004'],
            ['nik_employee' => 'MBLE-130082', 'nik_ktp' => '6205050712820004'],
            ['nik_employee' => 'MBLE-0422061', 'nik_ktp' => '1212017009990005'],
            ['nik_employee' => 'MB/F01-110022', 'nik_ktp' => '3520171406890003'],
            ['nik_employee' => 'MBLE-230862', 'nik_ktp' => '6204042612030001'],
            ['nik_employee' => 'MBLE-170205', 'nik_ktp' => '6204050707950007'],
            ['nik_employee' => 'MBLE-210397', 'nik_ktp' => '6205012504930001'],
            ['nik_employee' => 'MBLE-230906', 'nik_ktp' => '6201061708740001'],
            ['nik_employee' => 'MBLE-170233', 'nik_ktp' => '6205052304950005'],
            ['nik_employee' => 'MBLE-230898', 'nik_ktp' => '6206052008840002'],
            ['nik_employee' => 'MBLE-220668', 'nik_ktp' => '6205051104830003'],
            ['nik_employee' => 'MBLE-220551', 'nik_ktp' => '6205051109800001'],
            ['nik_employee' => 'MBLE-210413', 'nik_ktp' => '6205061212860004'],
            ['nik_employee' => 'MBLE-052211010', 'nik_ktp' => '6204040512870103'],
            ['nik_employee' => 'MBLE-220613', 'nik_ktp' => '6205051210910003'],
            ['nik_employee' => 'MBLE-210401', 'nik_ktp' => '6205052804970004'],
            ['nik_employee' => 'MBLE-220609', 'nik_ktp' => '6205051405960002'],
            ['nik_employee' => 'MBLE-220744', 'nik_ktp' => '6204060412820003 '],
            ['nik_employee' => 'MBLE-140131', 'nik_ktp' => '6205012710930001'],
            ['nik_employee' => 'MBLE-130101', 'nik_ktp' => '6205052810780004'],
            ['nik_employee' => 'MBLE-170249', 'nik_ktp' => '6205053003980004'],
            ['nik_employee' => 'MBLE-210396', 'nik_ktp' => '6204061406990001'],
            ['nik_employee' => 'MBLE-140130', 'nik_ktp' => '6213080705860001'],
            ['nik_employee' => 'MBLE-0219080058', 'nik_ktp' => '6205061109880003'],                                                                                                
            ['nik_employee' => 'MBLE-210394', 'nik_ktp' => '6301040102900001'],
            ['nik_employee' => 'MBLE-0322010065', 'nik_ktp' => '6205050801790003'],
            ['nik_employee' => 'MBLE-130075', 'nik_ktp' => '6204050207700003'],
            ['nik_employee' => 'MBLE-130086', 'nik_ktp' => '6213082304830002'],
            ['nik_employee' => 'MBLE-130102', 'nik_ktp' => '3301041102870006'],
            ['nik_employee' => 'MBLE-170228', 'nik_ktp' => '6205050107840097'],
            ['nik_employee' => 'MBLE-130092', 'nik_ktp' => '6212010206780002'],
            ['nik_employee' => 'MBLE-180264', 'nik_ktp' => '6205050504760003'],
            ['nik_employee' => 'MBLE-130074', 'nik_ktp' => '6205050107700122'],
            ['nik_employee' => 'MBLE-140119', 'nik_ktp' => '6204052608860001'],
            ['nik_employee' => 'MBLE-0321110040', 'nik_ktp' => 'password'],
            ['nik_employee' => 'MBLE-231110', 'nik_ktp' => '6306071604910003'],
            ['nik_employee' => 'MBLE-0422001', 'nik_ktp' => '1272011109970001'],
            ['nik_employee' => 'MBLE-220681', 'nik_ktp' => '6204040708010003'],
            ['nik_employee' => 'MBLE-220608', 'nik_ktp' => '6207016809950001'],
            ['nik_employee' => 'MBLE-220682', 'nik_ktp' => '6204065906000001'],
            ['nik_employee' => 'MBLE-230882', 'nik_ktp' => '3321110401880003'],
            ['nik_employee' => 'MBLE-0218120001', 'nik_ktp' => '6205052212730005'],
            ['nik_employee' => 'MBLE-120020', 'nik_ktp' => '6205052702840003'],
            ['nik_employee' => 'MBLE-210435', 'nik_ktp' => '6372021203770002'],
            ['nik_employee' => 'MBLE-0422024', 'nik_ktp' => '6310030107770087'],
            ['nik_employee' => 'MBLE-0422042', 'nik_ktp' => '6204030209990001'],
            ['nik_employee' => 'MB/F01-160101', 'nik_ktp' => '6204050603880001'],
            ['nik_employee' => 'MBLE-210429', 'nik_ktp' => '6204041605900002'],
            ['nik_employee' => 'MBLE-0321100010', 'nik_ktp' => '6371040905950007'],
            ['nik_employee' => 'MBLE-0422049', 'nik_ktp' => '6205010706040001'],
            ['nik_employee' => 'MBLE-0422051', 'nik_ktp' => '6213081807000001'],
            ['nik_employee' => 'MBLE-0422070', 'nik_ktp' => '6472020101050005'],
            ['nik_employee' => 'MB/F01-150077', 'nik_ktp' => '6212032309850002'],
            ['nik_employee' => 'MBLE-190328', 'nik_ktp' => '6204042709900005'],
            ['nik_employee' => 'MBLE-210427', 'nik_ktp' => '6205024402730001'],
            ['nik_employee' => 'MBLE-0422016', 'nik_ktp' => '6205011011640004'],
            ['nik_employee' => 'MBLE-0422081', 'nik_ktp' => '6203116805880003'],
            ['nik_employee' => 'MBLE-0422082', 'nik_ktp' => '6205053009030001'],
            ['nik_employee' => 'MB/F01-180157', 'nik_ktp' => '6305066710840001'],
            ['nik_employee' => 'MB/HO-130032', 'nik_ktp' => '6205050204790004'],
            ['nik_employee' => 'MB/HO-130028', 'nik_ktp' => '6205051808920008'],
            ['nik_employee' => 'MB/HO-050007', 'nik_ktp' => 'password'],
            ['nik_employee' => 'MB/HO-040006', 'nik_ktp' => '6205054303850011'],
            ['nik_employee' => 'MB/HO-180051', 'nik_ktp' => '6205076702950001'],
            ['nik_employee' => 'MB/FO-170342', 'nik_ktp' => '6205052609980002'],
            ['nik_employee' => 'MB/HO-200063', 'nik_ktp' => '6205052810680001'],
            ['nik_employee' => 'MB/PL-200361', 'nik_ktp' => '6304151810860002'],
            ['nik_employee' => 'MBLE-231201', 'nik_ktp' => '3205162311790001'],
            
            ['nik_employee' => 'MBLE-220681', 'nik_ktp' => '6204040710950003'],
            ['nik_employee' => 'MBLE-0422003', 'nik_ktp' => '62130828081234563'],
            ['nik_employee' => 'MB/PL-210455', 'nik_ktp' => '1234']
            
        ];

        // $user_nik = [
            
        // ];
            
        foreach($user_nik as $item){
            $nik_employee_uuid = ResponseFormatter::toUUID($item['nik_employee']);
            
            $nik_ktp = $item['nik_ktp'];
            User::updateOrCreate(['employee_uuid'=> $nik_employee_uuid],[
                'uuid'=> $nik_employee_uuid,
                'employee_uuid'=>$nik_employee_uuid,
                'role'=>'employee',
                'nik_employee' => $nik_employee_uuid,
                'password'  =>  Hash::make($nik_ktp)
            ]);
        }

        ResponseFormatter::setAllSession();
        return view('employee.index', [
            'title'         => 'Daftar Karyawan',
            'layout'    => $layout
        ]);
    }

    public function History()
    { //use
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
        'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index'
        ];
        ResponseFormatter::setAllSession();
        return view('employee.index', [
            'title'         => 'Daftar Karyawan',
            'layout'    => $layout
        ]);
    }

    public function deleteAll()
    {
        $data = Employee::where('employees.nik_employee', '!=', 'MBLE-0422003')->delete();
        $data = UserDetail::where('user_details.uuid', '!=', 'MBLE-0422003')->delete();
        // $data = Department::where('departments.uuid', '!=', 'IT')->delete();
        // $data = Position::where('positions.uuid', '!=', 'ETL-DEVELOPER')->delete();
        $data = EmployeeCompany::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeDebt::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeHourMeterDay::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeTonase::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeePayment::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeePremi::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeRoaster::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeSalary::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeCutiSetup::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeCuti::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeOut::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserAddress::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserPrivilege::where('nik_employee', '!=', 'MBLE-0422003')->delete();
        $data = UserHealth::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserLicense::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserReligion::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserEducation::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserDependent::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        return redirect()->back();
        // dd($data);
        return view('datatableshow', ['data'         => $data]);
        return 'delete';
    }

    public function delete(Request $request)
    {
        $data_emp = Employee::whereNull('employees.date_end')->get()->first();
        $data = Employee::where('employees.nik_employee', $request->uuid)->delete();
        $data = UserDetail::where('user_details.uuid', $request->uuid)->delete();
        $data = Department::where('departments.uuid', $request->uuid)->delete();
        $data = Position::where('positions.uuid', $request->uuid)->delete();
        $data = EmployeeCompany::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeDebt::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeHourMeterDay::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeTonase::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeePayment::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeePremi::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeRoaster::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeSalary::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeOut::where('employee_uuid', $request->uuid)->delete();
        $data = UserAddress::where('user_detail_uuid', $request->uuid)->delete();
        $data = UserPrivilege::where('nik_employee', $request->uuid)->delete();
        $data = UserHealth::where('user_detail_uuid', $request->uuid)->delete();
        $data = UserLicense::where('user_detail_uuid', $request->uuid)->delete();
        $data = UserReligion::where('user_detail_uuid', $request->uuid)->delete();
        $data = UserEducation::where('user_detail_uuid', $request->uuid)->delete();
        $data = UserDependent::where('user_detail_uuid', $request->uuid)->delete();
        $data = EmployeeAbsen::where('employee_uuid', $data_emp->machine_id)->delete();
        $data = EmployeeCutiSetup::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeCuti::where('employee_uuid', $request->uuid)->delete();
        return redirect()->back();
        // dd($data);
        return view('datatableshow', ['data'         => $data]);
        return 'delete';
    }

    public function export(Request $request)
    {
        $validatedData = $request->all();
        $validatedData['data_export'] = json_decode($request->data_export);
        $data_session = session('data_database');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();



        $createSheet->setCellValue('A19', 'NO.');
        $createSheet->setCellValue('B19', 'NAMA');
        $createSheet->setCellValue('C19', 'NIK');
        $createSheet->setCellValue('D19', 'POSISI');
        $createSheet->setCellValue('E19', 'DEPARTEMEN');
        $createSheet->setCellValue('F19', 'SITE');
        $createSheet->setCellValue('G19', 'PERUSAHAAN');
        

        $validatedData['data_export'] = (array)$validatedData['data_export'];

        $row_employees = 21;

        foreach ($validatedData['data_export'] as $item_data_export) {
            $createSheet->setCellValue('B' . $row_employees, $data_session['data_employees'][$item_data_export->nik_employee]['name']);
            $createSheet->setCellValue('C' . $row_employees, $item_data_export->nik_employee_with_space);
            $createSheet->setCellValue('D' . $row_employees, $data_session['data_employees'][$item_data_export->nik_employee]['position']);
            $createSheet->setCellValue('E' . $row_employees, $data_session['data_employees'][$item_data_export->nik_employee]['department']);
            $createSheet->setCellValue('F' . $row_employees, $item_data_export->site_uuid);
            $createSheet->setCellValue('G' . $row_employees, $item_data_export->company_uuid);

            $row_employees++;
        }

        $createSheet->mergeCells('A19:A20');
        $createSheet->mergeCells('B19:B20');
        $createSheet->mergeCells('C19:C20');
        $createSheet->mergeCells('D19:D20');
        $createSheet->mergeCells('E19:E20');
        $createSheet->mergeCells('F19:F20');
        $createSheet->mergeCells('G19:G20');

        $styleArray_header = array(
            'font' => [
                'bold' => true,
            ],
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
                'inside' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '4c4ce9'
                ]
            ],
        );
        //header
        $createSheet->getStyle('A19:G20')->applyFromArray($styleArray_header);
        $createSheet->getColumnDimension('B')->setAutoSize(true);
        $createSheet->getColumnDimension('C')->setAutoSize(true);
        $createSheet->getColumnDimension('D')->setAutoSize(true);
        $createSheet->getColumnDimension('E')->setAutoSize(true);
        $createSheet->getColumnDimension('F')->setAutoSize(true);
        $createSheet->getColumnDimension('G')->setAutoSize(true);



        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/export-karyawan-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::toJson($name, $validatedData);

        return ResponseFormatter::toJson($request->filter, 'hi i am from function export on employees');
    }

    public function test()
    { //big use
        $data = Employee::get_employee_all();
        return view('datatableshow', ['data'         => $data]);
    }



    public function indexContract()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-contract'
        ];
        return view('employee.monitoring.index', [
            'title'         => 'Daftar Karyawan',
            'layout'    => $layout
        ]);

        // Employee::whereNull('nik_employee')->delete();

        $data = Employee::whereNull('date_end')->get();
        $date_now = Carbon::now()->subMonth();

        // return $date_now;
        $arr_start_contract = [];



        foreach ($data as $item) {

            $date = new Carbon($item->date_document_contract);
            $arr_start_contract[] = [
                'nik_employee'  => $item->nik_employee,
                'date_start_contract' =>  $date->format("Y-m-d"),
                'date_end_training' => $date->addMonths(3)->format("Y-m-d")
            ];



            if ($date_now > $date) { //masih tanggal lama

                while ($date_now > $date) {
                    $date_start_contract = $date;
                    $date->addMonths(12);
                }

                if (empty($item->employee_status)) {
                    Employee::updateOrCreate(['uuid' => $item->nik_employee], ['employee_status' => 'Profesional']);
                }
                if (empty($item->date_end_contract)) {
                    Employee::updateOrCreate(['uuid' => $item->nik_employee], ['date_end_contract' => $date->format("Y-m-d"), 'date_start_contract' => $date_start_contract->format("Y-m-d")]);
                }
            } else { // kena training
                if (empty($item->employee_status)) {
                    Employee::updateOrCreate(['uuid' => $item->nik_employee], ['employee_status' => 'Training']);
                }
                if (empty($item->date_end_contract)) {
                    Employee::updateOrCreate(['uuid' => $item->nik_employee], ['date_end_contract' => $date->format("Y-m-d"), 'date_start_contract' => $item->date_document_contract]);
                }
            }
        }

        // dd($data);
    }

    public function getEmployee($nik_employee)
    { //used
        $data = Employee::noGet_employeeAll_detail()
            ->where('employees.nik_employee', $nik_employee)
            ->whereNull('employees.date_end')
            ->whereNull('user_details.date_end')
            ->first();

        $arr_employee_premi = EmployeePremi::where('employee_uuid', $nik_employee)
            ->whereNull('date_end')
            ->get();

        foreach ($arr_employee_premi as $employee_premi) {
            $name_col = $employee_premi->premi_uuid;
            $data->$name_col =  $employee_premi->premi_value;
        }

        // dd($data);
        return ResponseFormatter::toJson($data, 'data employee');
        dd($data);
    }

    public function showEmployeeProfile($nik_employee)
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index'
        ];

        $premis = Premi::all();
        return view('employee.show', [
            'title'         => 'Detail Karyawan',
            'layout'    => $layout,
            'premis' => $premis,
            'nik_employee' => $nik_employee
        ]);
    }

    public function anyDataOne($uuid)
    {
        $data = Employee::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_employee');
    }

    public function indexResign()
    {

        // return Employee::getAll();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => false,
            'active'                        => 'employees-index'
        ];
        return view('employee.resign.index', [
            'title'         => 'Daftar Karyawan Resign',
            'nik_employee' => '',
            'layout'    => $layout,

            'year_month'        => Carbon::today()->isoFormat('Y-M'),
        ]);
    }

    public function import(Request $request)
    {
        // return 'aaa';
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $date_now = Carbon::now()->subMonth();


        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];
            $no_row = 0;

            $dictionaries = Dictionary::all();
            $dictionaries = $dictionaries->keyBy(function ($item) {
                return strval($item->excel);
            });

            $arr_index = [];

            while ($sheet->getCell($rows[$no_row] . '2')->getValue() != null) {
                $arr_index[$dictionaries[$sheet->getCell($rows[$no_row] . '2')->getValue()]->database] = [
                    'index' => $rows[$no_row],
                    'database' => $dictionaries[$sheet->getCell($rows[$no_row] . '2')->getValue()]->database,
                    'excel' => $dictionaries[$sheet->getCell($rows[$no_row] . '2')->getValue()]->excel,
                    'data_type' => $dictionaries[$sheet->getCell($rows[$no_row] . '2')->getValue()]->data_type,
                ];
                $no_row++;
            }

            $no_employee = 3;
            $employees = [];

            $employee_data = Employee::whereNull('employees.date_end')->get();
            $employee_data = $employee_data->keyBy(function ($item) {
                return strval($item->uuid);
            });
            $arr_atribut_size = AtributSize::all();
            $arr_atribut_size = $arr_atribut_size->keyBy(function ($item) {
                return strval(ResponseFormatter::toUUID($item->name_atribut));
            });
            // dd($arr_atribut_size);

            $premis = Premi::all();
            $get_all_department = Department::all();
            $get_all_department = $get_all_department->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_position = Position::all();
            $get_all_position = $get_all_position->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_group_cuti = EmployeeCutiGroup::all();
            $get_all_group_cuti = $get_all_group_cuti->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_employee_premis = EmployeePremi::whereNull('date_end')->get();
            $get_all_employee_premis = $get_all_employee_premis->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_employee_salaries = EmployeeSalary::whereNull('date_end')->get();
            $get_all_employee_salaries = $get_all_employee_salaries->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_user_details = UserDetail::whereNull('date_end')->get();
            $get_all_user_details = $get_all_user_details->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_employee_companies = EmployeeCompany::whereNull('date_end')->get();
            $get_all_employee_companies = $get_all_employee_companies->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $month = $sheet->getCell('D1')->getValue();
            $year = $sheet->getCell('F1')->getValue();

            $this_date = $year . '-' . $month . '-' . '01';
            $date = Carbon::createFromFormat('Y-m-d', $this_date);
            $date_prev = Carbon::createFromFormat('Y-m-d', $this_date);
            $this_date_end_prev = $date_prev->subDays(1);

            $much_employee = 0;
            $all_data_import = [];

           
            // return $sheet->getCell('A' . $no_employee)->getValue();

            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                ob_start();
                $date_row = 3;
                $nik_employee = $sheet->getCell('B' . $no_employee)->getValue();
                $nik_employee = ResponseFormatter::toUUID($nik_employee);
                echo $nik_employee . "-start</br>";
                $data_old = [];
                $employee_data_one = [];

                if (!empty($employee_data[$nik_employee])) {
                    $data_old =  $employee_data[$nik_employee]->toArray();
                }

                // dd($get_all_user_details);
                if (!empty($get_all_user_details[$nik_employee])) {
                    $data_old_user_detail = $get_all_user_details[$nik_employee]->toArray();
                    $data_old = array_merge($data_old, $data_old_user_detail);
                    // dd($data_old);                     
                }
                // dd($data_old); 
                if (!empty($get_all_employee_salaries[$nik_employee])) {
                    $data_old_employee_salary = $get_all_employee_salaries[$nik_employee]->toArray();
                    $data_old = array_merge($data_old, $data_old_employee_salary);
                }

                if (!empty($get_all_employee_companies[$nik_employee])) {
                    $data_old_employee_company = $get_all_employee_companies[$nik_employee]->toArray();
                    $data_old = array_merge($data_old, $data_old_employee_company);
                }

                if (!empty($data_old)) {
                    $employee_data_one = $data_old;
                }
                echo $nik_employee.'';

                foreach ($arr_index as $item_index) {
                    $employee_data_one[$item_index['database'] . '_real'] = $sheet->getCell($item_index['index'] . $no_employee)->getValue();
                    if (!empty($sheet->getCell($item_index['index'] . $no_employee)->getValue())) {
                        $employee_data_one[$item_index['database'] . '_real'] = $sheet->getCell($item_index['index'] . $no_employee)->getValue();
                        switch ($item_index['data_type']) {
                            case 'uuid':
                                if (!empty($arr_atribut_size[ResponseFormatter::toUUID($sheet->getCell($item_index['index'] . $no_employee)->getValue())])) {
                                    $attr_value = $arr_atribut_size[ResponseFormatter::toUUID($sheet->getCell($item_index['index'] . $no_employee)->getValue())]->uuid;
                                    $employee_data_one[$item_index['database'] . '_uuid'] = $attr_value;
                                    $employee_data_one[$item_index['database']] =  $attr_value;
                                } else {
                                    $employee_data_one[$item_index['database'] . '_uuid'] = ResponseFormatter::toUUID($sheet->getCell($item_index['index'] . $no_employee)->getValue());
                                    $employee_data_one[$item_index['database']] =  ResponseFormatter::toUUID($sheet->getCell($item_index['index'] . $no_employee)->getValue());
                                    $employee_data_one[$item_index['database'] . '_with_space'] = str_replace('-', ' ', $employee_data_one[$item_index['database']]);
                                }
                                $employee_data_one[$item_index['database'] . '_with_space'] = str_replace('-', ' ', $employee_data_one[$item_index['database']]);
                                $employee_data_one[$item_index['database'] . '_real'] = $sheet->getCell($item_index['index'] . $no_employee)->getValue();
                                break;
                            case 'string':
                                // $employee_data_one[$item_index['database'].'_uuid'] = ResponseFormatter::toUUID($sheet->getCell( $item_index['index'].$no_employee)->getValue());
                                $employee_data_one[$item_index['database']] =  ResponseFormatter::isString($sheet->getCell($item_index['index'] . $no_employee)->getValue());
                                break;
                            case 'date':
                                $employee_data_one[$item_index['database']] = ResponseFormatter::excelToDate($sheet->getCell($item_index['index'] . $no_employee)->getValue());
                                break;
                            default:
                                $employee_data_one[$item_index['database']] = $sheet->getCell($item_index['index'] . $no_employee)->getValue();
                        }
                    }
                }
                

                $employee_data_one['name'] = $employee_data_one['name_real'];
                $employee_data_one['nik_employee_with_space'] = $employee_data_one['nik_employee_real'];
                if (!empty($employee_data_one['department_uuid'])) {
                    if (empty($get_all_department[$employee_data_one['department_uuid']])) {
                        Department::updateOrCreate(['uuid' => $employee_data_one['department_uuid']], ['department' => $employee_data_one['department_with_space']]);
                    }
                }
                if (!empty($employee_data_one['position_uuid'])) {
                    if (empty($get_all_position[$employee_data_one['position_uuid']])) {
                        Position::updateOrCreate(['uuid' => $employee_data_one['position_uuid']], ['position' => $employee_data_one['position_with_space']]);
                    }
                }

                if (!empty($employee_data_one['group_cuti_uuid'])) {
                    if (empty($get_all_group_cuti[$employee_data_one['group_cuti_uuid']])) {
                        EmployeeCutiGroup::updateOrCreate(['uuid' => $employee_data_one['group_cuti_uuid']], ['name_group_cuti' => $employee_data_one['group_cuti_uuid_with_space']]);
                    }
                }




                if (!empty($employee_data_one['bpjs_ketenagakerjaan'])) {
                    $employee_data_one['is_bpjs_kesehatan'] = 'Ya';
                    $employee_data_one['is_bpjs_pensiun'] = 'Ya';
                } else {
                    $employee_data_one['is_bpjs_kesehatan'] = 'Tidak';
                    $employee_data_one['is_bpjs_pensiun'] = 'Tidak';
                }

                if (!empty($employee_data_one['bpjs_kesehatan'])) {
                    $employee_data_one['is_bpjs_ketenagakerjaan'] = 'Ya';
                } else {
                    $employee_data_one['is_bpjs_ketenagakerjaan'] = 'Tidak';
                }
                if (empty($employee_data_one['employee_status'])) {
                    if (!empty($employee_data_one['long_contract'])) {
                        if ($employee_data_one['long_contract'] > 3) {
                            $employee_data_one['employee_status'] = 'Profesional';
                        } else {
                            $employee_data_one['employee_status'] = 'Training';
                        }
                    } else {
                        $employee_data_one['employee_status'] = 'Profesional';
                    }
                }

                

                if (!empty($employee_data_one['last_education'])) {
                    $employee_data_one[$employee_data_one['last_education'] . '_name'] = 'default';
                    $employee_data_one[$employee_data_one['last_education'] . '_place'] = 'default';
                    $employee_data_one[$employee_data_one['last_education'] . '_year'] = 2000;
                }

                $employee_data_one['uuid'] = $employee_data_one['nik_employee'];
                $employee_data_one['employee_uuid'] = $employee_data_one['uuid'];
                $employee_data_one['citizenship'] = 'WNI';

                $employee_data_one['date_start'] = $employee_data_one['date_start_effective'];
                $employee_data_one['user_detail_uuid'] = $employee_data_one['nik_employee'];

                // dd($employee_data_one);
                if (!empty($employee_data_one['contract_number_full'])) {
                    $contract_number = explode('/', $employee_data_one['contract_number_full']);
                    $employee_data_one['contract_number'] = (int)$contract_number[0];
                }

                if (!empty($employee_data_one['hour_meter_prices'])) {
                    $employee_data_one['hour_meter_price_uuid'] = $employee_data_one['hour_meter_prices'];
                }

                // default if null
                // roaster
                if (empty($employee_data_one['roaster_uuid'])) {
                    $employee_data_one['roaster_uuid'] = '70';
                }

                // date_start_contract
                if (empty($employee_data_one['date_start_contract'])) {
                    $employee_data_one['date_start_contract'] = $employee_data_one['date_document_contract'];
                }

                // contract_status
                if (empty($employee_data_one['contract_status'])) {
                    $employee_data_one['contract_status'] = 'PKWT';
                }

                // site_uuid
                if (empty($employee_data_one['site_uuid'])) {
                    $employee_data_one['site_uuid'] = 'PL';
                }

                // company_uuid
                if (empty($employee_data_one['company_uuid'])) {
                    $employee_data_one['company_uuid'] = 'PL';
                }

                // machine_id
                if (empty($employee_data_one['machine_id'])) {
                    $employee_data_one['machine_id'] = $employee_data_one['nik_employee'];
                }

                // date_start_work
                if (empty($employee_data_one['date_start_work'])) {
                    $date_swcount = new Carbon($employee_data_one['date_document_contract']);
                    $date_swcount->addMonths(3);
                    $date_swcount->addDays(14);
                    $employee_data_one['date_start_work'] = $date_swcount->format("Y-m-d");
                }
                // dd($employee_data_one);
                // long_contract
                if (empty($employee_data_one['long_contract'])) {
                    $employee_data_one['long_contract'] = 12;
                }

                // group_cuti_uuid
                if (empty($employee_data_one['group_cuti_uuid'])) {
                    $employee_data_one['group_cuti_uuid'] = $employee_data_one['position_uuid'];
                    if (empty($get_all_group_cuti[$employee_data_one['group_cuti_uuid']])) {
                        EmployeeCutiGroup::updateOrCreate(['uuid' => $employee_data_one['position_uuid']], ['name_group_cuti' => $employee_data_one['position_with_space']]);
                    }
                }
                // date_end_contract
                if (empty($employee_data_one['date_end_contract'])) {
                    $date_start_contract_where_null = new Carbon($employee_data_one['date_start_contract']);
                    $date_start_contract_where_null->addMonths(3)->format("Y-m-d");

                    if ($date_now > $date_start_contract_where_null) {
                        while ($date_now > $date_start_contract_where_null) {
                            $date_start_contract_where_null->addMonths(12);
                            $employee_data_one['date_end_contract'] = $date_start_contract_where_null->format("Y-m-d");
                        }
                        $employee_data_one['employee_status'] = 'Profesional';
                        $employee_data_one['long_contract'] = '12';
                    } else {
                        $employee_data_one['employee_status'] = 'Training';
                        $employee_data_one['long_contract'] = '3';
                        $employee_data_one['date_end_contract'] = $date_start_contract_where_null->format("Y-m-d");
                    }
                }

                if (!empty($employee_data_one['date_end'])) {
                    dd("employee_data_one");
                }
               

                echo $nik_employee . "-start employee</br>";
                if (!empty($employee_data_one['date_out'])) {
                    $employee_data_one['employee_status'] = 'Keluar';
                    $storeEmployee = EmployeeOut::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                }
               
                // dd($data_old);


                // $storeEmployee = Employee::updateOrCreate([''],$employee_data_one);
                // $storeEmployee = EmployeeSalary::updateOrCreate([''],$employee_data_one);
                // $storeEmployee = UserDetail::updateOrCreate([''],$employee_data_one);
                // $storeEmployee = UserAddress::updateOrCreate([''],$employee_data_one);
                // $storeEmployee = UserEducation::updateOrCreate([''],$employee_data_one);
                // $storeEmployee = UserDependent::updateOrCreate([''],$employee_data_one);
                // $storeEmployee = EmployeeCutiSetup::updateOrCreate([''],$employee_data_one);
                

                if(!empty($employee_data_one['nik_number'])){
                    $employee_data_one['nik_number_before'] = $employee_data_one['nik_number'];
                    $cel_val = $employee_data_one['nik_number'];
                    $firstCharacter = substr($cel_val, 0, 1); 
                    // if($firstCharacter == '`' or $firstCharacter == "'" ){
                        
                        $employee_data_one['nik_number'] = ResponseFormatter::toNumber($employee_data_one['nik_number']);
                    // }
                }
                // dd($employee_data_one);
                $storeEmployee = Employee::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                $storeEmployee = UserDetail::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                $storeEmployee = EmployeeSalary::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                $storeEmployee = UserAddress::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                $storeEmployee = UserEducation::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                $storeEmployee = UserDependent::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                $storeEmployee = EmployeeCutiSetup::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
              

                /*
                
                    if (!empty($data_old)) {
                        $all_data_import['data_old'][$nik_employee] = $nik_employee;
                        // dd("data_old");
                        if ($data_old['date_start'] > $employee_data_one['date_start']) {
                            dd('a');
                            if (empty($employee_data_one['date_end_effective'])) {
                                $employee_data_one['date_end'] = $data_old['date_start'];
                            } else {
                                if ($employee_data_one['date_end_effective'] < $data_old['date_start']) {
                                    $employee_data_one['date_end'] = $employee_data_one['date_end_effective'];
                                } else {
                                    $employee_data_one['date_end'] = $data_old['date_start'];
                                }
                            }
                            $storeEmployee = Employee::create($employee_data_one);
                            $storeEmployee = EmployeeSalary::create($employee_data_one);
                            $storeEmployee = UserDetail::create($employee_data_one);
                            $storeEmployee = UserAddress::create($employee_data_one);
                            $storeEmployee = UserEducation::create($employee_data_one);
                            $storeEmployee = UserDependent::create($employee_data_one);
                            $storeEmployee = EmployeeCutiSetup::create($employee_data_one);

                            // dd('a');
                        } elseif ($data_old['date_start'] == $employee_data_one['date_start']) {

                            $storeEmployee = Employee::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                            $storeEmployee = UserDetail::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                            $storeEmployee = EmployeeSalary::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                            $storeEmployee = UserAddress::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                            $storeEmployee = UserEducation::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                            $storeEmployee = UserDependent::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                            $storeEmployee = EmployeeCutiSetup::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                            dd('b');
                        } else {

                            $storeEmployee = Employee::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                            $storeEmployee = EmployeeSalary::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                            $storeEmployee = UserDetail::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                            $storeEmployee = UserAddress::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                            $storeEmployee = UserEducation::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                            $storeEmployee = UserDependent::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                            $storeEmployee = EmployeeCutiSetup::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);

                            $storeEmployee = Employee::create($employee_data_one);
                            $storeEmployee = EmployeeSalary::create($employee_data_one);
                            $storeEmployee = UserDetail::create($employee_data_one);
                            $storeEmployee = UserAddress::create($employee_data_one);
                            $storeEmployee = UserEducation::create($employee_data_one);
                            $storeEmployee = UserDependent::create($employee_data_one);
                            $storeEmployee = EmployeeCutiSetup::create($employee_data_one);
                            dd('c');
                        }
                    } else {
                        dd('lll');
                        $storeEmployee = Employee::create($employee_data_one);
                        $storeEmployee = EmployeeSalary::create($employee_data_one);
                        $storeEmployee = UserDetail::create($employee_data_one);
                        $storeEmployee = UserAddress::create($employee_data_one);
                        $storeEmployee = UserEducation::create($employee_data_one);
                        $storeEmployee = UserDependent::create($employee_data_one);
                        $storeEmployee = EmployeeCutiSetup::create($employee_data_one);
                        // dd('d');
                        $all_data_import['data_new'][$nik_employee] = $nik_employee;
                    }

                */

                echo $nik_employee . "-start user detail</br>";

                $employee_data_one['role'] = 'employee';
                if(!empty($employee_data_one['nik_number'])){
                    $employee_data_one['password'] = Hash::make($employee_data_one['nik_number']);
                }else{
                    $employee_data_one['password'] = Hash::make('password');
                }
                
                $storeUser = User::updateOrCreate(['uuid'    =>  $employee_data_one['uuid']], $employee_data_one);

                echo $nik_employee . "-start salary</br>";


                /*

                    foreach ($premis as $premi) {

                        if (!empty($employee_data_one[$premi->uuid])) {
                            $employee_data_one['premi_value'] = $employee_data_one[$premi->uuid];
                            $employee_data_one['premi_uuid'] = $premi->uuid;
                            $employee_data_one['uuid'] = $nik_employee . '-' . $premi->uuid;
                            $premi_value = $employee_data_one[$premi->uuid];

                            if (!empty($get_all_employee_premis[$nik_employee . '-' . $premi->uuid])) {
                                $data_old_premi[$premi->uuid] = $get_all_employee_premis[$nik_employee . '-' . $premi->uuid]->toArray();
                                $employee_data_one['premi_value'] = $employee_data_one[$premi->uuid];

                                if ($data_old_premi[$premi->uuid]['date_start'] >  $employee_data_one['date_start']) {
                                    if (empty($employee_data_one['date_end_effective'])) {
                                        $employee_data_one['date_end'] = $data_old_premi[$premi->uuid]['date_start'];
                                    } else {
                                        $employee_data_one['date_end'] = $employee_data_one['date_end_effective'];
                                    }
                                    $storeEmployee = EmployeePremi::create($employee_data_one);
                                } elseif ($data_old_premi[$premi->uuid]['date_start']  == $employee_data_one['date_start']) {
                                    $storeEmployee = EmployeePremi::updateOrCreate(['id'   => $data_old_premi[$premi->uuid]['id']], $employee_data_one);
                                } else {
                                    $storeEmployee = EmployeePremi::updateOrCreate(['id'   => $data_old_premi[$premi->uuid]['id']], ['date_end' => $employee_data_one['date_start']]);
                                    $storeEmployee = EmployeePremi::create($employee_data_one);
                                }
                            } else {
                                $storeEmployee = EmployeePremi::create($employee_data_one);
                            }
                            // dd($storeEmployee);
                        }
                        $data_old_arr = [];
                        if (!empty($get_all_employee_premis[$nik_employee . '-' . $premi->uuid])) {
                            if (empty($employee_data_one[$premi->uuid])) {
                                $employee_data_one['premi_value'] = 0;
                                $employee_data_one['premi_uuid'] = $premi->uuid;
                                $employee_data_one['uuid'] = $nik_employee . '-' . $premi->uuid;
                                $storeEmployee = EmployeePremi::updateOrCreate(['id'   => $get_all_employee_premis[$nik_employee . '-' . $premi->uuid]['id']], ['date_end' => $employee_data_one['date_start']]);
                                $storeEmployee = EmployeePremi::create($employee_data_one);
                            }
                            $data_old_arr[] = $get_all_employee_premis[$nik_employee . '-' . $premi->uuid];
                        }
                    }

                */

                echo $nik_employee . "-end</br>";
                // dd('user detail will');
                ob_end_clean();
                $no_employee++;
            }
            // dd($all_data_import);
            // dd(Employee::data_employee());
            ResponseFormatter::setAllSession();
            // dd($employee_data_one);
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }

    public function exportSimple()
    { //used
        $row = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];
        // $date = Car
        $year_month = Carbon::today()->isoFormat('Y-M');
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $variables = Dictionary::all();

        $variables = $variables->keyBy(function ($item) {
            return strval($item->database);
        });

        // dd($variables);

        // foreach($variables as $variable){
        //     Dictionary::updateOrCreate(['database'   => $variable->variable_code], ['excel'=> $variable->variable_name]);
        // }


        $arr_exports = [
            'no', //A
            'nik_employee', //B
            'name', //C           
            'machine_id', //D    
            'religion_uuid',
            'gender',
            'place_of_birth',
            'date_of_birth',
            'mother_name',
            'father_name',
            'blood_group',
            'status',
            'last_education',
            'poh_uuid',
            'rt',
            'rw',
            'desa',
            'kecamatan',
            'kabupaten',
            'provinsi',
            'position', //E
            'department', //F
            'contract_status', //G
            'employee_status', //G
            'date_document_contract', //H   
            'date_start_contract',   //I
            'long_contract', //J
            'date_end_contract',
            'tax_status',
            'financial_number',
            'financial_name',
            'bpjs_ketenagakerjaan',
            'bpjs_kesehatan',
            'nik_number',
            'kk_number',
            'phone_number',
            'npwp_number',
            'salary',
            'insentif',
            'tunjangan',
            'hour_meter_price_uuid',
            'company_uuid',
            'site_uuid',
            'roaster_uuid',
            'contract_number_full',
            'date_start_work',
            'group_cuti_uuid',
            'out_status',
            'date_out'
        ];

        $column_import = [

            'employees' => [
                'machine_id',
                'nik_employee',
                'position_uuid',
                'department_uuid',
                'company_uuid',
                'site_uuid',
                'roaster_uuid',
                'contract_number',
                'contract_number_full',
                'contract_status',
                'date_start_contract',
                'date_end_contract',
                'date_document_contract',
                'long_contract',
                'employee_status',
                'tax_status_uuid',
                'is_bpjs_kesehatan',
                'is_bpjs_ketenagakerjaan',
                'is_bpjs_pensiun',
            ],
            'user_details' => [
                'name',
                'nik_number',
                'kk_number',
                'citizenship',
                'gender',
                'place_of_birth',
                'date_of_birth',
                'religion_uuid',
                'blood_group',
                'status',
                'npwp_number',
                'financial_number',
                'financial_name',
                'bpjs_ketenagakerjaan',
                'bpjs_kesehatan',
                'phone_number',
            ]
        ];

        $data_religion = Religion::all();
        $data_database['religion_uuid']['data'] = $data_religion;
        $data_database['religion_uuid']['key'] = 'religion';

        $data_religion = AtributSize::where('size', 'gender')->get();
        $data_database['gender']['data'] = $data_religion;
        $data_database['gender']['key'] = 'name_atribut';

        $data_religion = AtributSize::where('size', 'blood_group')->get();
        $data_database['blood_group']['data'] = $data_religion;
        $data_database['blood_group']['key'] = 'name_atribut';

        $data_religion = AtributSize::where('size', 'status')->get();
        $data_database['status']['data'] = $data_religion;
        $data_database['status']['key'] = 'name_atribut';

        $data_religion = AtributSize::where('size', 'last_education')->get();
        $data_database['last_education']['data'] = $data_religion;
        $data_database['last_education']['key'] = 'name_atribut';

        $data_religion = AtributSize::where('size', 'contract_status')->get();
        $data_database['contract_status']['data'] = $data_religion;
        $data_database['contract_status']['key'] = 'name_atribut';

        $data_religion = AtributSize::where('size', 'poh_uuid')->get();
        $data_database['poh_uuid']['data'] = $data_religion;
        $data_database['poh_uuid']['key'] = 'name_atribut';

        $data_religion = Position::all();
        $data_database['position']['data'] = $data_religion;
        $data_database['position']['key'] = 'position';

        $data_religion = Department::all();
        $data_database['department']['data'] = $data_religion;
        $data_database['department']['key'] = 'department';

        $data_religion = HourMeterPrice::all();
        $data_database['hour_meter_price_uuid']['data'] = $data_religion;
        $data_database['hour_meter_price_uuid']['key'] = 'uuid';

        $data_religion = TaxStatus::all();
        $data_database['tax_status']['data'] = $data_religion;
        $data_database['tax_status']['key'] = 'tax_status_name';

        // dd($data_religion);

        // return $arr_exports;

        $premis = Premi::all();
        foreach ($premis as $premi) {
            $arr_exports[] = $premi->uuid;
        }

        // dd($variables);


        $arr_exports[] = 'date_start_effective';
        $arr_exports[] = 'date_end_effective';
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Import Data Karyawan Simpel');
        $createSheet->setCellValue('C1', 'Bulan');
        $createSheet->setCellValue('D1', $month);
        $createSheet->setCellValue('E1', 'Tahun');
        $createSheet->setCellValue('F1', $year);
        $no_col = 0;
        foreach ($arr_exports as $item_export) {
            $createSheet->setCellValue($row[$no_col] . '2', $variables[$item_export]->excel);
            if (!empty($data_database[$item_export])) {
                // dd($data_database[$item_export]);
                $column_item = 10;
                $name_column = $data_database[$item_export]['key'];
                foreach ($data_database[$item_export]['data'] as $item) {
                    $createSheet->setCellValue($row[$no_col] . $column_item, $item->$name_column);
                    $column_item++;
                }
            }
            $no_col++;
        }
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/Template Penambahan Karyawan -' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function cekNikEmployee(Request $request)
    {
        $data = Employee::where('nik_employee', $request->nik_employee)->get()->first();
        return ResponseFormatter::toJson($data, 'data nik');
    }

    public function storeFile(Request $request)
    {
        $validatedData = $request->validate([
            'nik_employee_file' => '',
        ]);
        // return ResponseFormatter::toJson($validatedData, 'da');
        if ($request->file('user_file')) {
            $imageName =   $validatedData['nik_employee_file'] . '.' . $request->user_file->getClientOriginalExtension();
            $name = 'file/user/' . $imageName;
            if (file_exists($name)) {
                $name = mt_rand(5, 99985) . '-' . $imageName;
                $name = 'file/user/' . $imageName;
            }

            $isMoved = $request->user_file->move('file/user/', $name);

            if ($isMoved) {
                $validatedData['file_path'] = $imageName;
            }
            $store = Employee::updateOrCreate(['nik_employee' => $validatedData['nik_employee_file']], $validatedData);
        }


        return ResponseFormatter::toJson($validatedData, 'file store');
    }

    public function store(Request $request)
    {
        $validateData = $request->all();
        $data = session('recruitment-user');

        if ($validateData['nik_employee'] != $data['detail']['nik_employee']) {
            //document
            //
            EmployeeApplicant::updateOrCreate(
                [
                    'employee_uuid' =>  $data['detail']['nik_employee']
                ],
                [
                    'status_applicant' => 'done'
                ]
            );

            EmployeeDocument::updateOrCreate(
                [
                    'employee_uuid' =>  $data['detail']['nik_employee']
                ],
                [
                    'employee_uuid' => $validateData['nik_employee']
                ]
            );
        }


        $user_detail_uuid = $validateData['uuid'];
        // return ResponseFormatter::toJson($user_detail_uuid, 'data store employee');
        // if(empty($validateData['uuid'])){
        $validateData['uuid'] = $validateData['nik_employee'];
        $validateData['user_detail_uuid'] = $validateData['nik_employee'];
        // }

        // jika awalnya ada di employee_applicant dan sekarang sudah berubah jadi employee, ubah yang di employee applicant

        if (empty($validateData['date_start'])) {
            $validateData['date_start'] = $data['detail']['date_start'];
        }
        if (empty($validateData['user_detail_uuid'])) {
            $validateData['user_detail_uuid'] = $validateData['uuid'];
        }

        $validateData['uuid'] = $validateData['nik_employee'];
        $validateData['user_detail_uuid'] = $validateData['nik_employee'];

        $number_contract = explode('/', $validateData['contract_number_full']);

        $validateData['contract_number'] = $number_contract[0];

        $storeEmployee = Employee::updateOrCreate(['uuid' => $validateData['uuid']], $validateData);
        $updateUserDetail = UserDetail::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid']]);
        $updateUserReligion = UserReligion::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserHealth = UserHealth::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserEducation = UserEducation::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserDependent = UserDependent::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserAddress = UserAddress::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserAddress = UserLicense::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);

        $updateUserCompany = EmployeeCompany::updateOrCreate(['uuid' => $validateData['uuid']], ['date_start' => $validateData['date_start'], 'employee_uuid' => $storeEmployee->uuid, 'company_uuid' => $validateData['company_uuid']]);
        $updateUserRoaster = EmployeeRoaster::updateOrCreate(['uuid' => $validateData['uuid']], ['date_start' => $validateData['date_start'], 'employee_uuid' => $storeEmployee->uuid, 'roaster_uuid' => $validateData['roaster_uuid']]);
        $updateUserDocument = EmployeeDocument::updateOrCreate(['employee_uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'employee_uuid' => $storeEmployee->uuid]);




        $validateDataUser['uuid'] = $storeEmployee->uuid;
        $validateDataUser['employee_uuid'] =   $validateData['uuid'];
        $validateDataUser['role'] = 'employee';
        $validateDataUser['nik_employee'] = $validateData['nik_employee'];;
        $validateDataUser['password'] = Hash::make('password');

        $updateUser = User::updateOrCreate(['uuid' => $validateDataUser['uuid']], $validateDataUser);
        $data_store = Employee::showWhereNik_employee($validateData['uuid']);
        $data['detail'] = $data_store;
        session()->put('recruitment-user', $data);
        $abc = [
            'validateDataUser' => $validateDataUser,
            'validateData' => $validateData,
            'updateUserDetail' => $updateUserDetail,
            'updateUserReligion' => $updateUserReligion,
            'updateUserHealth' => $updateUserHealth,
            'updateUserEducation' => $updateUserEducation,
            'updateUserDependent' => $updateUserDependent,
            'updateUserAddress' => $updateUserAddress,
            'updateUserCompany' => $updateUserCompany,

            'updateUserRoaster' => $updateUserRoaster,
            'updateUser' => $updateUser,
        ];
        ResponseFormatter::setAllSession();
        return ResponseFormatter::toJson($validateData, 'data store employee');
        return ResponseFormatter::toJson($storeEmployee, 'data store employee');
        return redirect()->intended('/user')->with('success', "Karyawan Ditambahkan");
    }

    public function show($nik_employee)
    {
        $data_employee = Employee::showWhereNik_employee($nik_employee)->toArray();
        $data = [
            'user-role'   => 'employee',
            'detail'    => $data_employee,
        ];



        session()->put('recruitment-user', $data);
        return redirect('/user/detail');
        dd($data);
    }

    public function showData(Request $request)
    {
        $data_employee = Employee::showWhereNik_employee($request->uuid)->toArray();
        $data = [
            'user-role'   => 'employee',
            'detail'    => $data_employee,
        ];
        return ResponseFormatter::toJson($data_employee, 'data employee');



        session()->put('recruitment-user', $data);
        return redirect('/user/detail');
        dd($data);
    }




    public function profile($nik_employee)
    {
        $data = Employee::noGet_employeeAll_detail()->where('employees.uuid', $nik_employee)->first();

        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-profile'
        ];
        return view('employee.show', [
            'title'         => 'Profile Karyawan',
            'data'  => $data,
            'layout'    => $layout,
        ]);
    }


    public function anyMoreData_(Request $request)
    {
        $validateData = $request->all();
        $start = ResponseFormatter::getDateToday();
        $end = ResponseFormatter::getDateToday();



        if (!empty($validateData['filter']['date_range_this_time_in_out'])) {
            $date_validateData_arr = explode(' - ', $validateData['filter']['date_range_this_time_in_out']);
            if (count($date_validateData_arr) > 1) {
                $start = ResponseFormatter::excelToDate($date_validateData_arr[0]);
                $end = ResponseFormatter::excelToDate($date_validateData_arr[1]);
            } elseif (count($date_validateData_arr) == 1) {
                $start = ResponseFormatter::excelToDate($date_validateData_arr[0]);
                $end = ResponseFormatter::excelToDate($date_validateData_arr[0]);
            }
        }
        $date_range_this_time_in_out = [
            'date_start_this_time_in_out' => $start,
            'date_end_this_time_in_out' => $end,
        ];

        $validateData['date_range_this_time_in_out'] = $date_range_this_time_in_out;

        $query = Employee::whereNull('employees.date_end')
            ->where('employee_status', '!=', 'talent');

        $query_employee_out = EmployeeOut::all();
        $data_employee_out = [];
        foreach ($query_employee_out as $employee_out) {
            $data_employee_out[$employee_out->employee_uuid] = $employee_out;
        }


        // ======= DEPARTMENT UUID
        if (!empty($validateData['filter']['department_uuid'])) {
            $query = $query->where('department_uuid', $validateData['filter']['department_uuid']);
        }
        // ======= DEPARTMENT UUID

        // ======= POSITION UUID===
        if (!empty($validateData['filter']['position_uuid'])) {
            $query = $query->where('position_uuid', $validateData['filter']['position_uuid']);
        }
        // ======= POSITION UUID

        // ======= employee_status UUID===
        if ($validateData['filter']['employee_status'] != 'off') {
            $query = $query->where('employee_status', $validateData['filter']['employee_status']);
        }
        // ======= employee_status UUID

        // ======= contract_status UUID===
        if ($validateData['filter']['contract_status'] != 'off') {
            $query = $query->where('contract_status', $validateData['filter']['contract_status']);
        }
        // ======= contract_status UUID

        $query = $query->get();

        if (empty($validateData['filter']['arr_filter'])) {
            $validateData['filter']['arr_filter'] = $validateData['filter']['value_checkbox'];
        } else {
            if (empty($validateData['filter']['arr_filter']['company'])) {
                $validateData['filter']['arr_filter']['company'] = $validateData['filter']['value_checkbox']['company'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }

        $filter_company_x_site = [];
        $employee_filter_company_x_site = [];
        $employee_non_filter_company_x_site = [];
        foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
            foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                $filter_company_x_site[$item_company . '-' . $item_site_uuid] = ['detail'];
            }
        }


        foreach ($query as $item_query) {
            if (!empty($filter_company_x_site[$item_query->company_uuid . '-' . $item_query->site_uuid])) {
                $employee_filter_company_x_site[] = $item_query;
            } else {
                $employee_non_filter_company_x_site[] = $item_query;
            }
        }

        // return ResponseFormatter::toJson($employee_filter_company_x_site, 'aaaa');

        if ($validateData['filter']['join_status'] != 'off') {
            $for_loop = $employee_filter_company_x_site;
            $employee_filter_company_x_site = [];
            foreach ($for_loop as $item_filtered_employee) {
                if ($validateData['filter']['join_status'] == '!=') {
                    if (($item_filtered_employee->date_document_contract >= $date_range_this_time_in_out['date_start_this_time_in_out']) &&  ($item_filtered_employee->date_document_contract <= $date_range_this_time_in_out['date_end_this_time_in_out'])) {
                        $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                    }
                }
                if ($validateData['filter']['join_status'] == '==') {
                    if (!empty($data_employee_out[$item_filtered_employee->nik_employee])) {
                        if (($data_employee_out[$item_filtered_employee->nik_employee]['date_out'] >= $date_range_this_time_in_out['date_start_this_time_in_out']) && ($data_employee_out[$item_filtered_employee->nik_employee]['date_out'] <= $date_range_this_time_in_out['date_end_this_time_in_out'])) {
                            $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                        }
                    }
                }
            }
        }

        if ($validateData['filter']['status_data'] != 'off') {
            $employee_non_filter_company_x_site = [];
            $for_loop = $employee_filter_company_x_site;
            $employee_filter_company_x_site = [];
            foreach ($for_loop as $item_filtered_employee) {
                if (!empty($data_employee_out[$item_filtered_employee->nik_employee])) {  //ada di karyawan keluar     
                    $employee_non_filter_company_x_site[] = $item_filtered_employee;
                    if (($data_employee_out[$item_filtered_employee->nik_employee]['date_out'] <= $validateData['filter']['date_range_in_out']) && ($validateData['filter']['status_data'] == '==')) { //bukan karyawan
                        $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                    } elseif (($data_employee_out[$item_filtered_employee->nik_employee]['date_out'] >= $validateData['filter']['date_range_in_out']) && ($validateData['filter']['status_data'] == '!=')) { // karyawan
                        $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                    }
                } elseif ($validateData['filter']['status_data'] == '!=') {
                    $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                }
            }
        }

        if ($validateData['filter']['status_join'] != 'off') {
            if (!empty($validateData['filter']['date_range'])) {
                $date_validateData_arr = explode(' - ', $validateData['filter']['date_range']);
                if (count($date_validateData_arr) > 1) {
                    $start = ResponseFormatter::excelToDate($date_validateData_arr[0]);
                    $end = ResponseFormatter::excelToDate($date_validateData_arr[1]);
                } elseif (count($date_validateData_arr) == 1) {
                    $start = ResponseFormatter::excelToDate($date_validateData_arr[0]);
                    $end = ResponseFormatter::excelToDate($date_validateData_arr[0]);
                }
            }
            $date_range = [
                'date_start' => $start,
                'date_end' => $end,
            ];

            $for_loop = $employee_filter_company_x_site;
            $employee_filter_company_x_site = [];
            foreach ($for_loop as $item_filtered_employee) {
                if (count($date_validateData_arr) > 1) {
                    if (($item_filtered_employee->date_end_contract >= $start) &&  ($item_filtered_employee->date_end_contract <= $end)) {
                        // return ResponseFormatter::toJson($validateData['filter']['status_join'], $item_filtered_employee);
                        if ($validateData['filter']['status_join'] == '==') { //akan tidak luarsa dalam range ini
                            $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                        }
                    }
                }
            }
        }



        $data = [
            'query' => $query,
            'employee_filter_company_x_site' => $employee_filter_company_x_site,
            'employee_non_filter_company_x_site' => $employee_non_filter_company_x_site,
            'query' => $query,
            'request' => $validateData
        ];

        return ResponseFormatter::toJson($data, 'success store data');
    }

    public function allEmployeeData()
    {
        // dd('ss');
        dd(ResponseFormatter::setAllSession());
        $employees_table = Employee::all();
        $user_details_table = UserDetail::all();
        $user_address_table = UserAddress::all();


        $user_health_table = UserHealth::all();
        $user_health_table_data = [];
        foreach ($user_health_table as $item) {
            $user_health_table_data[$item->uuid][$item->date_start] = $item->toArray();
        }

        $user_dependent_table = UserDependent::all();
        $user_dependent_table_data = [];
        foreach ($user_dependent_table as $item) {
            $user_dependent_table_data[$item->uuid][$item->date_start] = $item->toArray();
        }

        $user_license_table = UserLicense::all();
        $user_license_table_data = [];
        foreach ($user_license_table as $item) {
            $user_license_table_data[$item->uuid][$item->date_start] = $item->toArray();
        }

        $user_health_table = UserHealth::all();
        $user_health_table_data = [];
        foreach ($user_health_table as $item) {
            $user_health_table_data[$item->uuid][$item->date_start] = $item->toArray();
        }

        $user_education_table = UserEducation::all();
        $user_education_table_data = [];
        foreach ($user_education_table as $item) {
            $user_education_table_data[$item->uuid][$item->date_start] = $item->toArray();
        }

        $employee_table = Employee::all();
        $employee_table_data = [];
        foreach ($employee_table as $item) {
            $employee_table_data[$item->uuid][$item->date_start] = $item->toArray();
        }

        dd($employee_table_data['MBLE-0422003']);
        /*
            user detail
            user address
            user license
            user health
            user education
            user dependent
        */
        $data_user_details = [];

        foreach ($user_details_table as $item_user_details) {
            $data_user_details[$item_user_details->uuid][$item_user_details->date_start] = $item_user_details->toArray();
        }

        foreach ($user_address_table as $item_user_address) {
            $data_user_address[$item_user_address->uuid][$item_user_address->date_start] = $item_user_address->toArray();
        }

        dd($data_user_address);

        $data_finish = [];
        foreach ($employees_table as $item_employees_table) {
            if (!empty($data_user_details[$item_employees_table->nik_employee][$item_employees_table->date_start])) {
                $data_finish[$item_employees_table->nik_employee][$item_employees_table->date_start] = $item_employees_table->toArray();
                $data_finish[$item_employees_table->nik_employee][$item_employees_table->date_start] = array_merge($data_finish[$item_employees_table->nik_employee][$item_employees_table->date_start], $data_user_details[$item_employees_table->nik_employee][$item_employees_table->date_start]);
            }
        }

        dd($data_finish['MBLE-0422003']);
    }


    public function testUdin()
    {
        $data = Employee::data_employee_detail();
        var_dump($data);
        die;
        return view('datatableshow', ['data'         => $data]);
    }
}
