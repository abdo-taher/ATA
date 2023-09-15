<?php

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




    Route::group(['namespace'=>'App\Http\Controllers\Auth','middleware'=>'guest:web'],function (){
        Route::get('/login','LoginController@loginForm')->name('login');
        Route::post('/AdminChek','LoginController@checkup')->name('AdminCheck');
        });
    Route::get('/logout','App\Http\Controllers\Auth\loginController@logout')->name('exit');
    Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware'=>'auth:web'],function (){
        Route::get('/','IndexController@index')->name('index');
        Route::get('/view/oth/{page}','IndexController@showw')->name('ss');


        Route::group(['prefix'=>'Sections'],function (){
            Route::get('/','sectionController@index')->name('sectionIndex');
            Route::post('/Store','sectionController@store')->name('sectionStore');
            Route::post('/Update{id?}','sectionController@update')->name('sectionUpdate');
            Route::get('/Active/{id}','sectionController@active')->name('sectionActive');
            Route::get  ('/Delete/{id}','sectionController@destroy')->name('sectionDelete');
            Route::post('/AjaxData','sectionController@ajaxFunction')->name('sectionAjax');
        });
        Route::group(['prefix'=>'Products'],function (){
            Route::get('/','productController@index')->name('productIndex');
            Route::post('/Store','productController@store')->name('productStore');
            Route::post('/Update/{id}','productController@update')->name('productUpdate');
            Route::get('/Active/{id}','productController@active')->name('productActive');
            Route::get('/Delete/{id}','productController@destroy')->name('productDelete');
            Route::post('/AjaxData','productController@ajaxFunction')->name('productAjax');

        });
        Route::group(['prefix'=>'Bills'],function (){
            Route::get('/','billController@index')->name('billIndex');
            Route::get('/View/{id}','billController@view')->name('billView');
            Route::get('/Paid/{type}','billController@paidType')->name('billPaid');
            Route::get('/Archive','billController@archive')->name('billArchive');
            Route::get('/Create','billController@create')->name('billCreate');
            Route::post('/Store','billController@store')->name('billStore');
            Route::post('/storeAttachment','billController@storeBillAttachment')->name('storeBillAttachment');
            Route::get('/Edit/{bill_code}','billController@edit')->name('billEdit');
            Route::post('/Update/{id}','billController@update')->name('billUpdate');
            Route::post('/PaymentUpdate/{id}','billController@paymentUpdate')->name('paymentUpdate');
            Route::get('/Print-Bill/{bill_code}','billController@print')->name('billPrint');
            Route::get('/toArchive/{id?}','billController@toArchive')->name('billToArchive');
            Route::get('/Restore/{id}','billController@billRestore')->name('billRestore');
            Route::get('/DeleteAttachment/{id?}','billController@deleteAttachment')->name('deleteAttachment');
            Route::get('/Delete/{id?}','billController@forceDelete')->name('forceDelete');
            Route::get('/ExcelExport','billController@export')->name('exportExcel');
            Route::post('/AjaxData','billController@ajaxFunction')->name('billAjax');
            Route::post('/deleteAttachment','billController@deleteBillAttachment')->name('deleteBillAttachment');
        });
        Route::group(['prefix'=>'Reports'],function (){
            Route::get('/Bills','ReportsController@bills')->name('billReports');
            Route::post('/Ajax','ReportsController@reportsAjax')->name('reportsAjax');
            Route::get('/Customer','ReportsController@customer')->name('customerReports');
        });
    });


Route::group(['middleware' => ['auth']], function() {

    Route::resource('Roles','App\Http\Controllers\RoleController');
    Route::get('Roles/Active/{id?}','App\Http\Controllers\RoleController@active')->name('Roles.active');
    Route::get('Roles/delete/{id?}','App\Http\Controllers\RoleController@destroy')->name('Roles.delete');

    Route::resource('Users','App\Http\Controllers\UserController');
    Route::get('Users/Active/{id?}','App\Http\Controllers\UserController@active')->name('Users.active');
    Route::get('Users/delete/{id?}','App\Http\Controllers\UserController@destroy')->name('Users.delete');
});

