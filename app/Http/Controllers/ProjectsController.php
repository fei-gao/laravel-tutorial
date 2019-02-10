<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Services\Twitter;
use App\Mail\ProjectCreated;

class ProjectsController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }

    public function index() {
//        $projects = Project::where('owner_id', auth() -> id()) -> get();
        $projects = auth()->user()->projects;
        return view('projects.index', ['projects' => $projects]);
    }

    public function create(){
        return view('projects.create');
    }
    
    public function show(Project $project, Twitter $twitter){
    //   $twitter = app('twitter');
    //   dd($twitter);

        $this->authorize('update', $project);
      return view('projects.show', compact('project'));
    }

    public function store(){
        // form validation
        $attributes = this.$this->validateProject();
        $attributes['owner_id'] = auth()->id();
        $project = Project::create($attributes);
        Project::create($attributes );
        Mail::to($project->owner->email)->send(
            new ProjectCreated($project)
        );
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
        $project->update($this->validateProject());

        // $project->title = request('title');
        // $project->description = request('description');

        // $project->save();
       
        return redirect('/projects');
    }

    public function destroy(Project $project){
        $this->authorize('update', $project);
        $project->delete();
        return redirect('/projects');
    }

    protected function validateProject() {
        return request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
,        ]);
    }
}
