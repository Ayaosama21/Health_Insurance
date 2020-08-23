<h1>{{$doctor->D_Username}}</h1>

<div>
    <p>Name: {{$doctor->D_Username}}</p>
    <p>Password: {{$doctor->D_Password}}</p>
    <p>Active Status: {{$doctor->D_Active}}</p>
    <p>Degree: {{$doctor->degree}}</p>
    <p>Gender: {{$doctor->Gender}}</p>
    <p>Department: {{$doctor->dep_id}}</p>
    <p>Admin ID: {{$doctor->reservation_admin_id}}</p>
</div>

<a href="/doctors/{{$doctor->D_ID}}/edit">Edit</a>
<div>
{!!Form::open(['action'=>['DoctorsController@destroy', $doctor->D_ID], 'method'=> 'POST'])!!}
{{Form::hidden('_method', 'DELETE')}}
{{Form::submit('Delete')}}
{!!Form::close()!!}
</div>

