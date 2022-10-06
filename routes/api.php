<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@store');
Route::post('/send-token','Auth\ForgotPasswordController@sendToken');
Route::post('/validate-token','Auth\ForgotPasswordController@validateToken');
Route::post('/reset-password','Auth\ForgotPasswordController@resetPassword');
Route::post('/delete-token','Auth\ForgotPasswordController@destroy');
Route::get('/completedDataRegistration/{activation_code}','Auth\RegisterControllers@completedData');
Route::group(['middleware' => 'auth:api'], function () {
    //data
    Route::resource('/', 'HomeController')->except(['create', 'show', 'update']);
    Route::resource('/registration-users', 'API\UserController')->except(['create', 'show', 'update']);
    Route::post('/registration-users/{id}', 'API\UserController@update')->name('registrasi-user.update');
    Route::post('/registration-users/{id}/delete', 'API\UserController@destroy')->name('registrasi-user.safe_delete');
    Route::resource('/school', 'API\SchoolController')->except(['create', 'show', 'update']);
    Route::post('/school/{id}', 'API\SchoolController@update')->name('school.update');
    Route::post('/school/{id}/delete', 'API\SchoolController@destroy')->name('school.safe_delete');
    Route::resource('/userVerified', 'API\UserVerifiedController')->except(['create','show','update']);
    Route::post('/userVerified/{id}', 'API\UserVerifiedController@update')->name('userVerified.update');
    Route::post('/userVerified/{id}/delete', 'API\UserVerifiedController@destroy')->name('userVerified.safe_delete');
    Route::resource('/data-student', 'API\StudentController')->except(['create', 'show', 'update']);;
    //authenticated
    Route::get('user-authenticated', 'API\UserController@getUserLogin')->name('user.authenticated');
    Route::get('user-lists', 'API\UserController@userLists')->name('user.index');
    //settings role
    Route::get('roles', 'API\RolePermissionController@getAllRole')->name('roles');
    Route::get('permissions', 'API\RolePermissionController@getAllPermission')->name('permission');
    Route::post('role-permission', 'API\RolePermissionController@getRolePermission')->name('role_permission');
    Route::post('set-role-permission', 'API\RolePermissionController@setRolePermission')->name('set_role_permission');
    Route::post('set-role-user', 'API\RolePermissionController@setRoleUser')->name('user.set_role');
});


