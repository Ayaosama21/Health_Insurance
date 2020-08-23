<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminsController extends Controller
{
    public function index()
    {
        $users= User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {    
        $required_validation= \Validator::make($request->all(), [
            'full_name'=>'required',
            'username'=>'required',
            'password'=>'required',
            'gender'=>'required',
            'managed_by'=>'required',
            'admin_type'=>'required',
        ]);
        if ($required_validation->fails()) return response()->json("Missing Data");


        $user= new User();
        $name_validation= \Validator::make($request->all(), [
            'username' => 'unique:users',
        ]);
        if ($name_validation->fails()) return response()->json("This username is already used");
        $password_validation= \Validator::make($request->all(), [
            'password' => 'min:8|max:100'
        ]);
        if ($password_validation->fails()) return response()->json("Password should be between 8 to 100 characters");
        $user->password=\Hash::make($request->password);
        $user->gender=$request->gender;
        $user->username=$request->username;
        $user->full_name=$request->full_name;
        $user->managed_by=$request->managed_by;
        if($request->admin_type=="super") $user->is_admin=1;
        if($request->admin_type=="lab") $user->is_lab=1;
        if($request->admin_type=="pharm") $user->is_pharm=1;
        if($request->admin_type=="reserve") $user->is_reserve=1;
        $user->api_token=Str::random(60);
        $user->save();

    }

    public function show($id)
    {
        $user = User::find($id);
        $manager=User::where('id','=',$user->managed_by)->first();
        if ($user->is_admin==1) $admin_type="ادمن عام";
        if ($user->is_lab==1) $admin_type="ادمن معمل";
        if ($user->is_pharm==1) $admin_type="ادمن صيدلية";
        if ($user->is_reserve==1) $admin_type="ادمن حجز";
        if ($user->is_active==1) $active_flag="نعم"; else $active_flag="لا";
        $data=array($user->id,$user->username, $user->gender, $admin_type, $manager->username, $active_flag, $user->full_name);
        return response()->json($data);
       
    }

    public function update(Request $request, $id)
    {
        $required_validation= \Validator::make($request->all(), [
            'full_name'=>'required',
            'username'=>'required',
            'gender'=>'required',
            'managed_by'=>'required',
            'admin_type'=>'required',
            'is_active'=>'required',
        ]);
        if ($required_validation->fails()) return response()->json("Missing Data");

        //Edit User
        $user= User::find($id);
        if ($user->username!=$request->username){
            $user->username=$request->username;
            $name_validation= \Validator::make($request->all(), [
                'username' => 'unique:users',
            ]);
            if ($name_validation->fails())
            return response()->json("This username is already used");
        }
        else $user->username=$request->username;


        if ($request->passwordl=null) $user->password=User::where('username','=', $request->username)->pluck('password')->first();
        if ($request->password != null)
        {
             $user->password=\Hash::make($request->password);
             $password_validation= \Validator::make($request->all(), ['password' => 'min:8|max:100']);
            if ($password_validation->fails()) return response()->json("Password should be between 8 to 100 characters");
         }

        $user->full_name=$request->full_name;
        $user->gender=$request->gender;
        $user->managed_by=$request->managed_by;
        if($request->admin_type=="super") {$user->is_admin=1; $user->is_lab=0; $user->is_pharm=0; $user->is_reserve=0;}
        if($request->admin_type=="lab") {$user->is_admin=0; $user->is_lab=1; $user->is_pharm=0; $user->is_reserve=0;}
        if($request->admin_type=="pharm") {$user->is_admin=0; $user->is_lab=0; $user->is_pharm=1; $user->is_reserve=0;}
        if($request->admin_type=="reserve") {$user->is_admin=0; $user->is_lab=0; $user->is_pharm=0; $user->is_reserve=1;}
        if($request->is_active=="yes") $user->is_active=1;
        if($request->is_active=="no") $user->is_active=0;
        $user->save();
    }

    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
    }
    public function superadmins()
    {
        $superadmins=User::where('is_admin','=', '1')->get('username');
        return response()->json($superadmins);
    }

}
