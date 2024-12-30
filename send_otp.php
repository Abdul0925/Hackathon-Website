<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $leaderName = $_POST['name'];
    $leaderGender = $_POST['gender'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        require "db.php";
        // Store OTP in session for verification later
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
        $_SESSION['leaderName'] = $leaderName;
        $_SESSION['leaderGender'] = $leaderGender;

        $query = "SELECT * FROM team_and_leader_details WHERE leaderEmail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email); // 's' specifies the variable type => 'string'
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $otp_sent = false;
            echo json_encode([
                'success' => false,
                'message' => 'Team Leader Alreadey Exist',
            ]);
            return;
            //    echo '<script> alert("Leader Already Exist Try Again!"); window.location.href = "registerPage.php"; </script>';
        } else {


            // $email = $_POST['email'];
            $mail = new PHPMailer(true);

            // Configure the mail server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';           // SMTP server address
            $mail->SMTPAuth = true;
            $mail->Username = 'abdulrahim74264@gmail.com'; // Your email username
            $mail->Password = 'iotg jqut wkks sjrt';       // Your email password (use an app-specific password if needed)
            $mail->SMTPSecure = 'ssl';                // Enable SSL encryption
            $mail->Port = 465;                        // Port for SSL

            // Set the sender's email and name
            $mail->setFrom('abdulrahim74264@gmail.com', 'Abdul Rahim');

            // Add the recipient's email (student's email)
            $mail->addAddress($email);

            // Set the email format to HTML
            $mail->isHTML(true);

            // Set the email subject
            $mail->Subject = "OTP for Registration";

            // Construct the email body with the student's login details
            $msg =  '<p> your one time password for registraion process is: </p>' .
                '<p>OTP: ' . $_SESSION['otp'] . '</p>';

            // Set the email message content
            $mail->Body = $msg;

            // Send the email

            // Send OTP
            if ($mail->send()) {
                
                echo json_encode([
                    'success' => true,
                    'message' => 'OTP sent successfully to',
                    'email' => $email,
                ]);
                return;
            } else {
                session_reset();
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to send OTP. Please try again.',
                ]);
                return;
            }
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email address.',
        ]);
        return;
    }
}
