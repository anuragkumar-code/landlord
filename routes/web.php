<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [ManagerController::class,'managerLogin'])->name('managerLogin');
Route::post('/manager/logged', [ManagerController::class,'managerLogged']);

Route::get('/admin/login', [AdminController::class,'viewLogin'])->name('login');
Route::post('/admin/logged', [AdminController::class,'adminLogged']);

Route::get('/manager/force_login', [ManagerController::class,'forceLogin']);
Route::get('/manager/force', [ManagerController::class,'force'])->name('force');


Route::group(['middleware' => ['admin']], function(){

    Route::get('/admin/dashboard', [AdminController::class,'adminDashboard'])->name('adminDashboard');
    Route::get('/admin/archive-history', [AdminController::class,'archiveHistory'])->name('archiveHistory');
    Route::get('/admin/history_detail/{id}', [AdminController::class,'history_detail'])->name('history_detail');

    Route::get('/admin/logout', [AdminController::class,'logout'])->name('adminLogout');
    Route::get('/admin/managers', [AdminController::class,'viewManagers'])->name('viewManagers');

    Route::get('/admin/add-manager', [AdminController::class,'viewAddManager'])->name('viewAddManager');
    Route::post('/admin/addmanager', [AdminController::class,'addManager'])->name('addManager');

    Route::get('/admin/changepassword', [AdminController::class,'changepassword'])->name('changepassword');
    Route::post('/admin/updatepassword', [AdminController::class,'updatepassword'])->name('updatepassword');

    Route::get('/admin/manager-edit/{id}',[AdminController::class,'editManager']);
    Route::post('/admin/manager-edited',[AdminController::class,'editedManager']);

    Route::get('/admin/manager-delete/{id}', [AdminController::class,'deleteManager']);

    Route::post('/admin/archive_data', [AdminController::class,'archive_data']);

    

});

Route::group(['middleware' => ['manager']], function(){
    Route::get('/manager/dashboard', [ManagerController::class,'managerDashboard'])->name('managerDashboard');
    Route::get('/manager/logout', [ManagerController::class,'managerLogout'])->name('managerLogout');

    Route::post('/manager/newentry', [ManagerController::class,'newEntry'])->name('newEntry');
    Route::post('/manager/expense', [ManagerController::class,'newExpense'])->name('newExpense');

    Route::get('/manager/changepassword', [ManagerController::class,'changepassword'])->name('changepassword');
    Route::post('/manager/updatepassword', [ManagerController::class,'updatepassword'])->name('updatepassword');

    
});


