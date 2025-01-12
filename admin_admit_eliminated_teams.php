<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'db.php';
    $leaderEmail = $_POST['leaderEmail'];
    $leaderName = $_POST['leaderName'];
    $teamName = $_POST['teamName'];

    $stmt = $conn->prepare("UPDATE team_and_leader_details SET isEliminated=0 WHERE leaderEmail = ?");
    $stmt->bind_param("s", $leaderEmail);
    if ($stmt->execute()) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'abdulrahim74264@gmail.com';
        $mail->Password = 'iotg jqut wkks sjrt';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('abdulrahim74264@gmail.com', 'Abdul Rahim');
        $mail->addAddress($leaderEmail);
        $mail->isHTML(true);
        $mail->Subject = "Team Admitted";

        $msg = 'Dear ' . strtoupper($leaderName) . '<p>We are sorry for the inconvininece that happend with you.</p>' .
            '<p>Your team ' . $teamName . ' has been eliminated for a certain reasone </p>' .
            '<p>But that was mistake from our side you are now again participating in our event</p>';

        $mail->Body = $msg;
        if ($mail->send()) {
            echo "<script>
                alert('Team admitted again successfully');
                window.location.href = 'admin_all_teams.php';
            </script>";
        } else {
            echo "<script>
                alert('Team admitted again successfully but mail not sent');
                window.location.href = 'admin_all_teams.php';
            </script>";
        }
    } else {
        header('location:admin_all_eliminated_teams.php');
    }
}
