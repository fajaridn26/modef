<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with('user')->latest()->get();

        return new ProjectResource(true, 'List Project Success', $projects);
    }

    public function show($slug){
        $projects = Project::with('user')->where('slug', $slug)->get();
        
        return new ProjectResource(true, 'Project Detail Success', $projects);
    }
}
