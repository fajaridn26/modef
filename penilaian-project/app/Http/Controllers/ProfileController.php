<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
      $angkatan = User::where('role', 'Siswa')->get();
        return view('profile', [
          'title' => 'Profile',
          'angkatan' => $angkatan
        ]);
    }

    public function update(Request $request, $id){
      $users = User::find($id);
      $users->update([
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'jurusan' => $request->jurusan,
        'angkatan' => $request->angkatan,
        'email' => $request->email,
        'no_whatsapp' => $request->no_whatsapp,
      ]);
      return back()->with('success', 'Profile berhasil diperbarui!');
    }

    public function pageChangePassword(){
      return view('profile-password',[
          'title' => 'Profile',
      ]);
    }


    public function changePassword(Request $request, $id){
      $request->validate([
        'passwordLama' => 'required|min:5',
        'passwordBaru' => 'required|min:5',
        'konfirmasiPasswordBaru' => 'required|same:passwordBaru|min:5',
    ]);
    
      $users = User::findOrFail($id);
      if (!Hash::check($request->passwordLama, $users->password)){
        return back()->with('passwordLamaError', 'Password lama salah!');
      } 
      
       $users->update([
        'password' => Hash::make($request->passwordBaru),
      ]);

    return back()->with('changePasswordSuccess', 'Password berhasil diperbarui!');
    }
}
