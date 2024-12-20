<?php 

session_start();

// Handle deleting a member
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = intval($_POST['index']);

    if (isset($_SESSION['members'][$index])) {
        array_splice($_SESSION['members'], $index, 1);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Member not found.']);
    }

    exit; // Ensure no additional output is sent
}
?>
