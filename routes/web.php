<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\InsidenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManageProdukController;
use App\Http\Controllers\ManagePromosiController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\OrderProdukController;
use App\Http\Controllers\TransaksiController;

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
    Route::get('/managePromosi', [ManagePromosiController::class, 'index'])->name('managePromosi.index');
    Route::get('/managePromosi/create', [ManagePromosiController::class, 'create'])->name('managePromosi.create');
    Route::get('/managePromosi/getStok/{id}', [ManagePromosiController::class, 'show'])->name('managePromosi.show');
    Route::post('/managePromosi/store', [ManagePromosiController::class, 'store'])->name('managePromosi.store');
    Route::get('/managePromosi/edit/{id}', [ManagePromosiController::class, 'edit'])->name('managePromosi.edit');
    Route::patch('/managePromosi/update/{id}', [ManagePromosiController::class, 'update'])->name('managePromosi.update');
    Route::delete('/managePromosi/delete/{id}', [ManagePromosiController::class, 'destroy'])->name('managePromosi.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/{kodeProduk}/stok', [StokController::class, 'show'])->name('stok.show');
    Route::get('/{kodeProduk}/stok/create', [StokController::class, 'create'])->name('stok.create');
    Route::post('/stok/store', [StokController::class, 'store'])->name('stok.store');
    Route::get('/{kodeProduk}/stok/edit/{id}', [StokController::class, 'edit'])->name('stok.edit');
    Route::patch('/stok/update/{id}', [StokController::class, 'update'])->name('stok.update');
    Route::delete('/{kodeProduk}/stok/delete/{id}', [StokController::class, 'destroy'])->name('stok.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/orderProduk', [OrderProdukController::class, 'index'])->name('orderProduk.index');
    Route::get('/orderProduk/success', [OrderProdukController::class, 'success'])->name('orderProduk.success');
    Route::get('/orderProduk/{memberId}', [OrderProdukController::class, 'show'])->name('orderProduk.show');
    Route::post('/orderProduk/store', [OrderProdukController::class, 'store'])->name('orderProduk.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/detail/{kode_transaksi}', [TransaksiController::class, 'show'])->name('transaksi.detail');
    Route::get('/transaksi/{kode_transaksi}/insiden', [TransaksiController::class, 'insiden'])->name('transaksi.insiden');
    Route::patch('/transaksi/detail/{kode_transaksi}/storeInsiden', [TransaksiController::class, 'storeInsiden'])->name('transaksi.storeInsiden');
    Route::patch('/transaksi/detail/{kode_transaksi}/canceled', [TransaksiController::class, 'canceled'])->name('transaksi.canceled');
    Route::patch('/transaksi/detail/{kode_transaksi}/confirm', [TransaksiController::class, 'confirm'])->name('transaksi.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('/insiden', [InsidenController::class, 'index'])->name('insiden.index');
});

require __DIR__.'/auth.php';
