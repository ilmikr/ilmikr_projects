<?php
session_start();
include("connection.php");

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    // If not logged in, redirect to the login page
    header("Location: signin.php");
    exit;
}

// Check if the form was submitted and the required field is present
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['about'])) {
    $about = $_POST['about'];
    $userID = $_SESSION['userID'];

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $con->prepare("UPDATE Users SET About = ? WHERE UserID = ?");
    $stmt->bind_param("si", $about, $userID);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to profile page if the update is successful
        $stmt->close();
        header("Location: profile.php");
        exit;
    } else {
        // Log error or handle it as needed
        $error = "Failed to update the profile: " . $stmt->error;
        $stmt->close();
    }
}

// If there was an error or the needed POST data wasn't sent, redirect back
if (!empty($error)) {
    // Store error message in session to show on edit page or handle otherwise
    $_SESSION['error'] = $error;
    header("Location: edit_profile.php");
    exit;
}
?>
