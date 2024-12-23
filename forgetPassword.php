<?php
session_start();
require 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


// Handle form submission for OTP sending
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sendOtp'])) {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // echo $email;
    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate OTP
        if ($new_password == $confirm_password && strlen($new_password) > 6) {
            $otp = rand(100000, 999999);
            if ($role == 'Team Leader') {
                $_SESSION['otp'] = $otp;
                $_SESSION['email'] = $email;
                $_SESSION['new_password'] = $new_password;
                $_SESSION['role'] = 'Team Leader';

                $query = "SELECT * FROM team_and_leader_details WHERE leaderEmail = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $email); // 's' specifies that the parameter is a string
                $stmt->execute();

                $result = $stmt->get_result();
                if ($result->num_rows == 0) {
                    echo '<script> alert("User Not Exist!"); window.location.href = "forgetPassword.php"; </script>';
                } else {
                    echo "<script>document.getElementById('resetButton').addEventListener('click', ()=>{
                        setTimeout(()=>{
                            document.getElementById('resetButton').disabled = true;
                        },500)
                    })</script>";
                    $mentor = $result->fetch_assoc();
                    $email = $_POST['email'];
                    $mail = new PHPMailer(true);
                    // Configure the mail server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';           // SMTP server address
                    $mail->SMTPAuth = true;
                    $mail->Username = 'abdulrahim74264@gmail.com'; // Your email username
                    $mail->Password = 'iotg jqut wkks sjrt';       // Your email password (use an app-specific password if needed)
                    $mail->SMTPSecure = 'ssl';                // Enable SSL encryption
                    $mail->Port = 465;                        // Port for SSL
                    $mail->setFrom('abdulrahim74264@gmail.com', 'Abdul Rahim');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = "OTP for Reset Password";
                    $msg = 'Dear ' . strtoupper($mentor['first_name']) . '<p> your one time password for password process is:</p>' .
                        '<p>OTP: ' . $_SESSION['otp'] . '</p>';
                    $mail->Body = $msg;
                    if ($mail->send()) {
                        $otp_sent = true;
                        $message = "OTP sent successfully to " . $email;
                    } else {
                        $otp_sent = false;
                        $message = "Failed to send OTP. Please try again.";
                        echo "<script>document.getElementById('resetButton').addEventListener('click', ()=>{
                            setTimeout(()=>{
                                document.getElementById('resetButton').disabled = false;
                            },500)
                        })</script>";
                    }
                }
            } else {
                $message1 = "Only Leader can change password If your are already a Leader and got Login credentials plz contact admin";
            }
        } else {
        //     echo "<script>document.getElementById('resetButton').addEventListener('click', ()=>{
        //     setTimeout(()=>{
        //         document.getElementById('resetButton').disabled = true;
        //     },500)
        // })</script>";
            $message1 = "Password Not Match OR Please create password more than 6 characters";
        }
    } else {
        $otp_sent = false;
        // echo "<script>document.getElementById('resetButton').addEventListener('click', ()=>{
        //     setTimeout(()=>{
        //         document.getElementById('resetButton').disabled = true;
        //     },500)
        // })</script>";
        $message1 = "Invalid email address.";
    }
}


// Handle OTP verification and form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verifyOtp'])) {
    $entered_otp = $_POST['otpInput'];
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];

    // Check if entered OTP matches the session OTP
    if ($entered_otp == $_SESSION['otp']) {

        // OTP is valid
        $reset_success = true;
        $message = "Registration successful! Wait we are redirecting to you on Login Page";


        // Clear session OTP after successful verification
        unset($_SESSION['otp']);
        $password = $_SESSION['new_password'];

        $mail = new PHPMailer(true);

        // Configure the mail server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';           // SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'abdulrahim74264@gmail.com'; // Your email username
        $mail->Password = 'iotg jqut wkks sjrt';       // Your email password (use an app-specific password if needed)
        $mail->SMTPSecure = 'ssl';                // Enable SSL encryption
        $mail->Port = 465;                        // Port for SSL
        $mail->setFrom('abdulrahim74264@gmail.com', 'Abdul Rahim');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Login Credentials";

        // Construct the email body with the student's login details
        $msg = 'Dear ' . strtoupper($first_name) . '<p> Your password for RJH has Changed Successfully if its not you than contact us</p>' .
            '<p>Username: ' . $email . '</p>';

        // Set the email message content
        $mail->Body = $msg;


        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query = "UPDATE team_and_leader_details SET password = ? WHERE leaderEmail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $hashedPassword, $email);
        if ($stmt->execute()) {
            // if ($mail->Send()) {
            echo '<script> alert("Password Reset successful!"); window.location.href = "loginPage.php"; </script>';
            // }
            // } else {

            // echo '<script> alert("Error in reset Password Try Again!"); window.location.href = "loginPage.php"; </script>';
        } else {
            echo '<script> alert("Error in reset Password Try Again!"); window.location.href = "loginPage.php"; </script>';
        }
    } else {
        // OTP is invalid
        $reset_success = false;
        $message = "Invalid OTP. Please try again.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RJH Forget Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>

        .login-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 15px;
            border-bottom: 8px;
            border-right: 8px;
            border-style: solid;
            font-family: "Oxanium", sans-serif;
        }

        .login-container h3 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: black;
            font-family: "Oxanium", sans-serif;
        }

        .login-container .inputBox
        {
        position: relative;
        width: 100%;
        margin-top: 10px;
        }

        .login-container .inputBox input,
        .login-container .inputBox textarea
        {
        width: 100%;
        padding: 5px 0;
        font-size: 16px;
        margin: 10px 0;
        border: none;
        border-bottom: 2px solid #333;
        outline: none;
        resize: none;
        }

        .login-container .inputBox span
        {
        position: absolute;
        Left: 0;
        padding: 5px 0;
        font-size: 16px;
        margin: 10px 0;
        pointer-events: none;
        transition: 0.5s;
        color: #948686;
        }

        .login-container .inputBox input:focus ~ span,
        .login-container .inputBox input:valid ~ span,
        .login-container .inputBox textarea:focus ~ span,
        .login-container .inputBox textarea:valid ~ span
        {
        color: #5C0F8B;
        font-size: 12px;
        transform: translateY(-20px);
        }

        .form-control {
            border-radius: 8px;
        }

        .form-group {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 8px;
        }

        .extra-links {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .extra-links a {
            font-size: 14px;
        }

        .dropdown-menu {
            border-radius: 8px;
        }
    </style>
</head>

<body style="background-color: white">
    <?php require('indexNavbar.php'); ?>

    <div class="login-container">
        <h3>Reset your Password</h3>

        <!-- Display Message if Available -->
        <?php if (isset($message1)): ?>
            <div class="alert alert-<?php echo isset($otp_sent) && $otp_sent ? 'success' : 'danger'; ?>">
                <?php echo $message1; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo isset($otp_sent) && $otp_sent ? 'success' : 'danger'; ?>">
                <?php echo $message; ?>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#otpModal">VERIFY OTP</button>
            </div>
        <?php endif; ?>


        <form method="POST" action="">
            <!-- Email -->
            <div class="inputBox">
                <input type="email" name="email" id="email" required>
                <span>Enter your email</span>
            </div>

            <!-- Password -->
            <div class="inputBox">
                <input type="password" name="new_password" id="password" required>
                <span>Enter new password</span>
            </div>
            <div class="inputBox">
                <input type="password" name="confirm_password" id="password" required>
                <span>Confirm password</span>
            </div>

            <!-- Role Dropdown -->
            <div class="form-group">
                <select class="form-control" name="role" id="role" required>
                    <option selected disabled>Please Select Your Role</option>
                    <option value="institute-college">Institute/College</option>
                    <option value="Team Leader">Team Leader</option>
                    <option value="mentor">Mentor</option>
                </select>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="btn my-primary-btn w-100" name="sendOtp" id="resetButton">RESET Password</button>
           
            <!-- Extra Links (Register and Forget Password) -->
                
        </form>
    </div>



    <!-- OTP Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">Enter OTP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="otpInput" class="form-label">Enter OTP</label>
                            <input type="text" class="form-control" name="otpInput" placeholder="Enter OTP" required>
                        </div>
                        <button type="submit" class="btn my-primary-btn w-100 mt-3" name="verifyOtp" id="verifyBtn">Verify OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        // document.getElementById('resetButton').addEventListener('click', () => {
        //     setTimeout(() => {
        //         document.getElementById('resetButton').disabled = true;
        //     }, 500)
        // })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>