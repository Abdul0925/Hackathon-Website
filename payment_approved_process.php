<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $leaderEmail = $_POST['leaderEmail'];
    $leaderName = $_POST['leaderName'];
    $password = $_POST['password'];
    $isApproved = approvePayment($id);
    if (!$isApproved) {
        echo json_encode([
            'success' => false,
            'message' => 'Error in Approving',
        ]);
        return;
    }
    sentmail($leaderEmail, $leaderName, $password);
    updatePassword($leaderEmail, $password);
    echo json_encode([
        'success' => true,
        'message' => 'Team Approved',
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.', 'error' => 'Error Ocuured']);
}


function approvePayment($id)
{
    require "db.php";

    $updatePaymentIdQuery = "UPDATE payment_details SET is_approved = true WHERE id = ?";
    if ($stmt = $conn->prepare($updatePaymentIdQuery)) {

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            // Log error for debugging
            error_log("Execute failed: " . $stmt->error);
            $stmt->close();
            return false;
        }
    } else {
        // Log error for debugging
        error_log("Prepare failed: " . $conn->error);
        return false;
    }
}

function sentmail($leaderEmail, $leaderName, $password)
{


    if (filter_var($leaderEmail, FILTER_VALIDATE_EMAIL)) {
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
        $mail->addAddress($leaderEmail);

        // Set the email format to HTML
        $mail->isHTML(true);

        // Set the email subject
        $mail->Subject = "Login Credentials";

        // Construct the email body with the student's login details
        $msg = 'Dear ' . strtoupper($leaderName) . '<p>Thank you we approved your payment.</p>' .
            '<p>Your login crediantials are</p>' .
            '<p>Username: ' . $leaderEmail . '</p>' .
            '<p>Password: ' . $password . '</p>';

        // Set the email message content
        $mail->Body = $msg;

        // Send the email

        // Send OTP
        if ($mail->send()) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}


function updatePassword($leaderEmail, $pass)
{
    require "db.php";
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
    $updatePasswordQuery = "UPDATE team_and_leader_details SET password = ? WHERE leaderEmail = ?";
    if ($stmt = $conn->prepare($updatePasswordQuery)) {
        $stmt->bind_param("ss", $hashedPassword, $leaderEmail);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            // Log error for debugging
            error_log("Execute failed: " . $stmt->error);
            $stmt->close();
            return false;
        }
    } else {
        // Log error for debugging
        error_log("Prepare failed: " . $conn->error);
        return false;
    }
}
