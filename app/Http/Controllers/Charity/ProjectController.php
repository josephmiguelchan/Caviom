<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function ViewAllProjects()
    {
        $projects = Project::where('charitable_organization_id', Auth::user()->charitable_organization_id)->latest()->get();
        return view('charity.main.projects.all', compact('projects'));
    }
}
