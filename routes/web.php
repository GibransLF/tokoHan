<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManageProdukController;
use App\Http\Controllers\StokController;
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

Route::middleware('auth')->group(function () {
    Route::get('/manageProduk', [ManageProdukController::class, 'index'])->name('manageProduk.index');
    Route::get('/manageProduk/create', [ManageProdukController::class, 'create'])->name('manageProduk.create');
    Route::post('/manageProduk/store', [ManageProdukController::class, 'store'])->name('manageProduk.store');
    Route::get('/manageProduk/edit/{id}', [ManageProdukController::class, 'edit'])->name('manageProduk.edit');
    Route::patch('/manageProduk/update/{id}', [ManageProdukController::class, 'update'])->name('manageProduk.update');
    Route::delete('/manageProduk/delete/{id}', [ManageProdukController::class, 'destroy'])->name('manageProduk.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/{namaProduk}/stok', [StokController::class, 'show'])->name('stok.show');
    Route::get('/{namaProduk}/stok/create', [StokController::class, 'create'])->name('stok.create');
    Route::post('/stok/store', [StokController::class, 'store'])->name('stok.store');
    Route::get('/stok/edit/{id}', [StokController::class, 'edit'])->name('stok.edit');
    Route::patch('/stok/update/{id}', [StokController::class, 'update'])->name('stok.update');
    Route::delete('/{namaProduk}/stok/delete/{id}', [StokController::class, 'destroy'])->name('stok.destroy');
});

require __DIR__.'/auth.php';
