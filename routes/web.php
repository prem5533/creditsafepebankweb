<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect(route('login'));
});

Route::group(['namespace'=>'App\Http\Controllers\User'],function(){
	Route::post('/sendResetLinkEmail','UserController@sendResetLinkEmail')->name('password.request');
	Route::get('/login','UserController@showLoginForm')->name('login');
	Route::post('/login','UserController@login');
	Route::post('/sendSSVOTP','UserController@sendSSVOTP')->name('sendSSVOTP');
	Route::post('/verifySSVOTP','UserController@verifySSVOTP')->name('verifySSVOTP');
	Route::group(['middleware'=>'checkAuth'],function(){
		Route::post('/cashfreeOrderToken','UserController@cashfreeOrderToken')->name('cashfreeOrderToken');

		// Logout
		Route::get('/logoutAlldevices','UserController@logoutAlldevices')->name('logoutAlldevices');
		Route::get('/logout','UserController@logout')->name('logout');

		// User Dasgboard and Profile
		Route::get('/dashboard','UserController@dashboard')->name('dashboard');
		Route::get('/ssvProfile','UserController@ssvProfile')->name('ssvProfile');

		// New Member Details
		Route::post('/register','UserController@register')->name('register');
		Route::get('/ssvNewMember','UserController@ssvNewMember');
		Route::get('/ssvMemberJoinReport','UserController@ssvMemberJoinReport')->name('ssvMemberJoinReport');
		Route::post('/joinMemberReport','UserController@joinMemberReport')->name('joinMemberReport');

		// Collection Details 
		Route::get('/ssvSelfCollection','UserController@ssvSelfCollection')->name('ssvSelfCollection');
		Route::get('/ssvSelfCollectionReport','UserController@ssvSelfCollectionReport')->name('ssvSelfCollectionReport');
		Route::post('/selfCollectionDetails','UserController@selfCollectionDetails')->name('selfCollectionDetails');
		Route::post('/selfCollectionReport','UserController@selfCollectionReport')->name('selfCollectionReport');
		Route::get('/ssvTeamCollection','UserController@ssvTeamCollection')->name('ssvTeamCollection');
		Route::post('/teamCollectionReport','UserController@teamCollectionReport')->name('teamCollectionReport');
		Route::get('/ssvTeamCollectionSummary','UserController@ssvTeamCollection')->name('ssvTeamCollectionSummary');

		// KYC 
		Route::get('/ssvKyc','UserController@ssvKyc')->name('ssvKyc');
		Route::post('/registerSSVKyc','UserController@registerSSVKyc')->name('registerSSVKyc');

		// Policy Calculator
		Route::post('/ssvSchemePlan','PolicyController@ssvSchemePlan')->name('ssvSchemePlan');
		Route::get('/ssvCalculator','PolicyController@ssvCalculator')->name('ssvCalculator');
		Route::post('/calculateMaturity','PolicyController@calculateMaturity')->name('calculateMaturity');

		// Policy
		Route::get('/ssvOwnPolicy','PolicyController@ssvOwnPolicy')->name('ssvOwnPolicy');
		Route::get('/ssvNewApplication','PolicyController@ssvNewApplication')->name('ssvNewApplication');
		Route::get('/ssviewPolicy','PolicyController@ssviewPolicy')->name('ssviewPolicy');
		Route::post('/searchSSVPolicy','PolicyController@searchSSVPolicy')->name('searchSSVPolicy');

		// Wallet
		Route::get('/ssvMyWallet','PolicyController@ssvMyWallet')->name('ssvMyWallet');


	});
});
