<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Drug;

class DrugsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs= Drug::all();
        return response()->json($drugs);
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
            'is_special'=>'required',
        ]);

        //Create Drug
        $drug= new Drug();

        //Get drug name and validate uniqness
        $drug->name=$request->name;
        $name_validation= \Validator::make($request->all(), [
            'name' => 'unique:drugs',
        ]);
        if ($name_validation->fails()) return response()->json("This drug already exists");

        //Get speciality flag
        if ($request->is_special=="نعم") $drug->is_special=1;
        if ($request->is_special=="لا") $drug->is_special=0;

        //Get drug notes
        $drug->notes=$request->notes;

        //Save drug data
        $drug->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drug = Drug::find($id);
        if($drug->is_available==1) $available_flag="نعم";
        if($drug->is_available==0) $available_flag="لا";
        if($drug->is_special==1) $special_flag="نعم";
        if($drug->is_special==0) $special_flag="لا";
        $data=array("id"=>$drug->id, "name"=>$drug->name,"Availabilty_flag"=>$available_flag,"Special_flag"=>$special_flag, "Notes"=>$drug->notes);
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
            'name'=>'required',
            'is_available'=>'required',
            'is_special'=>'required',
        ]);

        $drug = Drug::find($id);

        //Get drug name and validate uniqness
        if ($drug->name=$request->name) $drug->name=$request->name;

        else {
            $drug->name=$request->name;
            $name_validation= \Validator::make($request->all(), [
                'name' => 'unique:drugs',
            ]);
            if ($name_validation->fails())
            return response()->json("This drug already exists");
            }

        //Get speciality flag
        if ($request->is_special=="نعم") $drug->is_special=1;
        if ($request->is_special=="لا") $drug->is_special=0;

        //Get availability flag
        if ($request->is_available=="نعم") $drug->is_available=1;
        if ($request->is_available=="لا") $drug->is_available=0;

        //Get drug notes
        $drug->notes=$request->notes;

        //Save drug data
        $drug->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drug = Drug::find($id);
        $drug->delete();
    }

    public function drugChecker(Request $request)
    {
        $drugs=Drug::where('name', 'LIKE',  $request->name.'%')->get();
        if ($drugs->first())
        {
            foreach($drugs as $drug)
            {
                if ($drug->is_available==1) $available_flag="نعم";
                elseif ($drug->is_available==0) $available_flag="لا";
                $data[]=array("name"=>$drug->name, "flag"=>$available_flag);
            }
            return response()->json($data);
        }
        else return response()->json("not available");
    }
}
