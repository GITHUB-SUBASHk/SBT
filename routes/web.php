<?php
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Livewire\Profiles;

Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/verify/{token}', [VerifyController::class, 'showForm']);
Route::post('/set-password', [VerifyController::class, 'savePassword']);


Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequestForm']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp']);

Route::get('/verify-otp', [ForgotPasswordController::class, 'showVerifyOtpForm']);
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp']);


Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', Profiles::class)->name('dashboard');
});
?>