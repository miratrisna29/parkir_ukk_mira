<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Kendaraan; use Illuminate\Http\Request; use Illuminate\Validation\Rule;
class KendaraanController extends Controller {
 public function index(){ $kendaraans=Kendaraan::with('user')->latest()->paginate(10); return view('admin.kendaraan.index',compact('kendaraans')); }
 public function create(){ return view('admin.kendaraan.create'); }
 public function store(Request $r){ $d=$r->validate(['plat_nomor'=>'required|string|max:15|unique:tb_kendaraan,plat_nomor','jenis_kendaraan'=>'required|in:motor,mobil','warna'=>'nullable|string|max:20','pemilik'=>'required|string|max:100']); Kendaraan::create($d+['id_user'=>auth()->id()]); return redirect()->route('admin.kendaraan.index')->with('success','Kendaraan ditambahkan.'); }
 public function edit(Kendaraan $kendaraan){ return view('admin.kendaraan.edit',compact('kendaraan')); }
 public function update(Request $r,Kendaraan $kendaraan){ $d=$r->validate(['plat_nomor'=>['required','string','max:15',Rule::unique('tb_kendaraan','plat_nomor')->ignore($kendaraan->id_kendaraan,'id_kendaraan')],'jenis_kendaraan'=>'required|in:motor,mobil','warna'=>'nullable|string|max:20','pemilik'=>'required|string|max:100']); $kendaraan->update($d); return redirect()->route('admin.kendaraan.index')->with('success','Kendaraan diperbarui.'); }
 public function destroy(Kendaraan $kendaraan){ if($kendaraan->transaksi()->exists()) return back()->with('error','Kendaraan memiliki riwayat transaksi dan tidak dapat dihapus.'); $kendaraan->delete(); return back()->with('success','Kendaraan dihapus.'); }
}
