<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ObAdminController;
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
use App\Http\Controllers\OverBurden\OverBurdenFlitController;
use App\Http\Controllers\OverBurden\OverBurdenListController;
use App\Http\Controllers\SafetyEmployeeController;
use App\Http\Controllers\EmployeeContractController;
use App\Http\Controllers\Hauling\HaulingSetupController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\OverBurden\OverBurdenOperatorController;
use App\Http\Controllers\UserDetail\UserDetailController;
use App\Http\Controllers\UserDetail\UserEducationController;
use App\Http\Controllers\UserDetail\UserExperienceController;
use App\Http\Controllers\Vehicle\VehicleController as VehicleVehicleController;

Route::get('pdf-generate', [PDFController::class, 'generatePDF']);
Route::get('pdf-show', [PDFController::class, 'showPDF']);
// 


// 
Route::resource('admin/religion/', ReligionController::class);
Route::get('/religion-data', [ReligionController::class, 'anyData'])->name('religion-data');
Route::delete('/admin/religion/delete/{religion}', [ReligionController::class, 'destroy']);


Route::get('login/', [AuthenticationController::class, 'index'])->name('login');
Route::post('login/', [AuthenticationController::class, 'login']);

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







// Over Burden
// Route::resource('/admin/ob/', OverBurdenController::class);
// Route::get('/ob-data', [OverBurdenController::class, 'anyData'])->name('ob-data');



Route::resource('admin/menu/', MenuController::class);
Route::get('/menu-data', [MenuController::class, 'anyData'])->name('menu-data');



Route::middleware(['islogin'])->group(function () {

    Route::middleware(['isSuperAdmin'])->group(function () {
        // Route::get('/superadmin/manage-user', [UserController::class, 'manageUser']);
        // Route::get('/superadmin/manage-user/{id}', [UserController::class, 'showLevelEmployeeUser']);
        // Route::get('/superadmin/users', [UserController::class, 'anyData'])->name('users-data');
        // Route::get('/superadmin', [AdminController::class, 'index']);
        
        //reacheble
        Route::resource('/superadmin', DepartmentController::class);

        Route::get('/admin/department/{department}', [DepartmentController::class, 'show']);
        Route::delete('/admin/department/delete/{department}', [DepartmentController::class, 'destroy']);
        Route::get('/department-data', [DepartmentController::class, 'anyData'])->name('department-data');
    });
    Route::middleware(['isSupervisor'])->group(function () {
        Route::get('supervisor', [SupervisorController::class, 'index']);

    });
    // foreman
    Route::middleware(['isForeman'])->group(function () {
        Route::prefix('/foreman')->group(function () {
            Route::get('/', [ShiftController::class, 'index']);
        });
        
        
        // Route::get('/foreman/manage-checker', [ShiftController::class, 'manageCheckerShift']);
        Route::get('/foreman/shifts/create', [ShiftController::class, 'create']);
        // Route::post('/foreman/manage-checker', [ShiftController::class, 'storeManageCheckerShift']);
        Route::post('/foreman/shifts/', [ShiftController::class, 'store']); 
        Route::post('/foreman/manage-member-list', [ShiftListController::class, 'index']);
        Route::post('/foreman/manage-member', [ShiftListController::class, 'store']);
        Route::post('/foreman/over-burden', [OverBurdenController::class, 'forForemanOB']);
        // Route::post('/foreman/over-burden', [OverBurdenListController::class, 'forForeman']);
        Route::post('/foreman/hour-meter', [HourMeterController::class, 'listHMforForeman']);
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
        
        
        

        Route::get('/admin-ob-data', [OverBurdenController::class, 'dataOverBurden'])->name('ob-data');
        
        Route::post('/admin-ob/flit', [OverBurdenFlitController::class, 'store']);        
    });
    Route::middleware(['isSafety'])->group(function () {
        Route::get('/safety', [SafetyEmployeeController::class, 'index']);
        Route::get('/safety/{NIK_employee}/show', [SafetyEmployeeController::class, 'show']);
        Route::post('/safety/{NIK_employee}/store', [SafetyEmployeeController::class, 'store']);
        Route::get('/safety-data', [SafetyEmployeeController::class, 'anyData'])->name('safety-data');
    });
    Route::middleware(['isAdminHr'])->group(function () {
        Route::prefix('/admin-hr')->group(function () {
            Route::get('/create', [UserDetailController::class, 'create']);
            Route::post('/', [UserDetailController::class, 'store']);
            Route::get('/', [UserDetailController::class, 'index']);
            Route::get('/data-user', [UserDetailController::class, 'anyData'])->name('data-user');

            Route::get('/education/create', [UserEducationController::class, 'create']);
            Route::post('/education', [UserEducationController::class, 'store']);

            Route::get('/experience/create', [UserExperienceController::class, 'create']);
            Route::post('/experience', [UserExperienceController::class, 'store']);

            Route::get('/experience/create', [UserExperienceController::class, 'create']);
            Route::post('/experience', [UserExperienceController::class, 'store']);

            // =============== e m p l o y e e
            Route::get('/employee/create', [EmployeeController::class, 'create']);
            Route::post('/employee', [EmployeeController::class, 'store']);
        });
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
        
        

        // Absensi
        // Route::get('/admin-hr/absensi', [EmployeeContractController::class, 'anyData']);
        Route::get('/admin-hr/absensi/{month}', [AbsensiController::class, 'index']);

        Route::get('/admin-hr/absensi-data/{month}', [AbsensiController::class, 'absensiData']);
        Route::get('/admin-hr/absensi-show/{month}/{nik}', [AbsensiController::class, 'show']);
        Route::get('/admin-hr/absensi-export/{month}', [AbsensiController::class, 'exportAbsen']);
        Route::post('/admin-hr/absensi-edit', [AbsensiController::class, 'edit']);
        
        Route::post('/admin-hr/absensi', [AbsensiController::class, 'store']);

        Route::post('/admin-hr/employees/contract/create', [EmployeeContractController::class, 'createEmployeeContract']);
        // Route::post('/admin-hr/employees/contract/store', [EmployeeContractController::class, 'storeEmployeeContract']);
        Route::get('/admin-hr/employees/contract/show/{NIK_employee}', [EmployeeContractController::class, 'showEmployeeContract']);
        

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
    });
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
});





// employee

Route::get('/', [EmployeeController::class, 'index']);
Route::get('/sign-in', [EmployeeContractController::class, 'loginEC']);
Route::post('/sign-in', [AuthenticationController::class, 'login']);





// Route::get('/i-am-forgot-login-admin', [AuthAdminController::class, 'forgot']);
// Route::get('reset/{uuid}', [AuthAdminController::class, 'reset']);
// Route::get('/login-admin', [AuthAdminController::class, 'index'])->name('login');
// Route::post('/forgot', [AuthAdminController::class, 'forgot_proses']);
// Route::post('/login-admin', [AuthAdminController::class, 'store']);
// Route::post('/new-password', [AuthAdminController::class, 'new_pass']);

// Route::get('com', [ManageCommunityController::class, 'listCommunities']);


// Route::middleware(['islogin'])->group(function () {
//     Route::get('/', [DashboardController::class, 'index']);
//     Route::get('bank', [ManageBankController::class, 'index']);
//     Route::get('bank/create', [ManageBankController::class, 'create']);
//     Route::get('/bank-data', [ManageBankController::class, 'anyData'])->name('bank-data');
//     Route::delete('bank/{financialService}', [ManageBankController::class, 'destroy']);
//     Route::post('bank/', [ManageBankController::class, 'store']);
//     Route::put('bank/{financialService}', [ManageBankController::class, 'update']);
//     Route::get('bank/edit/{financialService}', [ManageBankController::class, 'edit']);
//     Route::get('/logout', [AuthAdminController::class, 'logout']);



//     Route::resource('/users', ManageUserController::class);
//     Route::get('/-data', [ManageUserController::class, 'anyData'])->name('data');

//     Route::resource('/admin-bank', ManageAdminBankController::class);
//     Route::get('/admin-bank-data', [ManageAdminBankController::class, 'anyData'])->name('admin-bank-data');

//     Route::resource('/galleries', ManageGalerryController::class);
//     Route::get('/galleries-data', [ManageGalerryController::class, 'anyData'])->name('galleries_data');

//     Route::resource('/admin', ManageAdminController::class);
//     Route::get('/admin-data', [ManageAdminController::class, 'anyData'])->name('admin-data');


//     Route::resource('/slides', ManageSlideController::class);
//     Route::get('/slide-data', [ManageSlideController::class, 'anyData'])->name('slide-data');

//     Route::resource('/youtube', ManageYoutubeController::class);
//     Route::get('/youtube-data', [ManageYoutubeController::class, 'anyData'])->name('youtube-data');

//     Route::resource('/news', ManageNewsController::class);
//     Route::get('/news-data', [ManageNewsController::class, 'anyData'])->name('news-data');

//     Route::resource('/business-category', ManageBusinessCategoryController::class);
//     Route::get('/business-category-data', [ManageBusinessCategoryController::class, 'anyData'])->name('business-category-data');

//     Route::resource('/business', ManageBusinessController::class);
//     Route::get('/business-data', [ManageBusinessController::class, 'anyData'])->name('business-data');

//     Route::resource('/tour', ManageTourController::class);
//     Route::get('/tour-data', [ManageTourController::class, 'anyData'])->name('tour-data');
//     Route::get('/api-data', [ManageTourController::class, 'listTourUser']);

//     Route::resource('/community-category', ManageCommunityCategoryController::class);
//     Route::get('/community-category-data', [ManageCommunityCategoryController::class, 'anyData'])->name('community-category-data');

//     Route::resource('/community', ManageCommunityController::class);
//     Route::get('/community-data', [ManageCommunityController::class, 'anyData'])->name('community-data');

//     Route::resource('/community-registers', ManageCommunityRegisterController::class);
//     Route::get('/community-registers-data', [ManageCommunityRegisterController::class, 'anyData'])->name('community-registers-data');

//     Route::resource('/review', ManageReviewController::class);
//     Route::get('/review-data', [ManageReviewController::class, 'anyData'])->name('review-data');

//     Route::delete('bank-register/{financialServiceRegister}', [ManageBankRegisterController::class, 'destroy']);
//     Route::resource('/bank-register', ManageBankRegisterController::class);
//     Route::get('/bank-register-data', [ManageBankRegisterController::class, 'anyData'])->name('bank-register-data');
//     Route::post('/bank-send', [ManageBankRegisterController::class, 'sendData']);


//     Route::delete('bank-loan/{financialServiceRegister}', [ManageBankLoanController::class, 'destroy']);
//     Route::resource('/bank-loan', ManageBankLoanController::class);
//     Route::get('/bank-loan-data', [ManageBankLoanController::class, 'anyData'])->name('bank-loan-data');

// });
// Route::get('/report', [ManageBankLoanController::class, 'report']);


Route::get('generate-excel', [AbsensiExcellController::class, 'index']);

Route::post('generate-excel', [AbsensiExcellController::class, 'store']);




