<?php
session_start();
require "db.php";
if ($_SESSION['leader_logged_in'] != true) {
    header("location:loginPage.php");
}

$email = $_SESSION['leaderEmail'];

// Query to get the image path
$sql = "SELECT * FROM mentor_details WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagePath = $row['image_path']; // The path of the uploaded image
    $_SESSION['imagePath'] = $imagePath; // The path of the uploaded image
} else {
    // If no image found, use a placeholder image
    $imagePath = 'https://via.placeholder.com/100';
}

$result1 = mysqli_query($conn, "SELECT * FROM leader_and_member_details WHERE leaderEmail='$email'");


$teamDetails = mysqli_query($conn, "SELECT * FROM team_and_leader_details WHERE leaderEmail='$email'");
$teamDetailsRow = $teamDetails->fetch_assoc();
$teamName = $teamDetailsRow['teamName'];
$psId = $teamDetailsRow['psId'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Mentor Dashboard</title>

    <link rel="stylesheet" href="leader_dashboard.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table {
            margin-bottom: 0rem;
        }

        table {
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            margin: auto;
            width: 100%;
        }

        th,
        td {
            border: 1px solid rgb(200, 200, 200);
            padding: 8px 30px;
            text-align: center;
        }

        th {
            text-transform: uppercase;
            font-weight: 500;
            border-color: black;
        }

        td {
            font-size: 13px;
        }

        .popup {
            border: 1px solid black;
            border-radius: 10px;
            width: 500px;
            height: auto;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 0 30px 30px;
            visibility: hidden;
        }

        .open-popup {
            visibility: visible;
        }

        .modal-header h2 {
            padding-top: 25px;
            margin-bottom: 20px;
            color: #5500cb;
        }

        .my-primary-btn {
            background-color: rgb(220, 0, 0);
            color: white;
            width: 60px;
            height: 30px;
            border-radius: 5px;
            border: none;
            margin-top: 25px;
        }

        .my-primary-btn:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .my-primary-btn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(220, 0, 0);
        }

        @media screen and (max-width: 400px) {
            .popup {
                width: 300px;
            }
        }

        .primary-btn {
            color: white;
            width: 100%;
            height: 30px;
            background-color: rgb(47, 141, 70);
            border-radius: 5px;
            border: none;
        }

        .primary-btn:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .primary-btn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
        }

        .nav-option i {
            font-size: 185%;
        }

        .main {
            background-color: #cad7fda4;
        }

        .nav-upper-options {
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .nav-upper-options h3 {
            font-size: 18px;
            margin-bottom: 0px;
            font-weight: bold;
            padding-left: 10px;
        }

        .badge {
            background-color: rgb(229, 0, 0);
        }

        .DHead h1 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 0px;
        }

        .nav-option1 i {
            color: #fff;
        }

        .mt-5 {
            margin-top: 20px !important;
        }

        .team-title {
            padding: 15px 0px 15px 2px;
        }

        .team-title h6 {
            margin-bottom: 0px;
            line-height: 1.6;
        }

        .report-header h1 {
            margin-bottom: 0px;
            line-height: normal;
        }
    </style>

</head>

<body>
    <!-- for header part -->
    <header>
        <div class="logosec">

            <a href="leader_dashboard.php" style="text-decoration: none;">

                <div class="logo">Leader</div>
            </a>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png" class="icn menuicn" id="menuicn" alt="menu-icon">
        </div>
        <div class="DHead">
            <H1>My Team</H1>
        </div>
        <div class="message">
            <!-- <div class="circle"></div> -->
            <!-- <a href="admin_show_notifications.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt=""></a> -->
            <div class="dp">

                <a href="leader_team.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp"></a>

            </div>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">

                    <a href="leader_dashboard.php" style="text-decoration: none;">

                        <div class="nav-option option2">
                            <i style="color: black;" class="bi-columns"></i>
                            <h3 style="color: black;"> Dashboard</h3>
                        </div>
                    </a>


                    <a href="leader_team.php" style="text-decoration: none;">

                        <div class="nav-option option1" style="color: black;">
                            <i style="color: #fff;" class="bi-file-earmark-person"></i>
                            <h3 style="color: #fff;"> My Team</h3>
                        </div>
                    </a>


                    <a href="leader_payment.php" style="text-decoration: none;">

                        <div class="nav-option option3" style="color: black;">
                            <i class="bi-patch-check"></i>
                            <h3> Payment</h3>
                        </div>
                    </a>


                    <a href="leader_result.php" style="text-decoration: none;">

                        <div class="nav-option option4" style="color: black;">
                            <i class="bi-award"></i>
                            <h3> Result</h3>
                        </div>
                    </a>


                    <a href="leader_problem_statement.php" style="text-decoration: none;">

                        <div class="nav-option option5" style="color: black;">
                            <i class="bi-eye"></i>
                            <h3> Problems</h3>
                        </div>
                    </a>


                    <a href="leader_guideline.php" style="text-decoration: none;">

                        <div class="nav-option option6" style="color: black;">
                            <i class="bi-card-checklist"></i>
                            <h3> Guidelines</h3>
                        </div>
                    </a>

                    <a href="logout.php" style="text-decoration: none;">
                        <div class="nav-option logout" style="color: black;">
                            <i class="bi-arrow-left-circle"></i>
                            <h3>Logout</h3>
                        </div>
                    </a>

                </div>
            </nav>
        </div>

        <div class="main">
            <div class="report-container">
                <div class="mt-5">
                    <div class="report-header">
                        <h1 class="recent-Articles">Team Details</h1>
                    </div>
                    <div class="team-title">
                        <h6>
                            Team Name:<strong> <?php echo $teamName; ?></strong>
                        </h6>
                        <h6>
                            Problem Statement ID:
                            <a href="leader_problem_statement.php">
                                <strong><?php echo strtoupper($psId); ?></strong>
                            </a>
                        </h6>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Members</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sr_no = 1; ?>
                                <?php while ($row1 = $result1->fetch_assoc()) {
                                    // $date = date('d-m-Y', strtotime($row1['date']));
                                    $date = "";
                                ?>
                                    <tr>
                                        <td><?php echo $sr_no++; ?></td>

                                        <td><?php echo $row1['memberName'];
                                            echo ($row1['is_leader'] ? " (Leader)" : "") ?></td>

                                        <td><?php echo $row1['memberMobile']; ?></td>
                                        <td><?php echo $row1['memberEmail']; ?></td>
                                        <td><?php echo $row1['memberGender']; ?></td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let menuicn = document.querySelector(".menuicn");
        let nav = document.querySelector(".navcontainer");

        menuicn.addEventListener("click", () => {
            nav.classList.toggle("navclose");
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>