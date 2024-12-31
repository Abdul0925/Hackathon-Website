<?php
require 'db.php';
$result2 = mysqli_query($conn, "SELECT * FROM notifications ORDER BY id DESC");
?>

<?php
session_start();
//require "db.php";
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="admin_dash_style.css">
    <style>
        .main .report-container {
            padding-top: 20px;
            overflow-x: auto;
            min-height: auto;
        }

        .report-container .table {
            border-spacing: 5;
            border-collapse: collapse;
            background-color: #fff;
            width: 100%;
            
        }

        .container {
            padding: 5px;
            overflow: auto;
        }

        th,
        td {
            border: 1px solid rgb(200, 200, 200);
            padding: 10px 30px;
            text-align: center;
        }

        th {
            text-transform: uppercase;
            font-weight: 500;
            padding-top: 20px;
            border-color: black;

        }

        td {
            font-size: 13px;
            border-style: solid;
        }

        .btn-primary {
            color: white;
            width: 80px;
            height: 30px;
            background-color: rgb(200, 0, 0);
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .btn-primary:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(200, 0, 0);
        }

        .badge {
            background-color: rgb(229, 0, 0);
            text-align: center;
            color: #fff;
            font-weight: 700;
            border-radius: 7px;
            padding: 1px 7px 1px 7px;
        }

        @media screen and (max-width: 400px) {
            .report-container {
                width: 98%;
            }

            .main {
                padding: 20px 2px 0px 2px;
            }
        }

        @media screen and (max-width: 600px) {
            .report-container {
                width: 98%;
            }

            .main {
                padding: 20px 2px 10px 2px;
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
        </div>

        <div>
            <H1>Notifications</H1>
        </div>

        <div class="message">
            <div class="circle"></div>
            <a href="admin_show_notifications.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt=""></a>
            <div class="dp">
                <a href="admin_profile.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp"></a>
            </div>
        </div>

    </header>

    <div class="main">
        <div class="report-container">
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Status</th>
                            <th scope="col">Notification</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $currentDay = date("d");
                        $currentMonth = date("m");
                        $currentYear = date("Y");

                        while ($noti = $result2->fetch_assoc()) {
                            $date = date('d-m-Y', strtotime($noti['date'])) . " - " . date('h:i a', strtotime($noti['date']));
                            $oldDay = date('d', strtotime($noti['date']));
                            $oldMonth = date('m', strtotime($noti['date']));
                            $oldYear = date('Y', strtotime($noti['date']));
                            $new = ($currentDay - $oldDay <= 5 && $currentMonth == $oldMonth && $currentYear == $oldYear) ? 1 : 0;
                        ?>
                            <tr>
                                <td>
                                    <?php if ($new == 1) { ?>
                                        <span class="badge badge-reject">NEW</span>
                                    <?php } else { ?>
                                        <span></span>
                                    <?php } ?>
                                </td>
                                <td><?php echo htmlspecialchars($noti['notification']); ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                    <form action="admin_delete_noti_process.php" method="POST" class="d-inline">
                                        <input type="hidden" name="noti_id" value="<?php echo $noti['id']; ?>">
                                        <button class="btn-primary">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
    </script>
</body>

</html>