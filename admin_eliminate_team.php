<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Database connection
include 'db.php';

// Check for POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $reason = $_POST['reason'];
    $teamId = $_POST['teamId'];
    $teamName = $_POST['teamName'];
    $leaderEmail = $_POST['leaderEmail'];
    $leaderName = $_POST['leaderName'];

    if (empty($reason)) {
        echo json_encode(['success' => false, 'message' => 'Reason is required.']);
        exit;
    }

    $updateQuery = "UPDATE team_and_leader_details SET isEliminated = 1 WHERE leaderEmail = ?"; 
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("s", $leaderEmail);
    $stmt->execute();

    $query = "INSERT INTO eliminated_teams (teamId, teamName, leaderEmail, reasoneOfElimination) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $teamId, $teamName, $leaderEmail, $reason);
    $result = $stmt->execute();

    if ($result) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'encartaitcell@ghrcacs.raisoni.net';
        $mail->Password = 'encartapass@email';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('encartaitcell@ghrcacs.raisoni.net', 'Encarta IT Cell');
        $mail->addAddress($leaderEmail);
        $mail->isHTML(true);
        $mail->Subject = "Team Eliminated";

        $msg = 'Dear ' . strtoupper($leaderName) . '<p>Thank you for your initiative toward this hackathon.</p>' .
            '<p>Your team ' . $teamName . ' has been eliminated for a certain reasone the reasone is <b>"' . $reason . '"</b></p>' .
            '<p>Note: We will refund your money if round 1 is not yet started</p>' .
            '<p>If you think this is an mistake from our side then please contact the hackathon volunteers.</p>';

        $mail->Body = $msg;

        if ($mail->send()) {
            echo json_encode(['success' => true]);
        }
        else {
            echo json_encode(['success' => false, 'message' => 'Email Sent Error']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}
?>
