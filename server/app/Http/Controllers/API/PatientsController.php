<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\User;


class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $request)
    {
        $patients= Patient::all();
        return response()->json($patients);
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
            'DOB'=>'required',
        ]);
        if ($required_validation->fails()) return response()->json("Missing Data");

        //Create Patient
        $patient= new Patient();

        //Username Input and Validation
        $patient->username=$request->username;
        $name_validation= \Validator::make($request->all(), [
            'username' => 'unique:patients',
        ]);
        if ($name_validation->fails()) return response()->json("This username is already used");

        //Password Input and Validation
        $patient->password=\Hash::make($request->password);
        $password_validation= \Validator::make($request->all(), [
            'password' => 'min:8|max:100'
        ]);
        if ($password_validation->fails()) return response()->json("Password should be between 8 to 100 characters");

        $patient->full_name= $request->full_name;
        $patient->gender=$request->gender;
        $patient->DOB=$request->DOB;
        $patient->admin_id=$request->admin_id;
        $patient->api_token=\Str::random(60);
        $patient->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        $admin_name=User::where('id','=', $patient->admin_id)->pluck('username')->first();
        if($patient->is_active==1) $active_flag="نعم";
        if($patient->is_active==0) $active_flag="لا";
        $data=array($patient->id, $patient->username,$active_flag,$patient->gender,$patient->DOB,$admin_name, $patient->full_name);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    function update(Request $request, $id)
    {
        $required_validation= \Validator::make($request->all(), [
            'full_name'=>'required',
            'username'=>'required',
            'gender'=>'required',
            'admin_id'=>'required',
            'DOB'=>'required',
            'is_active'=>'required'
        ]);
        if ($required_validation->fails()) return response()->json("Missing Data");

        //Edit Patient
        $patient= Patient::find($id);

        //Username Edit
        if ($patient->username!=$request->username){
            $patient->username=$request->username;
            $name_validation= \Validator::make($request->all(), [
                'username' => 'unique:patients',
            ]);
            if ($name_validation->fails())
            return response()->json("This username is already used");
            }
        else $patient->username=$request->username;

        //Password Edit
        if ($request->passwordl==null) $patient->password=Patient::where('username','=', $request->username)->pluck('password')->first();
        if ($request->password != null)
        {
             $patient->password=\Hash::make($request->password);
             $password_validation= \Validator::make($request->all(), ['password' => 'min:8|max:100']);
            if ($password_validation->fails()) return response()->json("Password should be between 8 to 100 characters");
         }

        $patient->full_name= $request->full_name;
        $patient->gender=$request->gender;
        if ($request->is_active=="نعم") $patient->is_active=1;
        if ($request->is_active=="لا") $patient->is_active=0;
        $patient->admin_id=$request->admin_id;
        $patient->DOB=$request->DOB;
        $patient->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient=Patient::find($id);
        $patient->delete();
    }

    public function admins(){
        $reserve_admins=User::where('is_reserve','=', '1')->where('is_active','=','1')->pluck('username');
        return response()->json($reserve_admins);
    }
    
    
    public function search(Request $request)
    {
        $patients=Patient::where('full_name', 'LIKE','%'.  $request->name.'%')->get();
        if ($patients->first())
        {
            //return ("Yes");
            foreach($patients as $patient)
            {
                $data[]=array($patient->id);
            }
            return response()->json($data);
        }
        else return response()->json('No');
    }
    
}
