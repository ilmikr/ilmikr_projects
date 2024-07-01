<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css files/style.css">
    <style>
        .form-container {
            display: flex;
            justify-content: center; 
            margin-top: 50px;
        }
        .form-box {
            width: 50%; 
            padding: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="text-center">Edit Your Profile</h1>
        <a href="profile.php" style="display: block; text-align: center; margin-top: 10px;">Return to My Profile</a>
    </header>
    <main class="container form-container">
        <div class="form-box">
            <form action="update_profile.php" method="post">
                <div class="form-group">
                    <label for="about">About Me:</label>
                    <textarea id="about" name="about" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update About</button>
            </form>
        </div>
    </main>
    <footer class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-4 text-center">
            <a href="index.php">Home</a>
        </div>
        <div class="col-xs-12 col-md-4 text-center">
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


