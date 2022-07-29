<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgeGroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\PayrollController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// ----------------------------- Dashboard ----------------------------------------//
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ----------------------------- Login ----------------------------------------//
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


// ----------------------------- Age Groups ----------------------------------------//
Route::get('/age-groups', [App\Http\Controllers\AgeGroupController::class, 'ageGroupsView'])->middleware('auth')->name('organisation/age-groups');
Route::post('/age-groups/add', [App\Http\Controllers\AgeGroupController::class, 'addAgeGroups'])->middleware('auth')->name('organisation/age-groups/add');
Route::post('/age-groups/edit', [App\Http\Controllers\AgeGroupController::class, 'editAgeGroups'])->middleware('auth')->name('organisation/age-groups/edit');
Route::get('/age-groups/delete/{id}', [App\Http\Controllers\AgeGroupController::class, 'deleteAgeGroups'])->name('organisation/age-groups/delete');

// ----------------------------- Employees ----------------------------------------//
Route::get('/employees', [App\Http\Controllers\EmployeesController::class, 'employeeViews'])->name('organisation/employees');
Route::post('/employees/add', [App\Http\Controllers\EmployeesController::class, 'addEmployees'])->middleware('auth')->name('organisation/employees/add');
Route::post('/employees/edit', [App\Http\Controllers\EmployeesController::class, 'editEmployees'])->middleware('auth')->name('organisation/employees/edit');
Route::get('/employees/delete/{id}', [App\Http\Controllers\EmployeesController::class, 'deleteEmployees'])->name('organisation/employees/delete');

// ----------------------------- Departments ----------------------------------------//
Route::get('/departments', [App\Http\Controllers\DepartmentController::class, 'deptView'])->name('organisation/departments');
Route::post('/departments/add', [App\Http\Controllers\DepartmentController::class, 'addDept'])->middleware('auth')->name('organisation/departments/add');
Route::post('/departments/edit', [App\Http\Controllers\DepartmentController::class, 'editDept'])->middleware('auth')->name('organisation/departments/edit');
Route::get('/departments/delete/{id}', [App\Http\Controllers\DepartmentController::class, 'deleteDept'])->name('organisation/departments/delete');

// ----------------------------- Departments ----------------------------------------//
Route::get('/designations', [App\Http\Controllers\DesignationController::class, 'desigView'])->name('organisation/designations');
Route::post('/designations/add', [App\Http\Controllers\DesignationController::class, 'addDesig'])->middleware('auth')->name('organisation/designations/add');
Route::post('/designations/edit', [App\Http\Controllers\DesignationController::class, 'editDesig'])->middleware('auth')->name('organisation/designations/edit');
Route::get('/designations/delete/{id}', [App\Http\Controllers\DesignationController::class, 'deleteDesig'])->name('organisation/designations/delete');

// ----------------------------- Genders ----------------------------------------//
Route::get('/genders', [App\Http\Controllers\GenderController::class, 'genderView'])->name('organisation/genders');
Route::post('/genders/add', [App\Http\Controllers\GenderController::class, 'addGender'])->middleware('auth')->name('organisation/genders/add');
Route::post('/genders/edit', [App\Http\Controllers\GenderController::class, 'editGender'])->middleware('auth')->name('organisation/genders/edit');
Route::get('/genders/delete/{id}', [App\Http\Controllers\GenderController::class, 'deleteGender'])->name('organisation/genders/delete');

// ----------------------------- Levels ----------------------------------------//
Route::get('/levels', [App\Http\Controllers\LevelController::class, 'levelView'])->name('organisation/levels');
Route::post('/levels/add', [App\Http\Controllers\LevelController::class, 'addLevel'])->middleware('auth')->name('organisation/levels/add');
Route::post('/levels/edit', [App\Http\Controllers\LevelController::class, 'editLevel'])->middleware('auth')->name('organisation/levels/edit');
Route::get('/levels/delete/{id}', [App\Http\Controllers\LevelController::class, 'deleteLevel'])->name('organisation/levels/delete');

// ----------------------------- Regions ----------------------------------------//
Route::get('/regions', [App\Http\Controllers\RegionController::class, 'regionView'])->name('organisation/region');
Route::post('/regions/add', [App\Http\Controllers\RegionController::class, 'addRegion'])->middleware('auth')->name('organisation/region/add');
Route::post('/regions/edit', [App\Http\Controllers\RegionController::class, 'editRegion'])->middleware('auth')->name('organisation/region/edit');
Route::get('/regions/delete/{id}', [App\Http\Controllers\RegionController::class, 'deleteRegion'])->name('organisation/region/delete');

// ----------------------------- Holidays ----------------------------------------//
Route::get('/holidays', [App\Http\Controllers\HolidayController::class, 'holidayView'])->name('organisation/holidays');
Route::post('/holidays/add', [App\Http\Controllers\HolidayController::class, 'addHoliday'])->middleware('auth')->name('organisation/holidays/add');
Route::post('/holidays/edit', [App\Http\Controllers\HolidayController::class, 'editHoliday'])->middleware('auth')->name('organisation/holidays/edit');
Route::get('/holidays/delete/{id}', [App\Http\Controllers\HolidayController::class, 'deleteHoliday'])->name('organisation/holidays/delete');

// ----------------------------- Payroll ----------------------------------------//
Route::get('/payroll', [App\Http\Controllers\PayrollController::class, 'payrollView'])->name('payrolls/payroll');
Route::post('/payroll/add', [App\Http\Controllers\PayrollController::class, 'addPayroll'])->middleware('auth')->name('payrolls/payroll/add');
Route::post('/payroll/edit', [App\Http\Controllers\PayrollController::class, 'editPayroll'])->middleware('auth')->name('payrolls/payroll/edit');
Route::get('/payroll/delete/{id}', [App\Http\Controllers\PayrollController::class, 'deletePayroll'])->name('payrolls/payroll/delete');
Route::get('/payroll/view/{id}', [App\Http\Controllers\PayrollController::class,'employeeDetails'])->name('payrolls/employee-details');