<!DOCTYPE html>
<html lang="en">
<div class="container">
    <form action="{{route('auth.update_password')}}" method="post">
        @csrf
        <input type="text" name="id" required hidden value="{{$id}}">

        <label for="password1">Password</label>
        <input type="text" id="password1" name="password1" required>
        <br>

        <label for="password2">Confirm password</label>
        <input type="text" id="password2" name="password2" required>


        <input type="submit" value="Confirm">
    </form>
</div>
</html>
