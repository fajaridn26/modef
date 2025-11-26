<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
            $validatedData = $request->validate([
                'nama' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:5',
            ]);
    
            $validatedData['password'] = Hash::make($validatedData['password']);
    
            User::create($validatedData);
    
            return redirect('login')->with('registerSuccess', 'Registrasi berhasil! Silakan login.');
        } 
}
