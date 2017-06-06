<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('markdownToHtml');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('projects.index');
    }

    /**
     * Convert markdown content to html.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function markdownToHtml(Request $request)
    {
        return markdown($request->input('markdown'));
    }
}
