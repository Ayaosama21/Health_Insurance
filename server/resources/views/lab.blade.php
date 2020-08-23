<form action="{{ url( 'api/downloadpres' ) }}" method="POST" enctype="multipart/form-data">
    
    {{Form::text('id', '')}}

 {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

</form>


