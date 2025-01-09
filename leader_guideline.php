<?php
session_start();
if ($_SESSION['leader_logged_in'] != true) {
    header("location:loginPage.php");
}

require 'db.php';
$result2 = mysqli_query($conn, "SELECT * FROM notifications ORDER BY id DESC");
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
            margin-bottom: 0px;
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

        @media screen and (max-width: 400px) {
            .popup {
                width: 300px;
            }
        }

        .nav-option {
            gap: 16px;
        }

        .nav-option i {
            font-size: 160%;
        }

        .main {
            background-color: #cad7fda4;
        }

        .nav-upper-options {
            gap: 0px;
            justify-content: center;
            align-items: center;
        }

        .nav {
            padding-top: 20px;
            padding-left: 5px;
        }

        .nav-upper-options h3 {
            font-size: 16px;
            margin-bottom: 0px;
            font-weight: bold;
            padding-left: 10px;
        }

        .badge {
            background-color: rgb(229, 0, 0);
        }

        .mt-5 h5 {
            color: #5500cb;
            padding-top: 20px;
            padding-bottom: 10px;
            border-bottom: solid rgba(0, 20, 151, 0.59);
        }

        .DHead h1 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 0px;
        }

        .nav-option1 i {
            color: #fff;
        }

        .report-container {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .report-body {
            padding: 20px 0px 0px 0px;
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
            <H1>Guideline</H1>
        </div>
        <div class="message">
            <div class="circle"></div>
            <a href="leader_show_notifications.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt=""></a>
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
                        <div class="nav-option option6" style="color: black;">
                            <i class="bi-file-person"></i>
                            <h3> My Team</h3>
                        </div>
                    </a>

                    <a href="leader_payment.php" style="text-decoration: none;">
                        <div class="nav-option option3" style="color: black;">
                            <i class="bi-credit-card"></i>
                            <h3> Payment</h3>
                        </div>
                    </a>

                    <a href="leader_round.php" style="text-decoration: none;">
                        <div class="nav-option option4" style="color: black;">
                            <i class="bi-award"></i>
                            <h3> Rounds</h3>
                        </div>
                    </a>

                    <a href="leader_result.php" style="text-decoration: none;">
                        <div class="nav-option option4" style="color: black;">
                            <i class="bi-trophy"></i>
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
                        <div class="nav-option option1" style="color: black;">
                            <i style="color: #fff;" class="bi-card-checklist"></i>
                            <h3 style="color: #fff;"> Guidelines</h3>
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
                <div class="report-header">
                    <h1 class="recent-Articles">Guidelines</h1>
                </div>

                <div class="report-body">
                    <!-- top hedding -->
                    <div class="">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Sr No</th>
                                    <th scope="col">Guidelines</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // SQL query to fetch all records from the problem_statements table
                                $sql = "SELECT * FROM guidelines"; // Assuming your table name is 'ps_data'
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $sr_no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $sr_no . "</td>";
                                        echo "<td>" . $row['guideline'] . "</td>";
                                        echo "</tr>";

                                        $sr_no++; // Increment the serial number
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No guidelines found</td></tr>";
                                }

                                $conn->close();

                                ?>
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