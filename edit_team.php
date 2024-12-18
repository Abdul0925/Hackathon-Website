<?php
// Database connection
require "db.php";


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $team_id = $_SESSION['id'];
    echo $team_id;
    $paymentStatusStmt = $conn->prepare("SELECT * FROM payment_details WHERE team_id = ?");
    $paymentStatusStmt->bind_param("i", $teamId);
    $paymentStatusStmt->execute();
    $statusResult = $paymentStatusStmt->get_result();
    $paymentStatus = $statusResult->fetch_assoc();
    $paymentStatus = $paymentStatus['status'];

    if ($paymentStatus == "Completed") {
        echo '<script> alert("You can not update team details after payment "); window.location.href = "mentor_my_teams.php"; </script>';
        return;
    }


    $team_id = $_POST['team_id'];
    $team_name = $_POST['team_name'];
    $problem_statement = $_POST['problem_statement'];


    // Update team details
    $updateTeamSql = "UPDATE all_team_members SET team_name = ?, ps = ? WHERE team_id = ? AND is_leader = 1";

    $stmt = $conn->prepare($updateTeamSql);
    $stmt->bind_param("ssi", $team_name, $problem_statement, $team_id);
    if ($stmt->execute()) {
        // Success response
        header("Location: mentor_my_teams.php?msg=Details added successfully $paymentStatus");
        exit;
    } else {
        // Update team details failed
        header("Location: mentor_my_teams.php?msg=Failed to edit team details");
        exit;
    }

    // Close statements
    $stmt->close();
}
