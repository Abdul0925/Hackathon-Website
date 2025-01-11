<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
session_start();
require "db.php";


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
function checkIdeaSubmitted($leaderEmail)
{
    require "db.php";
    $checkIdeaQuery = "SELECT id FROM team_idea_submissions WHERE leaderEmail = ?";
    if ($stmt = $conn->prepare($checkIdeaQuery)) {
        $stmt->bind_param("s", $leaderEmail);
        if ($stmt->execute()) {
            $stmt->bind_result($teamId);

            // Fetch the result
            if ($stmt->fetch()) {
                $stmt->close();
                return $teamId;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            $stmt->close();
            return false;
        }
    } else {
        return false;
    }
}

function ideaApproval($leaderEmail)
{
    require "db.php";
    $ideaSubmissionQuery = "UPDATE team_idea_submissions SET isApproved = 1 WHERE leaderEmail = ?";
    $stmt = $conn->prepare($ideaSubmissionQuery);

    $stmt->bind_param("s", $leaderEmail);
    if ($stmt->execute()) {
        return 1;
    } else {
        return 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $leaderEmail = $_POST['leaderEmail'];

    $isIdeaApproved = ideaApproval($leaderEmail);
    if($isIdeaApproved) {
        echo json_encode([
            'success' => true,
            'message' => 'Idea Approved',
        ]);
        return;
    }
   

    echo json_encode([
        'success' => false,
        'message' => 'Error in approving idea',
    ]);
    return;
}
