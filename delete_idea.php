<?php 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'db.php';

    $leaderEmail = $_POST['leaderEmail'];

    $deleteSql = "DELETE FROM team_idea_submissions WHERE leaderEmail = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("s", $leaderEmail);

    if ($deleteStmt->execute()) {
        $_SESSION['message'] = "Idea deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete idea.";
    }

    header("Location: leader_round.php");
    exit();
}