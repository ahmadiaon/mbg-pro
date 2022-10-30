<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\OverBurden\HourMeterController;
use App\Http\Controllers\ShiftListController;
use App\Http\Controllers\UnitGroupController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OverBurden\OverBurdenController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\VehicleGroupController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CoalFromController;
use App\Http\Controllers\Employee\EmployeeAbsenController;
use App\Http\Controllers\Employee\EmployeeHourMeterDayController;
use App\Http\Controllers\Employee\EmployeePaymentController;
use App\Http\Controllers\Employee\EmployeeTotalHmMonthController;
use App\Http\Controllers\OverBurden\OverBurdenFlitController;
use App\Http\Controllers\OverBurden\OverBurdenListController;
use App\Http\Controllers\Employee\EmployeeSalaryController;
use App\Http\Controllers\Employee\EmployeeTonseController;
use App\Http\Controllers\Hauling\HaulingSetupController;
use App\Http\Controllers\HourMeterPriceController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\OverBurden\OverBurdenOperatorController;
use App\Http\Controllers\OverBurden\OverBurdenRitaseController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\PaymentEmployeeController;
use App\Http\Controllers\Payment\PaymentGroupController;
use App\Http\Controllers\Privilege\PrivilegeController;
use App\Http\Controllers\Privilege\UserPrivilegeController;
use App\Http\Controllers\PurchaseOrder\GaleryController;
use App\Http\Controllers\PurchaseOrder\PurchaseOrderController;
use App\Http\Controllers\Safety\AtributController;
use App\Http\Controllers\Safety\SafetyEmployeeController;
use App\Http\Controllers\StatusAbsenController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\TotalController;
use App\Http\Controllers\UserDetail\UserDependentController;
use App\Http\Controllers\UserDetail\UserDetailController;
use App\Http\Controllers\UserDetail\UserEducationController;
use App\Http\Controllers\UserDetail\UserLicenseController;
use App\Http\Controllers\UserDetail\UserHealthController;
use App\Http\Controllers\Vehicle\VehicleController as VehicleVehicleController;



Route::get('pdf-generate', [PDFController::class, 'generatePDF']);
Route::get('pdf-show', [PDFController::class, 'showPDF']);
// 


// 
Route::resource('admin/religion/', ReligionController::class);
Route::get('/religion-data', [ReligionController::class, 'anyData'])->name('religion-data');
Route::delete('/admin/religion/delete/{religion}', [ReligionController::class, 'destroy']);


Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);

// Route::get('admin/people/', [PeopleController::class, 'index']);

// unit
Route::get('/unit-data', [UnitController::class, 'anyData'])->name('unit-data');
Route::resource('admin/unit/', UnitController::class);
Route::delete('/admin/unit/delete/{unit}', [UnitController::class, 'destroy']);
Route::get('/admin/unit/{unit}', [UnitController::class, 'show']);
Route::get('/admin/unit-all', [UnitController::class, 'allData']);


// vehicle group
Route::get('/vehicle_group-data', [VehicleGroupController::class, 'anyData'])->name('vehicle_group-data');
Route::delete('/admin/vehicle_group/delete/{vehicle_group}', [VehicleGroupController::class, 'destroy']);
Route::get('/admin/vehicle_group/{vehicle_group}', [VehicleGroupController::class, 'show']);
Route::get('/admin/vehicle_group-all', [VehicleGroupController::class, 'allData']);
Route::post('/admin/vehicle_group/', [VehicleGroupController::class, 'store']);

// vehicle
Route::get('/vehicle-data', [VehicleController::class, 'anyData'])->name('vehicle-data');
Route::delete('/admin/vehicle/delete/{vehicle}', [VehicleController::class, 'destroy']);
Route::get('/admin/vehicle/{vehicle}', [VehicleController::class, 'show']);
Route::get('/admin/vehicle-all', [VehicleController::class, 'allData']);
Route::post('/admin/vehicle/', [VehicleController::class, 'store']);



// unit group
Route::get('/unit_group-data', [UnitGroupController::class, 'anyData'])->name('unit_group-data');
Route::resource('admin/unit_group/', UnitGroupController::class);
Route::delete('/admin/unit_group/delete/{unit_group}', [UnitGroupController::class, 'destroy']);
Route::get('/admin/unit_group/{unit_group}', [UnitGroupController::class, 'show']);
Route::get('/admin/unit_group-all', [UnitGroupController::class, 'allData']);


Route::resource('/admin/position/', PositionController::class);
Route::get('/position-data', [PositionController::class, 'anyData'])->name('position-data');
Route::get('/admin/position/{position}', [PositionController::class, 'show']);
Route::delete('/admin/position/delete/{position}', [PositionController::class, 'destroy']);

Route::resource('admin/menu/', MenuController::class);
Route::get('/menu-data', [MenuController::class, 'anyData'])->name('menu-data');



Route::middleware(['islogin'])->group(function () {
  
    Route::get('/me/{nik_employee}', [EmployeeController::class, 'profile']);
    Route::get('/cuti', [UserDetailController::class, 'indexUser']);
    Route::get('/data-setup-hauling', [HaulingSetupController::class, 'anyData']);     
    
    // user
    Route::get('/user', [EmployeeController::class, 'index']);
    Route::post('/user', [UserDetailController::class, 'store']);
    Route::post('/user-file/store', [EmployeeController::class, 'storeFile']);
    Route::get('/user/create', [UserDetailController::class, 'create']);
    Route::get('/user/{nik_employee}/edit', [UserDetailController::class, 'show']);
    
    
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

    //    allowance
    Route::prefix('/hour-meter')->group(function () {
        Route::get('/create', [EmployeeHourMeterDayController::class, 'create']);
        Route::get('/data', [EmployeeHourMeterDayController::class, 'anyData']);
        Route::post('/store', [EmployeeHourMeterDayController::class, 'store']);
        Route::post('/edit', [EmployeeHourMeterDayController::class, 'show']);
    });
    Route::prefix('/tonase')->group(function () {
        Route::get('/', [EmployeeTonseController::class, 'index']);
        Route::get('/create', [EmployeeTonseController::class, 'create']);
        Route::get('/data', [EmployeeTonseController::class, 'anyData']);
        Route::get('/data/{year_month}', [EmployeeTonseController::class, 'anyDataMonth']);
        Route::post('/store', [EmployeeTonseController::class, 'store']);
        Route::post('/edit', [EmployeeHourMeterDayController::class, 'show']);
    });
    Route::prefix('/payment')->group(function () {
        Route::get('/', [EmployeePaymentController::class, 'index']);
        Route::get('/create', [EmployeePaymentController::class, 'create']);
        Route::get('/data', [EmployeeTonseController::class, 'anyData']);
        Route::get('/show/{payment_uuid}', [PaymentController::class, 'show']);
        Route::get('/data/{year_month}', [EmployeePaymentController::class, 'anyDataMonth']);
        Route::post('/store', [PaymentController::class, 'store']);
        Route::post('/edit', [EmployeeHourMeterDayController::class, 'show']);
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
        Route::get('/detail/{year_month}/{employee_uuid}', [EmployeeAbsenController::class, 'showPayrol']);
        Route::get('/export/{year_month}', [EmployeeAbsenController::class, 'export']);
        Route::post('/import', [EmployeeAbsenController::class, 'import']);
        Route::get('/data/{year_month}', [EmployeeAbsenController::class, 'anyData']);
        Route::post('/store', [EmployeeAbsenController::class, 'store']);
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

    Route::prefix('/payrol')->group(function () {
        Route::get('/', [EmployeeSalaryController::class, 'indexPayrol']);
        Route::post('/store', [EmployeeTotalHmMonthController::class, 'storePayrol']);
        Route::get('/hour-meter/{date}', [EmployeeTotalHmMonthController::class, 'indexPayrol']);
        Route::get('/month/{month}', [EmployeeTotalHmMonthController::class, 'indexPayrol']);
        Route::get('/ritase/{over_burden_uuid}', [OverBurdenRitaseController::class, 'create']);
        Route::get('/dataHourMeterMonth/{month}', [EmployeeTotalHmMonthController::class, 'dataHourMeterMonth'])->name('dataHourMeterMonth');
        Route::get('/month/{month}/export', [EmployeeTotalHmMonthController::class, 'exportPayrol']);
        Route::post('/month/{month}/import', [EmployeeTotalHmMonthController::class, 'importPayrol']);


        Route::prefix('/payment')->group(function () {//payrol/absensi
            Route::post('/store', [PaymentController::class, 'storePayrol']);
            Route::get('/month/{year_month}', [PaymentController::class, 'indexPayrol']);//payrol/database/payment
            Route::get('/month-data/{year_month}',[PaymentController::class, 'dataPayment']);
            Route::get('/create', [PaymentController::class, 'createPayrol']);
            Route::get('/show/{uuid}', [PaymentController::class, 'editPayrol']);
            Route::post('/show', [PaymentController::class, 'showPayrol']);
        });

   

        Route::prefix('/payment-employee')->group(function () {//payrol/absensi
            Route::get('/month/{year_month}', [PaymentEmployeeController::class, 'indexPayrol']);      
            Route::post('/show', [PaymentEmployeeController::class, 'showEmployeePayrol']);                
            Route::post('/store', [PaymentEmployeeController::class, 'storePayrol']);                
        });

        Route::get('/total/{year_month}', [TotalController::class, 'indexPayrol']);

 
    });
        

        Route::get('/admin/department/{department}', [DepartmentController::class, 'show']);
        Route::delete('/admin/department/delete/{department}', [DepartmentController::class, 'destroy']);
        Route::get('/department-data', [DepartmentController::class, 'anyData'])->name('department-data');
    // ==============privilege end    

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
    
    Route::middleware(['isLogistic'])->group(function () {
        Route::get('/logistic', [LogisticController::class, 'index']);
        Route::prefix('/logistic')->group(function () {

            Route::get('/unit', [VehicleVehicleController::class, 'index']);
            Route::post('/unit', [VehicleVehicleController::class, 'store']);


            // data
            Route::get('/data-unit', [VehicleVehicleController::class, 'anyData']);
          
        });

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

});







Route::get('/eee/{uuu}', [PaymentController::class, 'dataPayment']);

