<form action="{{ url( 'api/createlab' ) }}" method="POST" enctype="multipart/form-data">
    
    {{Form::text('patient_name', '')}}
 
   
 {{Form::text('admin_id', '')}}

{{--  {{Form::text('valid_usage', '')}}
 --}}
 {{Form::file('file')}}
 {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

</form>

{{-- <form action="{{ url( 'api/saveapps' ) }}" method="POST" enctype="multipart/form-data">
    
{{Form::text('doc_id', '')}}
 
 {{Form::text('results[0][day]', '')}}

 {{Form::text('results[0][start]', '')}}

 {{Form::text('results[0][end]', '')}}

 {{Form::text('results[0][slots]', '')}}
 
 {{Form::text('results[1][day]', '')}}

 {{Form::text('results[1][start]', '')}}

 {{Form::text('results[1][end]', '')}}

 {{Form::text('results[1][slots]', '')}}

 {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

</form> --}}

