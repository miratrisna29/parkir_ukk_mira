<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User; use App\Models\Tarif;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {
 public function run(): void {
  foreach([['Administrator','admin','admin'],['Petugas Parkir','petugas','petugas'],['Pemilik','owner','owner']] as [$nama,$username,$role]) User::updateOrCreate(['username'=>$username],['nama_lengkap'=>$nama,'password'=>Hash::make('password123'),'role'=>$role,'status_aktif'=>1]);
  Tarif::updateOrCreate(['jenis_kendaraan'=>'motor'],['tarif_tetap'=>2000]);
  Tarif::updateOrCreate(['jenis_kendaraan'=>'mobil'],['tarif_tetap'=>5000]);
 }
}
