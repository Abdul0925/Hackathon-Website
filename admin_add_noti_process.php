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
    $notification = $_POST['notification'];
    $query = "INSERT INTO notifications(notification) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $notification);
    if ($stmt->execute()) {
        echo '<script> alert("Notification added successfully"); window.location.href = "admin_show_notifications.php"; </script>';
    } else {

        echo '<script> alert("Error! Try Again!"); window.location.href = "admin_add_notifications.php"; </script>';
    }
}

?>