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
use App\Http\Controllers\AbsensiExcellController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Employee\EmployeeAbsenController;
use App\Http\Controllers\Employee\EmployeeHourMeterDayController;
use App\Http\Controllers\Employee\EmployeeTotalHmMonthController;
use App\Http\Controllers\OverBurden\OverBurdenFlitController;
use App\Http\Controllers\OverBurden\OverBurdenListController;
use App\Http\Controllers\SafetyEmployeeController;
use App\Http\Controllers\EmployeeContractController;
use App\Http\Controllers\Employee\EmployeeSalaryController;
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
use App\Http\Controllers\Safety\AtributEmployeeController;
use App\Http\Controllers\StatusAbsenController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\TotalController;
use App\Http\Controllers\UserDetail\UserDependentController;
use App\Http\Controllers\UserDetail\UserDetailController;
use App\Http\Controllers\UserDetail\UserEducationController;
use App\Http\Controllers\UserDetail\UserExperienceController;
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

    // absensi user
    Route::prefix('/user/absensi')->group(function () {
        Route::get('/', [EmployeeAbsenController::class, 'index']);
        Route::get('/detail/{year_month}/{employee_uuid}', [EmployeeAbsenController::class, 'showPayrol']);
        Route::get('/export/{year_month}', [EmployeeAbsenController::class, 'export']);
        Route::post('/import', [EmployeeAbsenController::class, 'import']);
        Route::get('/data/{year_month}', [EmployeeAbsenController::class, 'anyData']);
    });

    
    Route::prefix('/database')->group(function () {
        Route::get('/absen', [StatusAbsenController::class, 'indexPayrol']);
    });
    
  

    Route::prefix('/admin-hr')->group(function () {
        // =============== u s e r   d e t a i l
        Route::get('/user/create', [UserDetailController::class, 'create']);
        Route::post('/user', [UserDetailController::class, 'store']);

        Route::get('/dependent/create/{user_detail_uuid}', [UserDependentController::class, 'create']);
        

        Route::get('/education/create/{user_detail_uuid}', [UserEducationController::class, 'create']);
        Route::post('/education', [UserEducationController::class, 'store']);

   

        

        Route::get('/health/create/{user_detail_uuid}', [UserHealthController::class, 'create']);
        Route::post('/health', [UserHealthController::class, 'store']);

        Route::get('/', [UserDetailController::class, 'index']);
        Route::get('/data-user', [UserDetailController::class, 'anyData'])->name('data-user');

        
    });

   
        // Route::get('/superadmin/manage-user', [UserController::class, 'manageUser']);
        // Route::get('/superadmin/manage-user/{id}', [UserController::class, 'showLevelEmployeeUser']);
        // Route::get('/superadmin/users', [UserController::class, 'anyData'])->name('users-data');
        // Route::get('/superadmin', [AdminController::class, 'index']);
        
        //reacheble
        // Route::resource('/superadmin', DepartmentController::class);

        Route::get('/superadmin/privilege', [PrivilegeController::class, 'index']);
        Route::get('/superadmin/database', [SuperadminController::class, 'index']);
        Route::post('/superadmin/database/store', [PrivilegeController::class, 'store']);
        Route::post('/superadmin/database/delete', [PrivilegeController::class, 'delete']);
        Route::post('/superadmin/database/show', [PrivilegeController::class, 'show']);

        Route::get('/superadmin/database-data', [PrivilegeController::class, 'anyData']);

        Route::get('/admin/department/{department}', [DepartmentController::class, 'show']);
        Route::delete('/admin/department/delete/{department}', [DepartmentController::class, 'destroy']);
        Route::get('/department-data', [DepartmentController::class, 'anyData'])->name('department-data');
   
    Route::middleware(['isSupervisor'])->group(function () {
        Route::get('supervisor', [SupervisorController::class, 'index']);

    });
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
    
    Route::middleware(['isSafety'])->group(function () {
        Route::prefix('/safety')->group(function () {
            Route::get('/manage', [AtributController::class, 'index']);
            Route::get('/employee-list', [AtributEmployeeController::class, 'index']);
        });
        Route::get('/safety/{nik_employee}/show', [SafetyEmployeeController::class, 'show']);
        Route::post('/safety/{nik_employee}/store', [SafetyEmployeeController::class, 'store']);
        Route::get('/safety-data', [SafetyEmployeeController::class, 'anyData'])->name('safety-data');
    });

    

        Route::get('/admin-hr/absensi-export/{month}', [AbsensiController::class, 'exportAbsen']);
        Route::post('/admin-hr/absensi-edit', [AbsensiController::class, 'edit']);
        
        Route::post('/admin-hr/absensi', [AbsensiController::class, 'store']);




        // Route::get('/admin-hr', [EmployeeContractController::class, 'index']);
        Route::get('/admin-hr/employee', [EmployeeController::class, 'listEmployee']);
        Route::get('/admin-hr/employee', [EmployeeController::class, 'listEmployee']);
        // setup
        Route::get('/admin-hr/employees', [EmployeeController::class, 'indexHR']);
        Route::get('/admin-hr/monitoring', [EmployeeContractController::class, 'index']);
        Route::get('/admin-hr/employees/create', [EmployeeController::class, 'create']);
        Route::post('/admin-hr/employees', [EmployeeController::class, 'store']);
        Route::post('/admin-hr/employees/contract/store', [EmployeeContractController::class, 'store']);

        // Route::get('/admin-hr/employees/create', [EmployeeController::class, 'createEmployee']);
        Route::get('/admin-hr/employeesData', [EmployeeController::class, 'employeesData']);
        
        


        Route::post('/admin-hr/employees/contract/create', [EmployeeContractController::class, 'createEmployeeContract']);
        // Route::post('/admin-hr/employees/contract/store', [EmployeeContractController::class, 'storeEmployeeContract']);
        Route::get('/admin-hr/employees/contract/show/{nik_employee}', [EmployeeContractController::class, 'showEmployeeContract']);
        

        // HR Hour Meter Employee
        Route::get('/admin-hr/hour-meter/{month}', [HourMeterController::class, 'indexHR']);
        Route::get('/admin-hr/hour-meter-data/{month}', [HourMeterController::class, 'hourMeterData']);
        
        Route::resource('/admin/people/', PeopleController::class);
        Route::get('/people-data', [PeopleController::class, 'anyData'])->name('people-data');
        Route::get('/admin/people/{people}', [PeopleController::class, 'show']);
       
    

        Route::get('/employee-contract-data', [EmployeeContractController::class, 'anyData'])->name('employee-contract-data');
        Route::post('/admin/employee-contract', [EmployeeContractController::class, 'store']);
        Route::get('/admin/employee-contract', [EmployeeContractController::class, 'index']);
        Route::get('/admin/employee-contract/create', [EmployeeContractController::class, 'create'])->name('employee-contract');
        Route::get('/admin/employee-contract/{people}', [EmployeeContractController::class, 'show'])->name('employee-contract-show');
   
    Route::middleware(['isLogistic'])->group(function () {
        Route::get('/logistic', [LogisticController::class, 'index']);
        Route::prefix('/logistic')->group(function () {

            Route::get('/unit', [VehicleVehicleController::class, 'index']);
            Route::post('/unit', [VehicleVehicleController::class, 'store']);


            // data
            Route::get('/data-unit', [VehicleVehicleController::class, 'anyData']);
          
        });

    });
    Route::middleware(['isHauling'])->group(function () {
        Route::prefix('/hauling')->group(function () {
            Route::get('/', [HaulingSetupController::class, 'index']);

            Route::get('/data-setup-hauling', [HaulingSetupController::class, 'anyData']);
        });
    });
   



    Route::middleware(['isEngineer'])->group(function () {
        Route::prefix('/engineer')->group(function () {
            Route::get('/', [OverBurdenController::class, 'indexEngineer']);
            Route::get('/ritase/{over_burden_uuid}', [OverBurdenRitaseController::class, 'create']);
        });
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

            Route::prefix('/absensi')->group(function () {//payrol/absensi
                
                Route::get('/month-data/{year_month}', [EmployeeAbsenController::class, 'dataEmployeeAbsen']);
                Route::post('/month/{year_month}', [EmployeeAbsenController::class, 'importPayrol']);
                Route::get('/month/export/{year_month}/export', [EmployeeAbsenController::class, 'exportPayrol']);
            });

            Route::prefix('/hour-meter-day')->group(function () {//payrol/absensi
                Route::get('/month/{year_month}', [EmployeeHourMeterDayController::class, 'indexPayrol']);
                Route::post('/store', [EmployeeHourMeterDayController::class, 'storePayrol']);

            });

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

          
            Route::prefix('/database')->group(function () {//payrol/absensi
                Route::get('/absen', [StatusAbsenController::class, 'indexPayrol']);///payrol/database/status-absen
                Route::post('/status-absen', [StatusAbsenController::class, 'storePayrol']);///payrol/database/status-absen
                Route::get('/absen/{uuid}/edit', [StatusAbsenController::class, 'showPayrol']);

                Route::get('/hour-meter-price', [HourMeterPriceController::class, 'indexPayrol']);//
                Route::post('/hour-meter-price', [HourMeterPriceController::class, 'storePayrol']);///payrol/database/status-absen
                Route::get('/hour-meter-price/{uuid}/edit', [HourMeterPriceController::class, 'showPayrol']);
                
                Route::get('/payment-group', [PaymentGroupController::class, 'indexPayrol']);//payrol/database/payment
                Route::get('/payment-group/{uuid}/edit', [PaymentGroupController::class, 'showPayrol']);
                Route::post('/payment-group', [PaymentGroupController::class, 'storePayrol']);
                Route::get('/payment-group/{uuid}/delete', [PaymentGroupController::class, 'deletePayrol']);

                Route::get('/month/{year_month}/{employee_uuid}', [EmployeeAbsenController::class, 'showPayrol']);
                Route::get('/month-data/{year_month}', [EmployeeAbsenController::class, 'dataEmployeeAbsen']);
                Route::post('/month/{year_month}', [EmployeeAbsenController::class, 'importPayrol']);
            });
        });


































    Route::middleware(['isPurchaseOrder'])->group(function () {
        Route::prefix('/purchase-order')->group(function () {
            Route::post('/store', [PurchaseOrderController::class, 'storeAdmin']);
            Route::get('/', [PurchaseOrderController::class, 'indexAdmin']);
            Route::post('/delete', [PurchaseOrderController::class, 'deleteAdmin']);
            Route::get('/create', [PurchaseOrderController::class, 'createAdmin']);
            Route::get('/show/{uuid}', [PurchaseOrderController::class, 'editAdmin']);
            Route::post('/show', [PurchaseOrderController::class, 'showAdmin']);
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
});



Route::get('/purchase-order/data', [PurchaseOrderController::class, 'anyData']);
Route::prefix('/penerimaan-barang-po')->group(function () {
    Route::get('/', [PurchaseOrderController::class, 'indexPublic']);
    Route::get('/detail/{po_number}', [PurchaseOrderController::class, 'showPublic']);
});


Route::get('/eee/{uuu}', [PaymentController::class, 'dataPayment']);



// employee


Route::get('/sign-in', [EmployeeContractController::class, 'loginEC']);
Route::post('/sign-in', [AuthenticationController::class, 'login']);

Route::get('generate-excel', [AbsensiExcellController::class, 'index']);

Route::post('generate-excel', [AbsensiExcellController::class, 'store']);




