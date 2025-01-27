<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require "db.php";

function addData($name, $email, $contact, $query, $optional_message) {
    require "db.php";
    $insertDataQuery = "INSERT INTO contact_us
    (name, email, contact, query, optional_message)
    VALUES(?, ?, ?, ?, ?)";
    if($stmt = $conn->prepare($insertDataQuery)) {
        $stmt->bind_param("sssss", $name, $email, $contact, $query, $optional_message);
        if($stmt->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
    else {
        return 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $contact = htmlspecialchars($_POST['contact']);
    if (!preg_match('/^[6-9][0-9]{9}$/', $contact)) {
        echo json_encode([
            'success' => false,
            'message' => 'not valid please provide valid mobile number!',
            'name' => 'Contact',
        ]);
        return;
    }
    $query = htmlspecialchars($_POST['query']);
    $optional_message = htmlspecialchars($_POST['optional_message']);

    $isDataSaved = addData($name, $email, $contact, $query, $optional_message);
    if(!$isDataSaved){
        echo json_encode([
            'success' => false,
            'message' => 'not valid Try in icognative mode',
            'name' => 'Data',
        ]);
        return;
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Form Submitted Successfully',
    ]);
    return;


} else {
    // Handle if the request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method.', 'error' => 'Error Ocuured']);
}
