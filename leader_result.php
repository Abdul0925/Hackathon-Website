<?php
session_start();
require "db.php";

// Redirect to login if the user is not logged in
if (!isset($_SESSION['leader_logged_in']) || $_SESSION['leader_logged_in'] !== true) {
    header("Location: loginPage.php");
    exit;
}

$email = $_SESSION['leaderEmail'];

// Fetch results announced
$srno = 1;
$isResultAnnounced = false;
$stmt1 = $conn->prepare("SELECT title FROM admin_rounds WHERE isResultAnnounced = 1");
$stmt1->execute();
$result1 = $stmt1->get_result();
if ($result1->num_rows > 0) {
    $isResultAnnounced = true;
}

// Fetch approved team ideas
$stmt2 = $conn->prepare("SELECT team_id, psId FROM team_idea_submissions WHERE isApproved = 1");
$stmt2->execute();
$result2 = $stmt2->get_result();

$dataByPsId = [];
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $teamId = $row["team_id"];
        $psId = $row["psId"];

        // Fetch team details
        $stmt3 = $conn->prepare("SELECT * FROM team_and_leader_details WHERE id = ?");
        $stmt3->bind_param("i", $teamId);
        $stmt3->execute();
        $teamDetailsResult = $stmt3->get_result();
        while ($teamRow = $teamDetailsResult->fetch_assoc()) {
            $dataByPsId[$psId][] = [
                "teamName" => htmlspecialchars($teamRow["teamName"], ENT_QUOTES, 'UTF-8'),
                "leaderName" => htmlspecialchars($teamRow["leaderName"], ENT_QUOTES, 'UTF-8'),
            ];
        }
        $stmt3->close();
    }
}

$isRoundClearedQuery = $conn->prepare("SELECT * FROM team_idea_submissions WHERE leaderEmail = ? AND isApproved = 1");
$isRoundClearedQuery->bind_param("s", $email);
$isRoundClearedQuery->execute();
$teamDetailsResult = $isRoundClearedQuery->get_result();
$isRoundCleared = 0;
if ($teamDetailsResult->num_rows > 0) {
    $isRoundCleared = 1;
}

$stmt2->close();
$stmt1->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>RTH 25 Results</title>
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

        .nav-option {
            gap: 16px;
        }

        .nav-option i {
            font-size: 160%;
        }

        .main {
            background-color: #cad7fda4;
            padding: 15px 30px 30px 30px;
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
            height: 400px;
            /* display: flex; */
            justify-content: center;
            align-items: center;
        }

        .report-container1 {
            margin-top: 20px;
            margin-bottom: 20px;
            height: 260px;
            display: flex;
            justify-content: center;
            align-items: center;
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
            width: 18%;
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

        .round-body-psid label {
            font-weight: 600;
            margin-bottom: 15px;
            width: 15%;
        }

        .recent-Articles h1 {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 0px;
        }

        .round-form p {
            font-weight: 600;
        }

        .round-submit {
            padding: 20px;
        }

        .round-submit p {
            font-weight: 600;
        }

        .round-submit p {
            font-weight: 600;
        }

        .round-submit span {
            border: 1px solid black;
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
            <H1>Result</H1>
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
                        <div class="nav-option option4" style="color: black;">
                            <i class="bi-award"></i>
                            <h3> Rounds</h3>
                        </div>
                    </a>

                    <a href="leader_result.php" style="text-decoration: none;">
                        <div class="nav-option option1" style="color: black;">
                            <i style="color: #fff;" class="bi-trophy"></i>
                            <h3 style="color: #fff;"> Result</h3>
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

                    <?php if ($isResultAnnounced): ?>
                        <p>Deadline: 5 Feb 2025</p>
                        <div class="round-body-psid">
                            <label class="round-label" for="">Your PS ID: </label>
                            <a href="leader_round.php">
                                <strong><?php echo $_SESSION['psId']; ?></strong>
                            </a>
                        </div>
                        <div>
                            Your Result: <?php echo ($isRoundCleared)?'You have cleared round 1':'Sorry you are not eligible for round 2' ?> 

                        </div>
                        <p>Following teams are selected for round 2:</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Problem Statement ID</th>
                                    <th>Team Name</th>
                                    <th>Leader Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dataByPsId)): ?>
                                    <?php foreach ($dataByPsId as $psId => $teams): ?>
                                        <?php foreach ($teams as $team): ?>
                                            <tr>
                                                <td><?= $srno++; ?></td>
                                                <td><?= htmlspecialchars($psId, ENT_QUOTES, 'UTF-8') ?></td>
                                                <td><?= $team["teamName"] ?></td>
                                                <td><?= $team["leaderName"] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">No teams approved yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="report-container1">
                            <h5>No results announced yet.</h5>
                        </div>
                    <?php endif; ?>

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