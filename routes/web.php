<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AuthenticateAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::view('/', 'index');

// Route::get('/welcome-mail', function(){
//     return view('admin.mail.welcome');
// });

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('login')->group(function() {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('/admin')->group(function(){
        Route::get('/set-password', [EmployeeController::class, 'indexSetPassword']);
        Route::post('/set-password', [EmployeeController::class, 'setPassword'])->name('set.password');

        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::post('/dashboard', [DashboardController::class, 'changeRole'])->name('change.role');

        Route::middleware('admin.auth')->group(function(){
            Route::get('/web-auth', [DashboardController::class, 'webAuthIndex']);
            Route::post('/web-auth', [DashboardController::class, 'assignRole'])->name('assign.role');
            Route::post('/get-role', [DashboardController::class, 'getRole']); // ajax call for filter roles

            Route::get('/employee-management', [EmployeeController::class, 'index']);
            Route::get('/add-employee', [EmployeeController::class, 'indexAddEmployee']);
            Route::post('/add-employee', [EmployeeController::class, 'addNewEmployee'])->name('employee.addNew');
            Route::get('/employee-deatil/{emp_id}', [EmployeeController::class, 'employeeDeatilIndex']);
        });
        Route::get('/my-profile', [EmployeeController::class, 'indexMyProfile']);
        Route::get('/manage-profile', [EmployeeController::class, 'indexManageProfile']);
        Route::post('/manage-personal-details', [EmployeeController::class, 'updatePersonalDetails'])->name('employee.updatePersonalDetails');
        Route::post('/manage-qualification', [EmployeeController::class, 'updateQualification'])->name('employee.updateQualification');
        Route::post('/manage-work-experience', [EmployeeController::class, 'updateWorkExperience'])->name('employee.updateWorkExperience');
        Route::post('/manage-bank-details', [EmployeeController::class, 'updateBankDetails'])->name('employee.updateBankDetails');
        Route::post('/manage-profile-image', [EmployeeController::class, 'updateProfileImage'])->name('employee.updateProfileImage');
        Route::get('/reset-password', [EmployeeController::class, 'indexResetPassword']);
        Route::post('/reset-password', [EmployeeController::class, 'resetPassword'])->name('employee.resetPassword');
    
        Route::get('/leave-management', [LeaveController::class, 'index']);
        Route::get('/apply-leave', [LeaveController::class, 'applyLeave']);
        Route::post('/apply-leave', [LeaveController::class, 'leaveApply'])->name('leave.apply');
        Route::get('/assign-leave', [LeaveController::class, 'assignLeave']);
        Route::post('/assign-leave', [LeaveController::class, 'leaveAssign'])->name('leave.assign');
        Route::get('/cancel-leave/{id}', [LeaveController::class, 'cancelLeave']);
        Route::get('/leave-approved/{id}', [LeaveController::class, 'leaveApprove']);
        Route::post('/leave-rejected/{id}', [LeaveController::class, 'leaveReject']);
        Route::get('/apply-wfh', [LeaveController::class, 'wfhIndex']);
        Route::get('/leave-report', [LeaveController::class, 'leaveReportIndex']);
        Route::get('/search-leave-report', [LeaveController::class, 'leaveReport']); //ajax call to load leave report
        Route::get('/search-leave-report/{name?}/{fromDate?}/{toDate?}', [LeaveController::class, 'searchLeave'])->name('leave.report'); //ajax call to search
        Route::post('/generate-leave-report', [LeaveController::class, 'generateLeaveReport']);
        Route::get('/generate-leave-report-wofilter', [LeaveController::class, 'generateLeaveReportWithoutFilter']);
        Route::get('/ckeck-leave-notification', [DashboardController::class, 'checkLeaveNotification']); //ajax call to check leave notification
        Route::get('/update-notification-status', [DashboardController::class, 'updateNotificationStatus']); //ajax call to update leave notification
    });
});