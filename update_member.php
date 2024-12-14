<?php
// Database connection
require "db.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $teamIdStmt = $conn->prepare("SELECT team_id FROM all_team_members WHERE id = ?");
    $teamIdStmt->bind_param("i", $id);
    $teamIdStmt->execute();
    $statusResult = $teamIdStmt->get_result();
    $teamId = $statusResult->fetch_assoc();
    $teamId = $teamId['team_id'];

    $paymentStatusStmt = $conn->prepare("SELECT * FROM payment_details WHERE team_id = ?");
    $paymentStatusStmt->bind_param("i", $teamId);
    $paymentStatusStmt->execute();
    $statusResult = $paymentStatusStmt->get_result();
    $paymentStatus = $statusResult->fetch_assoc();
    $paymentStatus = $paymentStatus['status'];

    if($paymentStatus == "Completed"){
        echo '<script> alert("You can not update members after payment "); window.location.href = "mentor_my_teams.php"; </script>';
        return;
    }

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);

    // Update query
    $sql = "UPDATE all_team_members SET name = ?, email = ?, phone = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phone, $id);

    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: mentor_my_teams.php?msg=Member updated successfully");
        
    } else {
        // Redirect with error message
        header("Location: mentor_my_teams.php?msg=Failed to update member");
         
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
