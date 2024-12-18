<?php

require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ps_id = $_POST['ps_id'];

    
    // Delete query
    $stmt = $conn->prepare("DELETE FROM problem_statements WHERE ps_id = ?");
    $stmt->bind_param("s", $ps_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Problem statement deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete problem statement.']);
    }

    $stmt->close();
    $conn->close();
}
?>
