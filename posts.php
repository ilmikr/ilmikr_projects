<?php
session_start();
include("connection.php");


// Check for user's permission level
$permissionLevel = $_SESSION['PermissionLevel'] ?? 0;


// Fetch posts and user details from the database
$stmt = $con->prepare("SELECT Posts.PostID, Posts.UserID, Posts.Content, Posts.ImagePath, Posts.CreatedAt, Users.Username FROM Posts JOIN Users ON Posts.UserID = Users.UserID ORDER BY Posts.CreatedAt DESC");
$stmt->execute();
$posts = $stmt->get_result();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postId = $_POST['postId'] ?? null;
    $userId = $_SESSION['userID'];
    $action = $_POST['action'] ?? '';


    switch ($action) {
        case 'like':
            echo json_encode(['likes' => handleLike($con, $postId, $userId)]);
            exit;
        case 'addComment':
            $commentText = $_POST['commentText'] ?? '';
            if ($postId && $commentText) {
                $insertCommentStmt = $con->prepare("INSERT INTO Comments (PostID, UserID, CommentText) VALUES (?, ?, ?)");
                $insertCommentStmt->bind_param("iis", $postId, $userId, $commentText);
                $insertCommentStmt->execute();
                $insertCommentStmt->close();
                header("Location: posts.php");
            }
            break;
        case 'deleteComment':
            $commentId = $_POST['commentId'] ?? null;
            if ($commentId) {
                $deleteCommentStmt = $con->prepare("DELETE FROM Comments WHERE CommentID = ?");
                $deleteCommentStmt->bind_param("i", $commentId);
                $deleteCommentStmt->execute();
                $deleteCommentStmt->close();
                header("Location: posts.php");
            }
            break;
        case 'deletePost':
            if ($postId && $permissionLevel == 2) {
                $con->begin_transaction();
                try {
                    $deleteCommentsStmt = $con->prepare("DELETE FROM Comments WHERE PostID = ?");
                    $deleteCommentsStmt->bind_param("i", $postId);
                    $deleteCommentsStmt->execute();
                    $deleteCommentsStmt->close();


                    $deletePostStmt = $con->prepare("DELETE FROM Posts WHERE PostID = ?");
                    $deletePostStmt->bind_param("i", $postId);
                    $deletePostStmt->execute();
                    $deletePostStmt->close();


                    $con->commit();
                    header("Location: posts.php");
                } catch (Exception $e) {
                    $con->rollback();
                    echo "Error: " . $e->getMessage();
                }
            }
            break;
    }
}


function handleLike($con, $postId, $userId) {
    $checkStmt = $con->prepare("SELECT * FROM Likes WHERE PostID = ? AND UserID = ?");
    $checkStmt->bind_param("ii", $postId, $userId);
    $checkStmt->execute();
    if ($checkStmt->get_result()->num_rows == 0) {
        $insertStmt = $con->prepare("INSERT INTO Likes (PostID, UserID) VALUES (?, ?)");
        $insertStmt->bind_param("ii", $postId, $userId);
        $insertStmt->execute();
        $insertStmt->close();
    }
    $checkStmt->close();


    $likeCountStmt = $con->prepare("SELECT COUNT(*) AS likeCount FROM Likes WHERE PostID = ?");
    $likeCountStmt->bind_param("i", $postId);
    $likeCountStmt->execute();
    $likeResult = $likeCountStmt->get_result()->fetch_assoc();
    $likeCountStmt->close();
    return $likeResult['likeCount'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>View Posts</title>
    <link rel="stylesheet" href="css files/style.css">
    <style>
        .header-logo {
            height: 50px;
            width: auto;
        }
        header {
            padding: 5px 0;
        }
        .post {
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 10px;
            box-sizing: border-box;
            flex: 0 0 31%;
        }
        .post img {
            width: 100%;
            height: auto;
        }
        .posts-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
    </style>
</head>
<body>
<header class="container">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto">
            <img src="images/logo.jpg" alt="Logo" class="header-logo">
        </div>
        <div class="col text-center">
            <h1>All posts</h1>
        </div>
    </div>
    <nav class="text-center">
        <a href="profile.php">Profile</a> |
        <a href="logout.php">Logout</a> |
        <a href="create_post.php" class="btn btn-primary">Create Post</a>
    </nav>
    <div class="col-12 search-bar">
        <form class="form-inline justify-content-center" action="search_profiles.php" method="post">
            <input class="form-control mr-sm-2" type="search" placeholder="Enter Username" name="username" required>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</header>
<main class="container">
    <div class="posts-container">
        <?php while ($post = $posts->fetch_assoc()): ?>
        <div class="post">
            <img src="<?= htmlspecialchars($post['ImagePath']) ?>" alt="Post Image">
            <div>
                <button type="button" class="like-btn" data-postid="<?= $post['PostID'] ?>">Like</button>
            </div>
            <p><strong>Post ID:</strong> <?= $post['PostID'] ?></p>
            <p><strong>User:</strong> <?= htmlspecialchars($post['Username']) ?></p>
            <p><strong>Posted:</strong> <?= date('Y-m-d H:i', strtotime($post['CreatedAt'])) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($post['Content']) ?></p>
            <?php
            $commentsQuery = $con->prepare("SELECT * FROM Comments WHERE PostID = ?");
            $commentsQuery->bind_param("i", $post['PostID']);
            $commentsQuery->execute();
            $commentsResult = $commentsQuery->get_result();
            while ($comment = $commentsResult->fetch_assoc()) {
                echo "<p>" . htmlspecialchars($comment['CommentText']) . " - by user <small>" . htmlspecialchars($comment['Username']) . "</small></p>";
                if ($permissionLevel == 2) {
                    echo "<form method='post'>
                            <input type='hidden' name='commentId' value='{$comment['CommentID']}'>
                            <input type='hidden' name='postId' value='{$post['PostID']}'>
                            <button type='submit' name='action' value='deleteComment'>Delete Comment</button>
                          </form>";
                }
            }
            $commentsQuery->close();
            ?>
            <form action="" method="post">
                <input type="hidden" name="postId" value="<?= $post['PostID'] ?>">
                <input type="text" name="commentText" placeholder="Add a comment">
                <button type="submit" name="action" value="addComment">Post Comment</button>
            </form>
            <?php if ($permissionLevel == 2): ?>
            <form action="" method="post">
                <input type="hidden" name="postId" value="<?= $post['PostID'] ?>">
                <button type="submit" name="action" value="deletePost">Delete Post</button>
            </form>
            <?php endif; ?>
        </div>
        <?php endwhile; ?>
    </div>
</main>
<footer class="container">
    <a href="contact.php">Contact Us</a> |
    <a href="about.php">About Us</a> |
    <p>&copy; 2024 Social Media Platform. All rights reserved.</p>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const likeButtons = document.querySelectorAll('.like-btn');
    likeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-postid');
            $.ajax({
                type: 'POST',
                url: 'posts.php',
                data: { action: 'like', postId: postId },
                success: function(response) {
                    const result = JSON.parse(response);
                    button.innerText = result.likes + ' like' + (result.likes !== 1 ? 's' : '');
                },
                error: function() {
                    console.error('Error with the request');
                }
            });
        });
    });
});
</script>
</body>
</html>


