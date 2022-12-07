<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\OverBurden\HourMeterController;
use App\Http\Controllers\ShiftListController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OverBurden\OverBurdenController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CoalFromController;
use App\Http\Controllers\CoalTypeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Employee\EmployeeAbsenController;
use App\Http\Controllers\Employee\EmployeeHourMeterDayController;
use App\Http\Controllers\Employee\EmployeePaymentController;
use App\Http\Controllers\Employee\EmployeePaymentOtherController;
use App\Http\Controllers\OverBurden\OverBurdenFlitController;
use App\Http\Controllers\OverBurden\OverBurdenListController;
use App\Http\Controllers\Employee\EmployeeTonseController;
use App\Http\Controllers\Hauling\HaulingSetupController;
use App\Http\Controllers\HourMeterPriceController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\OverBurden\OverBurdenOperatorController;
use App\Http\Controllers\OverBurden\OverBurdenRitaseController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\PaymentGroupController;
use App\Http\Controllers\PaymentOtherController;
use App\Http\Controllers\PremiController;
use App\Http\Controllers\Privilege\PrivilegeController;
use App\Http\Controllers\Privilege\UserPrivilegeController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\PurchaseOrder\GaleryController;
use App\Http\Controllers\PurchaseOrder\PurchaseOrderController;
use App\Http\Controllers\Safety\SafetyEmployeeController;
use App\Http\Controllers\StatusAbsenController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\TaxStatusController;
use App\Http\Controllers\UserDetail\UserDependentController;
use App\Http\Controllers\UserDetail\UserDetailController;
use App\Http\Controllers\UserDetail\UserEducationController;
use App\Http\Controllers\UserDetail\UserLicenseController;
use App\Http\Controllers\UserDetail\UserHealthController;
use App\Http\Controllers\Vehicle\VehicleController as VehicleVehicleController;
use App\Models\TaxStatus;

Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/', [AuthenticationController::class, 'index']);
Route::get('/user/me-only/{table_name}', [AdminController::class, 'exportTable']);



Route::middleware(['islogin'])->group(function () {
    Route::prefix('/me')->group(function () {
        Route::get('/{nik_employee}', [EmployeeController::class, 'profile']);
        Route::get('/{nik_employee}/absensi', [EmployeeAbsenController::class, 'show']);
        Route::get('/{nik_employee}/hour-meter', [EmployeeHourMeterDayController::class, 'indexForEmployee']); 
        Route::get('/{nik_employee}/tonase', [EmployeeTonseController::class, 'indexForEmployee']); 
    });
    
    

    //    allowance

    Route::prefix('/allowance')->group(function () {
        Route::get('/', [AllowanceController::class, 'index']);
        Route::get('/test/{year_month}', [AllowanceController::class, 'moreAnyData']);
        Route::post('/data', [AllowanceController::class, 'moreAnyData']);
        
        Route::post('/more-data', [AllowanceController::class, 'moreAnyData']);
        
    });

    Route::prefix('/production')->group(function () {
        Route::get('/', [ProductionController::class, 'index']);
        Route::get('/data/{year_month}', [ProductionController::class, 'anyData']);
        Route::get('/create', [ProductionController::class, 'create']);
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
    Route::prefix('/hour-meter')->group(function () {
        Route::get('/create', [EmployeeHourMeterDayController::class, 'create']);
        Route::get('/data', [EmployeeHourMeterDayController::class, 'anyData']);
        Route::get('/data-for-employee/{nik_employee}/{year_month}', [EmployeeHourMeterDayController::class, 'anyDataForEmployee']);
        Route::get('/data-all', [EmployeeHourMeterDayController::class, 'anyDataAll']);
        Route::get('/data/{year_month}', [EmployeeHourMeterDayController::class, 'anyDataMonth']);
        Route::get('/data-day/{year_month_day}', [EmployeeHourMeterDayController::class, 'anyDataDay']);
        Route::post('/store', [EmployeeHourMeterDayController::class, 'store']);
        Route::post('/edit', [EmployeeHourMeterDayController::class, 'show']);
        Route::post('/delete', [EmployeeHourMeterDayController::class, 'delete']);

        Route::get('/show/{hour_meter_uuid}', [EmployeeHourMeterDayController::class, 'showUuid']);
        Route::get('/data-uuid/{hour_meter_uuid}', [EmployeeHourMeterDayController::class, 'anyDataUuid']);
        
        Route::get('/show/{nik_employee}/{year_month}', [EmployeeHourMeterDayController::class, 'showMonth']);
        Route::get('/data/employee-month/{nik_employee}/{year_month}', [EmployeeHourMeterDayController::class, 'anyDataMonthEmployee']);


        Route::post('/import', [EmployeeHourMeterDayController::class, 'import']);
        Route::get('/export/{year_month}', [EmployeeHourMeterDayController::class, 'export']);

        Route::get('/', [EmployeeHourMeterDayController::class, 'index']);

        // for employee
        
    });
    Route::prefix('/tonase')->group(function () {
        Route::get('/', [EmployeeTonseController::class, 'index']);
        Route::get('/create', [EmployeeTonseController::class, 'create']);
        Route::get('/detail/{nik_employee}/{time}', [EmployeeTonseController::class, 'detail']);
        Route::post('/data', [EmployeeTonseController::class, 'anyDataMonthFilter']);
        Route::post('/data-create', [EmployeeTonseController::class, 'anyDataCreate']);
        Route::post('/store', [EmployeeTonseController::class, 'store']);

        Route::post('/import', [EmployeeTonseController::class, 'import']);
        Route::get('/export/{year_month}', [EmployeeTonseController::class, 'export']);
        Route::post('/edit', [EmployeeTonseController::class, 'show']);
    });

    Route::prefix('/payment')->group(function () {
        Route::get('/', [EmployeePaymentController::class, 'index']);
        Route::get('/create', [EmployeePaymentController::class, 'create']);
        Route::get('/show/{payment_uuid}', [PaymentController::class, 'show']);
        Route::get('/data/{year_month}', [EmployeePaymentController::class, 'anyDataMonth']);
        Route::post('/store', [PaymentController::class, 'store']);

        Route::post('/import', [PaymentController::class, 'import']);
        Route::get('/export/{year_month}', [PaymentController::class, 'export']);
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
        Route::get('/', [EmployeeAbsenController::class, 'index']);
        Route::get('/detail/{year_month}/{employee_uuid}', [EmployeeAbsenController::class, 'showEmployee']);
        Route::get('/export/{year_month}', [EmployeeAbsenController::class, 'exportWithData']);
        Route::get('/export-template/{year_month}', [EmployeeAbsenController::class, 'exportTemplate']);
        Route::post('/import', [EmployeeAbsenController::class, 'import']);
        Route::get('/data/{year_month}', [EmployeeAbsenController::class, 'anyData']);
        Route::get('/data-employee/{year_month}/{employee_uuid}', [EmployeeAbsenController::class, 'anyDataEmployee']);
        Route::post('/store', [EmployeeAbsenController::class, 'store']);
    });

    Route::prefix('/other-payment')->group(function () {
        Route::get('/', [EmployeePaymentOtherController::class, 'index']);
        Route::post('/import', [EmployeePaymentOtherController::class, 'import']);
        Route::get('/data/{year_month}', [EmployeePaymentOtherController::class, 'anyDataMonth']);
        Route::post('/show', [EmployeePaymentOtherController::class, 'show']);
        Route::post('/delete', [EmployeePaymentOtherController::class, 'delete']);
        
        Route::post('/store', [EmployeePaymentOtherController::class, 'store']);
        Route::get('/export/{year_month}', [EmployeePaymentOtherController::class, 'export']);
    });




    //  =============== a l l o w a n c e


    // ===================== d a t a b a s e 
    Route::prefix('/database')->group(function () {
        Route::get('/absen', [StatusAbsenController::class, 'indexPayrol']);
        Route::post('/status-absen', [StatusAbsenController::class, 'storePayrol']);///payrol/database/status-absen
        Route::get('/absen/{uuid}/edit', [StatusAbsenController::class, 'showPayrol']);
        Route::post('/absen/delete', [StatusAbsenController::class, 'delete']);
        Route::get('/absen-data', [StatusAbsenController::class, 'anyData']);
        Route::prefix('/hour-meter-price')->group(function () {
            Route::get('/', [HourMeterPriceController::class, 'index']);
            Route::post('/store', [HourMeterPriceController::class, 'store']);
            Route::post('/delete', [HourMeterPriceController::class, 'delete']);
            Route::post('/show', [HourMeterPriceController::class, 'show']);
            Route::get('/data', [HourMeterPriceController::class, 'anyData']);
        });
        Route::prefix('/company')->group(function () {
            Route::get('/', [CompanyController::class, 'index']);
            Route::post('/store', [CompanyController::class, 'store']);
            Route::post('/delete', [CompanyController::class, 'delete']);
            Route::post('/show', [CompanyController::class, 'show']);
            Route::get('/data', [CompanyController::class, 'anyData']);
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
        });
        Route::prefix('/coal-from')->group(function () {
            Route::get('/', [CoalFromController::class, 'index']);
            Route::post('/store', [CoalFromController::class, 'store']);
            Route::post('/delete', [CoalFromController::class, 'delete']);
            Route::post('/show', [CoalFromController::class, 'show']);
            Route::get('/data', [CoalFromController::class, 'anyData']);
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
        });

        Route::prefix('payment-other')->group(function () {
            Route::get('/', [PaymentOtherController::class, 'index']);
            Route::post('/store', [PaymentOtherController::class, 'store']);
            Route::post('/delete', [PaymentOtherController::class, 'delete']);
            Route::post('/show', [PaymentOtherController::class, 'show']);
            Route::get('/data', [PaymentOtherController::class, 'anyData']);
        });

    });

    Route::prefix('/superadmin')->group(function () {// ini privilege database sebenernya
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
        
        
        // Route::get('/foreman/manage-checker', [ShiftController::class, 'manageCheckerShift']);
        Route::get('/foreman/shifts/create', [ShiftController::class, 'create']);
        // Route::post('/foreman/manage-checker', [ShiftController::class, 'storeManageCheckerShift']);
        Route::post('/foreman/shifts/', [ShiftController::class, 'store']); 
        Route::post('/foreman/manage-member-list', [ShiftListController::class, 'index']);
        Route::post('/foreman/manage-member', [ShiftListController::class, 'store']);
        Route::post('/foreman/over-burden', [OverBurdenController::class, 'forForemanOB']);
        // Route::post('/foreman/over-burden', [OverBurdenListController::class, 'forForeman']);
        // Route::post('/foreman/hour-meter', [HourMeterController::class, 'listHMforForeman']);
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
    
   
        Route::get('/logistic', [LogisticController::class, 'index']);
        Route::prefix('/logistic')->group(function () {

            Route::get('/unit', [VehicleVehicleController::class, 'index']);
            Route::post('/unit', [VehicleVehicleController::class, 'store']);


            // data
            Route::get('/data-unit', [VehicleVehicleController::class, 'anyData']);
          
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




        
        Route::get('/cuti', [UserDetailController::class, 'indexUser']);
        Route::get('/data-setup-hauling', [HaulingSetupController::class, 'anyData']);    
        // hour-meter
        
        // user
        Route::prefix('/user')->group(function () {
            Route::get('/', [EmployeeController::class, 'index']);
            Route::post('/', [UserDetailController::class, 'store']);

            Route::get('/export-simple', [EmployeeController::class, 'exportSimple']);

            Route::post('/import', [EmployeeController::class, 'import']);
            
            Route::get('/create', [UserDetailController::class, 'create']);
            Route::get('/{nik_employee}/edit', [UserDetailController::class, 'show']);
            Route::get('/export-data', [UserDetailController::class, 'exportData']);
            Route::get('/export', [UserDetailController::class, 'export']);
            Route::post('/export', [UserDetailController::class, 'exportAction']);

            Route::get('/monitoring', [UserDetailController::class, 'monitoring']);
        });
        Route::prefix('/roaster')->group(function () {
            Route::get('/', [EmployeeController::class, 'index']);
        });

        Route::post('/user-file/store', [EmployeeController::class, 'storeFile']);
        Route::get('/user-data', [EmployeeController::class, 'anyData']);
        Route::post('/user/nik', [EmployeeController::class, 'show']);
        Route::get('/user/profile/{nik}', [EmployeeController::class, 'profile']);
        
    
        Route::get('/user-privilege', [UserPrivilegeController::class, 'index']);
        Route::post('/user-privilege/store', [UserPrivilegeController::class, 'store']);
        Route::get('/user-privilege-data', [UserPrivilegeController::class, 'anyData']);
    
        
        Route::get('/user-health/{nik_employee}/edit', [UserHealthController::class, 'show']);
        Route::get('/user-health/create/{user_detail_uuid}', [UserHealthController::class, 'create']);
        Route::post('/user-health/store', [UserHealthController::class, 'store']);
    
        Route::get('/user-dependent/create/{user_detail_uuid}', [UserDependentController::class, 'create']);
        Route::get('/user-dependent/{nik_employee}/edit', [UserDependentController::class, 'show']);
        Route::post('/user-dependent/store', [UserDependentController::class, 'store']);
    
        Route::get('/user-education/create/{user_detail_uuid}', [UserEducationController::class, 'create']);
        Route::get('/user-education/{nik_employee}/edit', [UserEducationController::class, 'show']);
        Route::post('/user-education/store', [UserEducationController::class, 'store']);
    
        Route::get('/user-license/create/{user_detail_uuid}', [UserLicenseController::class, 'create']);
        Route::post('/user-license/store', [UserLicenseController::class, 'store']);
        Route::get('/user-license/{nik_employee}/edit', [UserLicenseController::class, 'show']);
    
        Route::get('/user-employee/create/{user_detail_uuid}', [EmployeeController::class, 'create']);
        Route::get('/user-employee/{nik_employee}/edit', [EmployeeController::class, 'show']);
        Route::post('/user-employee/store', [EmployeeController::class, 'store']);

        Route::post('/user-employee/cekNikEmployee', [EmployeeController::class, 'cekNikEmployee']);
});

