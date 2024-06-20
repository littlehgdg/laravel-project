<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ApointmentController;
use App\Http\Controllers\PatientReportController;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

Route::get('/', function () {
    return view('auth.login');
});

// Authentication routes
Auth::routes();
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register/writer', [RegisterController::class, 'showWriterRegisterForm'])->name('register.writer');

// Forgot Password Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::post('/login/admin', [LoginController::class, 'adminLogin']);
Route::post('/login/writer', [LoginController::class, 'writerLogin']);
Route::post('/register/admin', [RegisterController::class, 'createAdmin'])->name('register.admin');
Route::post('/register/writer', [RegisterController::class, 'createWriter'])->name('register.writer');

// Route untuk halaman dashboard setelah login
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::view('/writer', 'writer');
});

Route::get('/send-test-email', function () {
    $details = [
        'title' => 'Mail from Laravel Application',
        'body' => 'This is for testing email using Mailtrap SMTP.'
    ];

    Mail::to('recipient@example.com')->send(new TestMail($details));

    return 'Email sent';
});

//halaman home/dashboard
Route::get('home_show', [HomeController::class, 'show'])->name('home_show');

// Doctor routes
Route::get('/doctor_show', [DoctorController::class, 'show'])->name('doctor_show');
Route::get('/doctor_create', [DoctorController::class, 'create'])->name('doctor_create');
Route::post('/doctor_store', [DoctorController::class, 'store'])->name('doctor_store');
Route::get('/doctor_edit/{id}', [DoctorController::class, 'edit'])->name('doctor_edit');
Route::post('doctor_update/{id}', [DoctorController::class, 'update'])->name('doctor_update');
Route::delete('/doctor_delete/{id}', [DoctorController::class, 'destroy'])->name('doctor_delete');

// Ward routes
Route::get('ward_show', [WardController::class, 'index']);
Route::get('ward_create', [WardController::class, 'create']);
Route::post('ward_store', [WardController::class, 'store']);
Route::get('ward_edit/{id}', [WardController::class, 'edit']);
Route::post('ward_update/{id}', [WardController::class, 'update']);
Route::delete('ward_delete/{id}', [WardController::class, 'destroy'])->name('ward_delete');

// Patient routes
Route::get('patient_show', [PatientController::class, 'show'])->name('patient_show');
Route::get('patient_create', [PatientController::class, 'create']);
Route::post('patient_submit', [PatientController::class, 'store'])->name('patient_submit');
Route::get('patient_delete/{id}', [PatientController::class, 'destroy'])->name('patient_delete');
Route::get('patient_update/{id}', [PatientController::class, 'edit'])->name('patient_edit');
Route::post('patient_update/{id}', [PatientController::class, 'update'])->name('patient_update');
Route::get('patient_report', [PatientReportController::class, 'index'])->name('patient_report');
Route::get('/patient_history/{id}', [PatientReportController::class, 'showHistory'])->name('patient_history');


// Department routes
Route::get('department', [DepartmentController::class, 'index']);
Route::post('dep_submit', [DepartmentController::class, 'store']);
Route::get('department', [DepartmentController::class, 'show']);
Route::get('dept_delete/{id}', [DepartmentController::class, 'destroy']);
Route::get('dept_update/{id}', [DepartmentController::class, 'edit']);

// Appointment routes
Route::get('apointment', [ApointmentController::class, 'show']);
Route::get('create_apoint', [ApointmentController::class, 'create']);
Route::post('apoint_submit', [ApointmentController::class, 'store']);
Route::get('apointment_update/{id}', [ApointmentController::class, 'edit']);
Route::post('apoint_update/{id}', [ApointmentController::class, 'update']);
Route::get('apointment_delete/{id}', [ApointmentController::class, 'destroy']);

// Themes
Route::view('profile', 'profile')->name('profile');
Route::view('map', 'googlemap');
Route::view('postwelcome', 'postwelcome');
