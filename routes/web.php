<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDocumentRequestController;
use App\Http\Controllers\AdminDocumentRequestController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserHomepageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminComplaintController;

// Root route - redirect to public homepage
Route::get('/', function () {
    return view('landing');
});


///SUPERADMIN PANEL

Route::get('/superadmin/dashboard', [AdminDashboardController::class, 'index'])->name('superadmin.dashboard');
Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');


Route::get('/superadmin/users', [App\Http\Controllers\UserController::class, 'index']);   
    Route::view('/superadmin/users/nextpage', 'superadmin.users.index2');
    Route::view('/superadmin/users/profile/view', 'superadmin.users.page-profile-view');
    Route::view('/superadmin/users/profile/edit', 'superadmin.users.page-profile-edit');


Route::get('/superadmin/documents', [AdminDocumentRequestController::class, 'index'])->name('superadmin.documents');
Route::post('/superadmin/documents/{id}/update-status', [AdminDocumentRequestController::class, 'updateStatus'])->name('superadmin.documents.update-status');
    Route::view('/superadmin/documents/nextpage', 'superadmin.documents.index2');


Route::get('/superadmin/complaints', [AdminComplaintController::class, 'index'])->name('superadmin.complaints');
Route::post('/superadmin/complaints/{id}/update-status', [AdminComplaintController::class, 'updateStatus'])->name('superadmin.complaints.update-status');
    Route::view('/superadmin/complaints/nextpage', 'superadmin.complaints.index2');

Route::view('/superadmin/auditlog', 'superadmin.auditlog.index');
    Route::view('/superadmin/auditlog/nextpage', 'superadmin.auditlog.index2');


Route::get('/superadmin/reports', [ReportController::class, 'index'])->name('superadmin.reports');
Route::post('/superadmin/reports/export', [ReportController::class, 'export'])->name('superadmin.reports.export');







///USER PANEL

Route::get('/user/homepage', [UserHomepageController::class, 'index'])->name('user.homepage');

Route::get('/user/document-req', [UserDocumentRequestController::class, 'userIndex'])->name('user.document-req');
Route::post('/user/document-req', [UserDocumentRequestController::class, 'store'])->name('user.document-req.store');

Route::get('/user/complaint-files', [App\Http\Controllers\ComplaintController::class, 'userIndex'])->name('user.complaints');
Route::post('/user/complaint-files', [App\Http\Controllers\ComplaintController::class, 'store'])->name('user.complaints.store');

Route::view('/user/profile', 'user.profile.index');





///jennica
Route::get('/publichomepage', function () {return view('landing');})->name('home');


Route::get('/register', function () {
    return view('auth.register');
});




Route::view('/superadmin/staffs', 'superadmin.staffs.index')->name('superadmin.staffs.index');
;



Route::view('/superadmin/barangay-officials', 'superadmin.barangay-officials.index')->name('superadmin.barangay-officials.index');
