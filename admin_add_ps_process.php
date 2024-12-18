<?php
session_start();
//require "db.php";
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}
?>
<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $psId = $_POST['psId'];
    $psName = $_POST['psName'];
    $psCategory = $_POST['psCategory'];
    $psGivenBy = $_POST['psGivenBy'];
    $psDificulty = $_POST['psDificulty'];
    $psDescription = $_POST['psDescription'];
    $noOfParticipation = 0;

    try {
        $query = "INSERT INTO problem_statements(ps_id, ps_name, ps_category, ps_description, ps_difficulty_level, ps_given_by, no_of_participation) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssi', $psId, $psName, $psCategory, $psDescription, $psDificulty, $psGivenBy, $noOfParticipation);
        if ($stmt->execute()) {
            echo '<script>alert("PS Added Successfully!")</script>';
            echo '<script>window.location.href = "admin_problem_statements.php"; </script>';
        } else {
            echo '<script>alert("Failed to Add PS!")</script>';
            echo '<script> alert("Error! Try Again!"); window.location.href = "admin_problem_statements.php"; </script>';
        }
    } catch (mysqli_sql_exception $e) {
        // Check for duplicate entry error
        if ($e->getCode() == 1062) { // Error code for duplicate entry
            echo "Error: Duplicate entry for 'ps_id'. Please use a unique value.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    } finally {
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}

?>