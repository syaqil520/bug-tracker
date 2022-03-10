<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{

    public function __construct()
    {
        Auth::loginUsingId(1);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        $project = Project::find($projectId);
        $tickets = $project->tickets()->get();
        return response()->json([
            'success' => true,
            'tickets' => $tickets
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required', 
            'tag' => 'required', 
            'priority' => 'required', 
            'status' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = $validator->validated();

        $project = Project::find($projectId);

        $ticket = new Ticket;
        $ticket->title = $data['title'];
        $ticket->description = $data['description'];
        $ticket->tag = $data['tag'];
        $ticket->priority = $data['priority'];
        $ticket->status = $data['status'];
        $ticket->project()->associate($project);
        $ticket->user()->associate(Auth::user());
        $ticket->save();

        return response()->json([
            'success' => true,
            'ticket' => $ticket
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
