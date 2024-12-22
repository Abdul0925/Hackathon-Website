<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = intval($_POST['index']);

    if (isset($_SESSION['members'][$index])) {
        $_SESSION['members'][$index] = [
            'name' => htmlspecialchars($_POST['name']),
            'email' => htmlspecialchars($_POST['email']),
            'mobile' => htmlspecialchars($_POST['mobile']),
            'gender' => htmlspecialchars($_POST['gender'])
        ];
        echo json_encode([
            'success' => true,
            'name' => htmlspecialchars($_POST['name']),
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Member not found.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request.']);
}
