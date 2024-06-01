// Initialize the map
const map = L.map('map').setView([0, 0], 2);

// Add a tile layer (you can replace this with other tile providers)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Add a marker on click
map.on('click', onMapClick);

function onMapClick(e) {
    //alert("You clicked the map at coordinates: " + e.latlng.lat + ", " + e.latlng.lng);
    // Open the form when clicking on the map
    document.getElementById('formContainer').style.display = 'block';


    // Set the form location fields with the clicked coordinates
    document.getElementById('latitude').value = e.latlng.lat;
    document.getElementById('longitude').value = e.latlng.lng;
    //alert("You clicked the map at coordinates: " + e.latlng.lat + ", " + e.latlng.lng);

}

document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('place-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Fetch the form data
        var formData = new FormData(form);

        // Perform asynchronous POST request to the server
        fetch('adminpage.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Assuming the server responds with JSON
        .then(data => {
            // Handle the response from the server
            if (data.success) {
                alert('Registration successful!');
                window.location.href = "adminpage.php";
            } else {
                alert('Registration failed. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
