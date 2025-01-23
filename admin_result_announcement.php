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
    <title>Result Announcement</title>
    <link rel="stylesheet" href="admin_dash_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        .main {
            padding: 15px 30px 30px 30px;
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
            cursor: pointer;
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

        @media screen and (max-width: 400px) {
            .popup {
                width: 300px;
            }
        }

        .result-declareBtn {
            color: white;
            width: 130px;
            height: 40px;
            background-color: rgb(47, 141, 70);
            border-radius: 50px;
            border: none;
        }

        .result-declareBtn:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .result-declareBtn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
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

        .report-body {
            padding: 0px 20px 20px 20px;
        }

        .report-container {
            min-height: auto;
            margin-top: 5px;
        }

        .DHead h1 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 0px;
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
            color: rgb(97, 19, 207);
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

        .teamBtn {
            border: none;
            background: none;
            color: rgb(97, 19, 207);
            text-decoration: underline;
            cursor: pointer;
        }

        .result-declare {
            padding: 10px 20px 20px 20px;
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
                            <button class="result-declareBtn" id="declareResultBtn">Declare Result</button>
                        <?php } else { ?>
                            <!-- <button id="declareResultBtn"> -->
                            Result Declared
                            <!-- </button> -->
                        <?php } ?>
                    </div>
                    <div class="result-declare">
                        <p>Deadline: 5 Feb 2025</p>
                        <div class="round-body-psid">
                            <label class="round-label" for=""><a href="admin_view_submissions.php"> Approved Teams: </a></label>
                            <?php
                            echo "<table class='table'>
                                    <tr>
                                    <th>Team Name</th>
                                    <th>Leader Email</th>
                                    <th>PS ID</th>
                                </tr>";

                            if ($row = mysqli_fetch_assoc($approvedTeams)) {
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
                            }else{
                                echo "<tr><td colspan='3'>No teams found</td></tr>";
                            }
                            echo "</table>";
                            ?>
                        </div>
                    </div>
                </div>
                <div id="round2" class="content <?php echo ($round == 'round2') ? "active" : "" ?>">
                    <div class="report-header">
                        <div class="recent-Articles">
                            <h1>RTH Round 2</h1>
                        </div>
                    </div>
                    <div class="result-declare">
                        <p>This is the content for Round 2. Add more details here as needed.</p>
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
    <script>
        $(document).ready(function() {
            $('th').click(function() {
                const table = $(this).parents('table');
                const tbody = table.find('tbody');
                const columnIndex = $(this).index();
                const rows = tbody.find('tr').toArray();

                // Determine sort order
                const isAscending = $(this).data('isAscending') || false;
                $(this).data('isAscending', !isAscending);

                rows.sort(function(a, b) {
                    const cellA = $(a).children('td').eq(columnIndex).text().toLowerCase();
                    const cellB = $(b).children('td').eq(columnIndex).text().toLowerCase();

                    if ($.isNumeric(cellA) && $.isNumeric(cellB)) {
                        return isAscending ? cellA - cellB : cellB - cellA;
                    }

                    return isAscending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
                });

                // Append sorted rows to tbody
                $.each(rows, function(index, row) {
                    tbody.append(row);
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // When 'View Details' button is clicked
            $('.view-details-btn').click(function() {
                var team_id = $(this).data('id'); // Get student ID from button data attribute
                console.log(team_id)
                // Make an AJAX request to fetch additional student details
                $.ajax({
                    url: 'fetch_team_details.php',
                    type: 'POST',
                    data: {
                        id: team_id
                    },
                    success: function(data) {
                        // console.log(data);
                        // Insert student details into the modal
                        $('#student-details').html(data);

                        // Show the modal
                        $('#teamDetailsModal').modal('show');
                    }
                });
                // Set the delete button with the student ID
                // $('#delete-btn').data('email', student-details);
            });
        });
        let popup = document.getElementById("popup");

        function openPopup() {
            popup.classList.add("open-popup")
        }

        function closePopup() {
            popup.classList.remove("open-popup")
        }
    </script>
    <script>
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
</body>

</html>