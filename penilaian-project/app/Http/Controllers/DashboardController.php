<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalSiswa = User::where('role', 'Siswa')->count();
        $totalProject = Project::all()->count();
        $belumDinilai = Project::where('nilai', '0')->count();
        $sudahDinilai = Project::where('nilai', '>', '0')->count();
        $listProject = Project::with('user')->where('nilai', 0)->get();
        
        return view('dashboard', [
            'title' => 'Dashboard',
            'totalProject' => $totalProject,
            'totalSiswa' => $totalSiswa,
            'belumDinilai' => $belumDinilai,
            'sudahDinilai' => $sudahDinilai,
            'listProject' => $listProject,
        ]);
    }
}
