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

$result1 = mysqli_query($conn, "SELECT * FROM all_team_members WHERE mentor='$email' AND is_leader = 1");
$result2 = mysqli_query($conn, "SELECT * FROM notifications ORDER BY id DESC");

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

        .modal-header h2 {
            padding-top: 25px;
            margin-bottom: 20px;
            color: #5500cb;
        }

        .main {
            background-color: #cad7fda4;
            padding: 15px 30px 30px 30px;
        }

        .round1btn {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: rgb(97, 19, 207);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .round1btn:hover {
            background-color: rgb(79, 0, 190);
        }

        .round1btn:active {
            background-color: rgb(97, 19, 207);
        }

        .nav-option {
            gap: 16px;
        }

        .nav-option i {
            font-size: 160%;
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

        .box-container {
            display: block;
            margin: 0px 0px 40px 30px;
        }

        .report-container {
            margin-top: 5px;
            margin-bottom: 0px;
            display: flex;
            flex-direction: column;
        }

        .report-container h5 {
            color: rgb(125, 125, 125);
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-top: 0px;
        }

        .tabs button {
            background-color: rgb(255, 255, 255);
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 50px 0 0 50px;
            height: 40px;
            width: 120px;
            transition: 0.3s;
        }

        .tabs button.active {
            background-color: rgb(97, 19, 207);
            color: white;
        }

        .content {
            display: none;
        }

        .content.active {
            display: block;
        }

        .round-body {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .round-body label {
            font-weight: 600;
            padding-right: 10px;
        }

        .round-control,
        select,
        textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            width: 100%;
        }

        textarea {
            resize: vertical;
        }

        .round-form {
            padding: 20px;
        }

        .round-form p {
            font-weight: 600;
        }

        .recent-Articles h1 {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 0px;
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
            <h1>Rounds</h1>
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
                        <div class="nav-option option5" style="color: black;">
                            <i class="bi-credit-card"></i>
                            <h3> Payment</h3>
                        </div>
                    </a>

                    <a href="leader_round.php" style="text-decoration: none;">
                        <div class="nav-option option1" style="color: black;">
                            <i style="color: #fff;" class="bi-award"></i>
                            <h3 style="color: #fff;"> Rounds</h3>
                        </div>
                    </a>

                    <a href="leader_result.php" style="text-decoration: none;">
                        <div class="nav-option option4" style="color: black;">
                            <i class="bi-trophy"></i>
                            <h3> Result</h3>
                        </div>
                    </a>

                    <a href="leader_problem_statement.php" style="text-decoration: none;">
                        <div class="nav-option option4" style="color: black;">
                            <i class="bi-eye"></i>
                            <h3> Problems</h3>
                        </div>
                    </a>

                    <a href="leader_guideline.php" style="text-decoration: none;">
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
            <div class="tabs">
                <button id="round1-tab" class="active" onclick="showContent('round1')">Round 1</button>
                <button style="border-radius: 0 50px 50px 0;" id="round2-tab" onclick="showContent('round2')">Round 2</button>
            </div>
            <div class="report-container">
                <div id="round1" class="content active">
                    <div class="report-header">
                        <div class="recent-Articles">
                            <h1>RTH Round 1</h1>
                        </div>
                    </div>

                    <form action="" class="round-form" method="POST">
                        <p>Start Date: 1 Feb 2025 || Deadline: 5 Feb 2025</p>
                        <div class="round-body">
                            <label class="round-label" for="">Your PS ID: </label>
                            <a href="leader_problem_statement.php">
                                <strong><?php echo strtoupper($psId); ?></strong>
                            </a>
                        </div>
                        <div class="round-body">
                            <label style="width: 270px" class="round-label" for="">Problem Statement Title :</label>
                            <input class="round-control" type="text" name="ps_title" id="ps_title" placeholder="Enter Problem Statement Title" required>
                        </div>
                        <div class="round-body">
                            <label style="width: 149px;" class="round-label" for="">PPT Drive Link :</label>
                            <input class="round-control" type="text" name="ppt_link" id="ppt_link" placeholder="Enter PPT Drive Link" required>
                        </div>
                        <div class="round-body">
                            <label style="width: 365px;" class="round-label" for="">Additional Document Drive Link :</label>
                            <input class="round-control" type="text" name="doc_link" id="doc_link" placeholder="(Optional)">
                        </div>
                        <div class="round-body">
                            <label style="width: 203px;" class="round-label" for="">Solution Summary :</label>
                            <textarea name="sol_summary" id="sol_summary" style="padding: 5px 0px 0px 8px; overflow-y: auto; height: 100px;" placeholder="Type your solution..." required></textarea>
                        </div>
                        <button class="round1btn">Submit</button>
                    </form>
                </div>
                <div id="round2" class="content">
                    <div class="report-header">
                        <div class="recent-Articles">
                            <h1>RTH Round 2</h1>
                        </div>
                    </div>
                    <form action="" class="round-form" method="POST">
                        <p>This is the content for Round 2. Add more details here as needed.</p>
                    </form>
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
    <script>
        function showContent(round) {
            // Hide all content
            const contents = document.querySelectorAll('.content');
            contents.forEach(content => content.classList.remove('active'));

            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.tabs button');
            tabs.forEach(tab => tab.classList.remove('active'));

            // Show the selected content and set the active tab
            document.getElementById(round).classList.add('active');
            document.getElementById(`${round}-tab`).classList.add('active');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>