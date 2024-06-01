<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
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
        .content .card .feedback-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .content .card .feedback-box:last-child {
            margin-bottom: 0;
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
        <a href="dashHboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="locations.php"><i class="fas fa-map-marker-alt"></i> Accessible Locations</a>
        <a href="requests.php"><i class="fas fa-users"></i> User Place Register</a>
        <a href="report.php"><i class="fas fa-chart-line"></i> Reports</a>
        <a href="feedback.php"><i class="fas fa-comments"></i> Feedback</a>
    </div>
    <div class="main-content">
        <div class="navbar">
            <h1>Govt. of Jammu and Kashmir</h1>
            <button class="back-button" onclick="location.href='dashHboard.php'">Back</button>
        </div>
        <div class="content">
            <div class="card">
                <h2>Feedbacks / Reviews</h2>
                <div class="feedback">
                    <?php
                    // Database connection credentials
                    $servername = 'localhost'; // or your database host
                    $dbname = 'projectdb';
                    $username = 'root';
                    $password = '';

                    try {
                        // Create a new PDO instance
                        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Fetch feedback from the database
                        $query = "SELECT name, msg FROM reachus";
                        $result = $pdo->query($query);

                        // Display feedback
                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<div class="feedback-box">';
                                echo '<p><strong>Name:</strong> ' . htmlspecialchars($row["name"]) . '</p>';
                                echo '<p><strong>Message:</strong> ' . htmlspecialchars($row["msg"]) . '</p>';
                                echo '</div>';
                            }
                        } else {
                            echo "<p>No feedback available.</p>";
                        }
                    } catch (PDOException $e) {
                        echo 'Connection failed: ' . htmlspecialchars($e->getMessage());
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
