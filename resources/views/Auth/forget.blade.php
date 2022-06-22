<!DOCTYPE html>
<html lang="en">
<div class="container">
    <div class="alert alert-success">
        @if (Session::has('error'))
            {{Session::get('error')}}
        @endif
    </div>
    <form method="post" action="{{route('auth.send_password_mail')}}">
        @csrf
        <label for="email">Email</label>
        <input type="text" id="email" name="email" required>
        <input type="submit" value="Send">
    </form>
</div>
</html>
