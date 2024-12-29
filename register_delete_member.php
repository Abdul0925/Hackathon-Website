<?php 

session_start();

// Handle deleting a member
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = intval($_POST['index']);
    $gender = $_POST['gender'];

    if (isset($_SESSION['members'][$index])) {
        array_splice($_SESSION['members'], $index, 1);
        if($gender == 'Male'){
            $_SESSION['maleCount']--;
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Member not found.']);
    }

    exit; // Ensure no additional output is sent
}
?>
