<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Registration Form</title>


    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
          rel="stylesheet">

    <!-- Vendor CSS-->

    <!-- Main CSS-->
    <link rel="stylesheet" media="all" href="{{asset('css/auth_css/registration.css')}}">

</head>

<body>

@extends('layouts.master')


<div class="page-wrapper p-t-180 p-b-100 font-robo" style="background-color:#006A4E;">
    <div class="wrapper wrapper--w960">
        <div class="card card-2">
            <div class="card-heading"></div>
            <div class="card-body">
                <h4 class="title">{{$user_type}} Registration Page</h4>

                <form method="POST" action="/auth/registration">
                    @csrf
                    <div>
                        <div>
                            <div class="input-group">
                                <input class="input--style-2" type="text" required placeholder="User Name" name="username">
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <input class="input--style-2" type="email" required autocomplete="off" placeholder="Email"
                               name="email">
                    </div>
                    <div class="p-t-30">
                        <input type="hidden" name="user_type" value="{{$user_type}}">
                        <button type="reset" style="color: black" class="btn btn--radius btn--green">Reset</button>
                        <button style="margin-left:85px; " class="btn btn--radius btn--green" type="submit">Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>




