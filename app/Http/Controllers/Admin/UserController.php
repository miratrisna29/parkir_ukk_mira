<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class UserController extends Controller {
 public function index(){ $users=User::latest()->paginate(10); return view('admin.user.index',compact('users')); }
 public function create(){ return view('admin.user.create'); }
 public function store(Request $r){ $d=$r->validate(['nama_lengkap'=>'required|string|max:100','username'=>'required|string|max:50|unique:tb_user,username','password'=>'required|string|min:6','role'=>'required|in:admin,petugas,owner']); User::create(['nama_lengkap'=>$d['nama_lengkap'],'username'=>$d['username'],'password'=>Hash::make($d['password']),'role'=>$d['role'],'status_aktif'=>1]); return redirect()->route('admin.user.index')->with('success','User berhasil ditambahkan.'); }
 public function edit(User $user){ return view('admin.user.edit',compact('user')); }
 public function update(Request $r,User $user){ $d=$r->validate(['nama_lengkap'=>'required|string|max:100','username'=>['required','string','max:50',Rule::unique('tb_user','username')->ignore($user->id_user,'id_user')],'password'=>'nullable|string|min:6','role'=>'required|in:admin,petugas,owner','status_aktif'=>'required|boolean']); unset($d['password']); if($r->filled('password')) $d['password']=Hash::make($r->password); $user->update($d); return redirect()->route('admin.user.index')->with('success','User berhasil diperbarui.'); }
 public function destroy(User $user){ if($user->id_user===auth()->id()) return back()->with('error','Akun yang sedang digunakan tidak dapat dihapus.'); if($user->kendaraan()->exists()||$user->transaksi()->exists()||$user->logAktivitas()->exists()) return back()->with('error','User memiliki data terkait sehingga tidak dapat dihapus.'); $user->delete(); return back()->with('success','User berhasil dihapus.'); }
}
