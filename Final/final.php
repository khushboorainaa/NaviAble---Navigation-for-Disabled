<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accessible Places</title>
  <style>
    /* Reset some default styles */
body, h1, h2, p, ul, li {
    margin: 0;
    padding: 0;
  }
  
  /* Apply a background color to the body */
  body {
    background-color: #f9f9f9;
    font-family: 'Arial', sans-serif;
  }
  
  /* Style the header and navbar */
  header {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
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
    margin: 0 10px;
    font-size: 16px;
  }
  
  /* Style the hero section */
  .hero-section {
    background-color: #4CAF50;
    color: #fff;
    text-align: center;
    padding: 50px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
  }
  
  .hero-section h1 {
    font-size: 36px;
    margin-bottom: 20px;
  }
  
  .hero-section p {
    font-size: 18px;
    margin-bottom: 30px;
  }
  
  .hero-section a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #fff;
    color: #4CAF50;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s;
  }
  
  .site-name {
    font-size: 1.5em;
    font-weight: bold;
    color: white;
    text-decoration: none;
    margin-right: 710px;
}

  .hero-section a:hover {
    background-color: #4CAF50;
    color: #fff;
  }
  
  /* Style the main content sections */
  main {
    padding: 20px;
  }
  
  .about-section, .features-section {
    background-color: #fff;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    margin-bottom: 20px;
    overflow: hidden;
  }
  
  .about-section h2, .features-section h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
    padding: 20px;
    background-color: #4CAF50;
    color: #fff;
  }
  
  .about-section p {
    font-size: 16px;
    line-height: 1.5;
    color: #666;
    padding: 20px;
  }
  
  .features-section .feature {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .features-section img {
    width: 60px;
  }
  
  .features-section p {
    margin-top: 10px;
  }
  
  /* Style the footer */
  footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
  }
  
  /* Responsive design */
  @media (max-width: 768px) {
    .navbar {
      flex-direction: column;
      align-items: flex-start;
    }
  
    .nav-links {
      margin-top: 10px;
    }
  
    .nav-links a {
      margin: 0;
    }
  
    .logo img {
      width: 80px;
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
      <a class="site-name" href="#">NaviAble</a>
      <div class="nav-links">
        <a href="#" onclick="redirectTo('final.php')">Home</a>
        <a href="#" onclick="redirectTo('user_login.php')">User Login</a>
        <a href="#" onclick="redirectTo('admin_login.php')">Admin Login</a>
        <a href="#" onclick="redirectTo('reachus.php')">Reach Us</a>
      </div>
    </div>
    <div class="hero-section">
      <h1>Welcome to NaviAble</h1>
      <p>Explore and find accessible places for physically challenged individuals.</p>
      <!-- <a href="#">Get Started</a> -->
    </div>
  </header>
  <main>
    <section class="about-section">
      <h2>About Us</h2>
      <p>
      NaviAble is committed to enhancing accessibility for individuals with physical challenges. Our mission is to create a comprehensive database of accessible places, fostering inclusivity and ensuring that everyone can navigate public spaces seamlessly. NaviAble is not just a platform; it's a movement—a shared journey toward breaking barriers and ensuring that every space is navigable for all. Join us as we redefine accessibility, one location at a time.
      </p>
      <img src="access.jpg" alt="About Us Image" width="560" height="450" >
 
    </section>

    <section class="features-section">
      <h2>Key Features</h2>
      <div class="feature">
        <img src="1.jpg" alt="Feature 1 Icon">
        <p>Search for places with wheelchair ramps,</p>
      </div>
      <div class="feature">
        <img src="2.jpeg" alt="Feature 2 Icon">
        <p>Find places with accessible toilets,</p>
      </div>
      <div class="feature">
        <img src="3.jpeg" alt="Feature 3 Icon">
        <p>Locate places with handrails for support and many more.</p>
      </div>
    </section>
  </main>
  <footer>
    <p>&copy; 2024 Accessible Places. All rights reserved.</p>
  </footer>
  <!-- Link to JavaScript file -->
  <script src="script.js"></script>
  <script>
    function redirectTo(page) {
      window.location.href = page;
    }
  </script>
</body>

</html>
