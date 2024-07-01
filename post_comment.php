
<?php
session_start();
include("connection.php");

if (isset($_POST['commentText'], $_POST['postID']) && !empty($_POST['commentText'])) {
    $commentText = $_POST['commentText'];
    $postID = $_POST['postID'];
    $userID = $_SESSION['userID']; // UserID should be stored in session upon login

    // Prepare and execute the insert statement
    $stmt = $con->prepare("INSERT INTO Comments (PostID, UserID, CommentText) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $postID, $userID, $commentText);
    if ($stmt->execute()) {
        echo "Comment added successfully.";
    } else {
        echo "Error adding comment: " . $con->error;
    }
    $stmt->close();

    // Redirect back to the post detail page or posts overview
    header("Location: posts.php"); // Modify as needed to redirect to the appropriate page
} else {
    echo "Please fill all required fields.";
}
?>
