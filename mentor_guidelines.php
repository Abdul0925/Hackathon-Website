<?php
session_start();
require "db.php";
if ($_SESSION['mentor_logged_in'] != true) {
    header("location:loginPage.php");
}


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
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 sidebar" id="sidebar">

                <div class="profile-section mb-4">
                    <div class="m-2 backBtn" id="backBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                            <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                        </svg>
                    </div>
                    <div id="myProfile" class="d-flex">
                        <img src="<?php echo $_SESSION['imagePath'] ?>" alt="Profile Picture">
                        <div>
                            <div class="name"> <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?> </div>
                            <small>Mentor</small>
                        </div>
                    </div>
                </div>

                <a href="mentor_dashboard.php" class=" nav-link">Dashboard</a>
                <a href="mentor_my_teams.php" class=" nav-link">My Teams</a>
                <a href="mentor_result.php" class=" nav-link">Results</a>
                <a href="mentor_problem_statements.php" class=" nav-link">Problem Statements</a>
                <a href="mentor_guidelines.php" class="active nav-link">Guidelines</a>
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
                    GuideLines
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

        document.getElementById('myProfile').addEventListener('click', () => {
            window.location.href = "myProfile.php";
        })
    </script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>