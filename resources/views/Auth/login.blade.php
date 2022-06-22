<!DOCTYPE html>
<html lang="en">
<body>
<form action="{{route('auth.check')}}" method="post">
    @csrf
    <div class="container">
        <label for="Email"><b>Email</b></label>
        <input id="Email" type="text" placeholder="Enter your email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input id="psw" type="password" placeholder="Enter Password" name="password" required>

        <div class="alert alert-danger">
            @if (Session::has('error'))
                {{Session::get('error')}}
            @endif
        </div>
        <button type="submit">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <span class="psw"><a href="{{route('auth.forget')}}">Forget password?</a></span>
        <br>
        <span ><a href="{{route('auth.register')}}">Register</a></span>
    </div>
</form>
</body>
</html>
