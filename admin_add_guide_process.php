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
    $guideline = $_POST['guideline'];
    $query = "INSERT INTO guidelines(guideline) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $guideline);
    if ($stmt->execute()) {
        echo '<script>alert("Guideline added succcesfully"); window.location.href = "admin_guidelines.php"; </script>';
    } else {

        echo '<script> alert("Error! Try Again!"); window.location.href = "admin_guidelines.php"; </script>';
    }
}

?>
