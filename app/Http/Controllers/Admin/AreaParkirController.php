<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\AreaParkir; use Illuminate\Http\Request;
class AreaParkirController extends Controller {
 public function index(){ $areas=AreaParkir::latest()->paginate(10); return view('admin.area.index',compact('areas')); }
 public function create(){ return view('admin.area.create'); }
 public function store(Request $r){ $d=$r->validate(['nama_area'=>'required|string|max:50',
 'kapasitas'=>'required|integer|min:1']); AreaParkir::create($d+['terisi'=>0]);
  return redirect()->route('admin.area.index')->with('success','Area berhasil ditambahkan.'); }
 public function edit(AreaParkir $area){ return view('admin.area.edit',compact('area')); }
 public function update(Request $r,AreaParkir $area){ $d=$r->validate
 (['nama_area'=>'required|string|max:50','kapasitas'=>'required|integer|min:1']); 
 if($d['kapasitas']<$area->terisi) return back()->withErrors(['kapasitas'=>'Kapasitas tidak boleh kurang dari jumlah kendaraan yang sedang parkir.'])->withInput(); $area->update($d); return redirect()->route('admin.area.index')->with('success','Area diperbarui.'); }
 public function destroy(AreaParkir $area){ if($area->transaksi()->exists()) return back()->with('error','Area sudah memiliki riwayat transaksi dan tidak dapat dihapus.'); $area->delete(); return back()->with('success','Area dihapus.'); }
}
