<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>verification Email</title>
</head>
<body>
    <h2>Hi {{$details['name']}}</h2>
    <p>This is Email to verification your email if you want to verification your email please click <span><a href="{{Route('auth.verification' , $details['id'])}}">here</a></span></p>
</body>
</html>

