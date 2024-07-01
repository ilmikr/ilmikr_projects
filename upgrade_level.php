<?php
session_start();
include("connection.php");

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    if ($email == $_SESSION['email']) {
        // Upgrade permission level in the database
        $stmt = $con->prepare("UPDATE Users SET PermissionLevel = 2 WHERE UserID = ?");
        $stmt->bind_param("i", $_SESSION['userID']);
        if ($stmt->execute()) {
            $_SESSION['PermissionLevel'] = 2;  // Update session
            header("Location: profile.php");  // Redirect to profile
            exit;
        } else {
            $message = "Error updating permission level.";
        }
        $stmt->close();
    } else {
        $message = "Wrong email, please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Upgrade Permission Level</title>
    <link rel="stylesheet" href="css files/style.css">
</head>
<body>
    <div class="container">
        <h1>Upgrade Your Permission Level</h1>
        <p>Please confirm your email to upgrade your permission level:</p>
        <form action="upgrade_level.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirm</button>
        </form>
        <?php if (!empty($message)): ?>
            <p class="alert alert-danger"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>


