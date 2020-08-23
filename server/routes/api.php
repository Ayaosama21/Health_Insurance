<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();});
/*Route::middleware('super')->group(function(){
    Route::get('superadmin', function () {
        return 'I am a super admin';
    });
});*/
Route::get('tester', 'API\LabController@tester');

Route::post('login', 'ApiController@login');
Route::get('supers', 'ApiController@superadmins');


// Admin Routes
Route::post('users', 'API\AdminsController@store');
Route::get('users', 'API\AdminsController@index');
Route::get('users/{id}', 'API\AdminsController@show');
Route::delete('users/{id}', 'API\AdminsController@destroy');
Route::post('users/{id}', 'API\AdminsController@update');

//Patient Routes
Route::post('patients', 'API\PatientsController@store');
Route::get('patients', 'API\PatientsController@index');
Route::get('patients/{id}', 'API\PatientsController@show');
Route::post('patients/{id}', 'API\PatientsController@update');
Route::delete('patients/{id}', 'API\PatientsController@destroy');
Route::get('admins', 'API\PatientsController@admins');
Route::post('search', 'API\PatientsController@search');

//Lab Routes
Route::post('checkpatient', 'API\LabController@PatientCheck');
Route::post('createlab', 'API\LabController@store');
Route::post('showlab', 'API\LabController@show');
Route::post('downloadlab', 'API\LabController@download');
Route::delete('deletelab/{id}','API\LabController@destroy');
Route::post('getlabs', 'API\LabController@getLabs');
Route::post('docgetlabs', 'API\LabController@docGetLabs');


//Prescription Routes
Route::post('createpres', 'API\PrescriptionsController@store');
Route::post('showpres', 'API\PrescriptionsController@show');
Route::delete('deletepres/{id}','API\PrescriptionsController@destroy');
Route::post('downloadpres', 'API\PrescriptionsController@download');
Route::post('minuspres', 'API\PrescriptionsController@minusPres');
Route::post('getpres', 'API\PrescriptionsController@getPres');
Route::post('docgetpres', 'API\PrescriptionsController@docGetPres');

//Drug Routes
Route::get('drugs', 'API\DrugsController@index');
Route::post('drugs', 'API\DrugsController@store');
Route::get('drugs/{id}', 'API\DrugsController@show');
Route::post('drugs/{id}', 'API\DrugsController@update');
Route::delete('drugs/{id}','API\DrugsController@destroy');
Route::post('drugchecker', 'API\DrugsController@drugChecker');


//Department Routes
Route::get('deps', 'API\DepartmentsController@index');
Route::post('deps', 'API\DepartmentsController@store');
Route::get('deps/{id}', 'API\DepartmentsController@show');
Route::post('deps/{id}', 'API\DepartmentsController@update');
Route::delete('deps/{id}','API\DepartmentsController@destroy');
Route::get('departments', 'API\DepartmentsController@departments');


//Doctors Routes
Route::get('doctors', 'API\DoctorsController@index');
Route::post('doctors', 'API\DoctorsController@store');
Route::get('doctors/{id}', 'API\DoctorsController@show');
Route::post('doctors/{id}', 'API\DoctorsController@update');
Route::delete('doctors/{id}','API\DoctorsController@destroy');
Route::post('getdocs','API\DoctorsController@getDoctors');


//Appointments Routes
Route::post('apps', 'API\AppointmentsController@store');
Route::post('checkapps', 'API\AppointmentsController@checker');
Route::post('saveapps', 'API\AppointmentsController@saveApps');

//Reservations Routes
Route::post('reservs', 'API\ReservationsController@viewApps');
Route::post('reserveapp', 'API\ReservationsController@reserveApp');
Route::post('docreservs', 'API\ReservationsController@getReservs');
Route::get('getDatabaseName', 'API\ReservationsController@getDatabaseName');

//News Routes
Route::get('news', 'API\NewsController@index');
Route::get('activenews', 'API\NewsController@getActive');
Route::get('news/{id}', 'API\NewsController@show');
Route::post('news', 'API\NewsController@store');
Route::post('news/{id}', 'API\NewsController@update');
Route::delete('news/{id}', 'API\NewsController@destroy');


//Login Routes
Route::post('patientLogin', 'API\LoginController@patientLogin');
Route::post('doctorLogin', 'API\LoginController@doctorLogin');
Route::post('adminLogin', 'API\LoginController@adminLogin');
Route::post('adminRegister', 'MyController@adminRegister');
Route::post('logout', 'API\LoginController@logout');


Route::group(['prefix' => 'patient','middleware' => ['assign.guard:patient','jwt.auth']],function ()
{
  Route::post('/demo','API\LoginController@auth');	// Accessed if authorized only
});

Route::group(['prefix' => 'doctor','middleware' => ['assign.guard:doctor','jwt.auth']],function ()
{
  Route::post('/demo','API\LoginController@auth'); // Accessed if authorized only
});

Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admin', 'admin.auth.role:admin', 'jwt.auth']],function ()
{
	Route::post('/super','API\LoginController@auth');
		
});

Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admin', 'admin.auth.role:lab', 'jwt.auth']],function ()
{
	Route::post('/lab','API\LoginController@auth');
		
});

Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admin','admin.auth.role:pharm','jwt.auth']],function ()
{
	Route::post('/pharm','API\LoginController@auth');
		
});


Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admin', 'admin.auth.role:reserve', 'jwt.auth']],function ()
{
	Route::post('/reserve','API\LoginController@auth');
		
});

Route::get('patientlabs','API\LabController@enterpatient');
Route::get('pres','API\PrescriptionsController@viewpres');

