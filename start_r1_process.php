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
    $startRoundQuery = "UPDATE admin_rounds SET on_going = ? , date = ? WHERE title = ?";
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
