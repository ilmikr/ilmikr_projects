<?php
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);

include("connection.php");
$error = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $userpassword = $_POST['userpassword'];

    if (!empty($username) && !empty($userpassword)) {
        $stmt = $con->prepare("SELECT UserID, Username, Email, PasswordHash, PermissionLevel FROM Users WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            if (password_verify($userpassword, $user_data['PasswordHash'])) {
                // Set session variables
                $_SESSION['userID'] = $user_data['UserID'];
                $_SESSION['username'] = $user_data['Username'];
                $_SESSION['email'] = $user_data['Email'];
                $_SESSION['permissionLevel'] = $user_data['PermissionLevel'];
                
                // Redirect to profile page
                header("Location: profile.php");
                exit;
            } else {
                $error = "Incorrect username or password. Please try again.";
            }
        } else {
            $error = "Incorrect username or password. Please try again.";
        }
        $stmt->close();
    } else {
        $error = "Please enter both username and password!";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <link rel="stylesheet" href="css files/style.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 10px;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 20px;
        } 
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
</header>
    <header>
        <h1 class="text-center">Login to Your Account</h1>
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
        <label for="password">Password:</label>
        <input type="password" id="password" name="userpassword" class="form-control" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Login</button>
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


