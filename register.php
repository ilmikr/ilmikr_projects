<?php
session_start();
include("connection.php");  // Ensure this file contains the correct database connection setup

$error = '';  // Initialize the error message variable

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        $username = mysqli_real_escape_string($con, $username);
        $email = mysqli_real_escape_string($con, $email);
        $password = mysqli_real_escape_string($con, $password);

        $stmt = $con->prepare("SELECT * FROM Users WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $error = "Username taken. Please choose another username.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $defaultPermissionLevel = 1;

            $stmt = $con->prepare("INSERT INTO Users (Username, Email, PasswordHash, PermissionLevel) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $username, $email, $passwordHash, $defaultPermissionLevel);
            if ($stmt->execute()) {
                $_SESSION['userID'] = $stmt->insert_id; // Save new user ID to session
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['permissionLevel'] = $defaultPermissionLevel;
                $stmt->close();
                header("Location: success.php"); // Redirect to profile page
                exit;
            } else {
                $error = "Error registering: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $error = "Please complete all fields!";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <link rel="stylesheet" href="css files/style.css">
    <style>
        .form-container {
            max-width: 400px; 
            margin: auto;
            padding: 20px;
            background-color: #f7f7f7; 
            border-radius: 10px; 
        }
        .form-group {
            margin-bottom: 20px; 
        }
       
   .header-logo {
            width: 100px; 
            height: auto; 
                                }
                           
        </style>
    </style>
</head>
<body>
<header class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
                <img src="images/logo.jpg" alt="Logo" class="header-logo">
            </div>
        </div>                            
</header>
    <header>
        <h1 class="text-center">Create Your Account</h1>
        <a href="index.php">Return to Home</a>
    </header>
    <main class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="form-container">
            <form action="" method="post"> 
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <?php if (!empty($error)): ?>
                    <p class="error-message"><?= htmlspecialchars($error); ?></p>
                <?php endif; ?>
            </form>
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
</body>
</html>





