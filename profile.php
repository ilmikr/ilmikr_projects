<?php
session_start();
include("connection.php");

// Redirect to login page if user is not logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

// Fetch user details including permission level
$stmt = $con->prepare("SELECT Username, Email, PermissionLevel FROM Users WHERE UserID = ?");
$stmt->bind_param("i", $_SESSION['userID']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Store user details in session variables
$_SESSION['username'] = $user['Username'];
$_SESSION['PermissionLevel'] = $user['PermissionLevel'];

// Error message variable
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['upgrade'])) {
        // Check permission level before upgrading
        if ($_SESSION['PermissionLevel'] == 1) {
            $inputEmail = $_POST['email'];
            if ($inputEmail === $user['Email']) {
                $updateStmt = $con->prepare("UPDATE Users SET PermissionLevel = 2 WHERE UserID = ?");
                $updateStmt->bind_param("i", $_SESSION['userID']);
                if ($updateStmt->execute()) {
                    $_SESSION['PermissionLevel'] = 2;
                    header("Location: profile.php");
                } else {
                    $error = "Error updating record: " . $con->error;
                }
                $updateStmt->close();
            } else {
                $error = "Email does not match our records.";
            }
        } else {
            $error = "You do not have permission to upgrade the level.";
        }
    } elseif (isset($_POST['downgrade'])) {
        // Check permission level before downgrading
        if ($_SESSION['PermissionLevel'] == 2) {
            $inputUsername = $_POST['username'];
            if ($inputUsername === $_SESSION['username']) {
                $updateStmt = $con->prepare("UPDATE Users SET PermissionLevel = 1 WHERE UserID = ?");
                $updateStmt->bind_param("i", $_SESSION['userID']);
                if ($updateStmt->execute()) {
                    $_SESSION['PermissionLevel'] = 1;
                    header("Location: profile.php");
                } else {
                    $error = "Error updating record: " . $con->error;
                }
                $updateStmt->close();
            } else {
                $error = "Wrong username, try again.";
            }
        } else {
            $error = "You do not have permission to downgrade the level.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>User Profile</title>
    <link rel="stylesheet" href="css files/style.css">
   <style>
    .logo {
        height: 60px; 
        width: auto; 
    }
    header .container-fluid {
        padding-left: 15px;
    }

    .profile-info {
        text-align: center;
        margin-top: 20px;
    }

</style>


</head>
<body>
   <header>
    <div class="container-fluid">
        <div class="row align-items-center"> 
            <div class="col-auto">
                <img src="images/logo.jpg" alt="Logo" class="logo">
            </div>
            <div class="col">
                <h1 class="text-center">Welcome To Your Dashboard</h1>
                <nav>
                    
                    <a href="posts.php">All Posts</a>
                    <a href="logout.php">Logout</a>
                </nav>
            </div>
        </div>
    </div>
</header>


    <main class="container">
        <section class="profile-info">
            <h2>Profile Information</h2>
            <img src="images/image3.jpg" alt="Profile Image" style="width:300px; height 300px; display:block; margin: auto;">
            <p><strong>UserID:</strong> <?php echo htmlspecialchars($_SESSION['userID']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></p>
            <p><strong>Permission Level:</strong> <?php echo htmlspecialchars($_SESSION['PermissionLevel']); ?></p>
            <p><strong>About:</strong> Thanks for registrating in our media platform. We hope that you enjoy it!.</p>
            <nav>
            <a href="create_post.php">Click Here to Make a Post!</a>
</nav>
            <?php if ($_SESSION['PermissionLevel'] == 1): ?>
            <form action="" method="POST">
                <input type="email" name="email" placeholder="Enter your email">
                <button type="submit" name="upgrade">Upgrade Level</button>
            </form>
            <?php endif; ?>
            <?php if ($_SESSION['PermissionLevel'] == 2): ?>
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Enter your username">
                <button type="submit" name="downgrade">Downgrade Level</button>
            </form>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
            <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>
        </section>
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


