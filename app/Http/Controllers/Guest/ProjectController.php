<?php

namespace App\Http\Controllers\Guest;

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
        $projects = Project::with(['type', 'type.projects'])->get();


        return view('guest.projects.index', compact('projects'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        // $projects = Project::with(['type', 'type.projects'])->get();
        //dd($project);

        $project->load(['type', 'type.projects']);
        

        return view('guest.projects.show', compact('project'));
    }









    /** Unused CRUD Functions */


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
