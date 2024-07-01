<?pphp
if (!isset($_SESSION['userID'])){
    header("Location: signin.php");
    exit;
}
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css files/style.css">
   <style> 
   .header-logo {
            width: 100px; 
            height: auto; 
       }
                           
        </style>
</head>
<body>
    <header class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
                <img src="images/logo.jpg" alt="Logo" class="header-logo">
            </div>
                            </div>
    <h1>Create a New Post</h1> 
                            
</header>

    <header>
    <div class="col-12 text-center">
                <nav>
                    <a href="posts.php">All posts</a> |
                    <a href="profile.php">Profile</a> |
                    <a href="logout.php">Logout</a>
                </nav>
            </div>
</header>
    <div class="container">

        <form action="post_submission.php" method="post">
            <div class="form-group">
                <label for="postContent">Post Content with auto-generated image</label>
                <textarea class="form-control" id="postContent" name="postContent" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit Post</button>
        </form>
    </div>
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
