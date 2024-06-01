
<?php
// Database credentials
// error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectdb";

// Create connection
// $conn = mysqli_connect($sname,$username,$password,$database);
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $placeName = $_POST['placeName'];
    $placeType = $_POST['placeType'];
    $ownerName = $_POST['ownerName'];
    $ownerEmail = $_POST['ownerEmail'];
    $ownerNumber = $_POST['ownerNumber'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $sql = "INSERT INTO placedata (pname, ptype, oname, oemail, omno, lat, lon)
            VALUES ('$placeName', '$placeType', '$ownerName', '$ownerEmail', '$ownerNumber', '$latitude', '$longitude')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessible Places Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f0f0f0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .logo img {
            height: 50px;
        }

        .site-name {
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            text-decoration: none;
            margin-right: 1000px; /* Adjusted margin for better spacing */
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 0 5px;
            border-radius: 5px;
            background-color: #555;
        }

        .nav-links a:hover {
            background-color: #777;
        }

        #map {
            height: 60vh; /* Adjusted height for better visibility */
            width: 100%;
            margin-top: 20px; /* Adjusted margin for better spacing */
        }

        .formContainer {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        form {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        fieldset {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .input_field {
            margin-top: 20px;
        }

        button {
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        #latitude,
        #longitude {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<header>
        <div class="navbar">
            <div class="logo">
                <img src="logo.png" alt="Accessible Places Logo">
            </div>
            <a class="site-name" href="#">NaviAble</a>
            <div class="nav-links">
                <a href="#" onclick="redirectTo('final.php')">Logout</a>
            </div>
        </div>
    </header>
    <div id="map"></div>
    <div class="formContainer">
    <form id="place-form" method="POST" action = "#">
        <h2>Register a New Accessible Place</h2>
        <label for="placeName">Place Name:</label>
        <input type="text" id="placeName" name="placeName" required>
        
        <label for="placeType">Place Type:</label>
        <select id="placeType" name="placeType" required>
            <option value="choose">--Select the type of place--</option>
            <option value="restaurant">Restaurant</option>
            <option value="hospital">Hospital</option>
            <option value="cafe">Cafe</option>
            <option value="school">School</option>
            <option value="college">College</option>
            <option value="Shopping mall">Shopping Mall</option>
            <option value="movie theater">Movie Theater</option>
            <option value="Religious Places">Religious Places</option>
            <option value="bus stand">Bus stand</option>
            <option value="railways">Railways Station</option>
        </select>

        <label for="ownerName">Owner's Name:</label>
        <input type="text" id="ownerName" name="ownerName" required>

        <label for="ownerEmail">Owner's Email:</label>
        <input type="email" id="ownerEmail" name="ownerEmail" required>

        <label for="ownerNumber">Owner's Contact Number:</label>
        <input type="text" id="ownerNumber" name="ownerNumber" required>
        Latitude: <input type="text" id="latitude" name="latitude" readonly><br>
        Longitude: <input type="text" id="longitude" name="longitude" readonly><br>
        <br>
        <button type="submit">SUBMIT PLACE</button>
    </form>
</div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var map = L.map('map').setView([51.505, -0.09], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add the geocoder control to the map
            var geocoder = L.Control.geocoder({
                defaultMarkGeocode: false
            })
            .on('markgeocode', function(e) {
                var bbox = e.geocode.bbox;
                var poly = L.polygon([
                    [bbox.getSouthEast().lat, bbox.getSouthEast().lng],
                    [bbox.getNorthEast().lat, bbox.getNorthEast().lng],
                    [bbox.getNorthWest().lat, bbox.getNorthWest().lng],
                    [bbox.getSouthWest().lat, bbox.getSouthWest().lng]
                ]).addTo(map);
                map.fitBounds(poly.getBounds());
            })
            .addTo(map);

            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            });
        });

        function redirectTo(page) {
            window.location.href = page;
        }

        function submitPlace() {
            // Implement form submission logic here
            alert("Form submitted!");
        }
    </script>
</body>
</html>
