<?php
session_start();
include("connection.php");

$searchTerm = $_POST['username'] ?? '';

if (!empty($searchTerm)) {
    $stmt = $con->prepare("SELECT UserID, Username, Email, CreatedAt FROM Users WHERE Username LIKE ?");
    $searchTerm = "%$searchTerm%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $results = $stmt->get_result();
} else {
    echo "<p>No search term provided.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Profile Search Results</title>
    <link rel="stylesheet" href="css files/style.css">
    <style>
        .header-logo {
            max-height: 50px;
            width: auto;
        }
        header {
          
            padding: 10px 0;
        }
        h1 {
            margin: 0;
            text-align: left;
        }
    </style>
</head>
<body>
<header class="container">
    <div class="row align-items-center">
        <div class="col-auto">
            <img src="images/logo.jpg" alt="Logo" class="header-logo">
        </div>
        <div class="col">
            <h1>Your search results</h1>
        </div>
    </div>
    <nav>
        <a href="posts.php">View All Posts</a> |
        <a href="profile.php">Profile</a> |
        <a href="logout.php">Logout</a>
    </nav>
</header>
<div class="container">
    <h2>Search Results for Users</h2>
    <div class="row">
        <?php if (isset($results)): ?>
        <?php while ($user = $results->fetch_assoc()): ?>
        <div class="col-md-4">
            <div class="profile">
                <img src="images/logo.jpg" alt="Profile Image" style="width:100%;">
                <p><strong>User ID:</strong> <?= htmlspecialchars($user['UserID']) ?></p>
                <p><strong>Username:</strong> <?= htmlspecialchars($user['Username']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['Email']) ?></p>
                <p><strong>Created:</strong> <?= date('d-m-Y', strtotime($user['CreatedAt'])) ?></p>
            </div>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <p>No users found.</p>
        <?php endif; ?>
    </div>
</div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




