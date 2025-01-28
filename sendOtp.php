<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


// Handle form submission for OTP sending
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sendOtp'])) {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in session for verification later
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
        $email = $_POST['email'];

        // Generate OTP
        $otp = rand(100000, 999999);
        $mail = new PHPMailer(true);
    
        // Configure the mail server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';           // SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'encartaitcell@ghrcacs.raisoni.net'; // Your email username
        $mail->Password = 'ntkc xkfq oekp tgnw';       // Your email password (use an app-specific password if needed)
        $mail->SMTPSecure = 'ssl';                // Enable SSL encryption
        $mail->Port = 465;                        // Port for SSL
    
        // Set the sender's email and name
        $mail->setFrom('encartaitcell@ghrcacs.raisoni.net', 'Encarta IT Cell');
    
        // Add the recipient's email (student's email)
        $mail->addAddress($email);
    
        // Set the email format to HTML
        $mail->isHTML(true);
    
        // Set the email subject
        $mail->Subject = "OTP for Registration";
    
        // Construct the email body with the student's login details
        $msg = 'Dear ' . strtoupper($first_name) . '<p> your one time password for registraion process is:</p>' .
            '<p>OTP: ' . $otp . '</p>';
    
        // Set the email message content
        $mail->Body = $msg;
    
        // Send the email
        
        // Send OTP
        if ($mail->send()) {
            $otp_sent = true;
            $message = "OTP sent successfully to your email.";
            
        } else {
            $otp_sent = false;
            $message = "Failed to send OTP. Please try again.";
        }
    } else {
        $otp_sent = false;
        $message = "Invalid email address.";
    }
}

// Handle OTP verification and form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $entered_otp = $_POST['otpInput'];

    // Check if entered OTP matches the session OTP
    if ($entered_otp == $_SESSION['otp']) {
        // OTP is valid
        $registration_success = true;
        $message = "Registration successful!";
        
        // Clear session OTP after successful verification
        unset($_SESSION['otp']);
    } else {
        // OTP is invalid
        $registration_success = false;
        $message = "Invalid OTP. Please try again.";
    }
}