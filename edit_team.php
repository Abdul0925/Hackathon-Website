<?php
// Database connection
require "db.php";


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


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
