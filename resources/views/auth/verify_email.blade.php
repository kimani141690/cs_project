<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>
<body>
<h1>Hey there {{$user}},Welcome to our SmartFarmer.</h1>
<p>Below arw your login credentials</p>
<p>Email:{{$user_email}}</p>
<p>Password:{{$user_password}}</p>


<p>Please click <a href="/user/verify-email/{{$tokenID}}/{{$token}}">here</a> to verify your email address.</p>

<p>If you did not receive a verification email, please click the button below to resend it.</p>
<br>

<button type="button" class="btn btn-primary"  id="resetpassword" >Reset Password</button>
<a href="{{ 'http://127.0.0.1:8080/auth/resetpassword/' . $user_id }}">Reset here</a>

<script>
    {{--$(document).ready(function() {--}}
    {{--    $('#resendVerificationEmailButton').click(function() {--}}
    {{--        $.ajax({--}}
    {{--            url: '/resend-verification-email',--}}
    {{--            type: 'POST',--}}
    {{--            data: {--}}
    {{--                email: '{{ $email }}',--}}
    {{--            },--}}
    {{--            success: function(data) {--}}
    {{--                if (data.success) {--}}
    {{--                    alert('Verification email has been sent.');--}}
    {{--                } else {--}}
    {{--                    alert('There was an error resending the verification email.');--}}
    {{--                }--}}
    {{--            },--}}
    {{--            error: function(error) {--}}
    {{--                alert('There was an error resending the verification email.');--}}
    {{--            }--}}
    {{--        });--}}
    {{--    });--}}
    {{--});--}}
</script>
</body>
</html>
