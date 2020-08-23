<form method= "post" action="{{url('users/handleregister')}}">@csrf
    <div>
        <input name="username" placeholder="Enter Username" type='text'><br>
        <input name="password" placeholder="Enter Password" type='text'><br>
        <input name="managedby" placeholder="Managed By" type='text'><br>
        <input name="gender" placeholder="Gendery" type='text'><br>
    </div>
        <input type='submit' value="Register"> <br>
        </form>
        