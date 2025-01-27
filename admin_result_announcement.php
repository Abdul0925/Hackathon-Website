<?php
session_start();
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}

require 'db.php';
$approvedTeams = mysqli_query($conn, "SELECT * FROM team_idea_submissions WHERE isApproved = 1");

$isRoundOneResDeclared = false;
$isRoundOneResDeclaredQuery = mysqli_query($conn, "SELECT isResultAnnounced FROM admin_rounds WHERE title = 'Round 1'");
if ($isRoundOneResDeclaredQuery) {
    $row = mysqli_fetch_assoc($isRoundOneResDeclaredQuery);
    $isRoundOneResDeclared = $row['isResultAnnounced'] == 1;
}

$round = isset($_GET['round']) ? $_GET['round'] : 'round1';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="admin_dash_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        .report-container {
            margin-top: 20px;
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

        table.approved-teams-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table.approved-teams-table th,
        table.approved-teams-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table.approved-teams-table th {
            background-color: rgb(168, 119, 253);
            color: black;
            font-weight: bold;
        }

        table.approved-teams-table tr:nth-child(even) {
            background-color: rgb(246, 241, 255);
        }

        table.approved-teams-table tr:hover {
            background-color: rgb(231, 218, 254);
        }

        .teamBtn {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
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
            <H1>Result Announcement</H1>
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
                        <div class="nav-option option1">
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
                        <div class="nav-option option2" style="color: black;">
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
            <div class="tabs">
                <button id="round1-tab" class="active" onclick="showContent('round1')">Round 1</button>
                <button style="border-radius: 0 50px 50px 0;" id="round2-tab" onclick="showContent('round2')">Round 2</button>
            </div>
            <div class="report-container">
                <div id="round1" class="content <?php echo ($round !== 'round2') ? "active" : "" ?> ">
                    <div class="report-header">

                        <div class="recent-Articles">
                            <h1>RTH Round 1</h1>
                        </div>
                        <?php if (!$isRoundOneResDeclared) { ?>
                            <button id="declareResultBtn">
                                Declare Result
                            </button>
                        <?php } else { ?>
                            <!-- <button id="declareResultBtn"> -->
                            Result Declared
                            <!-- </button> -->
                        <?php } ?>
                    </div>


                    <p>Deadline: 5 Feb 2025</p>
                    <div class="round-body-psid">
                        <label class="round-label" for=""><a href="admin_view_submissions.php"> Approved Teams: </a></label>
                        <?php
                        echo "<table class='approved-teams-table'>
                        <tr>
                        <th>Team Name</th>
                        <th>Leader Email</th>
                        <th>PS ID</th>
                        </tr>";

                        while ($row = mysqli_fetch_assoc($approvedTeams)) {
                            $teamId = $row['team_id'];
                            $teamQuery = mysqli_query($conn, "SELECT teamName FROM team_and_leader_details WHERE id = '$teamId'");
                            $teamRow = mysqli_fetch_assoc($teamQuery);
                            $teamName = $teamRow['teamName'];
                            echo "<tr>";
                            echo "<td><form action='admin_view_teams.php' method='POST' class='d-inline'>
                            <input type='hidden' name='leaderEmail' value='" . $row['leaderEmail'] . "'>
                            <button class='teamBtn' style='cursor: pointer;'>" .
                                $teamName . "</button></form>
                            </td>";
                            echo "<td>" . $row['leaderEmail'] . "</td>";
                            echo "<td>" . $row['psId'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        ?>
                    </div>
                </div>
                <div id="round2" class="content <?php echo ($round == 'round2') ? "active" : "" ?>">
                    <div class="report-header">
                        <div class="recent-Articles">
                            <h1>RTH Round 2</h1>
                        </div>
                    </div>
                    <p>This is the content for Round 2. Add more details here as needed.</p>
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

        <?php
        if ($round == 'round2') {
            echo "showContent('round2')";
        } else {
            echo "showContent('round1')";
        }
        ?>

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

        document.getElementById('declareResultBtn').addEventListener('click', function(e) {
            const declareResultBtn = document.getElementById('declareResultBtn');
            declareResultBtn.disabled = true;
            declareResultBtn.textContent = 'Declaring...';
            declareResultBtn.style.cursor = 'not-allowed';
            declareResultBtn.style.backgroundColor = 'gray';
            fetch('declare_r1_result.php', {
                    method: 'POST',
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert(result.message); // You can log the data received for debugging
                        alert("Result Declared Successfully")
                        window.location.href = "admin_result_announcement.php";
                    } else {
                        // alert('Failed to submit form: ' + result.message);
                        alert(result.message); // You can show a success message
                        declareResultBtn.disabled = false;
                        declareResultBtn.textContent = 'Decalare Result';
                        declareResultBtn.style.cursor = 'pointer';
                        declareResultBtn.style.backgroundColor = 'rgb(255, 255, 255)';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    declareResultBtn.disabled = false;
                    declareResultBtn.textContent = 'Decalare Result';
                    declareResultBtn.style.cursor = 'pointer';
                    declareResultBtn.style.backgroundColor = 'rgb(255, 255, 255)';
                });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>