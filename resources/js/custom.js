// Wait for the document to be ready
document.addEventListener('DOMContentLoaded', function() {
    // Get the register link element
    var registerLink = document.getElementById('registerLink');

    // Add a click event listener to the register link
    registerLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the link
        $('#userTypeModal').modal('show'); // Show the modal
    });
});
