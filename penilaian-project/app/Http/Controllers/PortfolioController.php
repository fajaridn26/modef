<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(){
        $totalPortfolio = Project::all()->count();
        $projects = Project::with('user')->latest()->get();
        return view('landing-page.portfolio', compact('projects', 'totalPortfolio'));
    }

    public function detailPortfolio(){

    }
}
