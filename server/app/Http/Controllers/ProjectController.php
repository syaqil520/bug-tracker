<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = User::find(1)->projects()->with('users')->orderBy('created_at')->paginate(4);
        // $projects = Project::find(1)->users()->get();
        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();

        $project = Project::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'author_id' => Auth::id()
        ]);

        $project->users()->attach(Auth::id());
        
        $project = Project::with('users')->find($project->id);        
        return response()->json([
            'success' => true,
            'project' => $project
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $project = Project::with('users')->find($id);
        // $projects = User::find(1)->projects()->with('users')->orderBy('created_at')->paginate(4);
        
        return response()->json([
            'success' => true,
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        // $project = Project::find($id);

        // $project->name = $data['name'];
        // $project->description = $data['description'];
        // $project->save();
        $project = Project::where('id', $id)->update([
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        $project = Project::with('users')->find($id);

        return response()->json([
            'success' => true,
            'project' => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->users()->detach();
        $project->delete();

        return response()->json([
            'success' => true,
            'project_id' => $id
        ]);
    }

}
