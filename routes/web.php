<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
    Route::get('/akun/create', [AkunController::class, 'create'])->name('akun.create');
    Route::post('/akun/store', [AkunController::class, 'store'])->name('akun.store');
    Route::get('/akun/edit/{id}', [AkunController::class, 'edit'])->name('akun.edit');
    Route::patch('/akun/update/{id}', [AkunController::class, 'update'])->name('akun.update');
    Route::delete('/akun/delete/{id}', [AkunController::class, 'destroy'])->name('akun.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
    Route::post('/member/store', [MemberController::class, 'store'])->name('member.store');
    Route::get('/member/edit/{id}', [MemberController::class, 'edit'])->name('member.edit');
    Route::patch('/member/update/{id}', [MemberController::class, 'update'])->name('member.update');
    Route::delete('/member/delete/{id}', [MemberController::class, 'destroy'])->name('member.destroy');
});

require __DIR__.'/auth.php';
