<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReminderController;

Route::apiResource('reminders', ReminderController::class);
