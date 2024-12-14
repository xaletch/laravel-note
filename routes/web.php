<?php

use App\Http\Controllers\Api\V1\CompleteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Api\V1\NoteController;

Route::prefix('v1')->group(function() {
    Route::apiResource('/notes', NoteController::class)->middleware('api');
    Route::patch('/notes/${note}/complete', CompleteController::class);
});