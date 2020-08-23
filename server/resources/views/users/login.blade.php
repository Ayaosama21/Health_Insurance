<form method= "post" action="{{url('users/handlelogin')}}">@csrf
<div>
    <input name="username" placeholder="Enter Username" type='text'><br>
    <input name="password" placeholder="Enter Password" type='text'><br>
</div>
    <input type='submit' value="Login"> <br>
    </form>
    