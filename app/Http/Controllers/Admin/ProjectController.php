<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$projects = Project::all();
        $projects = Project::with(['type', 'type.projects'])->get(); // 3 query. la 1° prende i project, la 2° prende i tipi associati a quel project, la 3° prende tutti i progetti associati al tipo indicato
        //dd($projects);


        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()    
    {

        $types = Type::orderBy('name', 'asc')->get();


        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        // VALIDATION in StoreProjectRequest


        $form_data = $request->validated();

        $new_project = new Project();

        $new_project->name = $form_data['name'];
        $new_project->link = $form_data['link'];
        $new_project->type_id = $form_data['type_id'];
        $new_project->date_of_creation = $form_data['date_of_creation'];        
        $new_project->is_public = $request->input('type');        
        $new_project->contributors = $form_data['contributors'];
        $new_project->contributors_name = $form_data['contributors_name'];
        $new_project->description = $form_data['description'];
        //$new_project->slug = $this->getUniqueSlug($new_project->name);
        $new_project->slug = Project::getUniqueSlug($new_project->name);

        //dd($new_project);

        $new_project->save();

        return to_route("admin.projects.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // eager loading
        $project->load(['type', 'type.projects']);

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::orderBy('name', 'asc')->get();


        return view("admin.projects.edit", compact("project"), compact('types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //VALIDATION in UpdateProjectRequest

        
        $form_data = $request->validated();

        $project->fill($form_data);
        $project->slug = Project::getUniqueSlug($project->name);

        $project->save();

        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index');
    }
}
