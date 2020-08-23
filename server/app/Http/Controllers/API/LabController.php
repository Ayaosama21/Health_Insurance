<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lab;
use App\Patient;
use App\Prescription;

class LabController extends Controller
{
        public function tester(Request $request)
    {
        return view('welcome');
    }
    
    public function PatientCheck(Request $request){
        $patient= Patient::where('username','=',$request->username)->first();
        if($patient !=null) $checked="yes";
        else $checked="no";
        return response()->json($checked);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lab=new Lab();

        $lab->admin_id=$request->admin_id;
        $lab->patient_id=Patient::where('username','=', $request->patient_name)->pluck('id')->first();

        $file = $request->file('file');
        // Generate a file name with extension
        $fileName = $lab->patient_id.time().'.'.$file->getClientOriginalExtension();

        // Save the file
        $path = $file->storeAs('public\files', $fileName);
        $lab->result= $fileName;
        $lab->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //Get patient ID
        $patient_id=Patient::where('username','=', $request->patient_name)->pluck('id')->first();

        //Check if patient exists
        if ($patient_id!=null)
        {

        // Get lab results of patient
        $labs=Lab::where('patient_id','=', $patient_id)->get();

        //Check if patient has lab results
        if ($labs->first())
        {
            //Get ID and name of each lab and save to array
            foreach ( $labs as $lab)
            {
                $lab_result=$lab->result;
                $lab_id=$lab->id;
                $data[]=array("id"=>$lab_id, "result"=>$lab_result);
            }
            
            //Return lab results data
            return response()->json($data);
        }

        //if patient has no lab results
        else
        {
            return response()->json("This patient has no lab results");
        }

    }
        //If patient does not exist
        else return response()->json("This patient does not exist");
    }

    public function download(Request $request)
    {
        //Get lab result file name 
        $lab=Lab::where('id','=', $request->id)->pluck('result')->first();

        //Set download file path
        $path= storage_path().'/'.'app'.'/'.'public' .'/'.'files'.'/'. $lab;

        //Download
        return response()->download($path, $lab);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lab=Lab::find($id);
        $fileName=$lab->result;
        unlink(storage_path().'/'.'app'.'/'.'public' .'/'.'files'.'/'. $fileName);
        $lab->delete();

    }

    public function getLabs(Request $request)
    {
        $labs=Lab::where('patient_id', '=', $request->patient_id)->get();
        if ($labs->first()){
        foreach($labs as $lab)
        {
            $data[]=array("id"=>$lab->id, "name"=>$lab->result);
        }
        return response()->json(collect($data)->sortBy('id')->reverse()->values());
    }
    else return response()->json("no");
    }

    public function docGetLabs(Request $request)
    {
        $patient=Patient::where('username', '=', $request->name);
        if ($patient->first())
        {
        $labs=Lab::where('patient_id', '=', $patient->first()->id)->get();
        if ($labs->first())
        {
        foreach($labs as $lab)
        {
            $data[]=array("id"=>$lab->id, "name"=>$lab->result);
        }
        return response()->json(collect($data)->sortBy('id')->reverse()->values());
    
        }
        else return response()->json("no"); 
        }
    else return response()->json("no");
    
}
}