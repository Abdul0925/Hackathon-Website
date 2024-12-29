<?php
session_start();
require "db.php";
if ($_SESSION['mentor_logged_in'] != true) {
    header("location:loginPage.php");
}
$email = $_SESSION['email'];
$team_id = $_SESSION['id'];

$paymentStatusStmt = $conn->prepare("SELECT * FROM payment_details WHERE team_id = ?");
$paymentStatusStmt->bind_param("i", $team_id);
$paymentStatusStmt->execute();
$statusResult = $paymentStatusStmt->get_result();
$paymentStatus = $statusResult->fetch_assoc();
$paymentStatus = $paymentStatus['status'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addNewMember'])) {
    if ($totalMembers > 4) {
        echo '<script> alert("You can only add 5 members "); window.location.href = "leader_team.php"; </script>';
        return;
    }
    if ($paymentStatus == "Completed") {
        echo '<script> alert("You can' . "'t" . ' add members after payment "); window.location.href = "leader_team.php"; </script>';
        return;
    }
    $memberName = $_POST['memberName'];
    $memberEmail = $_POST['memberEmail'];
    $memberMobile = $_POST['memberMobile'];
    $is_leader = 0;
    $team_name = "";
    $ps = "";
    $addNewMemberStmt = $conn->prepare("INSERT INTO all_team_members (team_id, leader, name, email, phone, team_name, ps, is_leader) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $addNewMemberStmt->bind_param("issssssi", $team_id, $email, $memberName, $memberEmail, $memberMobile, $team_name, $ps, $is_leader);
    if ($addNewMemberStmt->execute()) {
    } else {
        echo '<script> alert("Error Adding New Member!"); window.location.href = "leader_team.php"; </script>';
    }
    $addNewMemberStmt->close();
    $conn->close();
    echo '<script> window.location.href = "leader_team.php"; </script>';
    // return;

}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Team Detail</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7f6;
        }

        /* Sidebar styles */
        .sidebar {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            font-weight: 600;
            color: #333;
        }

        .sidebar a.active,
        .sidebar .nav-link:hover {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }

        .logoutBtn {
            margin-bottom: 2rem;
            position: absolute;
            bottom: 0;
            color: white;
            width: 14em;
        }

        /* Dashboard styles */
        .listBtn {
            border: none;
            background-color: #f4f7f6;
            display: none;
        }

        .backBtn {
            display: none;
        }

        .dashboard-header {
            margin-top: 20px;
            font-weight: bold;
            font-size: 24px;
            display: flex;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
        }

        .card-subtitle {
            font-size: 14px;
            color: yellow;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .badge-pending {
            background-color: #ffc107;
        }

        .badge-approved {
            background-color: #28a745;
        }

        .badge-reject {
            background-color: #dc3545;
        }

        /* For the profile picture and name */
        .profile-section {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .profile-section img {
            border-radius: 50%;
            width: 50px;
            margin-right: 10px;
        }

        .profile-section .name {
            font-weight: bold;
        }

        .tooltip-inner {
            max-width: 300px;
            /* Increase the tooltip width */
            white-space: pre-wrap;
            /* Allow wrapping for long text */
            font-size: 14px;
            /* Optional: Adjust the font size */
            background-color:rgb(255, 182, 11);
            color: black;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                display: none;
                z-index: 12;
                background-color: white;
                position: absolute;
            }

            .backBtn {
                display: block;
            }

            .logoutBtn {
                position: relative;
            }

            .listBtn {
                display: flex;
            }

        }
    </style>
</head>

<body>
    <!-- <script>document.getElementById('addNewBtn').blocked = 'true';</script> -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 sidebar" id="sidebar">

                <div class="profile-section mb-4">
                    <div class="m-2 backBtn" id="backBtn">
                        <button type="button" class="btn-close" aria-label="Close"></button>
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                            <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                        </svg> -->
                    </div>
                    <div id="myProfile" class="d-flex" data-bs-toggle="modal" data-bs-target="#myProfileModal">
                        <img src="<?php echo $_SESSION['imagePath']; ?>" alt="Profile Picture">
                        <div>
                            <div class="name"> <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?> </div>
                            <small>leader</small>
                        </div>
                    </div>
                </div>

                <a href="leader_dashboard.php" class=" nav-link">Dashboard</a>
                <a href="leader_team.php" class="nav-link">My Team</a>
                <a href="leader_payment.php" class="active nav-link">Payment</a>
                <a href="leader_result.php" class=" nav-link">Results</a>
                <a href="leader_problem_statement.php" class=" nav-link">Problem Statements</a>
                <a href="leader_guideline.php" class=" nav-link">Guidelines</a>
                <a href="logout.php" class="btn btn-danger logoutBtn">Log Out</a>
            </div>

            <div class="col-lg-10 col-md-9 p-4">
                <!-- Dashboard Header -->
                <div>
                    <h5>
                        Your Payment Status: <span style="color: <?php echo $paymentStatus === 'Pending' ? 'red' : ($paymentStatus === 'Completed' ? 'green' : 'black'); ?>;"> <?php echo ucfirst($paymentStatus); ?></span>
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="If you have already submitted the payment screenshot and your status still shows as pending, kindly wait for the admin to process your request. This might take some time. However, if the status remains pending for more than 6 hours, please reach out to a hackathon volunteer for assistance.">
                            i
                        </button>
                    </h5>
                </div>

                <div>
                    <img src="./picture/payment.jpg" alt="payment" height width="400">
                </div>
                <form action="">
                    <div>
                        <label for="paymentproof">Upload Screen Shot of Your Payment: </label>
                        <input type="file" name="paymentproof" id="paymentproof" required>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Uplaod</button>
                    </div>
                </form>
            </div>


            <!-- MyProfile Modal -->
            <div class="modal fade" id="myProfileModal" tabindex="-1" aria-labelledby="myProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myProfileModalLabel">My Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <form id="profilePicForm" method="POST" enctype="multipart/form-data" action="changeProfilePic.php">
                                    <div class="text-center mb-4">
                                        <div class="position-relative d-inline-block">
                                            <img src="<?php echo $_SESSION['imagePath']; ?>" id="profilePic" class="rounded-circle" alt="Profile Picture" width="100">
                                            <input type="file" id="changePicInput" name="profile_pic" accept="image/*" required>
                                            <div class="position-absolute top-50 start-50 translate-middle text-white" id="changePicHover" style="cursor: pointer; display: none;">
                                                <i class="fas fa-camera"></i> Change
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <!-- Profile Picture Section -->

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name" value="<?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>" disabled>
                            </div>

                            <!-- College Name -->
                            <div class="mb-3">
                                <label for="collegeName" class="form-label">College Name</label>
                                <input type="text" class="form-control" id="collegeName" placeholder="Enter your college name" value="<?php echo $_SESSION['college']; ?>" disabled>
                            </div>

                            <!-- Mobile Number -->
                            <div class="mb-3">
                                <label for="mobileNumber" class="form-label">Mobile Number</label>
                                <input type="tel" class="form-control" id="mobileNumber" placeholder="Enter your mobile number" value="<?php echo $_SESSION['mobile']; ?>" disabled>
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email" value="<?php echo $_SESSION['email']; ?>" disabled>
                            </div>

                            <!-- Forget Password -->
                            <div class="text-center mt-3">
                                <a href="#" id="forgetPassword" class="text-primary" data-bs-toggle="modal" data-bs-target="#formModal">Forget Password?</a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary" id="saveChanges">Save Changes</button> -->
                            <button type="submit" id="hiddenSubmitButton" class="btn btn-primary">Upload</button>

                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <script>
                document.getElementById('listBtn').addEventListener('click', () => {
                    if (document.getElementById("sidebar").style.display == 'block') {
                        document.getElementById("sidebar").style.display = 'none';
                    } else {
                        document.getElementById("sidebar").style.display = 'block';
                    }
                })

                document.getElementById('backBtn').addEventListener('click', () => {
                    if (document.getElementById("sidebar").style.display == 'block') {
                        document.getElementById("sidebar").style.display = 'none';
                    } else {
                        document.getElementById("sidebar").style.display = 'block';
                    }
                })
            </script>
            <!-- Include Bootstrap Tooltip Initialization -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                        new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                });
            </script>
            <!-- Bootstrap JS and dependencies -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>