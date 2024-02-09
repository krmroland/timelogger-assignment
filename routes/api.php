<?php

use App\Http\Controllers\UserTimeEntriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth"])->apiResource(
    "users.time-entries",
    UserTimeEntriesController::class
);
