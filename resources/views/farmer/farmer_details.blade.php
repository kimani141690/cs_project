<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>


</head>
<body>
<h1>Personal Details</h1>
<form action="{{ route('farmers_details') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h1>Personal details section</h1>

    <label for="contact">Contact:</label>
    <input type="text" id="contact" name="contact" required>
    <br>
    <label for="location"> Location:</label>
    <input type="text" id="location" name="location" required>
    <br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>
    <br>
    <label for="profile_photo">Profile photo</label>
    <input type="file" id="profile_photo" name="profile_photo" required>
    <br>
    <input type="hidden" name="user_id" value="{{ $userId }}">

    <button type="submit">Update</button>
</form>




</body>
</html>
