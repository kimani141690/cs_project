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
<form action="submit_profile.php" method="POST">
    @csrf
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="Username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="contact">Contact:</label>
    <input type="text" id="contact" name="contact" required>
    <br>
    <br>
    <label for="profile_photo">Profile photo</label>
    <input type="text" id="profile_photo" name="profile_photo" required>
    <br>
    <button type="submit">Update</button>

</form>
<h1>Farm Details</h1>
<form action="submit_profile.php" method="POST">
    @csrf
    <label for="farmName">Farm Name:</label>
    <input type="text" id="farmName" name="farmName" required>
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required>
    <br>
    <label for="farmdescription">Farm Description:</label>
    <input type="text" id="farmdescription" name="farmdescription" required>
    <br>
    <br>
    <label for="numCattle">Number of Cattle:</label>
    <input type="number" id="numCattle" name="numCattle" required>
    <br>
    <div>
        <h2>select the animal breed(s) you keep</h2>
        <label for="breed" name=breed>Breed:</label>

        <input type="checkbox" name="breed[]" value="Jersey"> Holstein
        <input type="checkbox" name="breed[]" value="Guernsey"> Guernsey
        <input type="checkbox" name="breed[]" value="Ayshire"> Ayshire
        <input type="checkbox" name="breed[]" value="Freshian"> Freshian
        <input type="checkbox" name="breed[]" value="Brownswiss"> Brownswiss

    </div>
    <br>
    <button>Save Farm Details</button>
</form>


</body>
</html>
