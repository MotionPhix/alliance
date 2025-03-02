<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
  public function index(Request $request)
  {
    $projects = Project::orderBy('order')
      ->get()
      ->map(function ($project) {
        return [
          'name' => $project->name,
          'description' => $project->description,
          'funded_by' => $project->funded_by,
          'duration' => $project->duration,
          'image' => $project->image ? Storage::url($project->image) : null,
          'key_achievements' => $project->key_achievements ?? [],
        ];
      });

    $featuredProjects = Project::featured()
      ->orderBy('order')
      ->take(3)
      ->get();

    $impactStats = Project::pluck('impact_stats')
      ->flatten(1)
      ->filter()
      ->values();

    return view('pages.project', compact('projects', 'featuredProjects', 'impactStats'));
  }
}
