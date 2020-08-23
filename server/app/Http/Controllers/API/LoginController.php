<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use JWTFactory;
use JWTAuth;
use JWTAuthException;
use App\Patient;
use App\Doctor;
use App\User;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistrationFormRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;


class LoginController extends Controller
{
/*     public function __construct()
    {
        $this->patient = new Patient;
        $this->doctor = new Doctor;
    }
     */
    //public $loginAfterSignUp = true;

    public function patientLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        config()->set( 'auth.defaults.guard', 'patient' );
        config()->set( 'auth.guards.api.driver', 'jwt' );
        \Config::set('jwt.user', 'App\Patient'); 
	\Config::set('auth.providers.users.model', \App\Patient::class);
	$credentials = $request->only('username', 'password');
	$token = null;
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                //return response()->json(['error' => 'invalid_credentials'], 401);
                return response()->json("Invalid Data");
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // user = JWTAuth::toUser($token);
        // $user = Auth::user();

      //return response()->json(compact('token'));
	 
	 //Find user and save token   
	   $user = Auth::user();
        //   $user->api_token = $token;
        //   $user->save();

           return response()->json(['status'=>'ok', 'token'=>$token,'id'=>$user->id]);
          
/*        return response()->json([
           compact('token'),
          'data' => $user,
        ]); */
    }


    public function doctorLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password'=> 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        config()->set( 'auth.defaults.guard', 'doctor' );
        config()->set( 'auth.guards.api.driver', 'jwt' );
        \Config::set('jwt.user', 'App\Doctor'); 
	\Config::set('auth.providers.users.model', \App\Doctor::class);
	$credentials = $request->only('username', 'password');
	$token = null;
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                //return response()->json(['error' => 'invalid_credentials'], 401);
                return response()->json("Invalid Data");
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // user = JWTAuth::toUser($token);
        // $user = Auth::user();
      //return response()->json(compact('token'));
	
	//Find user and save token   
	   $user = Auth::user();
        //   $user->api_token = $token;
        //   $user->save();

           return response()->json(['status'=>'ok', 'token'=>$token,'id'=>$user->id]);
          
/*        return response()->json([
           compact('token'),
          'data' => $user,
        ]); */
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
/*     public function patientRegister(Request $request)
    {
	$validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:patients',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = new Patient();
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->patientLogin($request);
        }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }

    public function doctorRegister(Request $request)
    {
	$validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:doctors',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
	    
        $user = new Doctor();
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->doctorLogin($request);
        }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    } */

    public $loginAfterSignUp = true;

    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        config()->set( 'auth.defaults.guard', 'admin' );
        config()->set( 'auth.guards.api.driver', 'jwt' );
        \Config::set('jwt.user', 'App\User'); 
		    \Config::set('auth.providers.users.model', \App\User::class);
		    $credentials = $request->only('username', 'password');
	    	$token = null;
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        //$user = JWTAuth::toUser($token);
        $user = Auth::user();
        // $user->api_token = $token;
        // $user->save();
         
        if(!($user->is_active) || (!($user->is_admin) && !($user->is_lab) && !($user->is_pharm) && !($user->is_reserve)) )
        return "You are not an admin";
        else
        return response()->json(['status'=>'ok', 'token'=>$token, 'id'=>$user->id,'admin_type'=>(($user->is_admin)?"super_admin":(
        ($user->is_lab)?"lab_admin":(($user->is_pharm)?"pharmacy_admin":(($user->is_reserve)?"reserve_admin":
        "You are not an admin"))))]);
    }


 
    public function adminRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:admins',
            'password'=> 'required|min:8|max:100'
        ]);
        $user = new Admin();
        $user->username = $request->username;
        $user->full_name = $request->full_name;
        $user->password = bcrypt($request->password);
        $user->managed_by = $request->managed_by;
        $user->gender = $request->gender;
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->adminLogin($request);
        }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }
	
//     public function demo_admin(Request $request){
//         $user =  (JWTAuth::setToken($request->token))->authenticate();
        
//         if(($request->id)[0] == '%'|| $user->id != $request->id)
//             return response()->json('no');

//         return response()->json('ok');
//     }	
//   public function demo_lab(Request $request){
//         $user =  (JWTAuth::setToken($request->token))->authenticate();
        
//         if(($request->id)[0] == '%'|| $user->id != $request->id)
//             return response()->json('no');

//         return response()->json('ok');
//     }
//     public function demo_pharm(Request $request){
//         $user =  (JWTAuth::setToken($request->token))->authenticate();
        
//         if(($request->id)[0] == '%'|| $user->id != $request->id)
//             return response()->json('no');

//         return response()->json('ok');
//     }
//     public function demo_reserve(Request $request){
//         $user =  (JWTAuth::setToken($request->token))->authenticate();
        
//         if(($request->id)[0] == '%'|| $user->id != $request->id)
//             return response()->json('no');

//         return response()->json('ok');
//     }
   
//     public function demo(Request $request){
        
//         $user =  (JWTAuth::setToken($request->token))->authenticate();
        
//         if(($request->id)[0] == '%'|| $user->id != $request->id)
//             return response()->json('no');

//         return response()->json('ok');
        
    
//     }
    public function auth(Request $request){
        
        $user =  (JWTAuth::setToken($request->token))->authenticate();
        
        if(($request->id)[0] == '%'|| $user->id != $request->id)
            return response()->json('no');

        return response()->json('ok');
        
    
    }
    public function logout(Request $request){
        // $token = JWTAuth::getToken();
        JWTAuth::invalidate($request->token);
        return response()->json('logged out');
    }


}