<?php

namespace App\Http\Controllers;

use App\Events\Project\Created;
use App\Events\Project\Deleted;
use App\Events\Project\Updated;
use App\Http\Requests\ProjectRequest;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * The project instance.
     *
     * @var \App\Project
     */
    protected $project;

    /**
     * Create project instance.
     *
     * @param \App\Project $project
     */
    public function __construct(Project $project)
    {
        $this->middleware('auth')->except(['index', 'show']);

        $this->project = $project;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->project->withCount('pages')->latest()->paginate(10);

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ProjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = $request->user()->projects()->create($request->all());

        event(new Created($project));

        return redirect()->route('projects.show', $project)->with('success', trans('projects.flash.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $pages = $project->pages;

        return view('projects.show', compact('project', 'pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->all());

        event(new Updated($project));

        return redirect()->route('projects.show', $project)->with('success', trans('projects.flash.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        event(new Deleted($project));

        $project->delete();

        return redirect()->route('projects.index')->with('success', trans('projects.flash.deleted'));
    }
}
