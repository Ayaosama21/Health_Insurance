<h1>Doctors</h1>

    
@foreach ($doctors as $doctor)

    <p><a href="/doctors/{{$doctor->D_ID}}"> {{$doctor->D_Username}}</a></p>
    
@endforeach

