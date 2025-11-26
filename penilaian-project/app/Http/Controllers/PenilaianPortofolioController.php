<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenilaianPortofolioController extends Controller
{
    public function index(){

        $users = User::all();
        return view('penilaian-portofolio', compact('users'));
    }
}
