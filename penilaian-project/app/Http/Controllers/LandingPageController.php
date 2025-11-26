<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        $projects = Project::with('user')->latest()->take(6)->get();
        return view('landing-page.landing-page', compact('projects'));
    }

}
