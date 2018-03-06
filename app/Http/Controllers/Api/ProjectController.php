<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProjectRequest;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filters\ProjectFilter;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProjectFilter $filter)
    {
        $sortBy = 'id';
        $direction = 'asc';
        $perPage = $request->perPage == -1 ? Project::count() : $request->perPage;
        


        if(!empty($request->sortBy)){
            $sortBy = $request->sortBy;
        }

        if(!empty($request->descending)){
            $direction = $request->descending == "true" ? 'desc' : 'asc';
        }
        if(request()->exists('search'))
            return Project::filter($filter)->orderBy($sortBy, $direction)->paginate($perPage);

        return Project::orderBy($sortBy, $direction)->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->all());
        return $project;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->all());
        return $project;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return [];
    }
}
