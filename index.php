<?php
session_start();
include("connection.php");
include("functions.php");
$guest=isset($_SESSION['guest'])? $_SESSION['guest'] : 'no';
$user_data = CheckLogin($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Social Media Site</title>
    <link rel="stylesheet" href="css files/style.css">
</head>
<body>  
    <header>
        <h1>Next Generation Social Media Platform XXX</h1>
        <img src="images/logo.jpg" alt="Next Generation Social Media Platform XXX Logo" id="logo">
            </header>
    <header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div id="sampleimages" class="carousel slide" data-ride="carousel">
                    <!-- Carousel indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#sampleimages" data-slide-to="0" class="active"></li>
                        <li data-target="#sampleimages" data-slide-to="1"></li>          
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="images/Join.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/Join.jpg" alt="Second slide">
                        </div>
                    </div>
                    <!-- Carousel controls -->
                    <a class="carousel-control-prev" href="#sampleimages" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#sampleimages" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

    <main>
        <div class="logo-container">
        
            <?php if ($guest === 'yes'): ?>
                <p>Displaying guest news. <a href='index.php'>Exit Guest View</a></p>
            <?php else: ?>
                <nav>
                <h2> Feel free to choose an option below! </h2>
                    <a href="signin.php">Sign In</a> | <a href="register.php">Register</a>
                    <p>Or</p>
                    <a href="guest_view.php">Continue to a Guest View</a>
                </nav>
            <?php endif; ?>
        </div>
    </main>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




