<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bing Maps with Pointers from Database</title>
    <style>
        /* Add some basic styling */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script>
        // Function to initialize Bing Map
        function initMap() {
            // Load Bing Maps SDK
            Microsoft.Maps.loadModule('Microsoft.Maps.Map', function () {
                // Create a map instance
                const map = new Microsoft.Maps.Map('#map', {
                    credentials: 'AqgUdVozGG-zX5cDIPjXIUo7aaqMe9z8uK2Gdce8dTV6qneLNm-HsU1W5yBb4Q4o', // Replace with your Bing Maps API key
                    center: new Microsoft.Maps.Location(0, 0), // Default center
                    zoom: 2 // Default zoom
                });

                // Parse the JSON response with location data fetched from PHP
                const locations = <?php echo json_encode($locations); ?>;

                // Add pointers for each location
                locations.forEach(location => {
                    const pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(location.lat, location.lng), {
                        icon: 'https://www.bingmapsportal.com/Content/images/poi_custom.png' // URL to custom pointer icon
                    });
                    map.entities.push(pin);
                });
            });
        }

        // Execute initMap when the page is loaded
        window.onload = initMap;
    </script>

    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=initMap' async defer></script>
</body>
</html>

<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch latitude and longitude from the database
$sql = "SELECT lan, lon FROM placedata";
$result = $conn->query($sql);

// Prepare an array to hold the location data
$locations = array();

// Loop through the query result and store the latitude and longitude in the locations array
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locations[] = array(
            'lat' => $row['lan'],
            'lng' => $row['lon']
        );
    }
}

// Close the database connection
$conn->close();
?>
