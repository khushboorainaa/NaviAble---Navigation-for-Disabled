<?php
include("connection.php");
if (isset($_POST["submit"])) {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // SQL to insert data into the "reachus" table
    $sql = "INSERT INTO reachus VALUES ('$name', '$email', '$message')";
    $data = mysqli_query($conn, $sql);

    if ($data) {
        echo '<script>alert("Thankyou! Response Submitted!");';
        echo 'window.location.href="final1.php";</script>';
        exit();
    } else {
        echo '<script>alert("Registration failed. Please try again."); ';
        echo 'window.location.href="final1.php";</script>';
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reach Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('4.jpg') no-repeat center center fixed;
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
            margin-right: 700px;
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

        h2 {
            text-align: center;
            margin-top: 30px;
            color: black;
            font-weight: bolder;
        }

        .us {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        form{
            display: flex;
            flex-direction: column;
        }

            label {
                display: block;
                margin-bottom: 5px;
                color: #333;
                font-weight: bold;
            }


            input,
            textarea {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .input_field {
            text-align: center;
        }
            .btn {
                background-color: red;
                color: white;
                padding: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: red;
            }

            footer {
                background-color: #333;
                color: white;
                text-align: center;
                padding: 10px;
                position: fixed;
                bottom: 0;
                width: 100%;
            }
    </style>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="logo.png" alt="Logo">
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
    <div class = "us">
        <h2>Contact Us</h2>
    <form action="#" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
<br></br>
            <div class="input_field">
                <input type="submit" value="Submit" class="btn" name="submit">
            </div>
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