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
    <title>Reset Password</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link rel="stylesheet"  media="all" href="{{asset('css/auth_css/registration.css')}}">

</head>

<body>
    <div class="page-wrapper p-t-180 p-b-100 font-robo" style="background-color:#006A4E;">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h3 class="title">Reset Password</h3>
                    <form method="POST" action="/auth/reset-password">
                        @csrf

                        <div>
                            <div>
                                <div class="input-group">
                                    <input class="input--style-2" type="password" id="newpassword" placeholder="New Password " minlength="8">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <div class="input-group">
                                    <input class="input--style-2" type="password" id="confirmpassword" placeholder="Confirm Password " minlength="8" name="new_password">
                                </div>
                            </div>
                        </div>

                        <div class="p-t-30">
                            <input  type="hidden" name="token" value="{{$token}}">
                            <button class="btn btn--radius btn--green" type="submit">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <scr>
        <script>
            $(document).ready(function() {
                $('#confirmpassword').on('keyup', function() {
                    var newPassword = $('#newpassword').val();
                    var confirmPassword = $(this).val();

                    if (newPassword !== confirmPassword) {
                        $('#password-error').text('Passwords do not match');
                    } else {
                        $('#password-error').text('');
                    }
                });
            });
        </script>

    </scr>
</body>

</html>
<!-- end document-->
