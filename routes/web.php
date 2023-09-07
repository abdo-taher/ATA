<?php
namespace App\Http\Controllers;
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



    Route::group(['namespace'=>'App\Http\Controllers\Auth','middleware'=>'guest:admin'],function (){
        Route::get('/login','loginController@login')->name('login');
        Route::post('/checkup','loginController@checkup')->name('loginCheckup');
    });


Route::group([],function (){
    Route::get('/logout','App\Http\Controllers\Auth\loginController@exit')->name('logout');
    Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware'=>'auth:admin'],function (){
        Route::get('/','AdminController@index')->name('index');
        Route::get('/view/{page}','AdminController@showw')->name('ss');


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
            Route::get('/{status?}','billController@trashed')->name('billTrashed');
            Route::get('/Create','billController@create')->name('billCreate');
            Route::post('/Store','billController@store')->name('billStore');
            Route::get('/Edit/{bill_code}','billController@edit')->name('billEdit');
            Route::post('/Update/{id}','billController@update')->name('billUpdate');
            Route::get('/Active','billController@active')->name('billActive');
            Route::get('/Delete/{id}','billController@delete')->name('billDelete');
            Route::post('/AjaxData','billController@ajaxFunction')->name('billAjax');
        });
    });
});
