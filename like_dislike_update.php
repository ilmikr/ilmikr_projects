// like_dislike_update.php
<?php
session_start();
include("connection.php");

if (isset($_POST['type'], $_POST['post_id'])) {
    $type = $_POST['type'];  
    $post_id = (int)$_POST['post_id'];
    $user_id = $_SESSION['userID']; // Assume user ID is stored in session

    // Check if the user has already liked the post
    $query = "SELECT * FROM Likes WHERE user_id = ? AND post_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $user_id, $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User has already liked this post, update the type if different
        $existing = $result->fetch_assoc();
        if ($existing['type'] !== $type) {
            $update = "UPDATE Likes SET type = ? WHERE user_id = ? AND post_id = ?";
            $update_stmt = $con->prepare($update);
            $update_stmt->bind_param("sii", $type, $user_id, $post_id);
            $update_stmt->execute();
            $update_stmt->close();
        }
    } else {
        // Insert new like
        $insert = "INSERT INTO Likes (user_id, post_id, type) VALUES (?, ?, ?)";
        $insert_stmt = $con->prepare($insert);
        $insert_stmt->bind_param("iis", $user_id, $post_id, $type);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    $stmt->close();
    echo "Success";
}
?>