<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){
        $project = Project::with('type', 'technologies')->paginate(6);

        return response()->json([
            'success' => true,
            'results' => $project
        ]);
    }
    
    public function show($titolo){
        $post = Project::with('type', 'technologies')->where('titolo', $titolo)->first();

        return response()->json([
            'success' => true,
            'results' => $post
        ]);
    }
}
