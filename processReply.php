<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    // $contact = $_POST['contact'];
    // $query = $_POST['query'];
    // $optional_message = $_POST['optional_message'];
    $replyMessage = $_POST['message'];
    
    $mail = new PHPMailer(true);
    
    // Configure the mail server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';           
    $mail->SMTPAuth = true;
    $mail->Username = 'encartaitcell@ghrcacs.raisoni.net'; // Your email username
    $mail->Password = 'encartapass@email';       // Your email password (use an app-specific password if needed)
    $mail->SMTPSecure = 'ssl';                // Enable SSL encryption
    $mail->Port = 465;                        // Port for SSL
    
    // Set the sender's email and name
    $mail->setFrom('encartaitcell@ghrcacs.raisoni.net', 'Encarta IT Cell');
    
    // Add the recipient's email (student's email)
    // echo json_encode([
    //     'success' => true, 
    //     'message' => 'Reply processed successfully for Query ID:'.$email, 
    //     'error' => 'Error Ocuured']
    // );
    // return;
    $mail->addAddress($email);
    
    // Set the email format to HTML
    $mail->isHTML(true);
    
    // Set the email subject
    $mail->Subject = "Query Resolved";
    
    // Construct the email body with the student's login details
    $msg = 'Dear ' . strtoupper($name) . '<p>We acknowledged your concern and have drawan a conclusion.</p>' .
    '<p>Conclusion ' . $replyMessage . '</p>';
    
    // Set the email message content
    $mail->Body = $msg;

    // Send the email

    // Send OTP
    if ($mail->send()) {
        echo json_encode([
            'success' => true, 
            'message' => 'Reply processed successfully for Email: '.$email, 
            'error' => 'Error Ocuured']
        );
        return;
    } else {
        echo json_encode([
            'success' => true, 
            'message' => 'Error', 
            'error' => 'Invalid request method']
        );
        return;
    }


}
?>
