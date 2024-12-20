<?php

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

function addMemberToDatabase($leaderEmail, $memberName, $memberMobile, $memberEmail, $memberGender, $teamName, $psId)
{
    require "db.php"; // Ensure this file contains valid `$conn` setup
    $team_id = 0;
    $is_leader = 0;

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verification Status
    $isVerified = $_SESSION['isVerified'] ?? false;

    if (!$isVerified) {
        echo json_encode([
            'success' => true,
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



    // // Member Details
    $members = $_SESSION['members'] ?? []; // Ensure members are set
    // // If you want to process each member individually
    foreach ($members as $index => $member) {
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
            $isSuccess = addMemberToDatabase($leaderEmail, $memberName, $memberMobile, $memberEmail, $memberGender, $teamName, $psId);
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

    echo json_encode([
        'success' => true,
        'message' => 'All Members Added Successfully',
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
