<?php
use Illuminate\Support\Facades\Route;
use App\Models\{User,Tarif,AreaParkir,Kendaraan,Transaksi};
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\{UserController,TarifController,AreaParkirController,KendaraanController,LogAktivitasController};
use App\Http\Controllers\Petugas\TransaksiController;
use App\Http\Controllers\Owner\RekapController;
Route::get('/',fn()=>redirect()->route('login'));
Route::middleware('guest')->group(function(){ Route::get('/login',[AuthController::class,'showLogin'])->name('login'); Route::post('/login',[AuthController::class,'login'])->name('login.post'); });
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth')->name('logout');
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function(){
 Route::get('/dashboard',fn()=>view('admin.dashboard',['jumlahUser'=>User::count(),'jumlahTarif'=>Tarif::count(),'jumlahArea'=>AreaParkir::count(),'jumlahKendaraan'=>Kendaraan::count()]))->name('dashboard');
 Route::resource('user',UserController::class)->except(['show']); Route::resource('tarif',TarifController::class)->except(['show']); Route::resource('area',AreaParkirController::class)->except(['show']); Route::resource('kendaraan',KendaraanController::class)->except(['show']);
 Route::get('/log-aktivitas',[LogAktivitasController::class,'index'])->name('log.index');
});
Route::middleware(['auth','role:petugas'])->prefix('petugas')->name('petugas.')->group(function(){
 Route::get('/dashboard',fn()=>view('petugas.dashboard',['jumlahAktif'=>Transaksi::where('status','masuk')->count()]))->name('dashboard');
 Route::get('/transaksi',[TransaksiController::class,'index'])->name('transaksi.index');
 Route::get('/transaksi/masuk',[TransaksiController::class,'formMasuk'])->name('transaksi.formMasuk');
 Route::post('/transaksi/masuk',[TransaksiController::class,'prosesMasuk'])->name('transaksi.prosesMasuk');
 Route::get('/transaksi/keluar/{id}',[TransaksiController::class,'formKeluar'])->name('transaksi.formKeluar');
 Route::post('/transaksi/keluar/{id}',[TransaksiController::class,'prosesKeluar'])->name('transaksi.prosesKeluar');
 Route::get('/struk/{id}',[TransaksiController::class,'cetakStruk'])->name('transaksi.struk');
});
Route::middleware(['auth','role:owner'])->prefix('owner')->name('owner.')->group(function(){
 Route::get('/dashboard',fn()=>redirect()->route('owner.rekap.index'))->name('dashboard');
 Route::get('/rekap',[RekapController::class,'index'])->name('rekap.index');
});
