<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Notification;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'manager'     => 'nullable|string|max:255',
            'status'      => 'nullable|string|max:50',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'team_members'=> 'nullable|string',
            'priority'    => 'nullable|string|max:50',
        ]);

$project = Project::create($request->all());
    // Yahan notification add karna hai
    Notification::create([
    'type'    => 'project',  // yeh value dena zaroori hai
    'message' => 'Project "' . $project->title . '" has been created.',
    'is_read' => false,
]);


        // Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'manager'     => 'nullable|string|max:255',
            'status'      => 'nullable|string|max:50',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'team_members'=> 'nullable|string',
            'priority'    => 'nullable|string|max:50',
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }

    
}
