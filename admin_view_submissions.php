<?php
session_start();
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}

require 'db.php';
$query = "SELECT * FROM team_idea_submissions";
$result = $conn->query($query);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Idea Submissions</title>
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
            padding: 8px 10px;
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
            max-width: 800px;
            max-height: 500px;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 0 20px 20px;
            visibility: hidden;
        }

        .open-popup {
            visibility: visible;
        }

        .modal-header h2 {
            padding-top: 25px;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #5500cb;
            border-bottom: 2px solid rgba(0, 20, 151, 0.59);
        }

        .modal-body {
            overflow-y: auto;
            max-height: 345px;
        }

        .modal-body p {
            margin-bottom: 5px;
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
            margin-top: 10px;
            font-size: 90%;
        }

        .modal-footer button:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .modal-footer button:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(220, 0, 0);
        }

        .primary-btn {
            background-color: rgb(47, 141, 70);
            color: white;
            width: 60px;
            height: 30px;
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

        .report-container {
            min-height: 0px;
            margin-top: 20px;
            height: auto;
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

        .approveIdeaBtn {
            background-color: rgb(47, 141, 70);
            color: white;
            width: 130px;
            height: 30px;
            border-radius: 5px;
            border: none;
        }

        .approveIdeaBtn:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .approveIdeaBtn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
        }

        .disapproveIdeaBtn {
            background-color: rgb(220, 0, 0);
            color: white;
            width: 130px;
            height: 30px;
            border-radius: 5px;
            border: none;
        }

        .disapproveIdeaBtn:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .disapproveIdeaBtn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(220, 0, 0);
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
                    <h1 class="recent-Articles">Round 1</h1>
                </div>

                <div class="report-body">
                    <?php
                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>Sr No</th><th>PS ID</th><th>Team Leader</th><th>Title</th><th>Summary</th><th>Status</th><th>Action</th></tr>";
                        $sr_no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $sr_no . "</td>";
                            echo "<td>" . $row['psId'] . "</td>";
                            echo "<td id='leaderEmail'>" . $row['leaderEmail'] . "</td>";
                            echo "<td>" . $row['psTitle'] . "</td>";
                            echo "<td><button class='primary-btn' onclick='openPopup(this)' data-id='" . $row["leaderEmail"] . "')>View</button></td>";
                            if (!$row['isApproved']) {
                                echo "<td>❌ Disapproved</td>";
                                echo "<td>
                                <form id='approve_idea_form'>
                                <button class='approveIdeaBtn' data-id='" . $row['leaderEmail'] . "'>Approve Idea</button>
                                </form>
                                </td>";
                            } else {
                                echo "<td>✅ Approved</td>";
                                echo "<td>
                                    <form id='disapprove_idea_form'>
                                    <button class='disapproveIdeaBtn' data-id='" . $row['leaderEmail'] . "'>DisApprove Idea</button>
                                    </form>
                                    </td>";
                            }
                            echo "</tr>";

                            echo '<div class="popup" id="' . $row['leaderEmail'] . '" tabindex="-1">
                            <div class="modal-header">
                                <h2 class="modal-title">Problem Statement Details</h2>
                            </div>
                            <div class="modal-body">
                                <p><strong>PPT link: </strong> <a href="' . $row["pptLink"] . '">' . $row["pptLink"] . '</a></p>
                                <p><strong>DOC link: </strong> <a href="' . $row["docLink"] . '">' . $row["docLink"] . '</a></p>
                                <p><strong>Summary: </strong> ' . $row['solSummary'] . '</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-id="' . $row['leaderEmail'] . '" onclick="closePopup(this)">Close</button>
                            </div>
                        </div>';
                            $sr_no++;
                        }
                        echo "</table>";
                    } else {
                        echo "No submissions found.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function viewSummary(summary) {
            document.getElementById('summaryContent').innerText = summary;
            var summaryModal = new bootstrap.Modal(document.getElementById('summaryModal'));
            summaryModal.show();
        }
    </script>

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
        
        const approveButtons = document.querySelectorAll('.approveIdeaBtn');

        approveButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                button.disabled = true;
                button.textContent = 'Approving...';
                button.style.cursor = 'not-allowed';
                button.style.backgroundColor = 'gray';
                const email = button.getAttribute('data-id');
                const formData = new FormData();
                formData.append('leaderEmail', email);
                console.log(email);
                fetch('approve_team_for_round2.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert(result.message);
                            window.location.href = "admin_view_submissions.php"
                        } else {
                            alert(result.message);
                            approveBtn.disabled = false;
                            approveBtn.textContent = 'Approve Idea';
                            approveBtn.style.cursor = 'pointer';
                            approveBtn.style.backgroundColor = 'rgb(106, 245, 78)';
                        }
                    })
                    .catch(error => {
                        console.error('Error: ', error);
                        approveBtn.disabled = false;
                        approveBtn.textContent = 'Approve Idea';
                        approveBtn.style.cursor = 'pointer';
                        approveBtn.style.backgroundColor = 'rgb(69, 226, 64)';
                    })
            });
        });

        const disapproveButtons = document.querySelectorAll('.disapproveIdeaBtn');

        disapproveButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                button.disabled = true;
                button.textContent = 'Approving...';
                button.style.cursor = 'not-allowed';
                button.style.backgroundColor = 'gray';
                const email = button.getAttribute('data-id');
                const formData = new FormData();
                formData.append('leaderEmail', email);
                console.log(email);
                fetch('disapprove_team_for_round2.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert(result.message);
                            window.location.href = "admin_view_submissions.php"
                        } else {
                            alert(result.message);
                            approveBtn.disabled = false;
                            approveBtn.textContent = 'Disapprove Idea';
                            approveBtn.style.cursor = 'pointer';
                            approveBtn.style.backgroundColor = 'rgb(106, 245, 78)';
                        }
                    })
                    .catch(error => {
                        console.error('Error: ', error);
                        approveBtn.disabled = false;
                        approveBtn.textContent = 'Disapprove Idea';
                        approveBtn.style.cursor = 'pointer';
                        approveBtn.style.backgroundColor = 'rgb(69, 226, 64)';
                    })
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>