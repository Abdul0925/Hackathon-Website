<?php

require "db.php";
session_start(); // Ensure session is started if using session variables like email

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
    // File details
    $file = $_FILES['profile_pic'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // File extension
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Allowed file types
    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000000) { // 5MB max size
                // Create unique file name to avoid overwriting
                $newFileName = uniqid('', true) . "." . $fileExt;

                // Upload directory
                $uploadDir = 'uploads/images/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
                }

                // File destination
                $fileDestination = $uploadDir . $newFileName;

                // Move the file to the upload directory
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // Insert or update in the database
                    $email = $_SESSION['email']; // Ensure email is set in session

                    // Update the database in mentor_details table
                    $sql = "UPDATE mentor_details SET image_name = ?, image_path = ? WHERE email = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('sss', $newFileName, $fileDestination, $email);

                    if ($stmt->execute()) {
                        echo "Profile picture updated successfully.";
                    } else {
                        echo "Database error: " . $conn->error;
                    }

                    $stmt->close();
                } else {
                    echo "There was an error uploading your file.";
                }
            } else {
                echo "File size exceeds the 5MB limit.";
            }
        } else {
            echo "There was an error uploading the file.";
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
    }
} else {
    echo "No file was uploaded or an error occurred.";
}

$conn->close();
?>
