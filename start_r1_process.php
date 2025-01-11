<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
session_start();
require "db.php";



function startRound($title, $on_going)
{
    require "db.php";

    date_default_timezone_set('Asia/Kolkata');
    $currentDate = date('Y-m-d H:i:s');
    // Check if the round already exists
    $checkRoundQuery = "SELECT * FROM admin_rounds WHERE title = ?";
    $stmt = $conn->prepare($checkRoundQuery);
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If the round exists, update it
        $startRoundQuery = "UPDATE admin_rounds SET on_going = ?, date = ? WHERE title = ?";
    } else {
        // If the round does not exist, insert a new record
        $startRoundQuery = "INSERT INTO admin_rounds (on_going, date, title) VALUES (?, ?, ?)";
    }
    // $startRoundQuery = "UPDATE admin_rounds SET on_going = ? , date = ? WHERE title = ?";
    $stmt = $conn->prepare($startRoundQuery);
    $stmt->bind_param("iss", $on_going, $currentDate, $title);
    if ($stmt->execute()) {
        return 1;
    } else {
        return 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = 'Round 1';
    $on_going = true;

    $isStarted = startRound($title, $on_going);
    if($isStarted) {
        echo json_encode([
            'success' => true,
            'message' => 'Round Started',
        ]);
        return;
    }

    echo json_encode([
        'success' => false,
        'message' => 'Error in Starting Round',
    ]);
    return;
}
