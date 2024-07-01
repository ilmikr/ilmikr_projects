<?php
session_start();
include("connection.php");

// Ensure the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['postContent'])) {
    $content = $_POST['postContent'];
    $userID = $_SESSION['userID'];  // Retrieve UserID from session
    $imagePath = "images/logo.jpg";  // Assuming a default image path

    // Prepare the insert statement
    $stmt = $con->prepare("INSERT INTO Posts (UserID, Content, ImagePath) VALUES (?, ?, ?)");
    if (!$stmt) {
        echo "Prepare failed: (" . $con->errno . ") " . $con->error;
    } else {
        // Bind parameters and execute the statement
        $stmt->bind_param("iss", $userID, $content, $imagePath);
        if ($stmt->execute()) {
            header("Location: posts.php"); // Redirect back to posts page on success
        } else {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo "Please fill all fields or form not submitted correctly!";
}
?>

