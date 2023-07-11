<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>


</head>
<body>
{{--<h1>Fill In further details abot yourself to proceed</h1>--}}{{-- make this a modal--}}
<h1>Personal Details</h1>
<h2>You are being redirected ro this page to fill some personal details before proceeding</h2>
<form method="POST" action="/customer/cust_details" enctype="multipart/form-data">
    @csrf

    <label for="contact">Contact:</label>
    <input type="text" id="contact" name="contact" required>
    <br>
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required>
    <br>
    <label for="homeadress">Home Address:</label>
    <input type="text" id="homeadress" name="homeadress" required>
    <br>

    <label for="profile_photo">Profile photo</label>
    <input type="file" id="profile_photo" name="profile_photo" required>
    <br>

    <input type="hidden" name="user_id" value="{{ $userId }}">

    <button type="submit">Update</button>

</form>


</body>
</html>
