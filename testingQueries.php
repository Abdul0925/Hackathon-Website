<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
session_start();

// $memberEmail = "abdulrahim74264@gmail.com";
// require "db.php";

// $team_id = 0;
// $is_leader = 0;
// $memberName = "abcd";
// $memberMobile = "abcd";
// $memberEmail = "abcd";
// $memberGender = "abcd";
// $teamName = "abcd";
// $psId = "abcd";
// $insertMemberQuery = "INSERT INTO leader_and_member_details 
//         (team_id, leaderEmail, memberName, memberMobile, memberEmail, memberGender, teamName, psId, is_leader) 
//         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
// $image_name = "";
// $image_path = "";
// $leaderName = "abcd";
// $leaderMobile = "abcd";
// $leaderEmail = "abcd";
// $password = "abcd";
// $leaderGender = "abcd";
// $role = "abcd";
// $no_of_members = "abcd";
// $leaderEmail = "abcd";


// Prepare the SQL statement
// if ($stmt = $conn->prepare($insertMemberQuery)) {
//     // Bind the parameters to the SQL query
//     $stmt->bind_param("isssssssi", $team_id, $leaderEmail, $memberName, $memberMobile, $memberEmail, $memberGender, $teamName, $psId, $is_leader);

//     // Execute the query
//     if ($stmt->execute()) {
//         $stmt->close();
//         $conn->close();
//         return 1;
//     } else {
//         // Log error for debugging
//         error_log("Execute failed: " . $stmt->error);
//         $stmt->close();
//         $conn->close();
//         return 0;
//     }
// } else {
//     // Log error for debugging
//     error_log("Prepare failed: " . $conn->error);
//     $conn->close();
//     return 0;
// }

// $insertLeaderQuery = "INSERT INTO team_and_leader_details 
//         (teamName, psId, leaderName, leaderMobile, leaderEmail, password, leaderGender, role, no_of_members, image_name, image_path) 
//         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
// if ($stmt = $conn->prepare($insertLeaderQuery)) {

//     $stmt->bind_param("ssssssssiss", $teamName, $psId, $leaderName, $leaderMobile, $leaderEmail, $password, $leaderGender, $role, $no_of_members, $image_name, $image_path);

//     if ($stmt->execute()) {
// echo "Done";
// } else {

//     echo "Not Done";

// }
// } else {
//     echo "Error";

// }

// $password = randomPassword();
// echo $password;

// function randomPassword()
// {
//     $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
//     $pass = array(); //remember to declare $pass as an array
//     $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
//     for ($i = 0; $i < 8; $i++) {
//         $n = rand(0, $alphaLength);
//         $pass[] = $alphabet[$n];
//     }
//     return implode($pass); //turn the array into a string
// }


// $leaderEmail = "faf@gmail.com";
// $getTeamIdQuery = "SELECT id FROM team_and_leader_details WHERE leaderEmail = ?";
//     if ($stmt = $conn->prepare($getTeamIdQuery)) {
//         $stmt->bind_param("s", $leaderEmail);
//         if ($stmt->execute()) {
//             $stmt->bind_result($teamId);

//             // Fetch the result
//             if ($stmt->fetch()) {
//                 $stmt->close();
//                 echo $teamId;
//             } else {
//                 $stmt->close();
//                 echo "null";
//             }
//         }
//         else{
//             $stmt->close();
//             echo "null";
//         }
//     } else {
//         echo "null";
//     }
// $team_id = 11;
//     $updateTeamIdQuery = "UPDATE leader_and_member_details SET team_id = ? WHERE leaderEmail = ?";
//     if ($stmt = $conn->prepare($updateTeamIdQuery)) {

//         $stmt->bind_param("is", $teamId, $leaderEmail);

//         if ($stmt->execute()) {

//             echo "true"; 
//         } else {
//             // Log error for debugging
//             error_log("Execute failed: " . $stmt->error);

//             echo "false"; 
//         }
//     } else {
//         // Log error for debugging
//         error_log("Prepare failed: " . $conn->error);
//         echo "false"; 
//     }


?>



<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // File details
//     $leaderEmail = "faf@gmail.com";
//     $transactionId = $_POST['transactionId'];
//     $paymentScreenshot = $_FILES['paymentScreenshot'];
//     $fileName = $paymentScreenshot['name'];
//     $fileTmpName = $paymentScreenshot['tmp_name'];
//     $fileSize = $paymentScreenshot['size'];
//     $fileError = $paymentScreenshot['error'];
//     $fileType = $paymentScreenshot['type'];
//     $isPaid = addPaymentDetails($transactionId, $paymentScreenshot, $leaderEmail);

//     // Check for upload errors
//     if ($fileError === 0) {
//         echo "File Name: $fileName<br>";
//         echo "Temporary Location: $fileTmpName<br>";
//         echo "File Size: $fileSize bytes<br>";
//         echo "File Type: $fileType<br>";
//     } else {
//         echo "There was an error uploading the file.";
//     }
// }
?>
<!-- <form method="POST" enctype="multipart/form-data">
<input type="text" id="transactionId" name="transactionId" required>
    <label for="paymentScreenshot" class="form-label">Upload Payment Screenshot</label>
    <input type="file" id="paymentScreenshot" name="paymentScreenshot" class="form-control" accept="image/*">
    <button type="submit">Submit</button>
</form> -->

<?php
// function addPaymentDetails($transactionId, $paymentScreenshot, $leaderEmail){
//     require "db.php";
//     echo "Done 1";
//     $team_id = 28;
//     $status = "Completed";
//     $pay_name = $paymentScreenshot;
//     $pay_path = "";
//     $is_approved = false;
//     $file = $_FILES['paymentScreenshot'];
//     $fileName = $file['name'];
//     $fileTmpName = $file['tmp_name'];
//     $fileSize = $file['size'];
//     $fileError = $file['error'];
//     $fileType = $file['type'];
//      // File extension
//      $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

//      // Allowed file types
//      $allowed = ['jpg', 'jpeg', 'png'];

//     if (in_array($fileExt, $allowed)) {
//         if ($fileError === 0) {
//             if ($fileSize < 5000000) { // 5MB max size
//                 // Create unique file name to avoid overwriting
//                 $newFileName = uniqid('', true) . "." . $fileExt;

//                 // Upload directory
//                 $uploadDir = 'uploads/payments/';
//                 if (!file_exists($uploadDir)) {
//                     mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
//                 }

//                 // File destination
//                 $fileDestination = $uploadDir . $newFileName;

//                 // Move the file to the upload directory
//                 if (move_uploaded_file($fileTmpName, $fileDestination)) {
//                     // Insert or update in the database
//                      // Ensure email is set in session
//                      $paymentDetailQuery = "INSERT INTO payment_details
//                      (team_id, transactionId, status, pay_name, pay_path, is_approved) 
//                      VALUES (?, ?, ?, ?, ?, ?)";
                    
//                     $stmt = $conn->prepare($paymentDetailQuery);
                    
//                     $stmt->bind_param("sssssi", $team_id, $transactionId, $status, $newFileName, $fileDestination, $is_approved);
//                     if ($stmt->execute()) {
//                         echo "Done 2";
//                         // echo "Profile picture updated successfully.";
//                     } else {
//                         echo "Not Done";
//                         // echo "Database error: " . $conn->error;
//                     }
                    
//                 } else {
//                     echo "Not Done";
//                     // echo "There was an error uploading your file.";
//                 }
//             } else {
//                 echo "Not Done";
//                 // echo "File size exceeds the 5MB limit.";
//             }
//         } else {
//             echo "Not Done";
//             // echo "There was an error uploading the file.";
//         }
//     } else {
//         echo "Not Done";
//         // echo "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
//     }

// }
sentmail('abdul954518@gmail.com','Abdul', 'rth01','Real MAdrid');
function sentmail($leaderEmail, $leaderName, $psId, $teamName)
{
    if (filter_var($leaderEmail, FILTER_VALIDATE_EMAIL)) {



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
        $mail->addAddress($leaderEmail);

        // Set the email format to HTML
        $mail->isHTML(true);

        // Set the email subject
        $mail->Subject = "Registartion Successfull";

        // Construct the email body with the student's login details
        $msg = 'Dear ' . strtoupper($leaderName) . '<p>, Thank you for your initiative toward this hackathon.</p>' .
            '<p>Your team ' . $teamName . ' has chosen a problem statement no ' . strtoupper($psId) . '</p>' .
            '<p>We will send you your login crediantials after verifying your payment status</p>' .
            '<p>You will receive your login credentials via email. If you do not receive an email regarding your submission, please contact the hackathon volunteers.</p>';

        // Set the email message content
        $mail->Body = $msg;

        // Send the email

        // Send OTP
        if ($mail->send()) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}
