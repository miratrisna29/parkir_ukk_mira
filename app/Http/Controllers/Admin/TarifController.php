<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class TarifController extends Controller {
 public function index(){ $tarifs=Tarif::orderBy('jenis_kendaraan')->paginate(10); return view('admin.tarif.index',compact('tarifs')); }
 public function create(){ return view('admin.tarif.create'); }
 public function store(Request $r){ $d=$r->validate(['jenis_kendaraan'=>'required|in:motor,mobil|unique:tb_tarif,jenis_kendaraan','tarif_tetap'=>'required|integer|min:0']); Tarif::create($d); return redirect()->route('admin.tarif.index')->with('success','Tarif berhasil ditambahkan.'); }
 public function edit(Tarif $tarif){ return view('admin.tarif.edit',compact('tarif')); }
 public function update(Request $r,Tarif $tarif){ $d=$r->validate(['jenis_kendaraan'=>['required','in:motor,mobil',Rule::unique('tb_tarif','jenis_kendaraan')->ignore($tarif->id_tarif,'id_tarif')],'tarif_tetap'=>'required|integer|min:0']); $tarif->update($d); return redirect()->route('admin.tarif.index')->with('success','Tarif berhasil diperbarui.'); }
 public function destroy(Tarif $tarif){ if($tarif->transaksi()->exists()) return back()->with('error','Tarif sudah digunakan transaksi dan tidak dapat dihapus.'); $tarif->delete(); return back()->with('success','Tarif berhasil dihapus.'); }
}
