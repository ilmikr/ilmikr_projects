<?php
session_start();
include("connection.php");

// Check if user is logged in and the request is POST
if (isset($_SESSION['userID']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the comment ID from POST request
    $commentID = isset($_POST['commentID']) ? intval($_POST['commentID']) : 0;

    if ($commentID > 0) {
        // Prepare the DELETE statement
        $stmt = $con->prepare("DELETE FROM Comments WHERE CommentID = ? AND UserID = ?");
        $stmt->bind_param("ii", $commentID, $_SESSION['userID']);

        // Execute the statement
        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $_SESSION['message'] = "Comment successfully deleted.";
            } else {
                $_SESSION['error'] = "No comment found or you do not have permission to delete this comment.";
            }
        } else {
            $_SESSION['error'] = "Error deleting comment: " . $con->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid comment ID.";
    }
} else {
    $_SESSION['error'] = "You must be logged in to perform this action.";
}

// Redirect back to the posts page or the referring page
header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'posts.php'));
exit;
?>

