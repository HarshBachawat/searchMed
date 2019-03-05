<?php
    Route::view('/', 'welcome');
    Auth::routes(['verify' => true]);
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
    Route::get('/login/medshop', 'Auth\LoginController@showMedShopLoginForm');
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
    Route::get('/register/medshop', 'Auth\RegisterController@showMedShopRegisterForm');

    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
    Route::post('/login/medshop', 'Auth\LoginController@medshopLogin');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
    Route::post('/register/medshop', 'Auth\RegisterController@createMedShop');

    
   // Route::view('/home', 'home')->middleware('auth');
    Route::view('/admin', 'admin')->middleware('auth:admin');
    Route::view('/medshop', 'medshop')->middleware(['auth:medshop','medshop.verified']);

    Route::get('medshop/email/resend', [
        'uses' => 'MedShopVerificationController@resend',
        'as' => 'medshop.verification.resend'
    ]);

    Route::get('medshop/email/verify', [
        'uses' => 'MedShopVerificationController@show',
        'as' => 'medshop.verification.notice'
    ]);

    Route::get('medshop/email/verify/{id}', [
        'uses' => 'MedShopVerificationController@verify',
        'as' => 'medshop.verification.verify'
    ]);
