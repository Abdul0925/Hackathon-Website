<?php
// Database connection
require "db.php";

// Check if ID is provided via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to integer to prevent SQL injection

    // Prepare the delete query
    $sql = "DELETE FROM all_team_members WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the main page with success message
        header("Location: mentor_my_teams.php?msg=Member deleted successfully");
    } else {
        // Redirect with error message
        header("Location: mentor_my_teams.php?msg=Failed to delete member");
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect if no ID is provided
    header("Location: mentor_my_teams.php?msg=Invalid request");
}

// Close the connection
$conn->close();
?>
