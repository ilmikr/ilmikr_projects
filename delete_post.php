<?php
session_start();
include("connection.php");

// Check if user is logged in and the request is POST
if (isset($_SESSION['userID']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the post ID from POST request
    $postID = isset($_POST['postID']) ? intval($_POST['postID']) : 0;

    if ($postID > 0) {
        // First, delete all comments associated with the post
        $stmt = $con->prepare("DELETE FROM Comments WHERE PostID = ?");
        $stmt->bind_param("i", $postID);
        $stmt->execute(); // Execute the statement
        $stmt->close();

        // Next, delete the post itself
        $stmt = $con->prepare("DELETE FROM Posts WHERE PostID = ? AND UserID = ?");
        $stmt->bind_param("ii", $postID, $_SESSION['userID']);

        // Execute the statement
        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $_SESSION['message'] = "Post and all related comments successfully deleted.";
            } else {
                $_SESSION['error'] = "No post found or you do not have permission to delete this post.";
            }
        } else {
            $_SESSION['error'] = "Error deleting post: " . $con->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid post ID.";
    }
} else {
    $_SESSION['error'] = "You must be logged in to perform this action.";
}

// Redirect back to the posts page or the referring page
header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'posts.php'));
exit;
?>

