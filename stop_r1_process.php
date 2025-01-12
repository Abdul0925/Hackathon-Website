<?php


session_start();
require "db.php";



function stopRound($title, $on_going)
{
    require "db.php";
    $updateRoundQuery = "UPDATE admin_rounds SET on_going = 0 WHERE title = 'Round 1'";
    $stmt = $conn->prepare($updateRoundQuery);

    if ($stmt->execute()) {
        return 1;
    } else {
        return 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = 'Round 1';
    $on_going = true;

    $isStopped = stopRound($title, $on_going);
    if($isStopped) {
        echo json_encode([
            'success' => true,
            'message' => 'Round Stopped',
        ]);
        return;
    }

    echo json_encode([
        'success' => false,
        'message' => 'Error in Stopping Round',
    ]);
    return;
}
