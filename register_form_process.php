<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
session_start();
require "db.php";

function randomPassword()
{
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function checkAlreadyAMember($memberEmail)
{
    require "db.php";
    // return 1;
    // Prepare the SQL query to check for the email
    $checkMemberEmail = "SELECT COUNT(*) AS count FROM leader_and_member_details WHERE memberEmail = ?";
    // Initialize a prepared statement
    if ($memberEmailStmt = $conn->prepare($checkMemberEmail)) {
        // Bind the email parameter to the query
        $memberEmailStmt->bind_param("s", $memberEmail);

        // Execute the query
        $memberEmailStmt->execute();

        // Fetch the result
        $memberEmailResult = $memberEmailStmt->get_result();
        $memberEmailrow = $memberEmailResult->fetch_assoc();

        // Check if the count is greater than 0
        if ($memberEmailrow['count'] > 0) {

            return true; // Email exists
        } else {
            return false; // Email does not exist
        }
    } else {
        // Handle query preparation failure
        return false;
        die("Query preparation failed: " . $conn->error);
    }


    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

function getTeamId($leaderEmail)
{
    require "db.php";
    $getTeamIdQuery = "SELECT id FROM team_and_leader_details WHERE leaderEmail = ?";
    if ($stmt = $conn->prepare($getTeamIdQuery)) {
        $stmt->bind_param("s", $leaderEmail);
        if ($stmt->execute()) {
            $stmt->bind_result($teamId);

            // Fetch the result
            if ($stmt->fetch()) {
                $stmt->close();
                return $teamId;
            } else {
                $stmt->close();
                return null;
            }
        } else {
            $stmt->close();
            return null;
        }
    } else {
        return null;
    }
}

function updateTeamId($leaderEmail)
{
    require "db.php";
    $team_id = getTeamId($leaderEmail);
    $updateTeamIdQuery = "UPDATE leader_and_member_details SET team_id = ? WHERE leaderEmail = ?";
    if ($stmt = $conn->prepare($updateTeamIdQuery)) {

        $stmt->bind_param("is", $team_id, $leaderEmail);

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

function addMemberToDatabase($leaderEmail, $memberName, $memberMobile, $memberEmail, $memberGender, $teamName, $psId, $is_leader)
{
    require "db.php"; // Ensure this file contains valid `$conn` setup
    $team_id = 0;


    $insertMemberQuery = "INSERT INTO leader_and_member_details 
        (team_id, leaderEmail, memberName, memberMobile, memberEmail, memberGender, teamName, psId, is_leader) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($insertMemberQuery)) {

        $stmt->bind_param("isssssssi", $team_id, $leaderEmail, $memberName, $memberMobile, $memberEmail, $memberGender, $teamName, $psId, $is_leader);

        if ($stmt->execute()) {

            return 1;
        } else {


            return 0;
        }
    } else {

        return 0;
    }
}

function addLedarDetails($teamName, $psId, $leaderName, $leaderMobile, $leaderEmail, $password, $leaderGender, $role, $no_of_members)
{
    require "db.php"; // Ensure this file contains valid `$conn` setup
    $image_name = "";
    $image_path = "";
    $password = randomPassword();
    $role = "Team Leader";
    $is_leader = 1;
    $insertLeaderQuery = "INSERT INTO team_and_leader_details
        (teamName, psId, leaderName, leaderMobile, leaderEmail, password, leaderGender, role, no_of_members, image_name, image_path) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($insertLeaderQuery)) {

        $stmt->bind_param("ssssssssiss", $teamName, $psId, $leaderName, $leaderMobile, $leaderEmail, $password, $leaderGender, $role, $no_of_members, $image_name, $image_path);

        if ($stmt->execute()) {
            $addLeaderToMember = addMemberToDatabase($leaderEmail, $leaderName, $leaderMobile, $leaderEmail, $leaderGender, $teamName, $psId, $is_leader);
            $updatedSuccess = updateTeamId($leaderEmail);
            // $updatePS = updateProblemStatement($psId);
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function addPaymentDetails($transactionId, $paymentScreenshot, $leaderEmail)
{
    require "db.php";

    $team_id = getTeamId($leaderEmail);
    $status = "Completed";

    $is_approved = false;
    $paymentScreenshot = $_FILES['paymentScreenshot'];
    $fileName = $paymentScreenshot['name'];
    $fileTmpName = $paymentScreenshot['tmp_name'];
    $fileSize = $paymentScreenshot['size'];
    $fileError = $paymentScreenshot['error'];
    $fileType = $paymentScreenshot['type'];
    // File extension
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Allowed file types
    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000000) { // 5MB max size
                // Create unique file name to avoid overwriting
                $newFileName = uniqid('', true) . "." . $fileExt;

                // Upload directory
                $uploadDir = 'uploads/payments/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
                }

                // File destination
                $fileDestination = $uploadDir . $newFileName;

                // Move the file to the upload directory
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // Insert or update in the database
                    // Ensure email is set in session
                    $paymentDetailQuery = "INSERT INTO payment_details
                     (team_id, transactionId, status, pay_name, pay_path, is_approved) 
                     VALUES (?, ?, ?, ?, ?, ?)";

                    $stmt = $conn->prepare($paymentDetailQuery);

                    $stmt->bind_param("sssssi", $team_id, $transactionId, $status, $newFileName, $fileDestination, $is_approved);
                    if ($stmt->execute()) {
                        return 1;
                        // echo "Profile picture updated successfully.";
                    } else {
                        return 0;
                        // echo "Database error: " . $conn->error;
                    }
                } else {
                    return 0;
                    // echo "There was an error uploading your file.";
                }
            } else {
                return 0;
                // echo "File size exceeds the 5MB limit.";
            }
        } else {
            return 0;
            // echo "There was an error uploading the file.";
        }
    } else {
        return 0;
        // echo "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verification Status
    $isVerified = $_SESSION['isVerified'] ?? false;

    if (!$isVerified) {
        echo json_encode([
            'success' => false,
            'message' => 'Please Verify Email Before Submitting!',
        ]);
        return;
    }


    // Team Details
    $teamName = $_POST['teamName'];
    $psId = $_POST['psId'];

    // // Leader Details
    $leaderName = $_POST['leaderName'];
    $leaderMobile = $_POST['leaderMobile'];
    $leaderEmail = $_POST['leaderEmail'];
    $password = randomPassword();
    $leaderGender = $_POST['leaderGender'];
    $role = "Team Leader";


    // Payment Details
    $transactionId = $_POST['transactionId'];
    $paymentScreenshot = $_FILES['paymentScreenshot'];

    $no_of_members = 0;
    // // Member Details
    $members = $_SESSION['members'] ?? []; // Ensure members are set
    // // If you want to process each member individually
    foreach ($members as $index => $member) {
        $no_of_members++;
        $is_leader = 0;
        $memberName = $member['name'] ?? 'N/A';
        $memberEmail = $member['email'] ?? 'N/A';
        $memberMobile = $member['mobile'] ?? 'N/A';
        $memberGender = $member['gender'] ?? 'N/A';

        $alreadyAMember = checkAlreadyAMember($memberEmail);

        if ($alreadyAMember) {
            echo json_encode([
                'success' => true,
                'message' => 'Already Exist in any team',
                'name' => $memberName,
            ]);
            return;
        } else {
            $isSuccess = addMemberToDatabase($leaderEmail, $memberName, $memberMobile, $memberEmail, $memberGender, $teamName, $psId, $is_leader);
            if (!$isSuccess) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Error Adding Member',
                    'name' => $memberName,
                ]);
                return;
            }
        }
    }

    $isLeaderAdded = addLedarDetails($teamName, $psId, $leaderName, $leaderMobile, $leaderEmail, $password, $leaderGender, $role, $no_of_members);
    if (!$isLeaderAdded) {
        echo json_encode([
            'success' => false,
            'message' => 'Error in Leader Details',
            'name' => $leaderName,
        ]);
        return;
    }

    $isPaid = addPaymentDetails($transactionId, $paymentScreenshot, $leaderEmail);
    if (!$isPaid) {
        echo json_encode([
            'success' => false,
            'message' => 'Error in Payment Details',
            'name' => $leaderName,
        ]);
        return;
    }
    $isSent = sentmail($leaderEmail, $leaderName, $psId, $teamName);
    if (!$isSent) {
        echo json_encode([
            'success' => false,
            'message' => 'Error in Email Sending',
        ]);
        return;
    }
    echo json_encode([
        'success' => true,
        'message' => 'From Submitted Successfully',
    ]);
    return;


    // // Payment Details
    // $transactionId = $_POST['transactionId'];
    // $paymentScreenshot = $_POST['paymentScreenshot'];



    // echo "</pre><br>Payment Details: ";
    // echo $_POST['transactionId'];
    // echo "<br>";
    // echo $_POST['paymentScreenshot'];
    // echo "<br>";
    // echo $_SESSION['isVerified'] ? "true" : "false";
} else {
    // Handle if the request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method.', 'error' => 'Error Ocuured']);
}





function sentmail($leaderEmail, $leaderName, $psId, $teamName)
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
        $mail->Subject = "Registartion Successfull";

        // Construct the email body with the student's login details
        $msg = 'Dear ' . strtoupper($leaderName) . '<p>Thank you for your initiative toward this hackathon.</p>' .
            '<p>Your team ' . $teamName . ' has chosen a problem statement no ' . strtoupper($psId) . '</p>' .
            '<p>We will send you your login crediantials after verifying your payment status</p>' .
            '<p>You will receive your login credentials via email. If you do not receive an email regarding your submission, please contact the hackathon volunteers.</p>';

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


function updateProblemStatement($psId)
{
    require "db.php";
    $updateStmt = $conn->prepare("UPDATE problem_statements SET no_of_participation = no_of_participation + 1 WHERE ps_id = ?");
    $updateStmt->bind_param("s", strtoupper($psId));
    if ($updateStmt->execute()) {
        $updateStmt->close();
        return true;
    } else {
        // Log error for debugging
        error_log("Execute failed: " . $updateStmt->error);
        $updateStmt->close();
        return false;
    }
}
