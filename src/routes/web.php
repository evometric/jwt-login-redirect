<?php

use Evometric\JwtLoginRedirect\Controllers\JwtLoginRedirectController;
use Illuminate\Support\Facades\Route;

Route::get('jwt-login-redirect/{to}', [JwtLoginRedirectController::class, 'get'])->where('to', '.*'); 
Route::get('jwt-login-redirect-test/{to}', [JwtLoginRedirectController::class, 'get_test'])->where('to', '.*'); 