<?php

namespace App\Http\Controllers;

use App\Events\Page\Created;
use App\Events\Page\Deleted;
use App\Events\Page\Updated;
use App\Http\Requests\PageRequest;
use App\Page;
use App\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * The project instance.
     *
     * @var \App\Project
     */
    protected $project;

    /**
     * The page instance.
     *
     * @var \App\Page
     */
    protected $page;

    /**
     * Create project instance.
     *
     * @param \App\Project $project
     */
    public function __construct(Project $project, Page $page)
    {
        $this->project = $project;
        $this->page = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Project $project)
    {
        $pages = $project->pages;

        return view('projects.show', compact('project', 'pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $this->authorize('update', $project);

        return view('pages.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Project $project
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request, Project $project)
    {
        $page = $project->pages()->create($request->all());

        event(new Created($page));

        return redirect()->route('projects.pages.show', [$project, $page])->with('success', trans('pages.flash.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @param  \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Page $page)
    {
        return view('pages.show', compact('project', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @param  \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Page $page)
    {
        $this->authorize('update', $page);

        return view('pages.edit', compact('project', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Project $project
     * @param  \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Project $project, Page $page)
    {
        $page->update($request->all());

        event(new Updated($page));

        return redirect()->route('projects.pages.show', [$project, $page])->with('success', trans('pages.flash.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @param  \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Page $page)
    {
        $this->authorize('delete', $page);

        event(new Deleted($page));

        $page->delete();

        return redirect()->route('projects.show', $project)->with('success', trans('pages.flash.deleted'));
    }
}
