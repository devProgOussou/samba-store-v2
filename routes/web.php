<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Home\WelcomeController;
use App\Http\Controllers\Message\MessageController;
use App\Http\Controllers\Advertisement\AdvertisementController;

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

//ROUTE FOR ADBERTISEMENT SHOW FOR UNREGISTERED USER
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/post/{id}', [WelcomeController::class, 'show'])->name('welcome.show');





Auth::routes();





// FACEBOOK LOGIN
Route::get('login/{provider}', [SocialController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [SocialController::class, 'handleProviderCallback']);





//ROUTE FOR HOME CONTROLLER TO FILTERED REQUEST ICOMING LOGIN OR REGISTER
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home.index');





//ROUTE FOR USER CONTROLLER
Route::get('/deactivate', [UserController::class, 'showDash'])->middleware('auth')->name('user.dash');
Route::get('/updateUserProfile/{id}', [UserController::class, 'edit'])->middleware('auth')->name('user.updateProfile');
Route::post('/updateUserProfile/{id}', [UserController::class, 'updateUser'])->middleware('auth')->name('user.updateProfiled');
// Route::get('/updateCompanyProfile/{id}', [UserController::class, 'UpdateCompany'])->name();
Route::post('/updateCompanyProfile/{id}', [UserController::class, 'UpdateCompany'])->middleware('auth')->name('ompany.update');





//ROUTE FOR AMDIN CONTROLLER
Route::get('/user/{id}', [AdminController::class, 'show'])->middleware('auth')->name('admin.show');
Route::get('/userDeactivate/{id}', [AdminController::class, 'deactivate'])->middleware('auth')->name('admin.deactivate');
Route::put('/userDeactivate/{id}', [AdminController::class], 'deactivate')->middleware('auth')->name('admin.deactivated');
Route::get('/userActivate/{id}', [AdminController::class, 'activate'])->middleware('auth')->name('admin.activate');
Route::put('/userActivate/{id}', [AdminController::class, 'activate'])->middleware('auth')->name('admin.activated');
Route::get('/userDelete/{id}', [AdminController::class, 'destroy'])->middleware('auth')->name('admin.destroy');
Route::delete('/userDelete/{id}', [AdminController::class, 'destroy'])->middleware('auth')->name('admin.destroyed');
Route::get('/showCompanies', [AdminController::class, 'showCompanies'])->middleware('auth')->name('admin.showCompanies');
Route::get('/showPersonals', [AdminController::class, 'showPersonals'])->middleware('auth')->name('admin.showPersonals');
Route::get('/company/{id}', [AdminController::class, 'showCompany'])->name('admin.showCompany');
Route::get('/personal/{id}', [AdminController::class, 'showPersonal'])->middleware('auth')->name('admin.showPersonal');
Route::get('/DeletePersonalPost/{id}', [AdminController::class, 'DeletePersonalPost'])->middleware('auth')->name('admin.showPersonalDelete');
Route::delete('/DeletePersonalPost/{id}', [AdminController::class, 'DeletePersonalPost'])->middleware('auth')->name('admin.DeletedPersonalPost');
Route::get('/personalDelete/{id}', [AdminController::class, 'personalDelete'])->middleware('auth')->name('admin.personalDelete');
Route::get('/personalDelete/{id}', [AdminController::class, 'personalDelete'])->middleware('auth')->name('admin.personalDeleted');
Route::get('/companyDelete/{id}', [AdminController::class, 'companyDelete'])->middleware('auth')->name('admin.companyDelete');
Route::delete('/companyDelete/{id}', [AdminController::class, 'companyDelete'])->middleware('auth')->name('admin.companyDeleted');
Route::get('/MessageSave', [AdminController::class, 'messageSave'])->middleware('auth')->name('Admin.messageSave');
Route::post('/contactAdmin', [AdminController::class, 'contactAdmin'])->middleware('auth')->name('contactAdmin.admin');
Route::get('/UserDeactivated', [AdminController::class, 'UserDeactivated'])->middleware('auth')->name('admin.UserDeactivated');
Route::post('/sendMessageToUserDeactivated', [AdminController::class, 'sendMessageToUserDeactivated'])->middleware('auth')->name('admin.sendMessageToUserDeactivated');
// Route::get('/contact', [AdminController::class, 'AdminContactUser'])->middleware('auth')->name('admin.AdminContactUser');





//ROUTE FOR ADVERTISEMENTS
Route::post('/userPost', [AdvertisementController::class, 'store'])->middleware('auth')->name('userPost');
Route::get('/userPost', [AdvertisementController::class, 'create'])->middleware('auth')->name('user.index');
Route::get('/advertisement/{id}', [AdvertisementController::class, 'show'])->middleware('auth')->name('advertisement.show');
Route::get('/advertisementDestroy/{id}', [AdvertisementController::class, 'destroy'])->middleware('auth')->name('advertisement.destroy');
Route::delete('/advertisementDestroy/{id}', [AdvertisementController::class, 'destroy'])->middleware('auth')->name('advertisement.destroyed');
Route::get('/deactivate/{id}', [AdvertisementController::class, 'deactivate'])->middleware('auth')->name('advertisement.deactivate');
Route::put('/deactivate/{id}', [AdvertisementController::class, 'deactivate'])->middleware('auth')->name('advertisement.deactivated');
Route::get('/activate/{id}', [AdvertisementController::class, 'activate'])->middleware('auth')->name('advertisement.activate');
Route::put('/activate/{id}', [AdvertisementController::class, 'activate'])->middleware('auth')->name('advertisement.activated');

                                //ROUTE FOR MESSAGE CONTROLLER
Route::post('/sendMessage', [MessageController::class, 'store'])->middleware('auth')->name('message.store');
Route::get('/message', [MessageController::class, 'displayAllMessage'])->middleware('auth')->name('message.displayAllMessage');
Route::get('/message/{id}', [MessageController::class, 'show'])->middleware('auth')->name('message.show');
