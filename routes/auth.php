<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::post("/auth/register", [RegisteredUserController::class, "store"])
  ->middleware("guest")
  ->name("register");

Route::post("/auth/login", [AuthenticatedSessionController::class, "store"])
  ->middleware("guest")
  ->name("login");

Route::post("/auth/logout", [AuthenticatedSessionController::class, "destroy"])
  ->middleware("auth")
  ->name("logout");
