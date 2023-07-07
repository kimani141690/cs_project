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
<form method="POST" action="/auth/cust_details">
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
    <input type="text" id="profile_photo" name="profile_photo" required>
    <br>
    <button type="submit">Update</button>

</form>


</body>
</html>
