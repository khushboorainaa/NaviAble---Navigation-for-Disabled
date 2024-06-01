<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="logo.png" alt="Accessible Places Logo">
            </div>
            <a class="site-name" href="#">NaviAble</a>
            <div class="nav-links">
                <a href="#" onclick="redirectTo('MapFinal.php')">Register Your Place</a>
                <a href="#" onclick="redirectTo('final1.php')">Logout</a>
            </div>
        </div>
    </header>
    <div class="transparent-block">
        <br>
        <div class="searchPlace">
            <form action="user_homepage.php" method="post">
                <div class="input_field">
                    <select id="state" name="state" required>
                        <option value="" disabled selected>Select State</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Others">Others</option>
                    </select>
                    <br><br>
                    <select id="place_type" name="place_type">
                        <option value="" disabled selected>Select Place Type</option>
                        <option value="Hospital">Hospital</option>
                        <option value="College">College</option>
                        <option value="School">School</option>
                        <option value="Railway Station">Railway Station</option>
                        <option value="Airport">Airport</option>
                        <option value="Others">Others</option>
                    </select>
                    <br><br>
                    <input type="submit" value="Submit" class="btn" name="submit">
                </div>
            </form>
        </div>
        <?php
        include("connection.php");

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the state and place type from the form submission
            $state = $_POST["state"];
            $place_type = $_POST["place_type"];

            // Prepare the SQL query
            $sql = "SELECT * FROM placedata WHERE stateut = '$state'";
            if (!empty($place_type)) {
                $sql .= " AND ptype = '$place_type'";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p><strong>Place Name:</strong> " . $row["pname"] . "</p>";
                    echo "<p><strong>Place Type:</strong> " . $row["ptype"] . "</p>";
                    echo "<p><strong>Owner:</strong> " . $row["oname"] . "</p>";
                    echo "<p><strong>Email:</strong> " . $row["oemail"] . "</p>";
                    echo "<p><strong>Description:</strong> " . $row["descp"] . "</p>";
                    echo "<p><strong>State:</strong> " . $row["stateut"] . "</p>";
                    $directions = $row["directions"];

                    echo '<p><strong>Get Directions:</strong> ' . $row["stateut"] . ' <a href="https://maps.app.goo.gl/' . $directions . '">Directions</a></p><br>';
                }
            } else {
                echo "<p>No results found</p>";
            }

            $conn->close();
        }
        ?>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('7.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .transparent-block {
            width: 60%;
            background-color: rgba(255, 255, 255, 0.8);
            margin: 20px auto;
            padding: 25px;
        }

        select {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 3px;
            width: 100%;
            box-sizing: border-box;
        }

        .logo img {
            width: 100px;
        }

        .site-name {
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            text-decoration: none;
            margin-right: auto;
            margin-left: 20px;
        }

        .nav-links {
            margin-right: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }

        .input_field {
            text-align: center;
        }

        .btn {
            background-color: grey;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 0px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: grey;
        }
    </style>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
