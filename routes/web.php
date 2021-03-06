<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('artikel', 'ArtikelController');
    Route::resource('vitamin', 'VitaminController');
    Route::resource('kategori', 'KategoriController');
    Route::resource('rekening', 'RekeningController');
    Route::resource('kandang', 'KandangController');
    Route::delete('artikel/{artikel:slug}', 'ArtikelController@destroy')->name('artikel.destroy.admin');
    Route::get('artikel/{artikel:slug}', 'ArtikelController@edit')->name('artikel.edit.admin');
    Route::patch('artikel/{artikel:slug}', 'ArtikelController@update')->name('artikel.update.admin');
    Route::get('/dataAkunKaryawan', 'AdminController@dataAkunKaryawan')->name('admin.akun.karyawan');
    Route::get('/dataAkunDistributor', 'AdminController@dataAkunDistributor')->name('admin.akun.distributor');
    Route::post('/dataAkun', 'AdminController@storeKaryawan')->name('admin.store.karyawan');
    Route::delete('/dataAkun/{users}', 'AdminController@destroy')->name('karyawan.destroy');
    Route::get('/produk', 'ProdukController@index')->name('produk.index.admin');
    Route::post('/produk', 'ProdukController@store')->name('produk.store');
    Route::get('/produk/{produk}', 'ProdukController@edit')->name('produk.edit');
    Route::post('/produk/{produk}', 'ProdukController@update')->name('produk.update');
    Route::delete('/produk/{produk}', 'ProdukController@destroy')->name('produk.destroy');
    Route::get('/rekapPemesanan', 'ProdukController@historyAdmin')->name('produk.history.admin');
    Route::get('rekapPemesanan/{order}', 'ProdukController@historyAdminDetail')->name('produk.historyDetail.admin');
    Route::patch('rekapPemesanan/{order}/t', 'ProdukController@verifikasiBerhasil')->name('verifikasi.berhasil');
    Route::patch('rekapPemesanan/{order}/f', 'ProdukController@verifikasiGagal')->name('verifikasi.gagal');
    Route::get('/progress', 'AdminController@indexProgress')->name('progress.index.admin');
    Route::get('progress-detail/{progress}', 'AdminController@progressDetail')->name('progress-detail.index.admin');
    Route::resource('pembukuan', 'PembukuanController');
});

Route::prefix('karyawan')->middleware('auth')->group(function () {
    Route::get('/', 'KaryawanController@index')->name('karyawan.index');
    Route::resource('progress', 'ProgressController');
    Route::get('progress-detail/{progress}', 'ProgressDetailController@index')->name('progress-detail.index');
    Route::post('progress-detail', 'ProgressDetailController@store')->name('progress-detail.store');
    Route::get('/myProfile', 'UserController@myProfile')->name('profile.karyawan');
    Route::get('/editProfile', 'UserController@editProfile')->name('edit.profile.karyawan');
    Route::patch('/editProfile', 'UserController@updateProfile')->name('edit.profile.karyawan');
    Route::get('/editPassword', 'UserController@editPassword')->name('edit.password.karyawan');
    Route::patch('/editPassword', 'UserController@updatePassword')->name('edit.password.karyawan');
});

Route::prefix('distributor')->middleware('auth')->group(function () {
    Route::get('/', 'DistributorController@index')->name('distributor.index');
    Route::get('artikel', 'ArtikelController@index')->name('artikel.index.distributor');
    Route::get('artikel/{artikel:slug}', 'ArtikelController@show')->name('artikel.show.distributor');
    Route::get('produk', 'ProdukController@indexDistributor')->name('produk.index.distributor');
    Route::get('produk/{produk}', 'ProdukController@show')->name('produk.show.distributor');
    Route::get('produk/{produk}/sale', 'ProdukController@sale')->name('produk.sale.distributor');
    Route::post('produk/{produk}/sale', 'ProdukController@purchase')->name('produk.purchase.distributor');
    Route::delete('produk/{produk}', 'ProdukController@destroyPesanan')->name('pesanan.destroy.distributor');
    Route::get('rekapPemesanan', 'ProdukController@historyDistributor')->name('produk.history.distributor');
    Route::get('rekapPemesanan/{order}', 'ProdukController@historyDistributorDetail')->name('produk.historyDetail.distributor');
    Route::get('rekapPemesanan/{order}/pembayaran', 'ProdukController@pembayaran')->name('produk.pembayaran.distributor');
    Route::patch('rekapPemesanan/{order}/pembayaran', 'ProdukController@storePembayaran')->name('produk.pembayaran.distributor');
    Route::get('/myProfile', 'UserController@myProfile')->name('profile.Distributor');
    Route::get('/editProfile', 'UserController@editProfile')->name('edit.profile.Distributor');
    Route::patch('/editProfile', 'UserController@updateProfile')->name('edit.profile.Distributor');
    Route::get('/editPassword', 'UserController@editPassword')->name('edit.password.Distributor');
    Route::patch('/editPassword', 'UserController@updatePassword')->name('edit.password.Distributor');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/', 'HomeController@index')->name('home');
