<?php
session_start();
include("connection.php");  // Ensure your database connection settings are correct

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $inputUsername = $_POST['username'];

    // Check if the input username matches the session username
    if ($inputUsername === $_SESSION['username']) {
        // Update the permission level in the database
        $stmt = $con->prepare("UPDATE Users SET PermissionLevel = 1 WHERE UserID = ?");
        $stmt->bind_param("i", $_SESSION['userID']);
        if ($stmt->execute()) {
            // Reflect the change in the session variable
            $_SESSION['PermissionLevel'] = 1;
            echo "Permission level downgraded successfully.";
            // Optionally redirect back to the profile page
            header("Location: profile.php");
        } else {
            echo "Error downgrading permission level: " . $con->error;
        }
        $stmt->close();
    } else {
        echo "Wrong username, please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>

