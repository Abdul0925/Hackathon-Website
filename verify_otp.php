<?php

// verify_otp.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOtp = $_POST['otp'];

    // Compare entered OTP with the one stored in the session
    if ($enteredOtp == $_SESSION['otp']) {
        // OTP is correct
        $_SESSION['isVerified'] = true;
        echo json_encode(['success' => true]);
    } else {
        // OTP is incorrect
        echo json_encode(['success' => false]);
    }
}
