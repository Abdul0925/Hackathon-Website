<?php

session_start();

$memberEmail = "abdulrahim74264@gmail.com";
require "db.php";

$team_id = 0;
$is_leader = 0;
$leaderEmail = "abcd";
$memberName = "abcd";
$memberMobile = "abcd";
$memberEmail = "abcd";
$memberGender = "abcd";
$teamName = "abcd";
$psId = "abcd";
$insertMemberQuery = "INSERT INTO leader_and_member_details 
        (team_id, leaderEmail, memberName, memberMobile, memberEmail, memberGender, teamName, psId, is_leader) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the SQL statement
if ($stmt = $conn->prepare($insertMemberQuery)) {
    // Bind the parameters to the SQL query
    $stmt->bind_param("isssssssi", $team_id, $leaderEmail, $memberName, $memberMobile, $memberEmail, $memberGender, $teamName, $psId, $is_leader);

    // Execute the query
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return 1;
    } else {
        // Log error for debugging
        error_log("Execute failed: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return 0;
    }
} else {
    // Log error for debugging
    error_log("Prepare failed: " . $conn->error);
    $conn->close();
    return 0;
}
