<?php

header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
session_start();
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = 'Round 1';
    $updateQuery = "UPDATE admin_rounds SET on_going = 0, isResultAnnounced = 1, resultDate = CURRENT_TIMESTAMP WHERE title = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('s', $title);
    if (!$stmt->execute()) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update result declaration status',
        ]);
        return;
    }
    

    $mail = new PHPMailer(true);
    $result = mysqli_query($conn, "SELECT leaderEmail FROM team_and_leader_details");
    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'encartaitcell@ghrcacs.raisoni.net';
    $mail->Password = 'encartapass@email'; // Use an app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('encartaitcell@ghrcacs.raisoni.net', 'Encarta IT Cell');
    $mail->Subject = "Results Declared";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $mail->addAddress($row['leaderEmail']);
        $mail->Body = "Dear Team Leader,\n\nThe results for Round 1 have been declared. Please check the portal for details.\n\nBest Regards,\nAdmin Team";
    
        if (!$mail->send()) {
            echo json_encode([
                'success' => false,
                'message' => 'Mail Not Sent',
            ]);
            return;
        }
    
        $mail->clearAddresses(); // Clear recipient list for the next iteration
    }


        echo json_encode([
            'success' => true,
            'message' => 'Mail Sent',
        ]);
        return;
    
}