<?php
// Database connection
require "db.php";

// Check if ID is provided via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to integer to prevent SQL injection
    $teamIdStmt = $conn->prepare("SELECT * FROM all_team_members WHERE id = ?");
    $teamIdStmt->bind_param("i", $id);
    $teamIdStmt->execute();
    $statusResult = $teamIdStmt->get_result();
    $memberDetail = $statusResult->fetch_assoc();
    $team_id = $memberDetail['team_id'];
    $isLeader = $memberDetail['is_leader'];

    $paymentStatusStmt = $conn->prepare("SELECT * FROM payment_details WHERE team_id = ?");
    $paymentStatusStmt->bind_param("i", $teamId);
    $paymentStatusStmt->execute();
    $statusResult = $paymentStatusStmt->get_result();
    $paymentStatus = $statusResult->fetch_assoc();
    $paymentStatus = $paymentStatus['status'];

    if($paymentStatus == "Completed"){
        echo '<script> alert("You can not delete members after payment "); window.location.href = "mentor_my_teams.php"; </script>';
        return;
    }

    if($isLeader == true){
        echo '<script> alert("You can not delete Team Leader"); window.location.href = "mentor_my_teams.php"; </script>';
        return;
    }
    echo $isLeader;

    // Prepare the delete query
    $sql = "DELETE FROM all_team_members WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the main page with success message
        header("Location: mentor_my_teams.php?msg=Member deleted successfully");
    } else {
        // Redirect with error message
        header("Location: mentor_my_teams.php?msg=Failed to delete member");
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect if no ID is provided
    header("Location: mentor_my_teams.php?msg=Invalid request");
}

// Close the connection
$conn->close();
?>
