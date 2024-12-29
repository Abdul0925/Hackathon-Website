<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['members'])) {
        $_SESSION['members'] = [];
    }

    if (!isset($_SESSION['maleCount'])) {
        $_SESSION['maleCount'] = 0;
    }

    if (count($_SESSION['members']) < 3) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $mobile = htmlspecialchars($_POST['mobile']);
        $gender = htmlspecialchars($_POST['memberGender']);
        if ($_SESSION['leaderGender'] == '') {
            echo json_encode([
                'success' => false,
                'error' => 'Please Verify Leader Email Before Adding Members.',
            ]);
            return;
        }

        if ($_SESSION['leaderGender'] == 'Male') {
            if ($gender == 'Male') {
                $_SESSION['maleCount']++;
            }
            if ($gender == 'Female') {
                $_SESSION['maleCount']--;
            }
            if ($_SESSION['maleCount'] > 2) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Atleast One Female Member Required.',
                ]);
                return;
            }
        }

        $newMember = [
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'gender' => $gender,
        ];

        $_SESSION['members'][] = $newMember;
        $index = count($_SESSION['members']) - 1; // Get index of the new member


        echo json_encode([
            'success' => true,
            'member' => $newMember,
            'index' => $index,
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Maximum 4 members can be added.',
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request.',
    ]);
}
