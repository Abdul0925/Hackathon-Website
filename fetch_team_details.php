<style>
    .modalClass{
        background-color: #f9f9f9;
        border: 1px solid #888;
        border-radius: 5px;
        padding: 8px;
        margin: 8px;
    }
</style>
<?php
require 'db.php'; // Include your database connection file
session_start(); // Start a new session or resume the existing session

// Check if the user is logged in



// Check if 'id' is set in the POST request
if (isset($_POST['id'])) {
    $team_id = $_POST['id']; // Retrieve the student ID from the POST data

    // Query to fetch job applications associated with the student
    $query1 = "SELECT * FROM leader_and_member_details WHERE team_id = '$team_id'"; // Get job applications for the user
    $result1 = $conn->query($query1); // Execute the query
    $sr_no = 1; // Initialize a serial number for listing the jobs
    // echo "<pre>".var_dump($result1->fetch_assoc());

    // Loop through the job applications and display each one
    while ($row1 = $result1->fetch_assoc()) {
       echo "<div class='modalClass'>"; 
      
       echo "<p><strong>$sr_no Member Name:</strong> " . $row1['memberName'] ." ".(($row1['is_leader'])?"(Team Leader)":"") . "</p>"; // Display the student's first name
       echo "<p><strong>Mobile Number:</strong> " . $row1['memberMobile'] . "</p>"; // Display the student's mobile number
       echo "<p><strong>Email:</strong> " . $row1['memberEmail'] . "</p>"; // Display the student's email address
     
       echo "</div>"; 
        $sr_no++; // Increment the serial number for the next job
    }
}
