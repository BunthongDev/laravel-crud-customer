<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('customer.index');
});


//example of a route for a login form (not a real login system)
Route::get('/login', function () {
    return view('customer.login-form');
});