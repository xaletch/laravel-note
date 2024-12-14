<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\NoteController;
use App\Http\Controllers\Api\V1\CompleteController;

Route::prefix('v1')->group(function() {
    Route::apiResource('/notes', NoteController::class);
    Route::patch('/notes/${note}/complete', CompleteController::class);
});