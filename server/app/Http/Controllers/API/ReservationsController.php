<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reservation;
use App\Appointment;
use App\Doctor;
use App\Patient;
use Carbon\Carbon;


class ReservationsController extends Controller
{

    //Internal Function
    //To get the date of a day within a week
    //Input: day to get its date -- $day -- Format: Sat, Sun, Mon, Tues, Wed, Thu
    public function getDates($day)
    {
        //Set dates of each day within a week
        $nextSun=Carbon::now()->modify('next sun')->format('d/m');
        $nextMon=Carbon::now()->modify('next mon')->format('d/m');
        $nextTues=Carbon::now()->modify('next tues')->format('d/m');
        $nextWed=Carbon::now()->modify('next wed')->format('d/m');
        $nextThu=Carbon::now()->modify('next thu')->format('d/m');
        $nextSat=Carbon::now()->modify('next sat')->format('d/m');

        //Create an array of the week days
        $nextDates=array($nextSun => 'Sun', $nextMon=>'Mon', $nextTues=>'Tue',
        $nextWed=>'Wed', $nextThu=>'Thu', $nextSat=>'Sat');

        //Search for a day date inside the next week array
        $date = array_search($day, $nextDates);

        //Return the required date
        return ($date);
    }

    public function arabicDay($day)
    {
        if($day=="Sun") $arabic_day="الأحد";
        if($day=="Mon") $arabic_day="الأثنين";
        if($day=="Tue") $arabic_day="الثلاثاء";
        if($day=="Wed") $arabic_day="الأربعاء";
        if($day=="Thu") $arabic_day="الخميس";
        if($day=="Sat") $arabic_day="السبت";

        return ($arabic_day);
    }
    //API
    //To get all available appointments of a certain doctor
    //Input: Doctor ID -- doc_id
    //Returns data of appointments (id, day, start, end, free slots, date)
    public function viewApps(Request $request)
    {
        $data=[];
        $today = Carbon::today('Egypt')->format('D');
        //Get all appointments for a doctor
        $apps=Appointment::where('doc_id', '=', $request->doc_id)->get();

        if($apps->first())
        {
        foreach(json_decode($apps) as $app)
        {
            if ($app->free_slots>0 && $today!=$app->day)
            {
            //Get data of each appointment
            $data[]=array("id"=> $app->id, "day"=>$this->arabicDay($app->day), "start"=>$app->start, "end"=>$app->end,
            "free_slots"=>$app->free_slots, "date"=>$this->getDates($app->day));
            }
        }
        //Return Appointments data
        if (sizeof($data)!=0) return response()->json(collect($data)->sortBy('date')->values());
        else return response()->json("No"); 
        }
    else return response()->json("No");
    
}

    public function store($app_id, $patient_id)
    {
        $year=Carbon::now()->year;
        $app=Appointment::where('id', '=', $app_id)->first();

        //Create new reservation record
        $reserve=new Reservation();

        //Set reservation data and save
        $reserve->patient_id=$patient_id;
        $reserve->app_id=$app_id;
        $reserve->date= ($this->getDates($app->day)).'/'.$year;
        $reserve->patient_turn=$app->slots - $app->free_slots+1;
        $reserve->save();
        
        //Decrement available slots and save
        $app->free_slots=$app->free_slots -1;
        $app->save();
    }

    //Input: Doctor ID -- doc_id
    //       Appointment ID -- app_id
    //       Patient ID -- patient_id
    public function reserveApp(Request $request)
    {
        $flag=0;
        //Get current date
        $current=new Carbon();

        //Get selected appointment
        $app=Appointment::where('id', '=', $request->app_id)->first();

        //Get all old reservations of the patient
        $old_reserves=Reservation::where('patient_id','=', $request->patient_id)->get();

        //Get doctor that patient wants to reserve with
        $current_doc=Doctor::where('id', '=', $request->doc_id)->first();
        
        //Check if patient has old reservations
        if($old_reserves->first())
        {
        foreach($old_reserves as $old_reserve)
        {
            //Calculate allowed date to reserve
            $expires=$old_reserve->created_at->addMonth();

            //Get old appointment reserved 
            $old_app=Appointment::where('id', '=', $old_reserve->app_id)->first();

            //Get doctor of the old appointment
            $old_doc=Doctor::where('id', '=', $old_app->doc_id)->first();

            //Check if current date is after the allowed reservation date
            //Check if old reserved doctor department is the same as the current one
            if($old_doc->dep_id==$current_doc->dep_id && $current<$expires)
            {
                $flag=$flag+1;
                //If patient is not allowed to reserve calculate time remaining and return it
                $diff= array("type"=>"remaining", "value"=>$current->diffInDays($expires)); 
                return response()->json($diff);
            }

        }
        if($flag==0)
        {
            $this->store($request->app_id,$request->patient_id);
            $turn=array("type"=> "turn", "value"=>$app->slots - $app->free_slots+1);
            return response()->json($turn);
        }
    }
        //If patient has no previous reservations create a new one
        else {
        $this->store($request->app_id,$request->patient_id);
        $turn=array("type"=> "turn", "value"=>$app->slots - $app->free_slots+1);
        return response()->json($turn);
        }
    }

    public function getReservs(Request $request)
    {
            $today=Carbon::today('Egypt')->format('d/m/Y');
            $reservs=Reservation::where('date', '=', $today)->get();
            if ($reservs->first())
            {
            foreach($reservs as $reserve)
            {
            $app=Appointment::where('id', '=', $reserve->app_id)->first();
            if($app->doc_id==$request->doc_id)
            {
                $patientName=Patient::where('id', '=', $reserve->patient_id)->pluck('username')->first();
                $docReservs[]=array("name"=>$patientName, "turn"=>$reserve->patient_turn);
            }
            }
            if (isset($docReservs)) return response()->json(collect($docReservs)->sortBy('turn')->values());
            else return response()->json("no");
        }
    }





}
