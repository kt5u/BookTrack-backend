<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to BookTrack API',
        'status' => 'online',
        'version' => '1.0.0',
    ]);
});
