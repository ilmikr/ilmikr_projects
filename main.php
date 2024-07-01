<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit;
}
echo "<p>Welcome to the main screen.</p>";
echo "<a href='logout.php'>Logout</a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Main Screen</title>
    <link rel="stylesheet" href="css files\style.css">
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard</h1>
    </header>
    <main>
        <p>View your profile or explore other posts.</p>
        <a href="profile.php">View Profile</a> | <a href="posts.php">View Posts</a>
        <a href="index.php">Logout</a>
        <a href="index.php">Return to Home</a>
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
</body>
</html>
