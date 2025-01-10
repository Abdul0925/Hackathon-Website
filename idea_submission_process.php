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

function addIdeaSolution($psTitle, $pptLink, $docLink, $solSummary, $psId, $leaderEmail)
{
    require "db.php";
    $team_id = getTeamId($leaderEmail);
    $ideaSubmissionQuery = "INSERT INTO team_idea_submissions
                     (team_id, leaderEmail, psId, psTitle, pptLink, docLink, solSummary) 
                     VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($ideaSubmissionQuery);

    $stmt->bind_param("issssss", $team_id, $leaderEmail, $psId, $psTitle, $pptLink, $docLink, $solSummary);
    if ($stmt->execute()) {
        return 1;
    } else {
        return 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $psTitle = $_POST['psTitle'];
    $pptLink = $_POST['pptLink'];
    $docLink = $_POST['docLink'];
    $solSummary = $_POST['solSummary'];
    $psId = $_SESSION['psId'];
    $leaderEmail = $_SESSION['leaderEmail'];

    $isAlreadySubmitted = checkIdeaSubmitted($leaderEmail);
    if($isAlreadySubmitted) {
        echo json_encode([
            'success' => false,
            'message' => 'Idea is already submitted',
        ]);
        return;
    }
    
    $isSuccess = addIdeaSolution($psTitle, $pptLink, $docLink, $solSummary, $psId, $leaderEmail);
    if (!$isSuccess) {
        echo json_encode([
            'success' => false,
            'message' => 'Error in submitting the form',
        ]);
        return;
    }

    echo json_encode([
        'success' => true,
        'message' => 'The idea is submitted if any information is filled by mistake then delete the idea and resubmit it',
    ]);
    return;
}
