<?php 

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "Team Details: ";
    echo $_POST['teamName'];
    echo "<br>";
    echo $_POST['psId'];
    echo "<br>Leader Details: ";
    echo $_POST['leaderName'];
    echo "<br>";
    echo $_POST['leaderEmail'];
    echo "<br>";
    echo $_POST['leaderMobile'];
    echo "<br>";
    echo $_POST['leaderGender'];
    echo "<br>Member Details: <pre>";
    print_r($_SESSION['members']);
    echo "</pre><br>Payment Details: ";
    echo $_POST['transactionId'];
    echo "<br>";
    echo $_POST['paymentScreenshot'];
    echo "<br>";
    echo $_SESSION['isVerified']?"true":"false";






}