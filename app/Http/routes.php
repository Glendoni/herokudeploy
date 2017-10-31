<?php

Route::get('/', function () {
    return view("bootstrap");
});

Route::group(['middleware' => 'cors'], function () {
    Route::post("/angular2login", 'UserController@login');
     Route::post('/create','UserController@create');
    Route::post('/talksendtest/{id}','UserController@talksendtest');
   // Route::post('auth/register', 'Auth\AuthController@create');
 
});
 Route::get("/yes", 'TestController@yes');

Route::group(['middleware' => ['cors']], function () {
  Route::auth();
    
    Route::get("/home", 'TestController@test');
     Route::get("/home/{id}", 'TestController@testuser');
    Route::get("/pages", 'TestController@pages');
    Route::get("/company", 'CompanyController@index');
    Route::get("/yes", 'TestController@yes');
    
    Route::get("/talk", 'TalkController@index');
    Route::get("/talk/{id}", 'TalkController@show');
    Route::post("/talkcreate", 'TalkController@store');
    Route::get("/talkedit/{id}", 'TalkController@edit');
    Route::post("/talkupdate/{id}", 'TalkController@update');

   // Route::get('/home', function () { return App\User::find(1); }); 
});

Route::get('/token', array('middleware' => ['cors', 'jwt.auth'], function() {
   $user = \JWTAuth::parseToken()->authenticate() ;
    
    if (!$user) {
        return response()->json(['User Not Found'], 404);
    }else{

   // $user = \JWTAuth::parseToken()->authenticate();
    return response()->json(['email' => $user->email], 200);
    }
}));


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    

});



 
