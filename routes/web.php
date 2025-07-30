<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BiometricAttendanceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PerformanceController;

       



Route::resource('projects', ProjectController::class);
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');



// Biometric Routes

Route::get('/biometric', [BiometricAttendanceController::class, 'index'])->name('biometric.index');
Route::get('/biometric/create', [BiometricAttendanceController::class, 'create'])->name('biometric.create');
Route::post('/biometric', [BiometricAttendanceController::class, 'store'])->name('biometric.store');


// Events
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events', [EventController::class, 'index'])->name('events.index');

Route::get('/', function () {
    return view('welcome');
});


Route::get('dashboard', function () {
    return view('dashboard');
});

Route::get('layout', function () {
    return view('layout');
});

Route::get('home', function () {
    return view('home');
});
Route::post('/home', [ContactController::class, 'store'])->name('contact.store');

Route::get('employee', function () {
    return view('employee-form');
});


// Attendance Routes

Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
Route::put('/attendance/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
Route::get('/attendance/export/{type}', [AttendanceController::class, 'export'])->name('attendance.export');
Route::get('/attendance/pdf', [AttendanceController::class, 'exportPdf'])->name('attendance.pdf');

// Leaves Routes

Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
Route::post('/leaves/{id}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
Route::post('/leaves/{id}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');

// Salary Routes

Route::get('/salary', [SalaryController::class, 'index'])->name('salary.index');
Route::post('/salary/calculate', [SalaryController::class, 'calculate'])->name('salary.calculate');
Route::get('/salary/payslip/{id}/{month}', [SalaryController::class, 'generatePayslip'])->name('salary.payslip');

// Payslip Routes

Route::get('/salary/payslip/{id}/{month}', [SalaryController::class, 'generatePayslip'])->name('salary.payslip');

// Employee Routes

Route::resource('employees', EmployeeController::class);
Route::resource('employees', \App\Http\Controllers\EmployeeController::class);

// Reports Routes

Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');

// Settings Controller

Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');


Route::get('/help', function () {
    return view('help');
})->name('help');



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::patch('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read.all');





Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');


Route::middleware('auth')->group(function () {
    Route::get('/chat', [MessageController::class, 'index'])->name('chat');
    Route::get('/chat/messages/{userId}', [MessageController::class, 'fetchMessages'])->name('chat.messages');
    Route::post('/chat/send', [MessageController::class, 'sendMessage'])->name('chat.send');
});
Route::delete('/messages/clear/{receiverId}', [MessageController::class, 'clearChat'])->name('messages.clear');
Route::put('/messages/{id}', [MessageController::class, 'update'])->name('messages.update');
Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Searchbar Routes
Route::get('/live-search', [App\Http\Controllers\LiveSearchController::class, 'search'])->name('live.search');

// Employee Show
Route::get('/employees/{id}', function($id){
    $employee = App\Models\Employee::findOrFail($id);
    return view('live-search.employee-show', compact('employee'));
})->name('employees.show');

// Attendance Show
Route::get('/attendance/{id}', function($id){
    $attendance = App\Models\Attendance::with('employee')->findOrFail($id);
    return view('live-search.attendance-show', compact('attendance'));
})->name('attendance.show');

// Leave Show
Route::get('/leaves/{id}', function($id){
    $leave = App\Models\Leave::with('employee')->findOrFail($id);
    return view('live-search.leave-show', compact('leave'));
})->name('leaves.show');

// Salary Show
Route::get('/salary/{id}', function($id){
    $salary = App\Models\Salary::with('employee')->findOrFail($id);
    return view('live-search.salary-show', compact('salary'));
})->name('salary.show');

// Reports Show
Route::get('/reports/{id}', function($id){
    $report = App\Models\Report::findOrFail($id);
    return view('live-search.report-show', compact('report'));
})->name('reports.show');



// Performance Insight
Route::get('/performance/create', [PerformanceController::class, 'create'])->name('performance.create');
Route::get('/performance/{id}', [PerformanceController::class, 'show'])->name('performance.show');

// Performance Insight Module Routes
Route::prefix('performance')->name('performance.')->group(function () {

    // Show all performance entries
    Route::get('/', [PerformanceController::class, 'index'])->name('index');

    // Show form to create new performance record
    Route::get('/create', [PerformanceController::class, 'create'])->name('create');

    // Store new performance record
    Route::post('/store', [PerformanceController::class, 'store'])->name('store');

    // Show individual performance detail
    Route::get('/show/{id}', [PerformanceController::class, 'show'])->name('performance.show');

    // Show form to edit performance record
    Route::get('/edit/{id}', [PerformanceController::class, 'edit'])->name('edit');

    // Update existing performance record
    Route::put('/update/{id}', [PerformanceController::class, 'update'])->name('update');

    // Delete performance record
    Route::delete('/delete/{id}', [PerformanceController::class, 'destroy'])->name('destroy');

    // Generate PDF for all performance records
    Route::get('/pdf', [PerformanceController::class, 'pdf'])->name('pdf');

    // Optional: Generate PDF for a single employee
    Route::get('/pdf/{id}', [PerformanceController::class, 'pdfSingle'])->name('pdf.single');

});

Route::get('/performance/download/{id}', [PerformanceController::class, 'download'])->name('performance.download');

//SelEvaluation Routes
Route::get('/self-evaluate', [PerformanceController::class, 'selfEvaluate'])->name('self.evaluate');
Route::post('/self-evaluate', [PerformanceController::class, 'storeSelfEvaluation'])->name('self.evaluate');
