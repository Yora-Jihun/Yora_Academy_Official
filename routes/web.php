<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\RegisterVerify;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Docs\ExploreDocs;
use App\Livewire\Docs\ManageDocs;
use App\Livewire\Docs\ViewPublic;
use App\Livewire\Settings\ProfileSettings;
use App\Livewire\Settings\SecuritySettings;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');

    Route::get('/register/verify', RegisterVerify::class)
        ->name('register.verify')
        ->middleware('registration.session');

    Route::get('/forgot-password', ForgotPassword::class)->name('forgot.password');

    Route::get('/reset-password', ResetPassword::class)
        ->name('password.reset')
        ->middleware('password.reset.session');
});

// Public documentation routes (no auth required)
Route::get('/docs/{slug}', ViewPublic::class)->name('public.docs.show');
Route::get('/explore', ExploreDocs::class)->name('docs.explore');

Route::middleware('auth')->group(function () {
    Route::get('/docs', ManageDocs::class)->name('docs');

    Route::get('/profile-settings', ProfileSettings::class)->name('profile-settings');

    Route::get('/security-settings', SecuritySettings::class)->name('security-settings');

    Route::post('/logout', function () {
        auth()->logout();

        return redirect()->route('welcome');
    })->name('logout');
});
