<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Prescription;
use Carbon\Carbon;


class PrescriptionsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'admin_id'=>'required',
            'patient_name'=>'required',
            'valid_usage'=>'required',
            'file'=>'required',
        ]);
        //Create new prescription
        $pres=new Prescription();
    
        //Get and save admin and patient ID
        $pres->admin_id=$request->admin_id;
        $pres->patient_id=Patient::where('username','=', $request->patient_name)->pluck('id')->first();
    
        //Get prescription file and valid no. of usage 
        $file = $request->file('file');
        $pres->valid_usage=$request->valid_usage;

        // Generate a file name with extension
        $fileName = $pres->patient_id.time().'.'.$file->getClientOriginalExtension();
    
        // Save the file
        $path = $file->storeAs('public/prescriptions', $fileName);
        $pres->item= $fileName;
        $pres->save();
    }

    public function show(Request $request)
    {
        //Get patient ID
        $patient_id=Patient::where('username','=', $request->patient_name)->pluck('id')->first();

        //Check if patient exists
        if ($patient_id!=null)
        {
            // Get prescriptions of patient
            $allPres=Prescription::where('patient_id','=', $patient_id)->get();
        
            //Check if patient has lab results
            if ($allPres->first())
            {
                //Get ID and name of each prescription and save to array
                foreach ( $allPres as $pres)
                {
                    $item=$pres->item;
                    $pres_id=$pres->id;
                    $valid_usage=$pres->valid_usage;
                    $last_usage=$pres->last_usage;
                    $data[]=array("id"=>$pres_id, "prescription"=>$item, "valid_usage"=>$valid_usage);
                }
                    
                //Return prsecription data
                return response()->json($data);
            }

        
        //if patient has no prescriptions
        else
        {
            return response()->json("This patient has no prescriptions");
        }

    }
        //If patient does not exist
        else return response()->json("This patient does not exist");
    }

    public function download(Request $request)
    {
        //Get prescription file name 
        $pres=prescription::where('id','=', $request->id)->pluck('item')->first();

        //Set download file path
        $path= storage_path().'/'.'app'.'/'.'public' .'/'.'prescriptions'.'/'. $pres;

        //Download
        return response()->download($path, $pres);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pres=Prescription::find($id);
        $fileName=$pres->item;
        unlink(storage_path().'/'.'app'.'/'.'public' .'/'.'prescriptions'.'/'. $fileName);
        $pres->delete();
    }

    public function minusPres(Request $request)
    {
        //Get Required prescription
        $pres=Prescription::find($request->id);

        //Check if patient can get prescription
        if($pres->valid_usage!=0)
        {
            //Decrement no. of valid usage times
            $pres->valid_usage=$pres->valid_usage - 1;

            //Save usage date
            $pres->last_usage=Carbon::now();
            $pres->save();
        }
        else return response()->json("Operation is not available anymore");
    }

    public function getPres(Request $request)
    {
        $pres= Prescription::where('patient_id', '=', $request->patient_id)->latest('created_at')->get();
        if ($pres->first())
        {
        $data=array("id"=> $pres->first()->id, "file_name"=> $pres->first()->item, "valid_usage"=>$pres->first()->valid_usage);
        return response()->json($data);
        }
        else return response()->json("no");
    }

    public function docGetPres(Request $request)
    {
        $patient=Patient::where('username', '=', $request->name)->get();
        if($patient->first())
        {
        $pres=Prescription::where('patient_id', '=', $patient->first()->id)->get();
        if ($pres->first()){
        foreach($pres as $pres)
        {
            $data[]=array("id"=> $pres->id, "file_name"=> $pres->item, "valid_usage"=>$pres->valid_usage);
        }
        return response()->json(collect($data)->sortBy('id')->reverse()->values());
    }
    else return response()->json("no");
    
}
    else return response()->json("no");
    }
}
