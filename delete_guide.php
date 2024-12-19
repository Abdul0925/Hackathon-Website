<?php

require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    
    // Delete query
    $stmt = $conn->prepare("DELETE FROM guidelines WHERE id = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Problem statement deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete problem statement.']);
    }

    $stmt->close();
    $conn->close();
}
?>
