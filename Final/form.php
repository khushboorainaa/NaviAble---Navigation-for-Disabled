<?php
// Include your database connection script
include 'connection.php';

// Check if the form is submitted
if (isset($_POST["register"])) {
    
    // Collect form data
    $ownerName = $_POST["Name"];
    $ownerEmail = $_POST["email"];
    $ownerPhone = $_POST["mobileNo"];
    $accessibilityCriteria = $_POST["accessibilityCriteria"];
    $placeName = $_POST["placename"];
    $placeType = $_POST["placeType"];
    $country = $_POST["country"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $location = $_POST["location"];

    // SQL to insert data into the "places" table
    $sql = "INSERT INTO places VALUES ('$ownerName', '$ownerEmail', '$ownerPhone', '$accessibilityCriteria', '$placeName', '$placeType', '$country', '$state', '$city', '$location')";

    $data = mysqli_query($conn, $sql);

    if ($data) {
        echo '<script>alert("Thankyou! Response Submitted!");';
        echo 'window.location.href="user_homepage.php";</script>';
        exit();
    } else {
        echo '<script>alert("Registration failed. Please try again."); ';
        echo 'window.location.href="final.php";</script>';
        exit();
    }
}

// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Place Information Form</title>
    <!-- <link rel="stylesheet" href="sytles.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('6.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .site-name {
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            text-decoration: none;
            margin-right: 890px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px;
        }

        .logo img {
            width: 100px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }

        .addPlace {
            max-width: 600px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 0px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 0px;
            margin-bottom: 0px;
            box-sizing: border-box;
        }

        fieldset {
            margin-top: 5px;
            padding: 5px;
        }

        legend {
            font-weight: bold;
        }

        .btn {
            background-color: grey;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: grey;
        }

    </style>
    <script>
        function logout() {
            window.location.href = 'final.php';
        }
    </script>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="logo.png" alt="Accessible Places Logo">
            </div>
            <a class="site-name" href="#">NaviAble</a>
            <div class="nav-links">
                <a href="#" onclick="redirectTo('user_homepage.php')">Search Place</a>
                <a href="#" onclick="logout()">Logout</a>
            </div>
    </header>
    <div class="addPlace">
        <h2>Register your Place</h2>

        <form action="#" method="post">

            <label for="Name">Owner Name:</label><br>
            <input type="text" id="Name" name="Name"><br><br>

            <label for="email">Owner Email:</label><br>
            <input type="text" id="email" name="email"><br><br>

            <label for="mobileNo">Owner Phone Number:</label><br>
            <input type="text" id="mobileNo" name="mobileNo"><br><br>
            <fieldset>
                <legend>Accessibility criteria:</legend>
                <input type="checkbox" id="ramps" name="accessibilityCriteria" value="ramps">
                <label for="ramps">Ramps</label>
                <input type="checkbox" id="handrails" name="accessibilityCriteria" value="handrails">
                <label for="handrails">Handrails</label>
                <input type="checkbox" id="accessibleToilets" name="accessibilityCriteria" value="accessible toilets">
                <label for="accessibleToilets">Accessible Toilets</label>
                <input type="checkbox" id="wheelchairs" name="accessibilityCriteria" value="wheelchairs">
                <label for="wheelchairs">Wheelchairs</label>

            </fieldset><br><br>

            <label for="placeName">Place Name:</label><br>
            <input type="text" id="placename" name="placename"><br><br>

            <label for="placeType">Place Type:</label><br>
            <select id="placeType" name="placeType" required>
                <option value="">--Select the type of place--</option>
                <option value="restaurant">Restaurant</option>
                <option value="hospital">Hospital</option>
                <option value="cafe">Cafe</option>
                <option value="school">School</option>
                <option value="college">College</option>
                <option value="Shopping mall">Shopping Mall</option>
                <option value="movie theater">Movie Theater</option>
                <option value="Religious Places">Religious Places</option>
                <option value="bus stand">Bus stand</option>
                <option value="railway Station">Railways Station</option>
                <option value="airport">Airport</option>
            </select><br><br>

            <label for="country">Country:</label><br>
            <select id="country" name="country">
                <option value="India" selected>India</option>
            </select><br><br>

            <label for="state">State/UT:</label><br>
            <select id="state" name="state">
                <option value="" selected disabled>Select State / UT</option>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                <option value="Assam">Assam</option>
                <option value="Bihar">Bihar</option>
                <option value="Chhattisgarh">Chhattisgarh</option>
                <option value="Goa">Goa</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Haryana">Haryana</option>
                <option value="Himachal Pradesh">Himachal Pradesh</option>
                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                <option value="Jharkhand">Jharkhand</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Kerala">Kerala</option>
                <option value="Madhya Pradesh">Madhya Pradesh</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Manipur">Manipur</option>
                <option value="Meghalaya">Meghalaya</option>
                <option value="Mizoram">Mizoram</option>
                <option value="Nagaland">Nagaland</option>
                <option value="Odisha">Odisha</option>
                <option value="Punjab">Punjab</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Sikkim">Sikkim</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Telangana">Telangana</option>
                <option value="Tripura">Tripura</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Uttarakhand">Uttarakhand</option>
                <option value="West Bengal">West Bengal</option>
                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                <option value="Chandigarh">Chandigarh</option>
                <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu
                </option>
                <option value="Lakshadweep">Lakshadweep</option>
                <option value="Delhi">Delhi</option>
                <option value="Puducherry">Puducherry</option>
            </select><br><br>

            <label for="city">City Name:</label><br>
            <input type="text" id="city" name="city"><br><br>

            <label for="location">Location (Address):</label><br>
            <input type="text" id="location" name="location"><br><br>

            <div class="input_field">
                <input type="submit" value="Register" class="btn" name="register">
            </div>
        </form>
    </div>
    <script src="script.js"></script>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>

</html>