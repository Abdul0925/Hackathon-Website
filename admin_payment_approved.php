<?php
session_start();
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}

require 'db.php';
$adminDetails = mysqli_query($conn, "SELECT * FROM payment_details");
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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

        .primary-btn {
            background-color: rgb(47, 141, 70);
            color: white;
            width: 80px;
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

        .filter-container {
            width: 100%;
            padding: 10px;
            margin: 20px 20px 0px 20px;
        }

        .filter-container label {
            font-size: 20px;
            font-weight: bold;
        }

        .filter-container input {
            width: 50%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .report-container {
            margin-top: 20px;
        }

        .nav-upper-options {
            /* gap: 10px; */
            justify-content: center;
            align-items: center;
        }

        .nav-upper-options h3 {
            font-size: 18px;
            /* margin-bottom: 0px; */
            font-weight: bold;
            padding-left: 10px;
            text-decoration: none;
        }

        .nav-option i {
            font-size: 185%;
        }

        @media screen and (max-width: 400px) {
            .popup {
                width: 300px;
            }
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
            <H1>Profile</H1>
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
                        <div class="nav-option option3" style="color: black;">
                            <i class="bi-file-person"></i>
                            <h3> Profile</h3>
                        </div>
                    </a>

                    <a href="admin_payment_approved.php" style="text-decoration: none;">
                        <div class="nav-option option1" style="color: black;">
                            <i style="color: #fff;" class="bi-patch-check"></i>
                            <h3 style="color: #fff"> Payment</h3>
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
                    <h1 class="recent-Articles">Admin List</h1>
                </div>

                <div class="filter-container">
                    <label for="filterInput">Search</label>
                    <input type="text" id="filterInput" placeholder="Search by Team Name or Transaction ID" onkeyup="filterTable()">
                </div>
                <script>
                    function filterTable() {
                        const input = document.getElementById('filterInput');
                        const filter = input.value.toLowerCase();
                        const table = document.querySelector('table tbody');
                        const rows = table.getElementsByTagName('tr');

                        for (let i = 0; i < rows.length; i++) {
                            const teamName = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
                            const transactionId = rows[i].getElementsByTagName('td')[2].textContent.toLowerCase();
                            if (teamName.includes(filter) || transactionId.includes(filter)) {
                                rows[i].style.display = '';
                            } else {
                                rows[i].style.display = 'none';
                            }
                        }
                    }
                </script>
                <div class="report-body">
                    <!-- top hedding -->
                    <div class="table">
                        <table>
                            <thead>


                                <tr>
                                    <th scope="col">Sr No</th>
                                    <th scope="col">Team Name</th>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 0;
                                while ($admin = $adminDetails->fetch_assoc()) {
                                    // Fetch teamName from team_and_leader_details
                                    $srno++;
                                    $stmt = $conn->prepare("SELECT * FROM team_and_leader_details WHERE id = ?");
                                    $stmt->bind_param("i", $admin['team_id']); // Bind the team_id as a parameter
                                    $stmt->execute();
                                    $teamResult = $stmt->get_result();
                                    $team = $teamResult->fetch_assoc();
                                    $teamName = $team['teamName'] ?? 'Unknown'; // Default to 'Unknown' if no team found
                                    $leaderMobile = $team['leaderMobile'] ?? '';
                                    // Free resources
                                    $stmt->close();
                                ?>
                                    <tr>
                                        <td><?php echo $srno ?></td>
                                        <td><?php echo $teamName ?></td>
                                        <td><?php echo $admin['transactionId'] ?></td>
                                        <td><?php echo $leaderMobile ?></td>
                                        <td><?php echo ($admin['is_approved'] == 0) ? 'Pending' : 'Accepted' ?></td>

                                        <td>
                                            <a style="text-decoration: none; color: white;" href="<?php echo $admin['pay_path'] ?>">
                                                <button class="primary-btn w-100 view-details-btn" onclick="" style="cursor: pointer;" data-id="<?php echo $admin['id']; ?>">
                                                    View
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <button
                                                class="primary-btn w-100 view-details-btn"
                                                onclick="approvedPayment(this)"
                                                style="cursor: pointer;"
                                                data-id="<?php echo $admin['id']; ?>"
                                                data-email="<?php echo $team['leaderEmail']; ?>"
                                                data-name="<?php echo $team['leaderName']; ?>"
                                                data-pass="<?php echo $team['password']; ?>">
                                                Approve
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('th').click(function() {
            let table = $(this).closest('table');
            let rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
            this.asc = !this.asc;

            if (!this.asc) {
                rows.reverse();
            }

            // Append rows efficiently
            let fragment = document.createDocumentFragment();
            rows.forEach(row => fragment.appendChild(row));
            table.find('tbody').append(fragment);

            // Update sorting indicator
            $('th').removeClass('asc desc'); // Reset all headers
            $(this).addClass(this.asc ? 'asc' : 'desc'); // Highlight current column
        });

        function comparer(index) {
            return function(a, b) {
                let valA = getCellValue(a, index);
                let valB = getCellValue(b, index);

                if ($.isNumeric(valA) && $.isNumeric(valB)) {
                    return parseFloat(valA) - parseFloat(valB); // Numeric comparison
                } else {
                    return valA.localeCompare(valB); // String comparison
                }
            };
        }

        function getCellValue(row, index) {
            return $(row).children('td').eq(index).text().trim();
        }
    });
</script>

    <script>
        let menuicn = document.querySelector(".menuicn");
        let nav = document.querySelector(".navcontainer");

        menuicn.addEventListener("click", () => {
            nav.classList.toggle("navclose");
        })

        function approvedPayment(button) {
            const id = button.getAttribute('data-id'); // Fetch the data-id
            const leaderEmail = button.getAttribute('data-email'); // Fetch the data-id
            const leaderName = button.getAttribute('data-name'); // Fetch the data-id
            const password = button.getAttribute('data-pass'); // Fetch the data-id
            console.log("Approved Payment ID:", id);
            console.log("Approved Leader Email:", leaderEmail);
            console.log("Approved Leader Name:", leaderName);
            console.log("Approved Password:", password);
            const data = new FormData();
            data.append('id', id);
            data.append('leaderEmail', leaderEmail);
            data.append('leaderName', leaderName);
            data.append('password', password);
            fetch('payment_approved_process.php', {
                    method: 'POST',
                    body: data,
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert(result.message);
                        location.reload();
                    } else {
                        alert(result.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                })
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   


</body>

</html>