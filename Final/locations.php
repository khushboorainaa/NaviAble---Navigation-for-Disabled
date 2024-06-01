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

// SQL query to fetch data from placedata table
$sql = "SELECT pname, descp, omno FROM placedata";
$result = $conn->query($sql);

// Fetch data and store in an array
$locations = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
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
$sql = "SELECT COUNT(*) as total FROM signup";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    $totalUsers = $row['total'];
} else {
    $totalUsers = 0;
}

$sql = "SELECT COUNT(*) as total FROM reachus";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    $totalfeedback = $row['total'];
} else {
    $totalfeedback = 0;
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessible Locations in J&K</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
        .navbar .back-link a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
        }
        .navbar .back-link a i {
            margin-right: 8px;
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
        h2 {
            text-align: center;
            margin-top: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f2f2f2;
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
        <a href="locations.php" class="active"><i class="fas fa-map-marker-alt"></i> Accessible Locations</a>
        <a href="requests.php"><i class="fas fa-users"></i> User Place Register</a>
        <a href="REPORT.php"><i class="fas fa-chart-line"></i> Reports</a>
        <a href="feedback.php"><i class="fas fa-comments"></i> Feedback</a>
    </div>
    <div class="main-content">
    <div class="navbar">
            <h1>Govt. of Jammu and Kashmir</h1>
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
                <h2>List of Accessible Locations in J&K</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Place Name</th>
                            <th>Description</th>
                            <th>Phone No</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($locations)): ?>
                            <?php foreach ($locations as $location): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($location['pname']); ?></td>
                                    <td><?php echo htmlspecialchars($location['descp']); ?></td>
                                    <td><?php echo htmlspecialchars($location['omno']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" style="text-align: center;">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
