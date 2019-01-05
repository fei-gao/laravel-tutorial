<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Services\Twitter;

class ProjectsController extends Controller
{
    //
    public function index() {
        $projects = Project::all();
        return view('projects.index', ['projects' => $projects]);
    }

    public function create(){
        return view('projects.create');
    }
    
    public function show(Project $project, Twitter $twitter){
    //   $twitter = app('twitter');
      dd($twitter);
      return view('projects.show', compact('project'));
    }

    public function store(){
        // form validation
        $attributes = request()->validate([
            'title'=>['required', 'min:3', 'max:255'],
            'description'=>['required','min:3']
        ]);

        Project::create($attributes);
        // $project = new Project();

        // $project -> title = request('title');
        // $project -> description = request('description');
         
        // $project -> save();

        return redirect('/projects');
    }

    public function edit(Project $project){
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project){
        $project->update(request(['title','description']));

        // $project->title = request('title');
        // $project->description = request('description');

        // $project->save();
       
        return redirect('/projects');
    }

    public function destroy(Project $project){
        $project->delete();
        return redirect('/projects');
    }
}
