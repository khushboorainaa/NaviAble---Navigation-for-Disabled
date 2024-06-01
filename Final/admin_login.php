<?php
session_start(); // Start the session for storing user information

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["username"];
    $password = $_POST["password"];

    // Validate input (you can add more validation if needed)

    // Check if the user is registered
    $check_user_query = "SELECT * FROM admin WHERE email = '$email'";
    $check_user_result = mysqli_query($conn, $check_user_query);

    if ($check_user_result) {
        // Check if any matching record is found
        if (mysqli_num_rows($check_user_result) == 1) {
            // User is registered, proceed to check login credentials
            $query = "SELECT * FROM admin WHERE email = '$email' AND pass = '$password'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Check if any matching record is found
                if (mysqli_num_rows($result) == 1) {
                    // Fetch user details from the result set
                    $row = mysqli_fetch_assoc($result);

                    // Store user information in the session
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['name'] = $row['name'];

                    // Redirect to a welcome page or dashboard
                    header("Location: dashHboard.php");
                    exit();
                } else {
                    // Incorrect email or password
                    echo '<script>alert("Incorrect email or password");</script>';
                }
            } else {
                // Error in the query
                echo '<script>alert("Error in database query");</script>';
            }
        } else {
            // User is not registered
            echo '<script>alert("You are not Admin");</script>';
        }
    } else {
        // Error in the query
        echo '<script>alert("Error in database query");</script>';
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <style>
    body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

header {
  background-color: #333;
  color: #fff;
  padding: 10px 0;
  text-align: center;
}

.navbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
}

.logo img {
  max-width: 100px;
}

.site-name {
  font-size: 1.5em;
  font-weight: bold;
  color: white;
  text-decoration: none;
  margin-right: 750px;
}

.nav-links {
  display: flex;
}

.nav-links a {
  color: #fff;
  margin: 0 10px;
  text-decoration: none;
}

.login-container {
  max-width: 400px;
  margin: 50px auto;
  background-color: white;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}
h2 {
  text-align: center;
  color: #333;
  font-weight: bold;
}

form {
  display: flex;
  flex-direction: column;
}

.input-group {
  margin: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
  color: #333;
  font-weight: bold;
}

input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button 
{
  background-color: #333;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
button:hover 
{
  background-color: #555;
}

footer 
{
  background-color: #333;
  color: white;
  padding: 10px;
  text-align: center;
  position: fixed;
  bottom: 0;
  width: 100%;
}

  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var loginForm = document.getElementById('login-form');

      loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevents the default form submission
        
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;

        // Basic validation to check if fields are empty
        if (username.trim() === '' || password.trim() === '') {
          alert('Please enter username and password');
          return;
        }
      });
    });
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
                <a href="#" onclick="redirectTo('final1.php')">Home</a>
                <a href="#" onclick="redirectTo('user_login.php')">User Login</a>
                <a href="#" onclick="redirectTo('admin_login.php')">Admin Login</a>
                <a href="#" onclick="redirectTo('reachus.php')">Reach Us</a>
            </div>
        </div>
    </header>
  <div class="login-container">
    <h2>Admin Login</h2>
    <form action="#" method="post">
      <div class="input-group">
        <label for="username">Email:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
  <footer>
        <p>&copy; 2024 Accessible Places. All rights reserved.</p>
    </footer>
    <script src="script.js"></script>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>