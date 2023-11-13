<?php
// Check if form is submitted
if($_POST) {
    // Initialize variables
    $name = "";
    $email = "";
    $subject = "";
    $message = "";
    
    // Check if name is set and sanitize it
    if(isset($_POST['name'])) {
      $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }

    // Check if email is set, remove new lines and validate it
    if(isset($_POST['email'])) {
      $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Check if subject is set and sanitize it
    if(isset($_POST['subject'])) {
      $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    }

    // Check if message is set and sanitize it
    if(isset($_POST['message'])) {
      $message = htmlspecialchars($_POST['message']);
    }

    // Check if all fields are filled
    if($name && $email && $subject && $message) {
        // Set recipient email address
        $recipient = "TCG.co@protonmail.com"; //replace with your email address

        // Set headers for the email
        $headers  = 'MIME-Version: 1.0' . "\r\n"
                  .'Content-type: text/html; charset=utf-8' . "\r\n"
                  .'From: ' . $email . "\r\n";
        
        // Send the email and check if it's sent successfully
        if(mail($recipient, $subject, $message, $headers)) {
            echo "OK";
        } else {
            echo "Could not send the email.";
        }
        
    } else {
        echo "All fields are required.";
    }
    
} else {
    echo "An unexpected error occurred.";
}
?>
