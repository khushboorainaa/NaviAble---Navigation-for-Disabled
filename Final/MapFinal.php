<?php
// Database connection parameters
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "projectdb"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $placeName = $conn->real_escape_string($_POST['placeName']);
    $placeType = $conn->real_escape_string($_POST['placeType']);
    $ownerName = $conn->real_escape_string($_POST['ownerName']);
    $ownerEmail = $conn->real_escape_string($_POST['ownerEmail']);
    $ownerNumber = $conn->real_escape_string($_POST['ownerNumber']);
    $latitude = $conn->real_escape_string($_POST['latitude']);
    $longitude = $conn->real_escape_string($_POST['longitude']);
    $description = $conn->real_escape_string($_POST['description']);
    $state = $conn->real_escape_string($_POST['state']);
    $googleMapsUrl = $conn->real_escape_string($_POST['googleMapsUrl']);

    // Insert data into database
    $sql = "INSERT INTO placedata (pname, ptype, oname, oemail, omno, lat, lon, descp, stateut, directions)
            VALUES ('$placeName', '$placeType', '$ownerName', '$ownerEmail', '$ownerNumber', '$latitude', '$longitude', '$description', '$state', '$googleMapsUrl')";

    if ($conn->query($sql) === TRUE) {
        // JavaScript to show pop-up and redirect after 2 seconds
        echo "<script>
                setTimeout(function() {
                    alert('Request Generated');
                    window.location.href = 'user_homepage.php';
                }, 2000);
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessible Places Map</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f0f0f0;
        }

        header {
            background-color: #0056a6;
            color: white;
            padding: 5px;
            text-align: center;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .logo img {
            height: 50px;
        }

        .site-name {
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            text-decoration: none;
            margin-right: 1000px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 0 5px;
            border-radius: 5px;
            background-color: #e74c3c;
        }

        .nav-links a:hover {
            background-color: #e74c3c;
        }

        #map {
            position: relative;
            height: 60vh;
            width: 100%;
            margin-top: 20px;
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


        .input_field {
            margin-top: 20px;
        }

        button {
            margin-top:10px;
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

        .searchContainer {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            width: 80%;
            max-width: 600px;
            z-index: 1000;
        }

        #searchInput {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
        }

        #searchIcon {
            background-color: transparent;
            color: #0056a6;
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-left: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
#mapContainer {
    position: relative;
    width: 100%;
    height: 60vh;
}

#map {
    width: 100%;
    height: 100%;
}

.searchContainer {
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    background-color: rgba(255, 255, 255, 0.8); /* Transparent background for better visibility */
    padding: 10px;
    border-radius: 5px;
    display: flex;
    align-items: center;
}

#searchInput {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px 0 0 4px;
}

#searchIcon {
    background-color: transparent;
    color: #0056a6;
    padding: 10px; /* Adjust padding as needed */
    border: none;
    cursor: pointer;
}

        #suggestions {
            display: none;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            top: 50px;
            width: 100%;
            z-index: 1000;
        }

        .suggestion {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion:hover {
            background-color: #f0f0f0;
        }
    </style>
    <script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AqgUdVozGG-zX5cDIPjXIUo7aaqMe9z8uK2Gdce8dTV6qneLNm-HsU1W5yBb4Q4o' async defer></script>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="logo.png" alt="Accessible Places Logo">
            </div>
            <!-- <a class="site-name" href="#">NaviAble</a> -->
            <div class="nav-links">
                <a href="#" onclick="redirectTo('final1.php')">Logout</a>
            </div>
        </div>
    </header>
    <div id="mapContainer">
    <div id="map"></div>
    <div class="searchContainer">
        <input type="text" id="searchInput" placeholder="Enter location..." oninput="suggestLocations()" onkeypress="handleEnter(event)">
        <div id="searchIcon" onclick="searchLocation()">
            <i class="fas fa-search"></i>
        </div>
    </div>
    <div id="suggestions"></div>
</div>

<div class="formContainer">
    <form id="place-form" method="POST" action="#">
        <h2>Register a New Accessible Place</h2>
        
        <label for="placeName">Place Name:</label>
        <input type="text" id="placeName" name="placeName" required>
        
        <label for="placeType">Place Type:</label>
        <select id="placeType" name="placeType" required>
            <option value="choose">--Select the type of place--</option>
            <option value="Hospital">Hospital</option>
            <option value="College">College</option>
            <option value="School">School</option>
            <option value="Railway Station">Railway Station</option>
            <option value="Airport">Airport </option>
            <option value="Others">Others </option>
        </select>

        <label for="ownerName">Owner's Name:</label>
        <input type="text" id="ownerName" name="ownerName" required>

        <label for="ownerEmail">Owner's Email:</label>
        <input type="email" id="ownerEmail" name="ownerEmail" required>

        <label for="ownerNumber">Owner's Contact Number:</label>
        <input type="text" id="ownerNumber" name="ownerNumber" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="80"></textarea>

        <label for="googleMapsUrl">Location:</label>
        <input type="text" id="googleMapsUrl" name="googleMapsUrl" required>

        <br>Latitude: <input type="text" id="latitude" name="latitude" readonly><br>
        Longitude: <input type="text" id="longitude" name="longitude" readonly><br>

        <label for="state">State:</label>
        <select id="state" name="state" required>
            <option value="" selected disabled>Select State</option>
            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
            <option value="Others">Others</option>
        </select>

        <button type="submit">SUBMIT PLACE</button>
    </form>
</div>


    <script>
        let map, searchManager, marker;

        function GetMap() {
            map = new Microsoft.Maps.Map('#map', {
                center: new Microsoft.Maps.Location(32.716000444176785, 74.86459598354983),
                zoom: 13
            });

            // Add click event to add marker on the map
            Microsoft.Maps.Events.addHandler(map, 'click', function (e) {
                var point = new Microsoft.Maps.Point(e.getX(), e.getY());
                var loc = e.target.tryPixelToLocation(point);

                if (!marker) {
                    marker = new Microsoft.Maps.Pushpin(loc, {
                        draggable: true
                    });
                    map.entities.push(marker);
                } else {
                    marker.setLocation(loc);
                }

                document.getElementById('latitude').value = loc.latitude;
                document.getElementById('longitude').value = loc.longitude;
            });

            // Load search manager
            Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
                searchManager = new Microsoft.Maps.Search.SearchManager(map);
            });
        }

        function searchLocation() {
            const query = document.getElementById('searchInput').value;
            if (query.length >= 3 && searchManager) {
                const requestOptions = {
                    where: query,
                    callback: function (answer, userData) {
                        if (answer && answer.results && answer.results.length > 0) {
                            const location = answer.results[0].location;
                            if (!marker) {
                                marker = new Microsoft.Maps.Pushpin(location, {
                                    draggable: true
                                });
                                map.entities.push(marker);
                            } else {
                                marker.setLocation(location);
                            }

                            map.setView({ center: location, zoom: 13 });
                            document.getElementById('latitude').value = location.latitude;
                            document.getElementById('longitude').value = location.longitude;
                        }
                    }
                };
                searchManager.geocode(requestOptions);
            }
        }

        function suggestLocations() {
            const query = document.getElementById('searchInput').value;
            if (query.length >= 3 && searchManager) {
                const suggestionsRequest = {
                    query: query,
                    callback: function (suggestions) {
                        const suggestionsList = document.getElementById('suggestions');
                        suggestionsList.innerHTML = '';
                        if (suggestions && suggestions.length > 0) {
                            suggestionsList.style.display = 'block';
                            suggestions.forEach(suggestion => {
                                const suggestionItem = document.createElement('div');
                                suggestionItem.className = 'suggestion';
                                suggestionItem.innerText = suggestion.displayText;
                                suggestionItem.onclick = () => {
                                    document.getElementById('searchInput').value = suggestion.displayText;
                                    suggestionsList.style.display = 'none';
                                    searchLocation();
                                };
                                suggestionsList.appendChild(suggestionItem);
                            });
                        } else {
                            suggestionsList.style.display = 'none';
                        }
                    },
                    errorCallback: function (error) {
                        console.error(error);
                    }
                };
                searchManager.suggest(suggestionsRequest);
            }
        }

        function handleEnter(event) {
            if (event.key === 'Enter') {
                searchLocation();
            }
        }

        function redirectTo(page) {
            window.location.href = page;
        }

        function submitPlace() {
            alert("Form submitted!");
        }

        // Initialize the map when the page loads
        document.addEventListener('DOMContentLoaded', GetMap);
    </script>
</body>

</html>
