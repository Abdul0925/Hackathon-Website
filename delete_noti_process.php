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
    $noti_id = $_POST['noti_id'];
    $query = "DELETE FROM notifications WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $noti_id);
    if ($stmt->execute()) {
        // echo $noti_id;
        echo '<script> window.location.href = "add_notifications.php"; </script>';
    } else {

        echo '<script> alert("Error! Try Again!"); window.location.href = "add_notifications.php"; </script>';
    }
}

?>