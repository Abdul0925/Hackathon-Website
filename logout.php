<?php
session_start();

$_SESSION['mentor_logged_in'] = false;
$_SESSION['admin_logged_in'] = false;
session_unset();

header("location:loginPage.php");