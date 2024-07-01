<?php
session_start(); // Start or resume a session
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>About Us - Social Media Site</title>
    <link rel="stylesheet" href="css files/style.css">
    <style>
        .header-logo {
            width: 100px; 
            height: auto; 
        }
    </style>
</head>
<body>
<header class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
                <img src="images/logo.jpg" alt="Logo" class="header-logo">
            </div>
         </div>
    <h1>About Us</h1> 
                            
</header>
    <main class="container text-center">
        <h2>Welcome to Our Social Media Platform</h2>
        <p>This platform was created to bring people together. Here you can share your thoughts, interact with others, and stay connected with the world. Our mission is to create a safe, engaging space for communication and creativity.</p>
    </main>
    <footer class="container">
        <div class="row justify-content-center text-center">
            <div class="col-auto">
                <a href="index.php">Home</a>
            </div>
            <div class="col-auto">
                <a href="contact.php">Contact Us</a>
            </div>
    
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <p>&copy; 2024 Social Media Platform. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>




