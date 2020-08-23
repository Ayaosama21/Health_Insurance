<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Doctor;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deps= Department::all();
        return response()->json($deps);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request,[
            'name'=>'required',
        ]);

        //Create Drug
        $dep= new Department();

        //Get department name and validate uniqness
        $dep->name=$request->name;
        $name_validation= \Validator::make($request->all(), [
            'name' => 'unique:departments',
        ]);
        if ($name_validation->fails()) return response()->json("This department already exists");

        //Save department data
        $dep->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dep = Department::find($id);
        $data=array("id"=>$dep->id, "name"=>$dep->name);
        return response()->json($data);
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
        $this->validate($request,[
            'name'=>'required'
        ]);

        $dep = Department::find($id);

        //Get department name and validate uniqness
        $dep->name=$request->name;
        $name_validation= \Validator::make($request->all(), [
            'name' => 'unique:departments',
        ]);
        if ($name_validation->fails()) return response()->json("This department already exists");

        //Save department data
        $dep->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dep = Department::find($id);
        $dep->delete();
    }

    public function departments(){
        $deps= Department::all()->pluck('name');
        return response()->json($deps);
    }


}
