<?php
namespace App\Http\Controllers;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
 public function showLogin() { return view('auth.login'); }
 public function login(Request $request) {
  $data=$request->validate(['username'=>'required|string','password'=>'required|string']);
  if (!Auth::attempt($data)) return back()->withInput($request->only('username'))->with('error','Username atau password salah.');
  $request->session()->regenerate();
  $user=Auth::user();
  if (!$user->status_aktif) { Auth::logout(); return back()->with('error','Akun tidak aktif. Hubungi admin.'); }
  LogAktivitas::create(['id_user'=>$user->id_user,'aktivitas'=>'Login ke sistem','waktu_aktivitas'=>now()]);
  return match($user->role) {
   'admin'=>redirect()->route('admin.dashboard'),
   'petugas'=>redirect()->route('petugas.dashboard'),
   'owner'=>redirect()->route('owner.rekap.index'),
   default=>redirect()->route('login')
  };
 }
 public function logout(Request $request) {
  if (Auth::check()) LogAktivitas::create(['id_user'=>Auth::id(),'aktivitas'=>'Logout dari sistem','waktu_aktivitas'=>now()]);
  Auth::logout(); $request->session()->invalidate(); $request->session()->regenerateToken();
  return redirect()->route('login');
 }
}
