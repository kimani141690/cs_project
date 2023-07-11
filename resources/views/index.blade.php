<!DOCTYPE html>
<html lang="en">

<head>
    <x-header-tag></x-header-tag>
    <title>Index Page</title>
</head>

<body>

<!-- Hero Section, Background Image change in css -->
<div id="top" class="hero background-overlay" style="display: flex; flex-direction: column;">
    <div class="navbar">
        <!-- Navigation -->
        <ul>
            <li class="page-scroll"><a href="#about">About</a></li>
            <li class="page-scroll"><a href="#services">Services</a></li>
            <li class="page-scroll"><a href="/auth/login">Login</a></li>
            <li class="page-scroll"><a href="#contact">Contact</a></li>
        </ul>
    </div>


    <div class="hero-content">
        <h1 style="font-size: 35px;">HELLO &amp; WELCOME TO SMART FARMER:</h1>
        <h2>WHERE FARMERS AND<br/>CUSTOMERS CAN INTERACT. </h2>
    </div>

    @if($errors->has('error'))
        <div id="myModal" class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close"> </span>
                <div>
                    <h1>{{ $errors->first('error') }}</h1>
                </div>
            </div>
        </div>
    @endif

</div>

<script src="{{ asset('js/registerModal.js') }}"></script>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>

</html>
