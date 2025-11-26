<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioDetailController extends Controller
{
    public function index($id){
        $projects = Project::with('user')->where('id', $id)->get();
        return view('landing-page.detail-portfolio', compact('projects'));
    }
}
