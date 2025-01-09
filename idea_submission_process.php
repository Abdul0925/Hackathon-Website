<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
session_start();
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $psTitle = $_POST['psTitle'];

    echo json_encode([
        'success' => true,
        'message' => 'Button clicked'.' '.$psTitle,
    ]);
    return;
}