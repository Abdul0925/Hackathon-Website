<?php
session_start();
require "db.php";
if ($_SESSION['mentor_logged_in'] != true) {
    header("location:loginPage.php");
}
$email = $_SESSION['email'];
$team_id = $_SESSION['id'];

// First query to select from `all_team_members`
// $memberCount = $conn->prepare("SELECT COUNT(column_name) FROM table_name WHERE condition; mentor = ? AND is_leader = 1");
// $memberCount->bind_param("s", $email);
// $memberCount->execute();
// $result1 = $memberCount->get_result();
// $totalTeams = 0;

$members_info = mysqli_query($conn, "SELECT * FROM all_team_members WHERE mentor='$email'");
$totalMembers = $members_info->num_rows;

// $stmt11 = $conn->prepare("SELECT no_of_teams FROM mentor_details WHERE email = ?");
// $stmt11->bind_param("s", $email);
// $stmt11->execute();
// $result11 = $stmt11->get_result();
// $result111 = $result11->fetch_assoc();
// $_SESSION['totalTeams'] = $result111['no_of_teams'];

// if ($result1->num_rows > 0) {
//     $_SESSION['totalTeams'] = $totalTeams = $result1->num_rows;

//     // Update query for `mentor_details`
//     $stmt2 = $conn->prepare("UPDATE mentor_details SET no_of_teams = ? WHERE email = ?");
//     $stmt2->bind_param("is", $totalTeams, $email);
//     $stmt2->execute();
// }

// Second query to select from `all_team_members`
$stmt3 = $conn->prepare("SELECT * FROM all_team_members WHERE mentor = ? AND is_leader = 1");
$stmt3->bind_param("s", $email);
$stmt3->execute();
$result = $stmt3->get_result();
$row1 = $result->fetch_assoc();
$ps = $row1['ps'];
$team_name = $row1['team_name'];

$paymentStatusStmt = $conn->prepare("SELECT * FROM payment_details WHERE team_id = ?");
$paymentStatusStmt->bind_param("i", $team_id);
$paymentStatusStmt->execute();
$statusResult = $paymentStatusStmt->get_result();
$paymentStatus = $statusResult->fetch_assoc();
$paymentStatus = $paymentStatus['status'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addNewMember'])) {
    if ($totalMembers > 4) {
        echo '<script> alert("You can only add 5 members "); window.location.href = "mentor_my_teams.php"; </script>';
        return;
    }
    if ($paymentStatus == "Completed") {
        echo '<script> alert("You can'."'t".' add members after payment "); window.location.href = "mentor_my_teams.php"; </script>';
        return;
    }
    $memberName = $_POST['memberName'];
    $memberEmail = $_POST['memberEmail'];
    $memberMobile = $_POST['memberMobile'];
    $is_leader = 0;
    $team_name = "";
    $ps = "";
    $addNewMemberStmt = $conn->prepare("INSERT INTO all_team_members (team_id, mentor, name, email, phone, team_name, ps, is_leader) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $addNewMemberStmt->bind_param("issssssi", $team_id, $email, $memberName, $memberEmail, $memberMobile, $team_name, $ps, $is_leader);
    if ($addNewMemberStmt->execute()) {
    } else {
        echo '<script> alert("Error Adding New Member!"); window.location.href = "mentor_my_teams.php"; </script>';
    }
    $addNewMemberStmt->close();
    $conn->close();
    echo '<script> window.location.href = "mentor_my_teams.php"; </script>';
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
                <a href="mentor_my_teams.php" class="active nav-link">My Team</a>
                <a href="leader_payment.php" class="nav-link">Payment</a>
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
                    My Team
                </div>

                <!-- <div>
                    <form action="addNewTeam.php">
                        <?php
                        //if (mysqli_num_rows($result) > 0) :
                        ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                You can add only one team
                            </div>
                            <button type="submit" class="btn btn-success" id="addNewBtn" disabled>Add New Team</button>
                        <?php
                        //endif;
                        ?>
                        <?php
                        //if (mysqli_num_rows($result) == 0) :
                        ?>
                            <button type="submit" class="btn btn-success mt-3" id="addNewBtn">Add My Team</button>
                        <?php
                        //endif;
                        ?>
                    </form>
                </div> -->

                <!-- Card Row
                    <div class="row mt-4">
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card p-3 text-white" style="background: linear-gradient(135deg, #8e44ad, #3498db);">
                                <div class="card-body">
                                    <h5 class="card-title">You dont have any registered team yet</h5>
                                </div>
                            </div>
                        </div>
                    </div> -->


                <div class="dashboard-header">
                    <?php //echo $members_info['team_name']; 
                    ?>
                </div>
                <button class="btn btn-success" 
                data-bs-toggle="modal"
                data-bs-target="#editTeamModal" 
                data-name="<?php echo $team_name; ?>"
                data-ps="<?php echo $ps; ?>"
                >
                    Edit Team Details
                </button>
                <div class="dashboard-header">
                    <!-- Edit Team Button -->

                    <h5 class="mb-3">
                        <?php  ?>
                        <div>
                            <h5>Team Name: <?php echo $team_name; ?></h5>
                        </div>
                        <div>
                            <h5>Problem Statement: <?php echo $ps; ?> </h5>
                        </div>
                        <div>
                            <h5>Payment Status: <span style="color:#dc3545;"> <?php echo $paymentStatus; ?> </span>
                            </h5>
                        </div>
                    </h5>
                </div>
                <!-- Table Section -->
                <div class="mt-2">
                    <h5 class="mb-3">Team List</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Member Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 1;
                                while ($row = $members_info->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $srno; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="<?php echo $row['id']; ?>"
                                                data-name="<?php echo $row['name']; ?>"
                                                data-email="<?php echo $row['email']; ?>"
                                                data-phone="<?php echo $row['phone']; ?>">
                                                Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>

                                        </td>
                                    </tr>
                                <?php
                                    $srno++;
                                }

                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div>
                    <?php if ($totalMembers > 4) { ?>
                        <div class="btn btn-danger">Only 5 Members are Allowed</div>
                    <?php } else { ?>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMemberModal">Add New Member</button>
                    <?php } ?>

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
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Member Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="memberName" class="form-label">Name: </label>
                            <input type="text" class="form-control" name="memberName" placeholder="Enter Name" required>
                            <label for="memberEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="memberEmail" placeholder="Enter Email" required>
                            <label for="memberMobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" name="memberMobile" placeholder="Enter Mobile" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3" name="addNewMember" id="addBtn">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="update_member.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Leader Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-phone" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="edit-phone" name="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Add Team Modal -->
<div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="editTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="edit_team.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTeamModalLabel">Team Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Team Name -->
                    <div class="mb-3">
                        <label for="teamName" class="form-label">Team Name</label>
                        <input type="text" class="form-control" id="teamName" name="team_name" required>
                    </div>
                    <input type="text" class="form-control" id="teamId" name="team_id" value="<?php echo $team_id ?>" hidden>
                    
                    <!-- Problem Statement -->
                    <div class="mb-3">
                        <label for="problemStatement" class="form-label">Problem Statement</label>
                        <select class="form-control" name="problem_statement" id="problemStatement" required>
                            <option value="" disabled selected>Choose Any One</option>
                            <option value="RTH01">RTH01</option>
                            <option value="RTH02">RTH02</option>
                            <option value="RTH03">RTH03</option>
                            <option value="RTH04">RTH04</option>
                            <option value="RTH05">RTH05</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Team</button>
                </div>
            </div>
        </form>
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


        // Get the modal element
        const editModal = document.getElementById('editModal');                    
        const editTeamModal = document.getElementById('editTeamModal');                    

        // Event listener for when the modal is triggered
        editModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            const button = event.relatedTarget;
            
            // Extract data attributes from the button
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const phone = button.getAttribute('data-phone');
            
            // Populate the modal fields
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-phone').value = phone;
        });
        
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this member?")) {
                // Redirect to the delete page with the member's ID
                window.location.href = `delete_member.php?id=${id}`;
            }
        }
        
        editTeamModal.addEventListener('show.bs.modal', function(event){
            const button = event.relatedTarget;
            const team_name = button.getAttribute('data-name');
            const ps = button.getAttribute('data-ps');
            document.getElementById('teamName').value = team_name;
            document.getElementById('problemStatement').value = ps;

        })
    </script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>