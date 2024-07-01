<?php
session_start();  // Assuming session start is needed if not already done.



// Assuming registration logic sets these session variables or similar logic is used.
if (!isset($_SESSION['userID'])) {
    header("Location: login.php"); // Redirect to login if not registered/logged in
    exit;
}


$message = "Congratulations on your successful registration! Redirecting to your profile...";
$redirectAfter = 5; // Delay in seconds before redirecting
$redirectPage = 'profile.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="<?= htmlspecialchars($redirectAfter); ?>;url=<?= htmlspecialchars($redirectPage); ?>">
    <title>Registration Successful</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background-color: #e0f0e0;
            position: relative;
        }
        .message {
            text-align: center;
            position: relative;
            z-index: 2; 
        }
        #fireworksCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
   .header-logo {
            width: 100px; 
            height: auto;
                                }
                           
        </style>
    </style>
</head>
<body>
<header>
    <div class="container-fluid">
        <div class="row align-items-center"> 
            <div class="col-auto">
                <img src="images/logo.jpg" alt="Logo" class="logo">
            </div>
           
        </div>
    </div>
</header>
    <canvas id="fireworksCanvas"></canvas>
    <div class="message">
        <p><?= htmlspecialchars($message); ?></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/fireworks-js/dist/fireworks.js"></script>
    <script>
        const container = document.getElementById('fireworksCanvas');
        const options = {
            maxRockets: 3,            // max # of rockets to spawn
            rocketSpawnInterval: 150, // milliseconds to check if new rockets should spawn
            numParticles: 100,        // number of particles to spawn when rocket explodes (+0-10)
            explosionMinHeight: 0.2,  // percentage. min height at which rockets can explode
            explosionMaxHeight: 0.9,  // percentage. max height before a particle is exploded
            explosionChance: 0.08     // chance in each tick the rocket will explode
        };
        const fireworks = new Fireworks(container, options);
        fireworks.start();
    </script>
    <footer class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4 text-center">
                <a href="contact.php">Contact Us</a>
            </div>
            <div class="col-12 col-md-4 text-center">
                <a href="about.php">About Us</a>
            </div>
     
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <p class="text-center">&copy; 2024 Social Media Platform. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>





