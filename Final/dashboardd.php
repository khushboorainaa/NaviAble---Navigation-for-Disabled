<?php
// Database connection credentials
$host = 'localhost'; // or your database host
$dbname = 'projectdb';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch coordinates and names from the database
    $query = "SELECT pname,lat,lon FROM placedata";
    $result = $pdo->query($query);

    $locations = array(); // Array to store locations

    // Fetching data and storing it in the array
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $locations[] = $row;
    }

    // Encode locations array as JSON
    $locations_json = json_encode($locations);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessible Information and Navigation Platform Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Basic CSS for the dashboard layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            margin: 10px 0;
            width: 100%;
            padding: 10px 20px;
            text-align: left;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .sidebar a.active {
            background: #1abc9c;
        }
        .main-content {
            flex: 1;
            background: #ecf0f1;
            padding: 20px;
            overflow-y: auto;
        }
        .navbar {
            width: 100%;
            background: #34495e;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }
        .navbar .user-info {
            display: flex;
            align-items: center;
        }
        .navbar .user-info img {
            border-radius: 50%;
            width: 40px;
            margin-right: 10px;
        }
        .navbar .logout {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 20px;
        }
        .content {
            margin-top: 20px;
        }
        .content .card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .content .card h2 {
            margin-top: 0;
        }
        .content .card .map {
            height: 300px;
            background: #bdc3c7;
        }
        .content .chart {
            height: 300px;
            background: #bdc3c7;
        }
        .sidebar .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .sidebar .logo img {
            width: 150px;
            height: 70px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="NaviAble Logo">
            <!-- <h2>NaviAble</h2> -->
        </div>
        <a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="location.php"><i class="fas fa-map-marker-alt"></i> Accessible Locations</a>
        <a href="#"><i class="fas fa-users"></i> User Place Register</a>
        <a href="report.php"><i class="fas fa-chart-line"></i> Reports</a>
    </div>
    <div class="main-content">
        <div class="navbar">
            <h1>Dashboard</h1>
            <h1>Welcome Admin</h1>
            <button class="logout" onclick="location.href='final1.php'">Logout</button>
        </div>
        <div class="content">
            <div class="card">
                <h2>Overview</h2>
                <div class="stats">
                    <!-- Dynamic statistics content -->
                    <p>Registered Accessible Locations: 123</p>
                    <p>Total Users: 456</p>
                    <p>Feedback Received: 789</p>
                </div>
            </div>
            <div class="card">
                <h2>Map View</h2>
                <div class="map" id="map"></div> <!-- Placeholder for the map -->
            </div>
            <div class="card">
                <h2>Feedback</h2>
                <div class="feedback">
                    <!-- Dynamic feedback content -->
                    <p>User1: Great accessibility at XYZ location!</p>
                    <p>User2: Could use more ramps at ABC park.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script> <!-- Chart.js library -->
    <script>
    // Pass locations data to JavaScript
    var locations = <?php echo $locations_json; ?>;

// Function to initialize Bing Map
    function initMap() {
        // Check if Microsoft.Maps is defined
        if (typeof Microsoft !== 'undefined' && Microsoft.Maps) {
            // Create a map instance
            var map = new Microsoft.Maps.Map(document.getElementById('map'), {
                credentials: 'AqgUdVozGG-zX5cDIPjXIUo7aaqMe9z8uK2Gdce8dTV6qneLNm-HsU1W5yBb4Q4o', // Replace with your Bing Maps API key
                center: new Microsoft.Maps.Location(32.7266, 74.8570), // Default center
                zoom: 12 // Default zoom
            });

            // Create an infobox but don't show it yet
            var infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
                visible: false
            });
            infobox.setMap(map);

            // Add pointers for each location
            locations.forEach(location => {
                var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(location.lat, location.lon), {
                    title: location.pname // Set the title to the place name
                });

                // Add a click event to the pin to display the infobox
                Microsoft.Maps.Events.addHandler(pin, 'click', function () {
                    infobox.setOptions({
                        location: pin.getLocation(),
                        title: location.pname,
                        visible: true
                    });
                });

                map.entities.push(pin);
            });
        } else {
            console.error('Microsoft Maps library is not loaded.');
        }
    }

    // Load Bing Maps script dynamically
    var script = document.createElement('script');
    script.src = 'https://www.bing.com/api/maps/mapcontrol?key=AqgUdVozGG-zX5cDIPjXIUo7aaqMe9z8uK2Gdce8dTV6qneLNm-HsU1W5yBb4Q4o&callback=initMap';
    script.defer = true;
    script.onload = function() {
        console.log('Bing Maps script loaded successfully.');
    };
    script.onerror = function() {
        console.error('Error loading Bing Maps script.');
    };
    document.head.appendChild(script);
    </script>

</body>
</html>
