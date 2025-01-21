<?php
session_start();
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}

require 'db.php';
$round1Query = "SELECT on_going FROM admin_rounds WHERE on_going = 1 AND title = 'Round 1'";
$isRound1StartedStmt = $conn->query($round1Query);
if ($isRound1StartedStmt->num_rows > 0) {
    $isR1OnGoing = 1;
} else {
    $isR1OnGoing = 0;
}

$startDateQuery = "SELECT * FROM admin_rounds WHERE title = 'Round 1' AND on_going = 1";
$startDateStmt = $conn->query($startDateQuery);
if ($startDateStmt->num_rows > 0) {
    $startDate = $startDateStmt->fetch_assoc()['date'];
} else {
    $startDate = null;
}

$round1ResultQuery = "SELECT on_going FROM admin_rounds WHERE isResultAnnounced = 1 AND title = 'Round 1'";
$isRResultAnnouncedStmt = $conn->query($round1ResultQuery);
if ($isRResultAnnouncedStmt->num_rows > 0) {
    $isResultDeclared = 1;
} else {
    $isResultDeclared = 0;
}

$round2Query = "SELECT on_going FROM admin_rounds WHERE on_going = 1 AND title = 'Round 2'";
$isRound2StartedStmt = $conn->query($round2Query);
if ($isRound2StartedStmt->num_rows > 0) {
    $isR2OnGoing = 1;
} else {
    $isR2OnGoing = 0;
}

$startDateQuery = "SELECT * FROM admin_rounds WHERE title = 'Round 2' AND on_going = 1";
$startDateStmt = $conn->query($startDateQuery);
if ($startDateStmt->num_rows > 0) {
    $startR2Date = $startDateStmt->fetch_assoc()['date'];
} else {
    $startR2Date = null;
}

$round2ResultQuery = "SELECT on_going FROM admin_rounds WHERE isResultAnnounced = 1 AND title = 'Round 2'";
$isRResultAnnouncedStmt = $conn->query($round2ResultQuery);
if ($isRResultAnnouncedStmt->num_rows > 0) {
    $isR2ResultDeclared = 1;
} else {
    $isR2ResultDeclared = 0;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Rounds</title>
    <link rel="stylesheet" href="admin_dash_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
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

        .primary-btn {
            background-color: rgb(220, 0, 0);
            color: white;
            width: 60px;
            height: 30px;
            border-radius: 5px;
            border: none;
        }

        .primary-btn:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .primary-btn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(220, 0, 0);
        }

        .report-container {
            min-height: 0px;
            margin-top: 20px;
            height: 400px;
        }

        .nav-upper-options {
            gap: 0px;
            justify-content: center;
            align-items: center;
        }

        .nav-upper-options h3 {
            font-size: 16px;
            font-weight: bold;
            padding-left: 10px;
            text-decoration: none;
        }

        .nav-option i {
            font-size: 160%;
        }

        @media screen and (max-width: 400px) {
            .popup {
                width: 300px;
            }
        }

        #start_round1 .startBtn {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .stopBtn {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <!-- for header part -->
    <header>

        <div class="logosec">
            <a href="admin_dashboard.php" style="text-decoration: none;">
                <div class="logo">Admin</div>
            </a>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png" class="icn menuicn" id="menuicn" alt="menu-icon">
        </div>

        <div>
            <H1>Rounds</H1>
        </div>

        <div class="message">
            <div class="circle"></div>
            <a href="admin_show_notifications.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt=""></a>
            <div class="dp">
                <a href="admin_profile.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp"></a>
            </div>
        </div>

    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <a href="admin_dashboard.php" style="text-decoration: none;">
                        <div class="nav-option option2" style="color: black;">
                            <i class="bi-columns"></i>
                            <h3> Dashboard</h3>
                        </div>
                    </a>

                    <a href="admin_profile.php" style="text-decoration: none;">
                        <div class="nav-option option2" style="color: black;">
                            <i class="bi-file-person"></i>
                            <h3> Profile</h3>
                        </div>
                    </a>

                    <a href="admin_all_teams.php" style="text-decoration: none;">
                        <div class="nav-option option2" style="color: black;">
                            <i class="bi-people-fill"></i>
                            <h3> Teams</h3>
                        </div>
                    </a>

                    <a href="admin_round.php" style="text-decoration: none;">
                        <div class="nav-option option1">
                            <i class="bi-award"></i>
                            <h3> Rounds</h3>
                        </div>
                    </a>

                    <a href="admin_payment_approved.php" style="text-decoration: none;">
                        <div class="nav-option option2" style="color: black;">
                            <i class="bi-credit-card"></i>
                            <h3> Payment</h3>
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



            <!-- team detail table -->
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Rounds</h1>
                </div>

                <div class="report-body">
                    <h2>Round 1</h2>
                    <?php if (!$isR1OnGoing && !$isResultDeclared) { ?>
                        <form id="start_round1">
                            <button class="startBtn">Start Round 1</button>
                        </form>
                    <?php } else if ($isResultDeclared) { ?>
                        <div class="startBtn">Round 1 result is already declared <a href="admin_result_announcement.php">View Result</a> </div>
                    <?php } else { ?>
                        <form id="stop_round1">
                            <div>Started on: <?php echo $startDate; ?></div>
                            <button class="stopBtn">Stop Round 1</button>
                        </form>
                    <?php } ?>
                    <form id="view_submissions_form">
                        <button class="ViewBtn">View Submissions</button>
                    </form>
                </div>
                
                <div class="report-body">
                    <h2>Round 2</h2>
                    <?php if (!$isResultDeclared) { ?>
                        <div>Round 1 Result is Pending First <a href="admin_result_announcement.php">declare Round 1 result</a></div>
                    <?php } else if (!$isR2OnGoing && !$isR2ResultDeclared) { ?>
                        <form id="start_round2">
                            <button class="startBtn">Start Round 2</button>
                        </form>
                    <?php } else if ($isR2ResultDeclared) { ?>
                        <div class="startBtn">Round 2 result declared <a href="admin_result_announcement.php?round=round2">View Result</a> </div>
                    <?php } else { ?>
                        <form id="stop_round2">
                            <div>Started on: <?php echo $startDate; ?></div>
                            <button class="stopBtn">Stop Round 2</button>
                        </form>
                    <?php } ?>
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

        const startRound1Form = document.getElementById('start_round1');
        if (startRound1Form) {
            startRound1Form.addEventListener('submit', function(e) {
                e.preventDefault();
                const startBtn = document.querySelector('.startBtn');
                startBtn.disabled = true;
                startBtn.textContent = 'Starting...';
                startBtn.style.cursor = 'not-allowed';
                startBtn.style.backgroundColor = 'gray';

                fetch('start_r1_process.php', {
                        method: 'POST',
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert(result.message);
                            window.location.href = "admin_round.php";
                        } else {
                            alert(result.message);
                            startBtn.disabled = false;
                            startBtn.textContent = 'Register';
                            startBtn.style.cursor = 'pointer';
                            startBtn.style.backgroundColor = 'rgb(97, 19, 207)';
                        }
                    })
                    .catch(error => {
                        console.error('Error: ', error);
                        startBtn.disabled = false;
                        startBtn.textContent = 'Started';
                        startBtn.style.cursor = 'pointer';
                        startBtn.style.backgroundColor = 'rgb(7, 99, 2)';
                    })
            });
        }

        const stopRound1Form = document.getElementById('stop_round1');
        if (stopRound1Form) {
            stopRound1Form.addEventListener('submit', function(e) {
                e.preventDefault();
                const stopBtn = document.querySelector('.stopBtn');
                stopBtn.disabled = true;
                stopBtn.textContent = 'stopping...';
                stopBtn.style.cursor = 'not-allowed';
                stopBtn.style.backgroundColor = 'gray';

                fetch('stop_r1_process.php', {
                        method: 'POST',
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert(result.message);
                            window.location.href = "admin_round.php";

                        } else {
                            alert(result.message);
                            stopBtn.disabled = false;
                            stopBtn.textContent = 'stopped';
                            stopBtn.style.cursor = 'pointer';
                            stopBtn.style.backgroundColor = 'rgb(97, 19, 207)';
                        }
                    })
                    .catch(error => {
                        console.error('Error: ', error);
                        stopBtn.disabled = false;
                        stopBtn.textContent = 'stopped';
                        stopBtn.style.cursor = 'pointer';
                        stopBtn.style.backgroundColor = 'rgb(7, 99, 2)';
                    })
            });
        }

        document.getElementById('view_submissions_form').addEventListener('submit', function(e) {
            e.preventDefault();
            window.location.href = "admin_view_submissions.php";
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>