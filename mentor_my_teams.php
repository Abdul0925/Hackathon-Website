<?php
session_start();
require "db.php";
if ($_SESSION['mentor_logged_in'] != true) {
    header("location:loginPage.php");
}
$email = $_SESSION['email'];


// First query to select from `all_team_members`
$stmt1 = $conn->prepare("SELECT * FROM all_team_members WHERE mentor = ? AND is_leader = 1");
$stmt1->bind_param("s", $email);
$stmt1->execute();
$result1 = $stmt1->get_result();
$totalTeams = 0;

if ($result1->num_rows > 0) {
    $_SESSION['totalTeams'] = $totalTeams = $result1->num_rows;
    
    // Update query for `mentor_details`
    $stmt2 = $conn->prepare("UPDATE mentor_details SET no_of_teams = ? WHERE email = ?");
    $stmt2->bind_param("is", $totalTeams, $email);
    $stmt2->execute();
}

// Second query to select from `all_team_members`
$stmt3 = $conn->prepare("SELECT * FROM all_team_members WHERE mentor = ? AND is_leader = 1");
$stmt3->bind_param("s", $email);
$stmt3->execute();
$result = $stmt3->get_result();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Dashboard</title>
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
                            <small>Mentor</small>
                        </div>
                    </div>
                </div>

                <a href="mentor_dashboard.php" class=" nav-link">Dashboard</a>
                <a href="mentor_my_teams.php" class="active nav-link">My Teams</a>
                <a href="mentor_result.php" class=" nav-link">Results</a>
                <a href="mentor_problem_statements.php" class=" nav-link">Problem Statements</a>
                <a href="mentor_guidelines.php" class=" nav-link">Guidelines</a>
                <a href="logout.php" class="btn btn-danger logoutBtn">Log Out</a>
            </div>

            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 p-4">
                <!-- Dashboard Header -->
                <div class="dashboard-header">
                    <button class="listBtn" id="listBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </button>
                    My Teams
                </div>

                <div>
                    <form action="addNewTeam.php">
                        <?php
                        if (mysqli_num_rows($result) >= 3) :
                        ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                You Cant Add More Than 3 Teams
                            </div>
                            <button type="submit" class="btn btn-success" id="addNewBtn" disabled>Add New Team</button>
                        <?php
                        endif;
                        ?>
                        <?php
                        if (mysqli_num_rows($result) < 3) :
                        ?>
                            <button type="submit" class="btn btn-success mt-3" id="addNewBtn">Add New Team</button>
                        <?php
                        endif;
                        ?>
                    </form>
                </div>

                <?php if ($totalTeams == 0): ?>
                    <!-- Card Row -->
                    <div class="row mt-4">
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card p-3 text-white" style="background: linear-gradient(135deg, #8e44ad, #3498db);">
                                <div class="card-body">
                                    <h5 class="card-title">You dont have any registered team yet</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($totalTeams != 0): ?>
                    <!-- Table Section -->
                    <div class="mt-5">
                        <h5 class="mb-3">Team List</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Team Name</th>
                                        <th>Leader Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['team_name']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            <td>
                                                <form action="team_info.php" method="post">
                                                    <input name="team_name" value="<?php echo $row['team_name']; ?>" hidden>
                                                    <input name="ps" value="<?php echo $row['ps']; ?>" hidden>
                                                    <button class="btn btn-primary"> View </button>
                                            </td>
                                            </form>
                                        </tr>
                                    <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                        </div>
                    </div>
            </div>
        </div>
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
    <!-- Form Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Reset your Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">

                        <!-- New Password -->
                        <div class="form-group m-2">
                            <input type="password" name="new_password" class="form-control" id="password" placeholder="Enter new password" required>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group m-2">
                            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm password" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="button" class="btn btn-primary m-2" id="submitFormBtn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
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
                        <button type="submit" class="btn btn-primary w-100 mt-3" name="verifyOtp" id="verifyBtn">Verify OTP</button>
                    </form>
                </div>
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
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>