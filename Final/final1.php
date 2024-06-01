<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NaviAble - Accessible Places</title>
    <style>
        body, h1, h2, p, ul, li {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        header {
            background: linear-gradient(90deg, #0056a6, #003b7a);
            color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            width: 100px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #ffd700;
        }

        .hero-section {
            background: linear-gradient(90deg, #0056a6, #003b7a);
            color: #fff;
            text-align: center;
            padding: 30px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .hero-section h1 {
            font-size: 24px;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
            height: 20px; /* Set height to 30px */
            line-height: 0.8; /* Adjust line-height to reduce vertical space */
            overflow: hidden;
        }



        main {
            padding: 20px;
        }

        .about-section, .features-section {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        .about-section h2, .features-section h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #fff;
            padding: 20px;
            background-color: #0056a6;
            text-align: center;
            width: 100%;
        }

        .about-section p {
            font-size: 18px;
            color: #666;
            flex: 1;
        }

        .about-section img {
            width: 50%;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            flex: 1;
            margin-right: 20px;
        }

        .features-section {
            flex-direction: column;
            align-items: center;
            
        }

        .features-section .feature-collage {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .features-section .feature {
            position: relative;
            overflow: hidden;
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
        }

        .features-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s;
        }

        .features-section .feature:hover img {
            transform: scale(1.1);
        }

        .features-section .feature-text {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .features-section .feature:hover .feature-text {
            opacity: 1;
        }

        footer {
            background-color: #0056a6;
            color: #fff;
            text-align: center;
            padding: 15px;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-links {
                margin-top: 10px;
            }

            .nav-links a {
                margin: 5px 0;
            }

            .logo img {
                width: 80px;
            }

            .hero-section {
                padding: 30px 20px;
            }

            .hero-section h1 {
                font-size: 24px;
            }

            .about-section, .features-section {
                flex-direction: column;
            }

            .about-section img {
                width: 100%;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <div class="nav-links">
                <a href="#" onclick="redirectTo('final1.php')">Home</a>
                <a href="#" onclick="redirectTo('user_login.php')">User Login</a>
                <a href="#" onclick="redirectTo('admin_login.php')">Admin Login</a>
                <a href="#" onclick="redirectTo('reachus.php')">Reach Us</a>
            </div>
        </div>
    </header>
    <main>
        <section class="hero-section">
            <h1>Welcome to NaviAble</h1>
        </section>
        <section class="about-section">
            <img src="access.jpg" alt="About Us Image">
            <div>
                <h2>About Us</h2>
                <p>
                    NaviAble is committed to enhancing accessibility for individuals with physical challenges. Our mission is to create a comprehensive database of accessible places, fostering inclusivity and ensuring that everyone can navigate public spaces seamlessly. NaviAble is not just a platform; it's a movement—a shared journey toward breaking barriers and ensuring that every space is navigable for all. Join us as we redefine accessibility, one location at a time.
                </p>
            </div>
        </section>
        <section class="features-section">
            <h2>Key Features</h2>
            <div class="feature-collage">
                <div class="feature">
                    <img src="1.jpg" alt="Feature 1 Icon">
                    <div class="feature-text">Search for places with wheelchair ramps</div>
                </div>
                <div class="feature">
                    <img src="2.jpeg" alt="Feature 2 Icon">
                    <div class="feature-text">Find places with accessible toilets</div>
                </div>
                <div class="feature">
                    <img src="3.jpeg" alt="Feature 3 Icon">
                    <div class="feature-text">Locate places with handrails for support and many more</div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 NaviAble. All rights reserved.</p>
    </footer>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>

</html>
