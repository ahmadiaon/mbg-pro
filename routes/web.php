<?php

use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Aktivity\AktivityController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\Api\Pendapatan\HaulingController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\OverBurden\HourMeterController;
use App\Http\Controllers\ShiftListController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OverBurden\OverBurdenController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CoalFromController;
use App\Http\Controllers\CoalTypeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\Employee\EmployeeAbsenController;
use App\Http\Controllers\Employee\EmployeeApplicantController;
use App\Http\Controllers\Employee\EmployeeChanggeController;
use App\Http\Controllers\Employee\EmployeeCutiController;
use App\Http\Controllers\Employee\EmployeeCutiSetupController;
use App\Http\Controllers\Employee\EmployeeDebtController;
use App\Http\Controllers\Employee\EmployeeDeductionController;
use App\Http\Controllers\Employee\EmployeeDocumentController;
use App\Http\Controllers\Employee\EmployeeHourMeterBonusController;
use App\Http\Controllers\Employee\EmployeeHourMeterDayController;
use App\Http\Controllers\Employee\EmployeeOutController;
use App\Http\Controllers\Employee\EmployeePaymentController;
use App\Http\Controllers\Employee\EmployeePaymentDebtController;
use App\Http\Controllers\Employee\EmployeePaymentOtherController;
use App\Http\Controllers\Employee\EmployeeSalaryController;
use App\Http\Controllers\OverBurden\OverBurdenFlitController;
use App\Http\Controllers\OverBurden\OverBurdenListController;
use App\Http\Controllers\Employee\EmployeeTonseController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\Hauling\HaulingSetupController;
use App\Http\Controllers\HourMeterPriceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Logistic\StorageLogisticController;
use App\Http\Controllers\OverBurden\OverBurdenOperatorController;
use App\Http\Controllers\OverBurden\OverBurdenRitaseController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\PaymentGroupController;
use App\Http\Controllers\PaymentOtherController;
use App\Http\Controllers\PohController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PremiController;
use App\Http\Controllers\Privilege\PrivilegeController;
use App\Http\Controllers\Privilege\UserPrivilegeController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\PurchaseOrder\GaleryController;
use App\Http\Controllers\PurchaseOrder\PurchaseOrderController;
use App\Http\Controllers\Recruitment\RecruitmentController as RecruitmentRecruitmentController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\Safety\AtributSizeController;
use App\Http\Controllers\Safety\SafetyEmployeeController;
use App\Http\Controllers\StatusAbsenController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\Support\DatabaseController;
use App\Http\Controllers\TaxStatusController;
use App\Http\Controllers\UserDetail\UserAddressController;
use App\Http\Controllers\UserDetail\UserDependentController;
use App\Http\Controllers\UserDetail\UserDetailController;
use App\Http\Controllers\UserDetail\UserEducationController;
use App\Http\Controllers\UserDetail\UserLicenseController;
use App\Http\Controllers\UserDetail\UserHealthController;
use App\Http\Controllers\VariableController;
use App\Http\Controllers\Vehicle\BrandController;
use App\Http\Controllers\Vehicle\BrandTypeController;
use App\Http\Controllers\Vehicle\GroupVehicleController;
use App\Http\Controllers\Vehicle\StatusController;
use App\Http\Controllers\Vehicle\VehicleController;
use App\Http\Controllers\WebAbsensiController;
use App\Http\Controllers\WebHaulingController;
use App\Http\Controllers\WebSlipController;
use App\Http\Controllers\WebUserController;
use App\Models\Employee\EmployeeAbsen;
use Illuminate\Support\Facades\Session;

Route::prefix('/support')->group(function () {
    Route::post('/set-date', [AdminController::class, 'setDate']);
    Route::get('/get-session/{name_session}', [AdminController::class, 'getSession']);
    Route::get('/setSessionDatabase', [AdminController::class, 'setSessionDatabase']);
    Route::get('/data/{nik_employee}', [UserDetailController::class, 'show']);
    Route::get('/all-db', [ResponseFormatter::class, 'tableList']);
});

Route::get('/test-udin', [EmployeeController::class, 'allEmployeeData']);
Route::get('/refresh-data', [AdminController::class, 'refreshData']);

//his data his only
Route::get('/get/data/{nik_employee}', [UserDetailController::class, 'show']);

// global
Route::prefix('/app')->group(function () {
    Route::prefix('/user')->group(function () {
        Route::prefix('/detail')->group(function () {
            Route::post('/store', [UserDetailController::class, 'store']);
        });
        Route::prefix('/address')->group(function () {
            Route::post('/store', [UserAddressController::class, 'store']);
        });
        Route::prefix('/dependent')->group(function () {
            Route::post('/store', [UserDependentController::class, 'store']);
        });
        Route::prefix('/education')->group(function () {
            Route::post('/store', [UserEducationController::class, 'store']);
        });
        Route::prefix('/health')->group(function () {
            Route::post('/store', [UserHealthController::class, 'store']);
        });
        Route::prefix('/license')->group(function () {
            Route::post('/store', [UserLicenseController::class, 'store']);
        });
        Route::prefix('/document')->group(function () {
            Route::post('/store', [EmployeeDocumentController::class, 'store']);
        });

        Route::prefix('/employee')->group(function () {
            Route::post('/store', [EmployeeController::class, 'store']);
        });
        Route::prefix('/salary')->group(function () {
            Route::post('/store', [EmployeeSalaryController::class, 'store']);
        });
        Route::prefix('/apply')->group(function () {
            Route::post('/store', [EmployeeApplicantController::class, 'store']);
        });
    });

    Route::prefix('/applicant')->group(function () {
        Route::post('/delete', [EmployeeApplicantController::class, 'delete']);
    });

    Route::prefix('/data')->group(function () {
        Route::post('/applicant', [EmployeeApplicantController::class, 'anyData']);
    });
});


Route::prefix('/recruitment')->group(function () {
    Route::get('/me', [UserDetailController::class, 'myRecruitmentProfile']);
    Route::get('/me/detail', [UserDetailController::class, 'showRecruitment']);
    Route::get('/me/identity', [UserDetailController::class, 'create']);
    Route::get('/me/address', [UserAddressController::class, 'create']);
    Route::get('/me/dependent', [UserDependentController::class, 'create']);
    Route::get('/me/education', [UserEducationController::class, 'create']);
    Route::get('/me/health', [UserHealthController::class, 'create']);
    Route::get('/me/license', [UserLicenseController::class, 'create']);
    Route::get('/me/document', [EmployeeDocumentController::class, 'create']);


    Route::get('/me/apply', [EmployeeApplicantController::class, 'indexRecruitment']);

    Route::get('/', [RecruitmentController::class, 'indexRecruitment']);
    Route::post('/data', [RecruitmentController::class, 'anyData']);

    Route::get('/data', [RecruitmentController::class, 'anyData']);




    Route::get('/create', [UserDetailController::class, 'createRecruitment']);


    Route::get('/up', [UserDetailController::class, 'createUp']);
    Route::post('/up', [UserDetailController::class, 'storeUp']);
    Route::get('/file', [UserDetailController::class, 'createRecruitment']);


    Route::prefix('/user-detail')->group(function () {
        Route::get('/{new}', [UserDetailController::class, 'create']);
        Route::post('/store/recruitment', [UserDetailController::class, 'store']);
    });

    Route::prefix('/user-address')->group(function () {
        Route::get('/{new}', [UserAddressController::class, 'create']);
        Route::post('/store/recruitment', [UserAddressController::class, 'store']);
    });

    Route::prefix('/user-dependent')->group(function () {
        Route::get('/{new}', [UserDependentController::class, 'create']);
        Route::post('/store/recruitment', [UserAddressController::class, 'store']);
    });
});

Route::get('/abc', function () {
    return view('abc');
});

Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
Route::get('/logout', [AuthenticationController::class, 'logout']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/user/me-only/{table_name}', [AdminController::class, 'exportTable']);

Route::get('/aaaaa', [AdminController::class, 'pdfs']);
Route::get('/test-employee', [EmployeeController::class, 'test']);
Route::get('/test-data', [EmployeeController::class, 'anyMoreDatatest']);

Route::middleware(['islogin'])->group(function () {
    Route::get('/', [AdminController::class, 'index']);

    Route::prefix('/form-recruitment')->group(function () {
        Route::get('/', [RecruitmentController::class, 'index']);
        Route::post('/import', [EmployeeCutiController::class, 'import']);
        Route::post('/store', [RecruitmentController::class, 'store']);
        Route::post('/show', [RecruitmentController::class, 'show']);
        Route::post('/delete', [RecruitmentController::class, 'delete']);
    });

    Route::prefix('/employee-out')->group(function () {
        Route::get('/', [EmployeeOutController::class, 'index']);
        Route::post('/data', [EmployeeOutController::class, 'dataOut']);
        Route::post('/store', [EmployeeOutController::class, 'store']);
        Route::post('/import', [EmployeeOutController::class, 'import']);
        Route::get('/export', [EmployeeOutController::class, 'export']);
        Route::post('/delete', [EmployeeOutController::class, 'delete']);
    });

    Route::prefix('/employee-contract')->group(function () {
        Route::get('/', [EmployeeController::class, 'indexContract']);
        Route::post('/data', [EmployeeController::class, 'anyData']);
        Route::post('/import', [EmployeeCutiController::class, 'import']);
        Route::post('/store', [EmployeeCutiController::class, 'store']);
    });


    Route::prefix('/employee-cuti')->group(function () {
        Route::get('/', [EmployeeCutiController::class, 'index']);
        Route::post('/data', [EmployeeCutiController::class, 'anyData']);
        Route::post('/import', [EmployeeCutiController::class, 'import']);
        Route::post('/store', [EmployeeCutiController::class, 'store']);

        Route::get('/show/{uuid}', [EmployeeCutiController::class, 'show']);
        Route::post('/delete', [EmployeeCutiController::class, 'delete']);

        Route::post('/data-timeline', [EmployeeCutiController::class, 'anyDataTimeLine']);
        Route::post('/data-warning', [EmployeeCutiController::class, 'anyDataWarning']);
    });

    Route::prefix('/employee-cuti-setup')->group(function () {
        Route::get('/', [EmployeeCutiSetupController::class, 'index']);
        Route::post('/data', [EmployeeCutiSetupController::class, 'anyData']);
        Route::post('/store', [EmployeeCutiSetupController::class, 'store']);
        Route::post('/show', [EmployeeCutiSetupController::class, 'show']);
        Route::get('/export/{year_month}', [EmployeeCutiSetupController::class, 'export']);
        Route::post('/import', [EmployeeCutiController::class, 'import']);
        Route::post('/delete', [EmployeeCutiSetupController::class, 'delete']);
    });

    Route::prefix('/employee-changge')->group(function () {
        Route::get('/', [EmployeeChanggeController::class, 'index']);
        Route::get('/create', [EmployeeChanggeController::class, 'create']);
        Route::get('/export/{year_month}', [EmployeeChanggeController::class, 'export']);
        Route::post('/import', [EmployeeChanggeController::class, 'import']);
    });

    Route::prefix('/me')->group(function () {
        Route::get('/{nik_employee}', [EmployeeController::class, 'profile']);
        Route::get('/{nik_employee}/absensi', [EmployeeAbsenController::class, 'show']);
        Route::get('/{nik_employee}/hour-meter', [EmployeeHourMeterDayController::class, 'indexForEmployee']);
        Route::get('/{nik_employee}/tonase', [EmployeeTonseController::class, 'indexForEmployee']);
    });

    //    allowance
    Route::prefix('/allowance')->group(function () {
        Route::get('/', [AllowanceController::class, 'index']);
        Route::post('/export', [AllowanceController::class, 'export']);
        Route::post('/data-filter', [AllowanceController::class, 'countPayrol']);
    });

    Route::prefix('/production')->group(function () {
        Route::get('/', [ProductionController::class, 'index']);
        Route::post('/data', [ProductionController::class, 'anyData']);
        Route::get('/create', [ProductionController::class, 'create']);
        Route::get('/export', [ProductionController::class, 'export']);
        Route::post('/create', [ProductionController::class, 'store']);
        Route::post('/show', [ProductionController::class, 'show']);
        Route::post('/delete', [ProductionController::class, 'delete']);

        Route::post('/import', [ProductionController::class, 'import']);
    });

    Route::prefix('/payrol')->group(function () {
        Route::get('/{year_month}', [AllowanceController::class, 'moreAnyData']);
        Route::get('/test', [AllowanceController::class, 'anyData']);
        Route::post('/data', [AllowanceController::class, 'anyData']);
    });

    Route::prefix('/applicant')->group(function () {
        Route::get('/', [EmployeeApplicantController::class, 'index']);
        Route::get('/test', [AllowanceController::class, 'anyData']);
        Route::post('/data', [EmployeeApplicantController::class, 'anyData']);

        Route::post('/pending', [EmployeeApplicantController::class, 'pendingProposal']);
    });

    Route::prefix('/hour-meter')->group(function () {
        Route::get('/', [EmployeeHourMeterDayController::class, 'index']);
        Route::post('/data', [EmployeeHourMeterDayController::class, 'moreAnyData']);
        Route::get('/template', [EmployeeHourMeterDayController::class, 'template']);
        Route::post('/export', [EmployeeHourMeterDayController::class, 'export']);
        Route::post('/store', [EmployeeHourMeterDayController::class, 'store']);
        Route::post('/import', [EmployeeHourMeterDayController::class, 'import']);
    });



    Route::prefix('/tonase')->group(function () {
        Route::get('/', [EmployeeTonseController::class, 'index']);
        Route::post('/data', [EmployeeTonseController::class, 'anyDataMonthFilter']);
        Route::post('/store', [EmployeeTonseController::class, 'store']);

        Route::post('/import', [EmployeeTonseController::class, 'import']);
        Route::get('/export/{year_month}', [EmployeeTonseController::class, 'export']);
        Route::get('/template/{year_month}', [EmployeeTonseController::class, 'template']);
    });

    Route::prefix('/payment')->group(function () {
        Route::get('/', [EmployeePaymentController::class, 'index']);
        Route::get('/create', [EmployeePaymentController::class, 'create']);
        Route::get('/show/{payment_uuid}', [PaymentController::class, 'show']);
        Route::post('/data', [EmployeePaymentController::class, 'anyDataMonth']);
        Route::post('/store', [PaymentController::class, 'store']);

        Route::post('/import', [PaymentController::class, 'import']);
        Route::get('/export', [PaymentController::class, 'export']);
    });

    Route::prefix('/employee-payment')->group(function () {
        Route::post('/store', [EmployeePaymentController::class, 'store']);
        Route::post('/delete', [EmployeePaymentController::class, 'delete']);
    });

    Route::prefix('/user/absensi')->group(function () {
        /*
            import absen
            export absen
            edit absen
            show every month
        */

        Route::post('/report-absensi', [EmployeeAbsenController::class, 'exportAbsensiX']);
        Route::post('/store-fingger', [EmployeeAbsenController::class, 'storeFingger']);
        Route::get('/', [EmployeeAbsenController::class, 'index']);
        Route::get('/detail/{year_month}/{employee_uuid}', [EmployeeAbsenController::class, 'showEmployee']);
        Route::post('/export+data', [EmployeeAbsenController::class, 'exportWithData']);
        Route::post('/reportUnAbsen', [EmployeeAbsenController::class, 'reportUnAbsen']);
        Route::post('/export-after-import', [EmployeeAbsenController::class, 'exportAfterImport']);
        Route::get('/export-template/{year_month}', [EmployeeAbsenController::class, 'exportTemplate']);
        Route::post('/import', [EmployeeAbsenController::class, 'import']);

        Route::post('/dialy-report', [EmployeeAbsenController::class, 'dialyReport']);

        // Route::post('/data', [EmployeeAbsenController::class, 'anyDataPost']);
        Route::post('/data-x', [EmployeeAbsenController::class, 'anyDataPost_X']);
        // Route::get('/data/{year_month}', [EmployeeAbsenController::class, 'anyData']);
        Route::get('/after-import', [EmployeeAbsenController::class, 'afterImport']);

        // Route::get('/data-employee/{year_month}/{employee_uuid}', [EmployeeAbsenController::class, 'anyDataEmployee']);

        Route::post('/store', [EmployeeAbsenController::class, 'store']);
        Route::post('/store-absen', [EmployeeAbsenController::class, 'storeAbsen']);
    });

    Route::prefix('/other-payment')->group(function () {
        Route::get('/', [EmployeePaymentOtherController::class, 'index']);
        Route::post('/import', [EmployeePaymentOtherController::class, 'import']);
        Route::post('/data', [EmployeePaymentOtherController::class, 'anyDataMonth']);
        Route::post('/show', [EmployeePaymentOtherController::class, 'show']);
        Route::post('/delete', [EmployeePaymentOtherController::class, 'delete']);

        Route::post('/store', [EmployeePaymentOtherController::class, 'store']);
        Route::get('/export', [EmployeePaymentOtherController::class, 'export']);
    });

    Route::prefix('/employee-debt')->group(function () {
        Route::get('/', [EmployeeDebtController::class, 'index']);
        Route::get('/export', [EmployeeDebtController::class, 'export']);
        Route::post('/import', [EmployeeDebtController::class, 'import']);
        Route::post('data', [EmployeeDebtController::class, 'anyData']);
        Route::post('/store', [EmployeeDebtController::class, 'store']);
        Route::post('/delete', [EmployeeDebtController::class, 'delete']);
    });


    Route::prefix('/employee-payment-debt')->group(function () {

        Route::post('/store', [EmployeePaymentDebtController::class, 'store']);
        Route::post('/delete', [EmployeePaymentDebtController::class, 'delete']);

        Route::get('/export', [EmployeePaymentDebtController::class, 'export']);
        Route::post('/import', [EmployeePaymentDebtController::class, 'import']);
    });


    Route::prefix('/employee-deduction')->group(function () {
        Route::get('/', [EmployeeDeductionController::class, 'index']);
        Route::get('/export', [EmployeeDeductionController::class, 'export']);
        Route::post('/import', [EmployeeDeductionController::class, 'import']);
        Route::post('/store', [EmployeeDeductionController::class, 'store']);
        Route::post('/data', [EmployeeDeductionController::class, 'anyData']);
        Route::post('/delete', [EmployeeDeductionController::class, 'delete']);
    });





    //  =============== end a l l o w a n c e


    Route::prefix('/activity')->group(function () {
        Route::get('/', [AdminController::class, 'indexActivity']);
        Route::get('/simple', [AdminController::class, 'indexSimple']);
        Route::post('/store-form', [AktivityController::class, 'storeForm']);
        Route::post('/store-data', [AktivityController::class, 'storeData']);
        Route::post('/all-table', [AktivityController::class, 'allTable']);
        Route::post('/get-data-table', [AktivityController::class, 'getDataTable']);
        Route::post('/delete-data-table', [AktivityController::class, 'deleteDataTable']);
    });
    Route::prefix('/form')->group(function () {
        Route::get('/', [AktivityController::class, 'indexForm']);
        Route::post('/export-form', [AktivityController::class, 'exportForm']);
    });


    // ===================== d a t a b a s e 
    Route::prefix('/database')->group(function () {

        Route::post('/get-data', [AktivityController::class, 'getData']);


        Route::get('/absen', [StatusAbsenController::class, 'indexPayrol']);
        Route::get('/export-db', [StatusAbsenController::class, 'exportDB']);
        Route::post('/status-absen', [StatusAbsenController::class, 'storePayrol']); ///payrol/database/status-absen
        Route::get('/absen/{uuid}/edit', [StatusAbsenController::class, 'showPayrol']);
        Route::post('/absen/delete', [StatusAbsenController::class, 'delete']);
        Route::get('/absen-data', [StatusAbsenController::class, 'anyData']);



        Route::prefix('/status-absen')->group(function () {
            Route::get('/export', [StatusAbsenController::class, 'export']);
            Route::post('/import', [StatusAbsenController::class, 'import']);
        });

        Route::prefix('/hour-meter-price')->group(function () {
            Route::get('/', [HourMeterPriceController::class, 'index']);
            Route::post('/store', [HourMeterPriceController::class, 'store']);
            Route::post('/delete', [HourMeterPriceController::class, 'delete']);
            Route::post('/show', [HourMeterPriceController::class, 'show']);
            Route::get('/data', [HourMeterPriceController::class, 'anyData']);
            Route::get('/export', [HourMeterPriceController::class, 'export']);
            Route::post('/import', [HourMeterPriceController::class, 'import']);
        });

        Route::prefix('/company')->group(function () {
            Route::get('/', [CompanyController::class, 'index']);
            Route::post('/store', [CompanyController::class, 'store']);
            Route::post('/delete', [CompanyController::class, 'delete']);
            Route::post('/show', [CompanyController::class, 'show']);
            Route::get('/data', [CompanyController::class, 'anyData']);

            Route::get('/export', [CompanyController::class, 'export']);
            Route::post('/import', [CompanyController::class, 'import']);
        });



        Route::prefix('/religion')->group(function () {
            Route::get('/', [ReligionController::class, 'index']);
            Route::post('/store', [ReligionController::class, 'store']);
            Route::post('/delete', [ReligionController::class, 'delete']);
            Route::post('/show', [ReligionController::class, 'show']);
            Route::get('/data', [ReligionController::class, 'anyData']);
            Route::get('/export', [ReligionController::class, 'export']);
            Route::post('/import', [ReligionController::class, 'import']);
        });

        Route::prefix('/hm-bonus')->group(function () {
            Route::get('/', [EmployeeHourMeterBonusController::class, 'index']);
            Route::post('/store', [EmployeeHourMeterBonusController::class, 'store']);
            Route::post('/delete', [EmployeeHourMeterBonusController::class, 'delete']);
            Route::post('/show', [EmployeeHourMeterBonusController::class, 'show']);
            Route::get('/data', [EmployeeHourMeterBonusController::class, 'anyData']);
            Route::get('/export', [EmployeeHourMeterBonusController::class, 'export']);
            Route::post('/import', [EmployeeHourMeterBonusController::class, 'import']);
        });

        Route::prefix('/poh')->group(function () {
            Route::get('/', [PohController::class, 'index']);
            Route::post('/store', [PohController::class, 'store']);
            Route::post('/delete', [PohController::class, 'delete']);
            Route::post('/show', [PohController::class, 'show']);
            Route::get('/data', [PohController::class, 'anyData']);
            Route::get('/export', [PohController::class, 'export']);
            Route::post('/import', [PohController::class, 'import']);
        });

        Route::prefix('/coal-type')->group(function () {
            Route::get('/', [CoalTypeController::class, 'index']);
            Route::post('/store', [CoalTypeController::class, 'store']);
            Route::post('/delete', [CoalTypeController::class, 'delete']);
            Route::post('/show', [CoalTypeController::class, 'show']);
            Route::get('/data', [CoalTypeController::class, 'anyData']);
        });

        Route::prefix('/payment-group')->group(function () {
            Route::get('/', [PaymentGroupController::class, 'index']);
            Route::post('/store', [PaymentGroupController::class, 'store']);
            Route::post('/delete', [PaymentGroupController::class, 'delete']);
            Route::post('/show', [PaymentGroupController::class, 'show']);
            Route::get('/data', [PaymentGroupController::class, 'anyData']);
            Route::get('/export', [PaymentGroupController::class, 'export']);
            Route::post('/import', [PaymentGroupController::class, 'import']);
        });

        Route::prefix('/coal-from')->group(function () {
            Route::get('/', [CoalFromController::class, 'index']);
            Route::post('/store', [CoalFromController::class, 'store']);
            Route::post('/delete', [CoalFromController::class, 'delete']);
            Route::post('/show', [CoalFromController::class, 'show']);
            Route::get('/data', [CoalFromController::class, 'anyData']);
            Route::get('/export', [CoalFromController::class, 'export']);
            Route::post('/import', [CoalFromController::class, 'import']);
        });

        Route::prefix('/premi')->group(function () {
            Route::get('/', [PremiController::class, 'index']);
            Route::post('/store', [PremiController::class, 'store']);
            Route::post('/delete', [PremiController::class, 'delete']);
            Route::post('/show', [PremiController::class, 'show']);
            Route::get('/data', [PremiController::class, 'anyData']);
        });

        Route::prefix('tax-status')->group(function () {
            Route::get('/', [TaxStatusController::class, 'index']);
            Route::post('/store', [TaxStatusController::class, 'store']);
            Route::post('/delete', [TaxStatusController::class, 'delete']);
            Route::post('/show', [TaxStatusController::class, 'show']);
            Route::get('/data', [TaxStatusController::class, 'anyData']);
            Route::get('/export', [TaxStatusController::class, 'export']);
            Route::post('/import', [TaxStatusController::class, 'import']);
        });

        Route::prefix('variable')->group(function () {
            Route::get('/', [VariableController::class, 'index']);
            Route::post('/store', [VariableController::class, 'store']);
            Route::post('/delete', [VariableController::class, 'delete']);
            Route::post('/show', [VariableController::class, 'show']);
            Route::get('/data', [VariableController::class, 'anyData']);
            Route::get('/export', [VariableController::class, 'export']);
            Route::post('/import', [VariableController::class, 'import']);
        });

        Route::prefix('position')->group(function () {
            Route::get('/', [PositionController::class, 'index']);
            Route::post('/store', [PositionController::class, 'store']);
            Route::post('/delete', [PositionController::class, 'delete']);
            Route::post('/show', [PositionController::class, 'show']);
            Route::get('/data', [PositionController::class, 'anyData']);
            Route::get('/export', [PositionController::class, 'export']);
            Route::post('/import', [PositionController::class, 'import']);
        });

        Route::prefix('department')->group(function () {
            Route::get('/', [DepartmentController::class, 'index']);
            Route::post('/store', [DepartmentController::class, 'store']);
            Route::post('/delete', [DepartmentController::class, 'delete']);
            Route::post('/show', [DepartmentController::class, 'show']);
            Route::get('/data', [DepartmentController::class, 'anyData']);
            Route::get('/export', [DepartmentController::class, 'export']);
            Route::post('/import', [DepartmentController::class, 'import']);
        });

        Route::prefix('dictionary')->group(function () {
            Route::get('/', [DictionaryController::class, 'index']);
            Route::post('/store', [DepartmentController::class, 'store']);
            Route::post('/delete', [DepartmentController::class, 'delete']);
            Route::post('/show', [DepartmentController::class, 'show']);
            Route::get('/data', [DictionaryController::class, 'anyData']);
            Route::get('/export', [DepartmentController::class, 'export']);
            Route::post('/import', [DepartmentController::class, 'import']);
        });

        Route::prefix('location')->group(function () {
            Route::get('/', [LocationController::class, 'index']);
            Route::post('/store', [LocationController::class, 'store']);
            Route::post('/delete', [LocationController::class, 'delete']);
            Route::post('/show', [LocationController::class, 'show']);
            Route::get('/data', [LocationController::class, 'anyData']);
            Route::get('/export', [LocationController::class, 'export']);
            Route::post('/import', [LocationController::class, 'import']);
        });

        Route::prefix('atribut-size')->group(function () {
            Route::get('/', [AtributSizeController::class, 'index']);
            Route::post('/store', [AtributSizeController::class, 'store']);
            Route::post('/delete', [AtributSizeController::class, 'delete']);
            Route::post('/show', [AtributSizeController::class, 'show']);
            Route::get('/data', [AtributSizeController::class, 'anyData']);
            Route::get('/export', [AtributSizeController::class, 'export']);
            Route::post('/import', [AtributSizeController::class, 'import']);
        });

        Route::prefix('formula')->group(function () {
            Route::get('/', [FormulaController::class, 'index']);
            Route::get('/create', [FormulaController::class, 'create']);
            Route::get('/data', [FormulaController::class, 'anyData']);
            Route::get('/show/{uuid}', [FormulaController::class, 'show']);
            Route::post('/store', [FormulaController::class, 'store']);
        });

        Route::prefix('payment-other')->group(function () {
            Route::get('/', [PaymentOtherController::class, 'index']);
            Route::post('/store', [PaymentOtherController::class, 'store']);
            Route::post('/delete', [PaymentOtherController::class, 'delete']);
            Route::post('/show', [PaymentOtherController::class, 'show']);
            Route::get('/data', [PaymentOtherController::class, 'anyData']);
            Route::get('/export', [PaymentOtherController::class, 'export']);
            Route::post('/import', [PaymentOtherController::class, 'import']);
        });

        Route::prefix('privilege')->group(function () {
            Route::get('/export', [PrivilegeController::class, 'export']);
            Route::post('/import', [PrivilegeController::class, 'import']);
        });
    });

    Route::prefix('/superadmin')->group(function () { // ini privilege database sebenernya
        /*privilege 
            superadmin bisa membuat privilege dan mengatur privilege tiap user
        */

        Route::get('/privilege', [PrivilegeController::class, 'index']);
        Route::get('/database', [SuperadminController::class, 'index']);
        Route::post('/database/store', [PrivilegeController::class, 'store']);
        Route::post('/database/delete', [PrivilegeController::class, 'delete']);
        Route::post('/database/show', [PrivilegeController::class, 'show']);
        Route::get('/database-data', [PrivilegeController::class, 'anyData']);
    });

    // ===================== e n d   d a t a b a s e 

    Route::prefix('/safety')->group(function () {
        Route::get('/', [SafetyEmployeeController::class, 'index']);
        Route::get('/data', [SafetyEmployeeController::class, 'anyData']);
        Route::post('/store', [SafetyEmployeeController::class, 'store']);
        Route::post('/image-store', [SafetyEmployeeController::class, 'store']);
        Route::get('/edit/{nik_employee}', [SafetyEmployeeController::class, 'edit']);
    });


    Route::get('/admin/department/{department}', [DepartmentController::class, 'show']);
    Route::delete('/admin/department/delete/{department}', [DepartmentController::class, 'destroy']);
    Route::get('/department-data', [DepartmentController::class, 'anyData'])->name('department-data');
    // ============== privilege end    

    // foreman
    Route::middleware(['isForeman'])->group(function () {
        Route::prefix('/foreman')->group(function () {
            Route::get('/', [OverBurdenController::class, 'indexForeman']);
            Route::get('/hour-meter/{over_burden_uuid}', [HourMeterController::class, 'indexForeman']);
            Route::post('/hour-meter', [HourMeterController::class, 'store']);
            Route::get('/ritase/{over_burden_uuid}', [OverBurdenListController::class, 'indexForeman']);
        });


        Route::get('/foreman-ob-data/{checkerId}', [OverBurdenController::class, 'dataOverBurdenForeman'])->name('dataOverBurdenForeman');
        Route::get('/foreman/over-burden/{obID}/show', [OverBurdenListController::class, 'listOBforForeman']);
    });

    Route::middleware(['isAdminOb'])->group(function () {
        Route::prefix('/admin-ob')->group(function () {
            Route::get('/', [OverBurdenController::class, 'index']);
            Route::get('/create', [OverBurdenController::class, 'create']);
            Route::post('/', [OverBurdenController::class, 'store']);
            Route::get('/{idOB}/show', [OverBurdenController::class, 'show']);

            Route::get('/hour-meter/{idOB}', [HourMeterController::class, 'index']);
            Route::post('/hour-meter', [HourMeterController::class, 'store']);

            Route::post('/add-operator', [OverBurdenOperatorController::class, 'store']);

            Route::get('/ritasi/{idOB}', [OverBurdenListController::class, 'index']);
            Route::post('/add-ritase', [OverBurdenListController::class, 'store']);
        });



        Route::post('/admin-ob/flit', [OverBurdenFlitController::class, 'store']);
    });

    Route::get('/admin-ob-data', [OverBurdenController::class, 'dataOverBurden'])->name('ob-data');

    Route::prefix('/logistic')->group(function () {
        Route::prefix('/unit')->group(function () {
            Route::get('/', [VehicleController::class, 'index']);
            Route::post('/', [VehicleController::class, 'store']);

            Route::post('/delete', [VehicleController::class, 'delete']);
            Route::post('/show', [VehicleController::class, 'show']);
            Route::get('/data', [VehicleController::class, 'anyData']);
        });
        Route::prefix('brand')->group(function () {
            Route::get('/', [BrandController::class, 'index']);
            Route::post('/store', [BrandController::class, 'store']);
            Route::post('/delete', [BrandController::class, 'delete']);
            Route::post('/show', [BrandController::class, 'show']);
            Route::get('/data', [BrandController::class, 'anyData']);
        });
        Route::prefix('group-vehicle')->group(function () {
            Route::get('/', [GroupVehicleController::class, 'index']);
            Route::post('/store', [GroupVehicleController::class, 'store']);
            Route::post('/delete', [GroupVehicleController::class, 'delete']);
            Route::post('/show', [GroupVehicleController::class, 'show']);
            Route::get('/data', [GroupVehicleController::class, 'anyData']);
        });
        Route::prefix('brand-type')->group(function () {
            Route::get('/', [BrandTypeController::class, 'index']);
            Route::post('/store', [BrandTypeController::class, 'store']);
            Route::post('/delete', [BrandTypeController::class, 'delete']);
            Route::post('/show', [BrandTypeController::class, 'show']);
            Route::get('/data', [BrandTypeController::class, 'anyData']);
        });
        Route::prefix('status')->group(function () {
            Route::get('/', [StatusController::class, 'index']);
            Route::post('/store', [StatusController::class, 'store']);
            Route::post('/delete', [StatusController::class, 'delete']);
            Route::post('/show', [StatusController::class, 'show']);
            Route::get('/data', [StatusController::class, 'anyData']);
        });
        // data
        Route::get('/data-unit', [VehicleController::class, 'anyData']);
    });

    Route::middleware(['isEngineer'])->group(function () {
        Route::prefix('/engineer')->group(function () {
            Route::get('/', [OverBurdenController::class, 'indexEngineer']);
            Route::get('/ritase/{over_burden_uuid}', [OverBurdenRitaseController::class, 'create']);
        });
    });






































    Route::prefix('/purchase-order')->group(function () {
        Route::post('/store', [PurchaseOrderController::class, 'storeAdmin']);
        Route::get('/', [PurchaseOrderController::class, 'indexAdmin']);
        Route::post('/delete', [PurchaseOrderController::class, 'deleteAdmin']);
        Route::get('/create', [PurchaseOrderController::class, 'createAdmin']);
        Route::get('/show/{uuid}', [PurchaseOrderController::class, 'editAdmin']);
        Route::post('/show', [PurchaseOrderController::class, 'showAdmin']);
        Route::get('/data', [PurchaseOrderController::class, 'anyData']);
        Route::get('/detail/{po_number}', [PurchaseOrderController::class, 'showPublic']);
    });

    Route::prefix('/galery')->group(function () {
        Route::get('/data', [GaleryController::class, 'anyData']);
        Route::post('/store', [GaleryController::class, 'storeAdmin']);
        Route::post('/delete', [GaleryController::class, 'deleteAdmin']);
        Route::get('/', [GaleryController::class, 'indexAdmin']);
        Route::get('/show/{uuid}', [GaleryController::class, 'editAdmin']);
        Route::post('/show', [GaleryController::class, 'showAdmin']);
    });

    Route::prefix('/application')->group(function () {
        Route::get('/', [DatabaseController::class, 'index']);
    });





    Route::prefix('/user')->group(function () {
        Route::get('/data-session', [EmployeeController::class, 'dataSession']);
        Route::get('/', [EmployeeController::class, 'index']);
        Route::get('/history', [EmployeeController::class, 'index']);
        Route::post('/export-data', [EmployeeController::class, 'export']);

        Route::get('/delete', [EmployeeController::class, 'deleteAll']); //on index menu delete all
        Route::post('/data-x', [EmployeeController::class, 'anyMoreData_']);
        Route::post('/delete/employee', [EmployeeController::class, 'delete']);

        Route::get('/show/{nik_employee}', [EmployeeController::class, 'showEmployeeProfile']);
        Route::get('/get/{nik_employee}', [EmployeeController::class, 'getEmployee']);

        Route::get('/close', [UserDetailController::class, 'closeSession']);

        Route::get('/detail', [UserDetailController::class, 'create']);
        Route::get('/detail/{nik_employee}', [EmployeeController::class, 'show']);
        Route::get('/detail/{nik_employee}/{is_edit}', [UserDetailController::class, 'create']);

        Route::post('/store', [UserDetailController::class, 'store']);
        Route::get('/data/{nik_employee}', [UserDetailController::class, 'show']);


        Route::get('/data-one/{nik_employee}', [UserDetailController::class, 'anyDataDetailOne']);

        Route::get('/export-simple', [EmployeeController::class, 'exportSimple']);

        Route::post('/import', [EmployeeController::class, 'import']);
        Route::get('/{nik_employee}/edit', [UserDetailController::class, 'show']);
        Route::get('/export-data', [UserDetailController::class, 'exportData']);
        Route::get('/export', [UserDetailController::class, 'export']);
        Route::post('/export-full', [UserDetailController::class, 'exportFull']);
        Route::post('/export', [UserDetailController::class, 'exportAction']);
        Route::get('/monitoring', [UserDetailController::class, 'monitoring']);

        Route::prefix('/address')->group(function () {
            Route::get('/create', [UserAddressController::class, 'create']);
        });
        Route::prefix('/dependent')->group(function () {
            Route::get('/create', [UserDependentController::class, 'create']);
        });
        Route::prefix('/education')->group(function () {
            Route::get('/create', [UserEducationController::class, 'create']);
        });
        Route::prefix('/health')->group(function () {
            Route::get('/create', [UserHealthController::class, 'create']);
        });
        Route::prefix('/license')->group(function () {
            Route::get('/create', [UserLicenseController::class, 'create']);
        });
        Route::prefix('/document')->group(function () {
            Route::get('/create', [EmployeeDocumentController::class, 'create']);
        });
        Route::prefix('/employee')->group(function () {
            Route::get('/create', [EmployeeController::class, 'create']);
        });
        Route::prefix('/salary')->group(function () {
            Route::get('/create', [EmployeeSalaryController::class, 'create']);
        });
    });

    Route::prefix('/user-dependent')->group(function () {
        Route::get('/detail/{nik_employee}', [UserDependentController::class, 'create']);
        Route::get('/detail/{nik_employee}/{edit}', [UserDependentController::class, 'create']);
        Route::post('/store', [UserDependentController::class, 'store']);
        Route::get('/data/{nik_employee}', [UserDependentController::class, 'anyDataOne']);
    });

    Route::prefix('/user-education')->group(function () {
        Route::get('/detail/{nik_employee}', [UserEducationController::class, 'create']);
        Route::get('/detail/{nik_employee}/{edit}', [UserEducationController::class, 'create']);
        Route::get('/data/{uuid}', [UserEducationController::class, 'anyDataOne']);
        Route::post('/store', [UserEducationController::class, 'store']);
    });

    Route::prefix('/user-address')->group(function () {
        Route::get('/detail/{nik_employee}', [UserAddressController::class, 'create']);
        Route::get('/detail/{nik_employee}/{edit}', [UserAddressController::class, 'create']);
        Route::post('/store', [UserAddressController::class, 'store']);
        Route::get('/data/{nik_employee}', [UserAddressController::class, 'anyDataOne']);
    });

    Route::prefix('/user-license')->group(function () {
        Route::get('/detail/{nik_employee}', [UserLicenseController::class, 'create']);
        Route::get('/detail/{nik_employee}/{edit}', [UserLicenseController::class, 'create']);
        Route::post('/store', [UserLicenseController::class, 'store']);
        Route::get('/data/{uuid}', [UserLicenseController::class, 'anyDataOne']);
    });

    Route::prefix('/user-health')->group(function () {
        Route::get('/detail/{nik_employee}', [UserHealthController::class, 'create']);
        Route::get('/detail/{nik_employee}/{edit}', [UserHealthController::class, 'create']);
        Route::post('/store', [UserHealthController::class, 'store']);
        Route::get('/data/{uuid}', [UserHealthController::class, 'anyDataOne']);
    });

    Route::prefix('/user-employee')->group(function () {

        Route::get('/detail/{nik_employee}', [EmployeeController::class, 'create']);
        Route::get('/detail/{nik_employee}/{edit}', [EmployeeController::class, 'create']);
        Route::post('/store', [EmployeeController::class, 'store']);
        Route::get('/data/{uuid}', [EmployeeController::class, 'anyDataOne']);
    });

    Route::prefix('/employee-salary')->group(function () {
        Route::get('/detail/{nik_employee}', [EmployeeSalaryController::class, 'create']);
        Route::get('/detail/{nik_employee}/{edit}', [EmployeeSalaryController::class, 'create']);
        Route::post('/store', [EmployeeSalaryController::class, 'store']);
        Route::get('/data/{uuid}', [EmployeeSalaryController::class, 'anyDataOne']);
    });


    Route::prefix('/roaster')->group(function () {
        Route::get('/', [EmployeeController::class, 'index']);
    });

    Route::post('/user-file/store', [EmployeeController::class, 'storeFile']);

    Route::post('/user/nik', [EmployeeController::class, 'showData']);
    Route::get('/user/profile/{nik}', [EmployeeController::class, 'profile']);


    Route::get('/user-privilege', [UserPrivilegeController::class, 'index']);
    Route::post('/user-privilege/store', [UserPrivilegeController::class, 'store']);
    Route::get('/user-privilege-data', [UserPrivilegeController::class, 'anyData']);







    Route::get('/user-employee/{nik_employee}/edit', [EmployeeController::class, 'show']);
    Route::post('/user-employee/store', [EmployeeController::class, 'store']);
    Route::post('/user-employee/cekNikEmployee', [EmployeeController::class, 'cekNikEmployee']);


    Route::prefix('/logistic')->group(function () {
        Route::get('/', [StorageLogisticController::class, 'index']);
        Route::get('/show/{uuid_storage}', [StorageLogisticController::class, 'show']);
        Route::post('/storage/store', [StorageLogisticController::class, 'store']);

        Route::get('/data', [StorageLogisticController::class, 'anyData']);
    });
});

Route::middleware(['webIsLogin'])->group(function () {
    Route::prefix('/web')->group(function () {
        // 1. FILE
        Route::prefix('/file')->group(function () {
            Route::get('/', [DatabaseController::class, 'file']);
        });

        Route::prefix('/data')->group(function () {
            Route::post('/employee', [UserController::class, 'getfull']);
        });
        Route::post('/local-storage', [UserController::class, 'localStorage']);
        Route::get('/profile', [WebUserController::class, 'profile']);
        Route::get('/menu', function () {
            return view('app.menu');
        });


        Route::prefix('/hr')->group(function () {
            Route::get('/karyawan', [DatabaseController::class, 'indexHR']);
        });


        Route::prefix('/pendapatan')->group(function () {
            Route::get('/absensi', [WebAbsensiController::class, 'index']);
            Route::get('/slip', [WebAbsensiController::class, 'slip']);
            Route::prefix('/hauling')->group(function () {
                Route::get('/', [WebHaulingController::class, 'index']); 
                Route::post('/get', [HaulingController::class, 'get']);
                Route::post('/export', [HaulingController::class, 'export']);
            });
        });
        
        Route::prefix('/manage')->group(function () {            
            Route::get('/absensi', [WebAbsensiController::class, 'manageIndex']);
            Route::get('/slip', [WebAbsensiController::class, 'slipManage']);
            Route::get('/privilege', [UserPrivilegeController::class, 'index']);
            
                // Route::get('/user-privilege', [UserPrivilegeController::class, 'index']);

            
            
            Route::prefix('database')->group(function () {// /api/mbg/manage/database/
                Route::get('/', [DatabaseController::class, 'indexData']);
                Route::post('/export-datatable', [DatabaseController::class, 'exportDatatable']);
                Route::post('/store-database', [DatabaseController::class, 'storeDataWeb']);
            });

            Route::get('/users', [WebUserController::class, 'manageIndexUser']);
            Route::post('/import-user', [WebUserController::class, 'manageImportUser']);
            Route::post('/slip', [WebSlipController::class, 'slipStore']);
            Route::get('/app', function () {
                return view('app.menuApp');
            });
            Route::get('/menu', function () {
                return view('app.manageMenuApp');
            });

            Route::get('/localdata', function () {
                return view('app.localdata');
            });
        });
        Route::prefix('/pengelolaan')->group(function () {
            Route::prefix('/absensi')->group(function () {
                Route::get('/', [WebAbsensiController::class, 'manageIndex']);  
                Route::post('/store-single', [EmployeeAbsenController::class, 'storeAbsensiSingle']);
                Route::post('/post/list', [WebAbsensiController::class, 'storeListAbsensi']); 
                Route::post('/getAbsenEmployee', [EmployeeAbsen::class, 'getAbsenEmployee']); 
                Route::post('/daily-report', [EmployeeAbsenController::class, 'dialyReportWeb']);    
            });
            
            Route::get('/file-fingger', [WebAbsensiController::class, 'fileIndex']);            
            Route::get('/roaster-kerja', [EmployeeCutiController::class, 'webIndex']);       
            Route::post('/roaster-kerja/export', [EmployeeCutiController::class, 'webExport']);

        });
        Route::prefix('/recruitment')->group(function () {
            Route::get('/recruitment', [RecruitmentRecruitmentController::class, 'manageIndex']);
        });
        Route::prefix('/menu')->group(function () {
            Route::get('/user', [WebUserController::class, 'user']);
        });
    });
});

Route::prefix('/web')->group(function () {//before login
    Route::get('/logout', [WebUserController::class, 'logout']);
    Route::get('/login', function () {        
        return view('app.login');
    });
    Route::post('/login', [WebUserController::class, 'login']);
    Route::post('/login/available', [UserController::class, 'cekAvailableEmployee']);
    Route::get('/session', function () {
        dd(session('user_authentication'));
        return view('app.menuApp');
    });
    Route::get('/set-session', function () {        
        Session::put('user_authentication', '$storeEmployee');
        return view('app.menuApp');
    });
});



