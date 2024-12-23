<?php
session_start();

if ($_SESSION['leader_logged_in'] != true) {
    header("location:loginPage.php");
}

require 'db.php';
$teamName = mysqli_query($conn, "SELECT DISTINCT team_name FROM all_team_members");
// $teamDetails = mysqli_query($conn, "SELECT * FROM all_team_members");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Mentor Dashboard</title>
    <link rel="stylesheet" href="mentor_dash_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-y: hidden;
        }

        .table {
            margin-bottom: 0px;
        }

        table {
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            margin: auto;
            width: 100%;
            margin-top: 20px;
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
            height: auto;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 0 30px 30px;
            visibility: hidden;
            width: 60%;
        }

        .open-popup {
            visibility: visible;
        }

        .modal-header {
            display: block;
        }

        .modal-body p {
            margin-bottom: 0px;
            padding: 0px 0px 5px 10px;
        }

        .modal-header h2 {
            padding-top: 25px;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #5500cb;
            border-bottom: 2px solid rgba(0, 20, 151, 0.59);
        }

        .modal-footer {
            display: block;
        }

        .modal-footer button {
            background-color: rgb(220, 0, 0);
            color: white;
            width: 60px;
            height: 30px;
            border-radius: 5px;
            border: none;
            margin: 20px 0px 10px 8px;
            padding: 0px;
            font-size: 90%;
        }

        .modal-footer button:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .modal-footer button:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(220, 0, 0);
            /* color: white; */
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

        .view-btn {
            color: white;
            width: 60px;
            height: 30px;
            background-color: rgb(47, 141, 70);
            border-radius: 5px;
            border: none;
        }

        .view-btn:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .view-btn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
            /* color: white; */
        }

        .delete-btn {
            background-color: rgb(200, 0, 0);
            color: white;
            width: 60px;
            height: 30px;
            border-radius: 5px;
            border: none;
        }

        .delete-btn:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .delete-btn:active {
            box-shadow: 2px 2px 5pxrgb(252, 77, 77);
            background-color: rgb(200, 0, 0);
            /* color: white; */
        }

        .report-container {
            margin-top: 20px;
            margin-bottom: 20px;

        }

        .btn-primary {
            color: white;
            width: 100px;
            height: 40px;
            background-color: rgb(47, 141, 70);
            border-radius: 5px;
            border: none;
            margin-top: 10px;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .btn-primary:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
        }

        .form-body {
            padding-bottom: 10px;
        }

        .form-body .form-label {
            font-weight: 500;
        }

        .form-control {
            padding-left: 5px;
            width: 300px;
            height: 40px;
            margin-left: 5px;
        }

        .form-body select {
            padding-left: 5px;
            width: 120px;
            height: 40px;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <!-- for header part -->
    <header>
        <div class="logosec">
            <a href="mentor_dashboard_shad.php" style="text-decoration: none;">
                <div class="logo">Leader</div>
            </a>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png" class="icn menuicn" id="menuicn" alt="menu-icon">
        </div>
        <div class="DHead">
            <H1>Problem</H1>
        </div>
        <div class="message">
            <!-- <div class="circle"></div> -->
            <!-- <a href="admin_show_notifications.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt=""></a> -->
            <div class="dp">
                <a href="mentor_my_teams_shad.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp"></a>
            </div>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <a href="mentor_dashboard_shad.php" style="text-decoration: none;">
                        <div class="nav-option option2">
                            <i style="color: black;" class="bi-columns"></i>
                            <h3 style="color: black;"> Dashboard</h3>
                        </div>
                    </a>

                    <a href="mentor_my_teams_shad.php" style="text-decoration: none;">
                        <div class="nav-option option6" style="color: black;">
                            <i class="bi-file-earmark-person"></i>
                            <h3> My Team</h3>
                        </div>
                    </a>

                    <a href="mentor_payment_shad.php" style="text-decoration: none;">
                        <div class="nav-option option5" style="color: black;">
                            <i class="bi-patch-check"></i>
                            <h3> Payment</h3>
                        </div>
                    </a>

                    <a href="mentor_result_shad.php" style="text-decoration: none;">
                        <div class="nav-option option4" style="color: black;">
                            <i class="bi-award"></i>
                            <h3> Result</h3>
                        </div>
                    </a>

                    <a href="mentor_problem_shad.php" style="text-decoration: none;">
                        <div class="nav-option option1" style="color: black;">
                            <i style="color: #fff;" class="bi-eye"></i>
                            <h3 style="color: #fff;"> Problems</h3>
                        </div>
                    </a>

                    <a href="mentor_guideline_shad.php" style="text-decoration: none;">
                        <div class="nav-option option3" style="color: black;">
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
                <div class="report-header">
                    <h1 class="recent-Articles">Problems</h1>
                </div>

                <!-- <div class="report-body"> -->
                <!-- top hedding -->
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Sr No</th>
                                <th scope="col">PS ID</th>
                                <th scope="col">PS Name</th>
                                <th scope="col">PS Category</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // SQL query to fetch all records from the problem_statements table
                            $sql = "SELECT * FROM problem_statements"; // Assuming your table name is 'ps_data'
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $sr_no = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $sr_no . "</td>";
                                    echo "<td>" . $row['ps_id'] . "</td>";
                                    echo "<td>" . $row['ps_name'] . "</td>";
                                    echo "<td>" . $row['ps_category'] . "</td>";
                                    echo '<td> <button class="view-btn" onclick="openPopup(this)" data-id="' . $row['ps_id'] . '">View</button> </td>';
                                    echo "</tr>";

                                    // Modal for each problem statement
                                    echo '
                                        <div class="popup" id="' . $row['ps_id'] . '" tabindex="-1">
                                            <div class="modal-header">
                                                <h2 class="modal-title">Problem Statement Details</h2>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>PS ID:</strong> ' . $row['ps_id'] . '</p>
                                                <p><strong>Name:</strong> ' . $row['ps_name'] . '</p>
                                                <p><strong>Description:</strong> ' . $row['ps_description'] . '</p>
                                                <p><strong>Total Participation:</strong> ' . $row['no_of_participation'] . '</p>
                                                <p><strong>Difficulty Level:</strong> ' . $row['ps_difficulty_level'] . '</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" data-id="' . $row['ps_id'] . '" onclick="closePopup(this)">Close</button>
                                            </div>
                                        </div>';
                                    $sr_no++; // Increment the serial number
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No problem statements found</td></tr>";
                            }

                            $conn->close();

                            ?>
                        </tbody>
                    </table>
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

    <script>
        function openPopup(button) {
            const dataId = button.getAttribute('data-id'); // Get the data-id value

            const popup = document.getElementById(dataId); // Get the popup element by ID
            if (popup) {
                popup.classList.add("open-popup"); // Add the class to open the popup
            } else {
                console.error(`Popup with ID "${dataId}" not found`);
            }
        }

        function closePopup(button) {
            const dataId = button.getAttribute('data-id'); // Get the data-id value
            const popup = document.getElementById(dataId); // Get the popup element by ID
            popup.classList.remove("open-popup")
        }
    </script>
</body>

</html>