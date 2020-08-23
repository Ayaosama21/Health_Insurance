<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Doctor;
use App\User;
use App\Department;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors= Doctor::all();
        return response()->json($doctors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $required_validation= \Validator::make($request->all(), [
            'full_name'=>'required',
            'username'=>'required',
            'password'=>'required',
            'gender'=>'required',
            'admin_id'=>'required',
            'dep_name'=>'required',
            'degree'=>'required',
        ]);
        if ($required_validation->fails()) return response()->json("Missing Data");
        
        //Create Doctor
        $doctor= new Doctor();

        //Username Input and Validation
        $doctor->username=$request->username;
        $name_validation= \Validator::make($request->all(), [
            'username' => 'unique:doctors',
        ]);
        if ($name_validation->fails()) return response()->json("This username is already used");

        //Password Input and Validation
        $doctor->password=\Hash::make($request->password);
        $password_validation= \Validator::make($request->all(), [
            'password' => 'min:8|max:100|required'
        ]);
        if ($password_validation->fails()) return response()->json("Password should be between 8 to 100 characters");

        $doctor->full_name=$request->full_name;
        $doctor->gender=$request->gender;
        $doctor->degree=$request->degree;
        $doctor->admin_id=$request->admin_id;
        $doctor->dep_id=Department::where('name','=', $request->dep_name)->pluck('id')->first();
        $doctor->api_token=\Str::random(60);
        $doctor->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::find($id);
        $admin_name=User::where('id','=', $doctor->admin_id)->pluck('username')->first();
        $dep_name=Department::where('id','=', $doctor->dep_id)->pluck('name')->first();
        if($doctor->is_active==1) $active_flag="نعم";
        if($doctor->is_active==0) $active_flag="لا";
        $data=array("id"=>$doctor->id, "username"=>$doctor->username,"active_flag"=>$active_flag,
        "gender"=>$doctor->gender,"degree"=>$doctor->degree,"admin_username"=>$admin_name,
        "department_name"=>$dep_name, "full_name"=>$doctor->full_name);
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
        //Required Fields Validation
        $required_validation= \Validator::make($request->all(), [
            'full_name'=>'required',
            'username'=>'required',
            'gender'=>'required',
            'admin_id'=>'required',
            'dep_name'=>'required',
            'degree'=>'required',
            'is_active'=>'required'
        ]);
        if ($required_validation->fails()) return response()->json("Missing Data");

        //Edit Patient
        $doctor= Doctor::find($id);

        //Username Edit
        if ($doctor->username==$request->username) $doctor->username=$request->username;
        else
        {
            $doctor->username=$request->username;
            //Name Validation
            $name_validation= \Validator::make($request->all(), [
            'username' => 'unique:doctors',
            ]);
        if ($name_validation->fails()) return response()->json("This username is already used");
        }

        //Password Edit
        if (is_null($request->password )) $doctor->password=Doctor::where('username','=', $doctor->username)->pluck('password')->first();
        else {$doctor->password=\Hash::make($request->password);

        //Password Validation
        $password_validation= \Validator::make($request->all(), ['password' => 'min:8|max:100']);
        if ($password_validation->fails()) return response()->json("Password should be between 8 to 100 characters");
        }

        $doctor->full_name=$request->full_name;
        $doctor->gender=$request->gender;
        $doctor->degree=$request->degree;
        if ($request->is_active=="نعم") $doctor->is_active=1;
        if ($request->is_active=="لا") $doctor->is_active=0;
        $doctor->admin_id=$request->admin_id;
        $doctor->dep_id=Department::where('name','=', $request->dep_name)->pluck('id')->first();
        $doctor->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor=Doctor::find($id);
        $doctor->delete();
    }

    public function getDoctors(Request $request)
    {
        //Get Department name
        $dep=Department::where('name','=', $request->dep_name)->pluck('id');

        //
        $docs=Doctor::where('dep_id', '=', $dep)->where('is_active','=', 1)->where('degree','=','استشاري')->get();

        //Check if there exists a doctor
        if ($docs->first())
        {
        //Get data of each doctor
        foreach ($docs as $doc){
            $admin=User::where('id','=', $doc->admin_id)->pluck('username')->first();
            $data[]=array("ID"=>$doc->id,"full_name"=> $doc->full_name,"username"=>$doc->username,
            "gender"=>$doc->gender,"degree"=>$doc->degree, "admin"=>$admin, "department"=>$request->dep_name);
        }

        //Return Array of doctors data
        return response()->json($data);
    }
    //If there are no doctors in the department
    else return response()->json('No doctors in this department');
    }
}
