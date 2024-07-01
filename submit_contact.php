<?php
session_start();
// Here, you would handle your form data, such as saving it to a database or sending an email.


// Assuming processing is done, set a success message:
$_SESSION['feedback'] = "Thanks for Your Feedback!";


// Redirect back to the contact form page:
header('Location: index.php');
exit();
?>
