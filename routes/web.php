<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NPDController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NpdpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\GantiPasswordController;

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('lupa-password', [LupaPasswordController::class, 'index']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
Route::get('/logout', [LogoutController::class, 'logout']);


Route::get('/', [LoginController::class, 'index']);
Route::get('fitur', [FrontController::class, 'fitur']);
Route::get('tim', [FrontController::class, 'tim']);
Route::get('partner', [FrontController::class, 'partner']);
Route::get('hubungikami', [FrontController::class, 'hubungikami']);
Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('superadmin', [HomeController::class, 'superadmin']);
    Route::get('superadmin/gp', [GantiPasswordController::class, 'index']);
    Route::post('superadmin/gp', [GantiPasswordController::class, 'update']);
    Route::post('superadmin/sk/updatelurah', [HomeController::class, 'updatelurah']);

    Route::get('superadmin/user', [UserController::class, 'index']);
    Route::get('superadmin/user/create', [UserController::class, 'create']);
    Route::post('superadmin/user/create', [UserController::class, 'store']);
    Route::get('superadmin/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('superadmin/user/edit/{id}', [UserController::class, 'update']);
    Route::get('superadmin/user/delete/{id}', [UserController::class, 'delete']);

    Route::get('superadmin/npd', [SuperadminController::class, 'npd']);
    Route::get('superadmin/npd/create', [SuperadminController::class, 'createNpd']);
    Route::post('superadmin/npd/create', [SuperadminController::class, 'storeNpd']);
    Route::get('superadmin/npd/edit/{id}', [SuperadminController::class, 'editNpd']);
    Route::post('superadmin/npd/edit/{id}', [SuperadminController::class, 'updateNpd']);
    Route::get('superadmin/npd/delete/{id}', [SuperadminController::class, 'deleteNpd']);
    Route::get('superadmin/npd/uraian/{id}', [SuperadminController::class, 'uraianNpd']);
    Route::post('superadmin/npd/uraian/{id}/add', [SuperadminController::class, 'storeUraianNpd']);

    Route::get('superadmin/npdp', [NpdpController::class, 'index']);
    Route::get('superadmin/npdp/uraian/{id}', [NpdpController::class, 'uraian']);

    Route::get('superadmin/user', [UserController::class, 'index']);
    Route::get('superadmin/user/create', [UserController::class, 'create']);
    Route::post('superadmin/user/create', [UserController::class, 'store']);
    Route::get('superadmin/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('superadmin/user/edit/{id}', [UserController::class, 'update']);
    Route::get('superadmin/user/delete/{id}', [UserController::class, 'delete']);
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('admin', [HomeController::class, 'admin']);
    Route::get('admin/gp', [GantiPasswordController::class, 'index']);
    Route::get('admin/npd', [NPDController::class, 'index']);
    Route::get('admin/npd/uraian/{id}', [NPDController::class, 'uraian']);
    Route::post('admin/npd/uraian/{id}/pencairan', [NPDController::class, 'storePencairan']);
    Route::get('admin/npd/delete/{id}', [NPDController::class, 'delete']);
    Route::get('admin/npd/edit/{id}', [NPDController::class, 'edit']);
    Route::get('admin/npd/create', [NPDController::class, 'create']);
    Route::post('admin/npd/create', [NPDController::class, 'store']);
    Route::post('admin/gp', [GantiPasswordController::class, 'update']);
});
