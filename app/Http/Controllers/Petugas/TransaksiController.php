<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use App\Models\{Transaksi,Kendaraan,Tarif,AreaParkir,LogAktivitas};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TransaksiController extends Controller {
 public function index(){ $transaksiAktif=Transaksi::with(['kendaraan','area','tarif'])->where('status','masuk')->latest()->get(); return view('petugas.transaksi.index',compact('transaksiAktif')); }
 public function formMasuk(){ $kendaraans=Kendaraan::orderBy('plat_nomor')->get(); $tarifs=Tarif::orderBy('jenis_kendaraan')->get(); $areas=AreaParkir::whereColumn('terisi','<','kapasitas')->get(); return view('petugas.transaksi.formmasuk',compact('kendaraans','tarifs','areas')); }
 public function prosesMasuk(Request $r){
  $d=$r->validate(['id_kendaraan'=>'required|exists:tb_kendaraan,id_kendaraan','id_tarif'=>'required|exists:tb_tarif,id_tarif','id_area'=>'required|exists:tb_area_parkir,id_area']);
  $kendaraan=Kendaraan::findOrFail($d['id_kendaraan']); $tarif=Tarif::findOrFail($d['id_tarif']);
  if($kendaraan->jenis_kendaraan!==$tarif->jenis_kendaraan) return back()->withInput()->with('error','Jenis tarif tidak sesuai dengan kendaraan.');
  if(Transaksi::where('id_kendaraan',$kendaraan->id_kendaraan)->where('status','masuk')->exists()) return back()->withInput()->with('error','Kendaraan ini masih tercatat sedang parkir.');
  DB::transaction(function() use($d){ $area=AreaParkir::whereKey($d['id_area'])->lockForUpdate()->firstOrFail(); if($area->terisi >= $area->kapasitas) throw new \RuntimeException('Area parkir sudah penuh.'); Transaksi::create(['id_kendaraan'=>$d['id_kendaraan'],'waktu_masuk'=>now(),'id_tarif'=>$d['id_tarif'],'status'=>'masuk','id_user'=>auth()->id(),'id_area'=>$d['id_area']]); $area->increment('terisi'); LogAktivitas::create(['id_user'=>auth()->id(),'aktivitas'=>'Mencatat kendaraan masuk','waktu_aktivitas'=>now()]); });
  return redirect()->route('petugas.transaksi.index')->with('success','Kendaraan berhasil dicatat masuk.');
 }
 public function formKeluar($id){ $transaksi=Transaksi::with(['kendaraan','tarif','area'])->findOrFail($id); abort_if($transaksi->status!=='masuk',404); $biaya=(int)$transaksi->tarif->tarif_tetap; return view('petugas.transaksi.formkeluar',compact('transaksi','biaya')); }
 public function prosesKeluar(Request $r,$id){ $transaksi=Transaksi::with(['tarif','area'])->findOrFail($id); if($transaksi->status!=='masuk') return redirect()->route('petugas.transaksi.index')->with('error','Transaksi sudah selesai.'); DB::transaction(function() use($transaksi){ $transaksi->update(['waktu_keluar'=>now(),'durasi_jam'=>null,'biaya_total'=>$transaksi->tarif->tarif_tetap,'status'=>'keluar']); $transaksi->area()->lockForUpdate()->first()->decrement('terisi'); LogAktivitas::create(['id_user'=>auth()->id(),'aktivitas'=>'Mencatat kendaraan keluar','waktu_aktivitas'=>now()]); }); return redirect()->route('petugas.transaksi.struk',$transaksi->id_parkir); }
 public function cetakStruk($id){ $transaksi=Transaksi::with(['kendaraan','tarif','area','petugas'])->findOrFail($id); return view('petugas.transaksi.struk',compact('transaksi')); }
}
