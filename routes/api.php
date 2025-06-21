<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Keep this file clean - we moved the active users routes to web.php
// Add any other API routes here if needed

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
