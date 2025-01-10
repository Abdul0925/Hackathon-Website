<?php
require 'db.php';
$result2 = mysqli_query($conn, "SELECT * FROM notifications ORDER BY id DESC");
?>

<?php
session_start();
//require "db.php";
if ($_SESSION['leader_logged_in'] != true) {
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
    <link rel="stylesheet" href="leader_dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            /* background-color: #f1f2f6; */
        }

        .main {
            background-color: #cad7fda4;
            height: 100vh;
        }

        .main .report-container {
            padding-top: 20px;
            overflow-x: auto;
            min-height: auto;
            margin-top: 70px;
        }

        .report-container .table {
            border-collapse: collapse;
            background-color: #fff;
            width: 100%;
            margin-bottom: 0px;
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
        }

        .dp {
            align-items: baseline;
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
            <a href="leader_dashboard.php" style="text-decoration: none;">
                <div class="logo">Leader</div>
            </a>
        </div>

        <div>
            <H1>Notifications</H1>
        </div>

        <div class="message">
            <div class="circle"></div>
            <a href="leader_show_notifications.php" style="display: flex;"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt=""></a>
            <div class="dp">
                <a href="leader_team.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp"></a>
            </div>
        </div>

    </header>

    <div class="main">
        <div class="report-container">
            <div class="container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Status</th>
                            <th scope="col">Notification</th>
                            <th scope="col">Date</th>
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