<?php

namespace App\Http\Controllers;

use App\Models\GambioProject;
use Illuminate\Http\Request;

class GambioProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gambioProject=GambioProject::all();

        return view('gambio.index',compact('gambioProject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('gambio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $gambioProject=new GambioProject;
        
        $gambioProject->name=$request->name;
        $gambioProject->link=$request->link;
        $gambioProject->save();

        return redirect()->route('gambioProject.show',$gambioProject->id);
        // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GambioProject  $gambioProject
     * @return \Illuminate\Http\Response
     */
    public function show(GambioProject $gambioProject)
    {
        //

        // $gambioProject=GambioProject::all();

        return view('gambio.show',compact('gambioProject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GambioProject  $gambioProject
     * @return \Illuminate\Http\Response
     */
    public function edit(GambioProject $gambioProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GambioProject  $gambioProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GambioProject $gambioProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GambioProject  $gambioProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(GambioProject $gambioProject)
    {
        //
    }
}
