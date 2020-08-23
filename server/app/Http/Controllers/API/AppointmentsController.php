<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checker(Request $request)
    {
        //Get Appointments of doctor
        $apps=Appointment::where('doc_id', '=', $request->doc_id)->get();

        //Check if a doctor has appointments
        if ($apps->first())
        {
            foreach ($apps as $app)
            {
                //Get data of each appointment
                $data[]=array("id"=>$app->id, "day"=>$app->day, "start"=>$app->start, "end"=>$app->end, "slots"=> $app->slots);
            }

            // Return appointments data
            return response()->json($data);
        }

        // If there exists no appointments
        else return response()->json("There are no appointments");

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
            'doc_id'=>'required',
            'start'=>'required',
            'end'=>'required',
            'day'=>'required',
            'slots'=>'required'
        ]);

        //Create Appointment
        $app= new Appointment();

        //Get appointment data
        $app->doc_id= $request->doc_id;
        $app->start=$request->start;
        $app->end=$request->end;
        $app->day=$request->day;
        $app->slots=$request->slots;

        //Save appointment
        $app->save();
    }

   /**
     * Inputs: Doctor ID --> doc_id
     *         Appointments Data --> results[]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveApps(Request $request)
    {
        $apps=$request->results;

         foreach(json_decode($apps, true) as $app)
        {
            $appt=Appointment::where('day', '=', $app['day'])->where('doc_id','=', $request->doc_id)->first();

            if($app['start'] == "-" || $app['end'] == "-")
            {
                //Check if appointment already exists in database
                //If exists delete
                if($appt!=null)  $appt->delete();

            }
            else
            {
                //Check if appointment already exists in database
                //If appointment does not exist create new one
                if($appt==null) $appt= new Appointment();

                //Set appointment data
                $appt->doc_id= $request->doc_id;
                $appt->start=$app['start'];
                $appt->end=$app['end'];
                $appt->day=$app['day'];
                $appt->slots=$app['slots'];
                $appt->free_slots=$app['slots'];

                //Save appointment
                $appt->save(); 
            
        } 
    }
}

}
