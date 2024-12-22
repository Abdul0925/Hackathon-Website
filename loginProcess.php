<?php 
session_start();
require "db.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    echo $role;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($role == 'Team Leader') {
            $query = "SELECT * FROM team_and_leader_details WHERE leaderEmail = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $mentor = $result->fetch_assoc(); 

                if (password_verify($password, $mentor['password'])) {
                // if ($password == $mentor['password']) {
                    $_SESSION['leaderName'] = $mentor['leaderName'];
                    $_SESSION['leaderMobile'] = $mentor['leaderMobile'];
                    $_SESSION['leaderEmail'] = $mentor['leaderEmail'];
                    $_SESSION['id'] = $mentor['id'];
                    $_SESSION['leader_logged_in'] = true;
                    echo '<script>alert("Login successful!"); window.location.href = "mentor_dashboard_shad.php";</script>';
                } else {
                    if ($password == $mentor['password']) {
                        $_SESSION['leaderName'] = $mentor['leaderName'];
                        $_SESSION['leaderMobile'] = $mentor['leaderMobile'];
                        $_SESSION['leaderEmail'] = $mentor['leaderEmail'];
                        $_SESSION['id'] = $mentor['id'];
                        $_SESSION['leader_logged_in'] = true;
                        echo '<script>alert("Login successful!"); window.location.href = "mentor_dashboard_shad.php";</script>';
                    }else{

                        echo '<script>alert("Invalid password. Please try again."); window.location.href = "loginPage.php";</script>';
                    }
                }
            } else {
                echo '<script>alert("No user found with that email."); window.location.href = "loginPage.php";</script>';
            }
        } else 
        if(($role == 'super-admin')){
            echo '<script>alert("Work in Progress"); window.location.href = "loginPage.php";</script>';
        }
        else{
            echo '<script>alert("Invalid Role"); window.location.href = "loginPage.php";</script>';
        }
    } else {
        if(($role == 'super-admin')){
            $query = "SELECT * FROM admin_details WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $admin = $result->fetch_assoc(); 

                if ($password == $admin['password']) {
                    $_SESSION['admin_logged_in'] = true;
                    echo '<script>alert("Login successful!"); window.location.href = "admin_dashboard.php";</script>';
                } else {
                    echo '<script>alert("Invalid password. Please try again."); window.location.href = "loginPage.php";</script>';
                }
            } else {
                echo '<script>alert("No user found with that email."); window.location.href = "loginPage.php";</script>';
            }
        }
        echo '<script>alert("Invalid email Address"); window.location.href = "loginPage.php";</script>';
    }
}
