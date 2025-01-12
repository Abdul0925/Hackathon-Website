<?php
session_start();
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'db.php';
    $leaderEmail = $_POST['leaderEmail'];

    $stmt = $conn->prepare("SELECT * FROM team_and_leader_details WHERE leaderEmail = ?");
    $stmt->bind_param("s", $leaderEmail);
    $stmt->execute();
    $teamName = $stmt->get_result();
    $leader = $teamName->fetch_assoc();

    $ideaSubmittedStmt = $conn->prepare("SELECT * FROM team_idea_submissions WHERE leaderEmail = ?");
    $ideaSubmittedStmt->bind_param("s", $leaderEmail);
    $ideaSubmittedStmt->execute();
    $ideaSubmitted = $ideaSubmittedStmt->get_result();
    $idea = $ideaSubmitted->fetch_assoc();
    $isIdeaAvailable = !empty($idea);

    if ($leader['isEliminated']) {
        $isEliminated = 1;
    }
    $isEliminated = 0;
} else {
    header('location:admin_all_teams.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>RTH 25 Teams</title>
    <link rel="stylesheet" href="admin_dash_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        .searchFeature {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px;
        }

        .searchLable {
            margin: 10px;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .searchInput {
            margin: 10px;
            margin-bottom: 10px;
            width: 100%;
            height: 40px;
            border-radius: 5px;
            border: 1px solid rgb(200, 200, 200);
            padding: 1rem;
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
            margin-top: 20px;
            min-height: auto;
        }

        /* Pop up CSS */
        #eliminateModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .elim-btn {
            color: white;
            width: auto;
            height: 40px;
            background-color: rgb(220, 0, 0);
            border: none;
            border-radius: 50px;
            margin-top: 10px;
            padding-right: 15px;
            padding-left: 15px;
            font-size: 15px;
            cursor: pointer;
        }

        .elim-btn:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .eliminateSubmitBtn {
            color: white;
            width: 80px;
            height: 40px;
            background-color: rgb(47, 141, 70);
            border-radius: 5px;
            border: none;
        }

        .eliminateSubmitBtn:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .eliminateCancelBtn {
            color: white;
            width: 80px;
            height: 40px;
            background-color: rgb(220, 0, 0);
            border-radius: 5px;
            border: none;
        }

        .eliminateCancelBtn:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .elim-reason {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            text-align: center;
        }

        .elim-reason textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            padding: 5px;
        }

        .reason-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
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
            <H1>Team Detail</H1>
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
                        <div class="nav-option option1">
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
            <!-- team detail table -->
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles"><?php echo $leader['teamName'] ?></h1>
                    <?php if ($isEliminated) { ?>
                        <div>
                            <button disabled>Eliminated</button>
                        </div>
                    <?php } else { ?>
                        <div>
                            <button class="elim-btn" onclick="openEliminateModal()">Eliminate Team</button>
                        </div>
                    <?php }  ?>
                </div>


                <div class="report-body">
                    <!-- top hedding -->
                    <div>
                        <div>Leader Details:</div>
                        <div>Name: <?php echo $leader['leaderName'] ?></div>
                        <div>Email: <?php echo $leader['leaderEmail'] ?></div>
                        <div>Mobile: <?php echo $leader['leaderMobile'] ?></div>
                        <div>Gender: <?php echo $leader['leaderGender'] ?></div>
                        <div>PS Choosen: <?php echo $leader['psId'] ?></div>
                    </div>
                    <?php if ($isIdeaAvailable) { ?>
                        <div>
                            <div>Idea Details:</div>
                            <div>Title: <?php echo $idea['psTitle'] ?></div>
                            <div>PPT link: <a href="<?php echo $idea['pptLink'] ?>">See PPT</a></div>
                            <div>Doc Link: <a href="<?php echo $idea['docLink'] ?>">See Document</a></div>
                            <div>Summary: <?php echo $idea['solSummary'] ?></div>
                            <div>Idea Approved: <?php echo ($idea['isApproved']) ? 'Approved to Round 2' : 'false'; ?></div>
                        </div>
                    <?php } ?>
                    <div class="table">
                        <table>
                            Member Details:
                            <thead>
                                <tr>
                                    <th scope="col">Sr No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $team_name = $leader['teamName'];
                                $stmt = $conn->prepare("SELECT * FROM leader_and_member_details WHERE teamName = ? AND is_leader = 0");
                                $stmt->bind_param("s", $team_name);
                                $stmt->execute();
                                $teamDetails = $stmt->get_result();
                                $srNo = 1;
                                while ($mentorEmail = $teamDetails->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $srNo ?></td>
                                        <td><?php echo $mentorEmail['memberName'] ?></td>
                                        <td><?php echo $mentorEmail['memberEmail'] ?></td>
                                        <td><?php echo $mentorEmail['memberMobile'] ?></td>
                                        <td><?php echo $mentorEmail['memberGender'] ?></td>

                                    </tr>

                                <?php $srNo++;
                                } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="popup" id="popup" tabindex="-1">
                <div class="modal-header">
                    <h2>Team Details</h2>
                </div>
                <div class="modal-body" id="modalBody">
                    <div id="student-details"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="my-primary-btn" onclick="closePopup()" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Structure -->
    <div id="eliminateModal" class="reason-popup">
        <div class="elim-reason">
            <h3>Eliminate Team</h3>
            <textarea id="eliminationReason" placeholder="Reason for elimination..."></textarea>
            <button onclick="submitElimination()" class="eliminateSubmitBtn">Submit</button>
            <button onclick="closeEliminateModal()" class="eliminateCancelBtn">Cancel</button>
        </div>
    </div>

    <script>
        let menuicn = document.querySelector(".menuicn");
        let nav = document.querySelector(".navcontainer");

        menuicn.addEventListener("click", () => {
            nav.classList.toggle("navclose");
        })

        function openTeamDetails(button) {
            // Access the data-id attribute using the dataset property
            const teamId = button.dataset.id;
            console.log(teamId);

        }

        // Open the modal
        function openEliminateModal() {
            document.getElementById('eliminateModal').style.display = 'flex';
        }

        // Close the modal
        function closeEliminateModal() {
            document.getElementById('eliminateModal').style.display = 'none';
        }

        // Submit elimination reason
        function submitElimination() {
            const reason = document.getElementById('eliminationReason').value.trim();
            const leaderEmail = "<?php echo $leader['leaderEmail']; ?>";
            const leaderName = "<?php echo $leader['leaderName']; ?>";
            const teamName = "<?php echo $leader['teamName']; ?>";
            const teamId = "<?php echo $leader['id']; ?>";
            if (!reason) {
                alert('Please provide a reason for elimination.');
                return;
            }

            const eliminateSubmitBtn = document.querySelector('.eliminateSubmitBtn');
            eliminateSubmitBtn.disabled = true;
            eliminateSubmitBtn.textContent = 'Submitting...';
            eliminateSubmitBtn.style.cursor = 'not-allowed';
            eliminateSubmitBtn.style.backgroundColor = 'gray';

            const formData = new FormData();
            formData.append('reason', reason);
            formData.append('teamId', teamId);
            formData.append('teamName', teamName);
            formData.append('leaderEmail', leaderEmail);
            formData.append('leaderName', leaderName);

            // Send data to admin_eliminate_team.php via fetch
            fetch('admin_eliminate_team.php', {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert('Team eliminated successfully.');
                        closeEliminateModal();
                        window.location.href = "admin_all_eliminated_teams.php";
                    } else {
                        alert('Failed to eliminate team. Please try again.');
                        eliminateSubmitBtn.disabled = false;
                        eliminateSubmitBtn.textContent = 'Submit';
                        eliminateSubmitBtn.style.cursor = 'pointer';
                        eliminateSubmitBtn.style.backgroundColor = 'gray';
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('An error occurred while eliminating the team.');
                    eliminateSubmitBtn.disabled = false;
                    eliminateSubmitBtn.textContent = 'Submit';
                    eliminateSubmitBtn.style.cursor = 'pointer';
                    eliminateSubmitBtn.style.backgroundColor = 'gray';
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>