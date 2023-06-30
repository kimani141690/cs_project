<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>
<body>
<h1>Reset Password.</h1>
<h1>Hey there {{$user}},Welcome to our SmartFarmer .</h1>
<p>Email:{{$user_email}}</p>
<p>Password:{{$user_password}}</p>


<p>Please click <a href="/user/verify-email/{{$tokenID}}/{{$token}}">here</a> to verify your email address.</p>
<p>To  reset your password Clink the link below</p>

<p>Click the button below to reset password.</p>
<br>

<button type="button" class="btn btn-primary" id="resetpassword">
    <a href="{{ 'http://127.0.0.1:8000/auth/resetpassword/' . $user_id.'' }}">Reset here</a>
</button>

</body>
</html>
