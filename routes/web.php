<?php


use App\Http\Controllers\CookieController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevelopersController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\WagesController;
use App\Http\Controllers\VerifyController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\RecoveryController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TaskController;
use App\Models\Category;
use App\Models\Developers;

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
// dasboard
Route::controller(DashboardController::class)->group(function(){
Route::get('/','index')->middleware('auth');
});
// project
Route::controller(ProjectController::class)->group(function(){
Route::get('/projects', 'index')->name('project.index')->middleware('auth');
Route::post('/projects/update/{id}', 'update')->name('project.update');
Route::post('/projects/store', 'store')->name('project.store');
Route::get('projects/delete/{id}','delete')->name('project.delete');
Route::get('projects/getProjectByidcategory/{id}','getProjectByidcategory')->name('project.getProjectByidcategory');
Route::get('/projects/getProjectByid/{id}', 'getProjectByid')->name('project.byid');
Route::get('/Projects/getProjectsByidClients/{id}', 'getProjectsByidClients');
});
// payments
Route::controller(PaymentsController::class)->group(function(){
Route::get('/payments', 'false');
Route::get('/payments/from_project/{id}','show')->middleware('auth');
Route::post('/payments/store','store')->name('payments.store');
Route::get('/payments/delete/{id}','delete');
Route::post('/payments/update/{id}','update');
Route::get('/payments/getdataPayments/{id}','getdataPayments');
Route::get('/payments/getPaymentsByidproject/{id}','getPaymentsByidproject');
});
// tasks
Route::controller(TasksController::class)->group(function(){

Route::get('/tasks', 'false');
Route::get('/tasks/from_project/{id}','show')->middleware('auth');
Route::post('/tasks/store', 'store');
});
// clients
Route::controller(ClientsController::class)->group(function(){
Route::get('/clients','index')->middleware('auth');
Route::post('/clients/store', 'store');
Route::post('/clients/update/{id}', 'update');
Route::get('/clients/delete/{id}','delete');
Route::get('/clients/getclient/{id}','getclient');
});


// wages
Route::controller(SalaryController::class)->group(function(){

Route::get('/salary','index')->middleware('auth');
Route::get('/salary/getsalaryByidDeveloper/{id}', 'getsalaryByidDeveloper');
Route::post('/salary/store', 'store')->name('salary.store');
Route::get('/salary/getsalaryById/{id}', 'getsalaryById');
Route::post('/salary/update/{id}', 'update');
Route::get('/salary/delete/{id}','delete')->name('salary.delete');
});
// finance
Route::controller(FinanceController::class)->group(function(){
Route::get('/finances','index')->middleware('auth');
});
Route::controller(FinanceSettingController::class)->group(function(){
Route::get('/financessettins','index');
});
// login
Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout');
});
// developer
Route::controller(DevelopersController::class)->group(function(){
Route::get('/developers', 'index')->middleware('auth');
Route::post('/developers/store','store');
Route::get('/developers/delete/{id}','delete');
Route::post('/developers/update/{id}','update');
Route::get('/developers/getsalaryByidDeveloper/{id}', 'getsalaryByidDeveloper');
Route::get('/developers/getDeveloper/{id}','getDeveloper');
});
// platform
Route::controller(PlatformController::class)->group(function(){
Route::get('/platform', 'index')->middleware('auth');

// Route::post('/clients/store', 'store');
Route::get('/platform/getPlatform/{id}', 'getPlatform');
Route::get('/platform/checkproject/{id}', 'checkproject');



});
// category
Route::controller(CategoryController::class)->group(function(){

Route::get('/category', 'index')->middleware('auth');
Route::post('/category/store', 'store')->name('category.store');
Route::get('/category/getCategory/{id}', 'getCategory');
Route::get('/category/checkproject/{id}', 'checkproject');
Route::post('/category/update/{id}', 'update');
Route::get('/category/delete/{id}', 'delete');

});
// recofery
Route::controller(RecoveryController::class)->group(function(){

Route::get('/recovery','getEmail');
Route::post('/postemail','postEmail');

});

Route::controller(VerifyController::class)->group(function(){
Route::get('/codeverify','index');
});

Route::controller(PasswordController::class)->group(function(){
Route::get('/resetpassword','resetpassword');

});


