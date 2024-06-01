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

// SQL query to count the number of rows in placedata table
$sql = "SELECT COUNT(*) as total FROM placedata";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    $totalLocations = $row['total'];
} else {
    $totalLocations = 0;
}

// SQL query to count the number of rows in signup table
$sql = "SELECT COUNT(*) as total FROM signup";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    $totalUsers = $row['total'];
} else {
    $totalUsers = 0;
}

// SQL query to count the number of rows in reachus table
$sql = "SELECT COUNT(*) as total FROM reachus";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    $totalfeedback = $row['total'];
} else {
    $totalfeedback = 0;
}

// SQL query to get the counts for each ptype
$ptypeCounts = [];
$ptypes = ['Hospital', 'College', 'School', 'Railway Station', 'Airport', 'Others'];

foreach ($ptypes as $ptype) {
    $sql = "SELECT COUNT(*) as total FROM placedata WHERE ptype = '$ptype'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ptypeCounts[$ptype] = $row['total'];
    } else {
        $ptypeCounts[$ptype] = 0;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - AINP Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .navbar .back-link {
            display: flex;
            align-items: center;
        }
        .navbar .back-link a {
            color: white;
            text-decoration: none;
        }
        .navbar .back-link a:hover {
            text-decoration: underline;
        }
        .navbar .back-button {
            background: #3498db;
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
        .chart-container {
            position: relative;
            height: 400px;
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
        </div>
        <a href="dashHboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="locations.php"><i class="fas fa-map-marker-alt"></i> Accessible Locations</a>
        <a href="requests.php"><i class="fas fa-users"></i> User Place Register</a>
        <a href="reports.php" class="active"><i class="fas fa-chart-line"></i> Reports</a>
        <a href="feedback.php"><i class="fas fa-comments"></i> Feedback</a>
    </div>
    <div class="main-content">
        <div class="navbar">
            <h1>Reports</h1>
            <button class="back-button" onclick="location.href='dashHboard.php'">Back</button>
        </div>
        <div class="content">
            <div class="card">
                <h2>Overview</h2>
                <div class="stats">
                    <p>Total Registered Accessible Locations: <?php echo $totalLocations; ?></p>
                    <p>Total Users: <?php echo $totalUsers; ?></p>
                    <p>Feedback Received: <?php echo $totalfeedback; ?></p>
                </div>
            </div>
            <div class="card">
                <h2>Accessibility Features Chart</h2>
                <div class="chart-container">
                    <canvas id="featuresChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        // Data for the insights
        const ptypeCounts = <?php echo json_encode(array_values($ptypeCounts)); ?>;
        const ptypes = <?php echo json_encode(array_keys($ptypeCounts)); ?>;

        // Bar chart for accessibility features
        const ctx = document.getElementById('featuresChart').getContext('2d');
        const featuresChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ptypes,
                datasets: [{
                    label: 'Place Type',
                    data: ptypeCounts,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(201, 203, 207, 0.7)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(201, 203, 207, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Places';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Places'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Analysis'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
