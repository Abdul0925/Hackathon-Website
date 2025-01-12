<?php
session_start();
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}

require 'db.php';
$teamName = mysqli_query($conn, "SELECT * FROM team_and_leader_details WHERE isEliminated = 1");
// $teamDetails = mysqli_query($conn, "SELECT * FROM all_team_members");
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
            <H1>All Teams</H1>
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
                    <h1 class="recent-Articles">Teams</h1>
                    <div>
                        <a href="admin_all_teams.php">
                            See participating teams
                        </a>
                    </div>
                </div>
                <div class="searchFeature">

                    <!-- <label for="" class="searchLable">Search: </label> -->
                    <input class="searchInput" type="text" id="searchBox" placeholder="Search by Team Name or Leader Email">
                </div>

                <div class="report-body">
                    <!-- top hedding -->
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">Sr No</th>
                                    <th scope="col">Team Name</th>
                                    <th scope="col">Leader</th>
                                    <th scope="col">PS</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 0;
                                while ($leader = $teamName->fetch_assoc()) {
                                    $srno++;
                                    $team_name = $leader['teamName'];
                                    // $teamDetails = mysqli_query($conn, "SELECT * FROM all_team_members WHERE team_name = '$team_name'");
                                    // $mentorEmail = $teamDetails->fetch_assoc();
                                ?>
                                    <tr>
                                        <td><?php echo $srno ?></td>
                                        <td>
                                            <form action="admin_view_teams.php" method="POST" class="d-inline">
                                                <input type="hidden" name="leaderEmail" value="<?php echo $leader['leaderEmail']; ?>">
                                                <button class="primary-btn w-100 view-details-btn" style="cursor: pointer;"><?php echo $leader['teamName'] ?></button>
                                            </form>
                                        </td>
                                        <td><?php echo $leader['leaderEmail'] ?></td>
                                        <td><?php echo  strtoupper($leader['psId']) ?></td>
                                        <td>
                                            <form action="admin_admit_eliminated_teams.php" method="POST" class="d-inline">
                                                <input type="hidden" name="leaderEmail" value="<?php echo $leader['leaderEmail']; ?>">
                                                <input type="hidden" name="leaderName" value="<?php echo $leader['leaderName']; ?>">
                                                <input type="hidden" name="teamName" value="<?php echo $leader['teamName']; ?>">
                                                <button class="primary-btn w-100 view-details-btn" style="cursor: pointer;" onclick="return confirm('Are you sure you want to admit this team?');">Admit</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
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

    <script>
        let menuicn = document.querySelector(".menuicn");
        let nav = document.querySelector(".navcontainer");

        menuicn.addEventListener("click", () => {
            nav.classList.toggle("navclose");
        })
    </script>
    <script>
        // Search functionality
        document.getElementById('searchBox').addEventListener('input', function() {
            const searchQuery = this.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr'); // Target only tbody rows

            rows.forEach(row => {
                const cells = Array.from(row.cells);
                const matches = cells.some(cell =>
                    cell.textContent.toLowerCase().includes(searchQuery)
                );
                row.style.display = matches ? '' : 'none'; // Show or hide rows
            });
        });

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

        function openTeamDetails(button) {
            // Access the data-id attribute using the dataset property
            const teamId = button.dataset.id;
            console.log(teamId);

        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>