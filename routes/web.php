<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});


Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/change-information', [\App\Http\Controllers\ProfileController::class, 'changeInformation'])->name('profile.change-information');
    Route::put('/profile/change-password', [\App\Http\Controllers\ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/logout-session', [\App\Http\Controllers\ProfileController::class, 'logoutSession'])->name('profile.logout-session');
    Route::delete('/profile/delete-account', [\App\Http\Controllers\ProfileController::class, 'deleteAccount'])->name('profile.delete-account');

    Route::post('/import/users', [\App\Http\Controllers\ImportController::class, 'users'])->name('import.users');

    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [\App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('/user', [\App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::put('/user/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    Route::put('/user/restore/{id}', [\App\Http\Controllers\UserController::class, 'restore'])->name('user.restore');

    Route::put('/collector/{id}', [\App\Http\Controllers\CollectorController::class, 'update'])->name('collector.update');

    Route::get('/clients', [\App\Http\Controllers\ClientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [\App\Http\Controllers\ClientController::class, 'create'])->name('client.create');
    Route::post('/client', [\App\Http\Controllers\ClientController::class, 'store'])->name('client.store');
    Route::get('/client/{id}', [\App\Http\Controllers\ClientController::class, 'show'])->name('client.show');
    Route::get('/client-logs/{id}', [\App\Http\Controllers\ClientController::class, 'show_logs'])->name('client.show.logs');
    Route::put('/client/{id}', [\App\Http\Controllers\ClientController::class, 'update'])->name('client.update');
    Route::delete('/client/{id}', [\App\Http\Controllers\ClientController::class, 'destroy'])->name('client.destroy');
    Route::put('/client/restore/{id}', [\App\Http\Controllers\ClientController::class, 'restore'])->name('client.restore');

    Route::get('/ref-offices', [\App\Http\Controllers\ReferenceController::class, 'office_index'])->name('ref-office.index');
    Route::get('/ref-office/create', [\App\Http\Controllers\ReferenceController::class, 'office_create'])->name('ref-office.create');
    Route::get('/ref-office/{id}', [\App\Http\Controllers\ReferenceController::class, 'office_show'])->name('ref-office.show');

    Route::get('/ref-accounts', [\App\Http\Controllers\ReferenceController::class, 'account_index'])->name('ref-account.index');
    Route::get('/ref-account/create', [\App\Http\Controllers\ReferenceController::class, 'account_create'])->name('ref-account.create');
    Route::get('/ref-account/{id}', [\App\Http\Controllers\ReferenceController::class, 'account_show'])->name('ref-account.show');

    Route::get('/tokens', [\App\Http\Controllers\TokenController::class, 'index'])->name('token.index');
    Route::get('/token/create', [\App\Http\Controllers\TokenController::class, 'create'])->name('token.create');
    Route::post('/token', [\App\Http\Controllers\TokenController::class, 'store'])->name('token.store');
    Route::get('/token/{id}', [\App\Http\Controllers\TokenController::class, 'show'])->name('token.show');
    Route::delete('/token/{id}', [\App\Http\Controllers\TokenController::class, 'destroy'])->name('token.destroy');
});
