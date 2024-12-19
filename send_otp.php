<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    
  

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
       

        // Store OTP in session for verification later
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

       // $query = "SELECT * FROM mentor_details WHERE email = ?";
        //$stmt = $conn->prepare($query);
        //$stmt->bind_param("s", $email); // 's' specifies the variable type => 'string'
       // $stmt->execute();

       // $result = $stmt->get_result();
       // if ($result->num_rows > 0) {
        //    echo '<script> alert("User Already Exist Try Again!"); window.location.href = "registerPage.php"; </script>';
       // } else {


            // $email = $_POST['email'];
            $mail = new PHPMailer(true);

            // Configure the mail server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';           // SMTP server address
            $mail->SMTPAuth = true;
            $mail->Username = 'abdulrahim74264@gmail.com'; // Your email username
            $mail->Password = 'iotg jqut wkks sjrt';       // Your email password (use an app-specific password if needed)
            $mail->SMTPSecure = 'ssl';                // Enable SSL encryption
            $mail->Port = 465;                        // Port for SSL

            // Set the sender's email and name
            $mail->setFrom('abdulrahim74264@gmail.com', 'Abdul Rahim');

            // Add the recipient's email (student's email)
            $mail->addAddress($email);

            // Set the email format to HTML
            $mail->isHTML(true);

            // Set the email subject
            $mail->Subject = "OTP for Registration";

            // Construct the email body with the student's login details
            $msg =  '<p> your one time password for registraion process is: </p>' .
                '<p>OTP: ' . $_SESSION['otp'] . '</p>';

            // Set the email message content
            $mail->Body = $msg;

            // Send the email

            // Send OTP
            if ($mail->send()) {
                $otp_sent = true;
                echo "OTP sent successfully to " . $email;
            } else {
                $otp_sent = false;
                echo "Failed to send OTP. Please try again.";
            }
        }
    } else {
        $otp_sent = false;
        echo "Invalid email address.";
 //   }
    
}
