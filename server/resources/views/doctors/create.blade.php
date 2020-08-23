<h1>Create Doctor</h1>
{!! Form::open(['action' => 'DoctorsController@store', 'method'=>'POST']) !!}
    <div class="form-group">
        {{Form::label('D_Username', 'Name')}}
        {{Form::text('D_Username', '')}}
    </div>
    <div class="form-group">
        {{Form::label('D_Password', 'Password')}}
        {{Form::text('D_Password', '')}}
    </div>
    <div class="form-group">
        {{Form::label('gender', 'Gender')}}
        {{Form::text('gender', '')}}
    </div>
    <div class="form-group">
        {{Form::label('degree', 'Degree')}}
        {{Form::text('degree', '')}}
    </div>
    <div class="form-group">
        {{Form::label('D_Active', 'Active State')}}
        {{Form::number('D_Active', '')}}
    </div>
    <div class="form-group">
        {{Form::label('dep_id', 'Departement ID')}}
        {{Form::number('dep_id', '')}}
    </div>
    <div class="form-group">
        {{Form::label('reservation_admin_id', 'Admin ID')}}
        {{Form::number('reservation_admin_id', '')}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}