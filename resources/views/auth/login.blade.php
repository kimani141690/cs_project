<!DOCTYPE html>
<html lang="en">

<head>
    <x-header-tag></x-header-tag>
    <title>Registration Form</title>
</head>

<body>
<div class="page-wrapper p-t-180 p-b-100 font-robo" style="background-color:#006A4E;">
    <div class="wrapper wrapper--w960">
        <div class="card card-2">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title">Login Page</h2>
                <form method="POST" action="/auth/processLogin" autocomplete="off">
                    @csrf

                    <div class="input-group">
                        <input class="input--style-2" type="email" placeholder="Email " name="email" autofocus>
                    </div>

                    <div class="input-group">
                        <input class="input--style-2" type="password" placeholder="Password " minlength="8" name="password">
                    </div>

                    <div class="w-50" style="margin-top: 30px;">
                        <input type="checkbox" style="width: 20px;" checked id="remember" name="remember">

                        <label class="checkbox-wrap checkbox-primary" style="display: flex; align-items:center; ">
                            Remember Me &nbsp; &nbsp;
                        </label>

                        <button class="btn btn--radius btn--green" type="submit" style="margin-top:10px;">Login</button>
                    </div>

                </form>
                <button class="btn btn--radius btn--green" type="submit" name="btn_reset" style="margin-top:10px;">


                <a href="/auth/enteremail"> Reset Password</a>

                   </button>


                <div class="w-50" style="margin-top: 30px;">
                    <button class="btn btn--radius btn--green" id="myBtn">Dont' have an account?</button>
                    &nbsp; &nbsp;
                    {{--<a href="/auth/resetPassword" style="text-decoration: none; color:black;">Forgot password ?</a>--}}
                </div>


                <div id="myModal" class="modal">


                    <div class="modal-content">
                        <span class="close"> </span>
                        <div>
                            <h1>Select User Type</h1>
                        </div>

                        <div style="display: block; justify-content: space-between;">
                            <button style="padding-bottom: 10px; padding-top: 5px; background-color: #006A4E;">
                                <a href="/auth/farmer-reg" style="text-decoration: none; color: white; ">Farmer</a>
                            </button>

                            <button style="padding-bottom: 10px; padding-top: 5px; background-color: #006A4E;">
                                <a href=" /auth/customer-reg" style="text-decoration: none; color: white; ">Customer</a>
                            </button>
                        </div>
                    </div>
                </div>

                <br><br>

                <p style="margin-left: 50%;">-or-</p>
                <br>
                <button class="btn btn--radius btn--green">
                    <a href={{route('google.login')}} style="text-decoration: none; justify-items: center;">Sign In With
                       <i class="fab fa-google-f fa-fw">Login with google</i>
                    </a>
                </button>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/registerModal.js') }}"></script>


</body>

</html>
