<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Contact Us - Social Media Site</title>
    <link rel="stylesheet" href="css files/style.css">
    <style>
        body, html {
            height: 100%; 
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center; 
        }
        main, header, footer { 
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center; 
        }
        
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
    <h1>Contact Us</h1> 
                            
</header>
      <main class="container">
        <h2>We'd love to hear from you!</h2>
        <form action="submit_contact.php" method="POST" class="w-50">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" class="form-control" required rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </main>
    
    <footer class="container">
        <div class="row text-center py-4 justify-content-center">
            <div class="col-auto">
                <a href="index.php">Home</a>
            </div>
            <div class="col-auto">
                <a href="about.php">About Us</a>
            </div>
                </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <p class="text-center">&copy; 2024 Social Media Platform. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


