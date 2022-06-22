<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>verification Email</title>
</head>
<body>
<h2>Hi {{$mailData['name']}}</h2>
<p>This is Email to Reset your password on Elokaily app please click <span><a href="{{Route('auth.reset_password' , $mailData['id'])}}">here </a></span>if you want to reset your password</p>
</body>
</html>

