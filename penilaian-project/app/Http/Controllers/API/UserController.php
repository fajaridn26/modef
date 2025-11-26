<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return new UserResource(true, 'List Data Users', $users);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nama' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()){
            return response()->json($validator->erros(), 422);
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return new UserResource(true, 'User berhasil ditambahkan!', $user);
    }
}
