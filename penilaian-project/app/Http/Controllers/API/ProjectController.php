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

    public function search(Request $request)
{
    $keyword = $request->keyword;

    if (!$keyword) {
        $projects = Project::with('user')->latest()->get();
        return new ProjectResource(true, 'List Search Project Success', $projects);
    }

    $projects = Project::with('user')
    ->where(function ($query) use ($keyword) {
        $keywordLower = strtolower($keyword);

        $query->whereRaw('LOWER(nama_project) LIKE ?', ["%{$keywordLower}%"])
        ->orWhereHas('user', function($q) use ($keywordLower) {
                  $q->whereRaw('LOWER(nama) LIKE ?', ["%{$keywordLower}%"]);
              });
    })
        ->latest()
        ->get();

    return new ProjectResource(true, 'Search Project Success', $projects);
}


}
