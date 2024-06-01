<?php
include("connection.php");

if (isset($_POST["register"])) 
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $cpass = $_POST["confirm_password"];

    $query = "INSERT INTO signup VALUES('$name','$email','$pass','$cpass')";
    $data = mysqli_query($conn, $query);

    if ($data) {
        echo '<script>alert("Registration successful!");';
        echo 'window.location.href="user_login.php";</script>';
        exit();
    } else {
        echo '<script>alert("Registration failed. Please try again."); ';
        echo 'window.location.href="signup1.php";</script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login and Sign Up</title>
    <!-- <link rel="stylesheet" href="project1.css"> -->
</head>

<head>
    <meta charset="UTF-8">
    <title>Login and Sign Up</title>
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
            /* padding: 10px; */
        }

        .logo img {
            width: 100px; /* Adjust as needed */
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }

        .site-name {
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            text-decoration: none;
            margin-right: 700px;
        }
        .signup-container {
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
            margin-bottom: 15px;
        }

        label {
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

        .input_field {
            text-align: center;
        }

        .btn {
            background-color: #333;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #555;
        }

        p {
            text-align: center;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            /* position: fixed; */
            bottom: 5;
            width: 100%;
        }

    </style>

    <script>
        function validateSignUpForm() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            if (name === '' || email === '' || password === '' || confirmPassword === '') {
                alert('All fields are required');
                return false;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return false;
            }
            // You can add more complex validation rules here if needed
            return true;
        }
    </script>
</head>

<body>
    <header>
        <div class="navbar">
        <div class="logo">
            <img src="logo.png" alt="Accessible Places Logo">
        </div>
        <div class="site-info">
            <a class="site-name" href="#">NaviAble</a>
        </div>
        <div class="nav-links">
            <a href="#" onclick="redirectTo('final1.php')">Home</a>
            <a href="#" onclick="redirectTo('user_login.php')">User Login</a>
            <a href="#" onclick="redirectTo('admin_login.php')">Admin Login</a>
            <a href="#" onclick="redirectTo('reachus.php')">Reach Us</a>
        </div>
        </div>
    </header>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="#" method="post">
            <div class="input-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="input_field">
                <input type="submit" value="Register" class="btn" name="register">
            </div>
        </form>
        <p>Already have an account? <a href="user_login.php">Login</a></p>
    </div>
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