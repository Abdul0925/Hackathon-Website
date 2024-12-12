<?php
session_start();
if ($_SESSION['admin_logged_in'] != true) {
    header("loginPage.php");
}

require 'db.php';
$teamName = mysqli_query($conn, "SELECT DISTINCT team_name FROM all_team_members");
// $teamDetails = mysqli_query($conn, "SELECT * FROM all_team_members");
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="admin_dash_style.css">
        <style>
            table{
                border-collapse: collapse;
                background-color: #fff;
                border-radius: 10px;
                margin: auto;
                width: 100%;
            }
            th,td {
                border:1px solid rgb(200, 200, 200);
                padding: 8px 30px;
                text-align: center;
            }
            th{
                text-transform: uppercase;
                font-weight: 500;
                border-color: black;
            }
            td{ 
                font-size: 13px;
            }
        </style>
        
    </head>

    <body>
        <!-- for header part -->
        <header>

            <div class="logosec">
                <div class="logo">Admin</div>
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png" class="icn menuicn" id="menuicn" alt="menu-icon">
            </div>

            <div>
                <H1>Dashboard</H1>
            </div>

            <div class="message">
                <div class="circle"></div>
                    <a href="show_notifications.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt=""></a>
                <div class="dp">
                    <a href=""><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp"></a>
                </div>
            </div>

        </header>

        <div class="main-container">
            <div class="navcontainer">
                <nav class="nav">
                    <div class="nav-upper-options">
                        <div class="nav-option option1">
                            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png" class="nav-img" alt="dashboard">
                            <h3> Dashboard</h3>
                        </div>

                        <a href="" style="text-decoration: none;">
                            <div class="nav-option option2" style="color: black;">
                                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183323/10.png" class="nav-img" alt="blog">
                                <h3> Profile</h3>
                            </div>
                        </a>

                        <a href="logout.php" style="text-decoration: none;">
                            <div class="nav-option logout" style="color: black;">
                                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png" class="nav-img" alt="logout">
                                <h3>Logout</h3>
                            </div>
                        </a>

                    </div>
                </nav>
            </div>

            <div class="main">

                <div class="box-container">

                    <a href="">
                        <div class="box box1">
                            <div class="text">
                                <h2 class="topic-heading">See</h2>
                                <h2 class="topic">Problems</h2>
                            </div>
                            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(31).png" alt="Views">
                        </div>
                    </a>

                    <div class="box box2">
                        <a href="">
                        <div class="text">
                                <h2 class="topic-heading">Add</h2>
                                <h2 class="topic">Guidelines</h2>
                            </div>
                        </a>                            
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185030/14.png" alt="likes">
                    </div>

                    <a href="add_notifications.php">
                        <div class="box box3">
                            <div class="text">
                                <h2 class="topic-heading">Add</h2>
                                <h2 class="topic">Notification</h2>
                            </div>                            
                            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(32).png" alt="comments">
                        </div>
                    </a>

                    <div class="box box4">
                        <a href="">
                            <div class="text">
                                <h2 class="topic-heading">Result</h2>
                                <h2 class="topic">Announcement</h2>
                            </div>
                        </a>                            
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185029/13.png" alt="published">
                    </div>
                    
                </div>

                <!-- team detail table -->
                <div class="report-container">
                    <div class="report-header">
                        <h1 class="recent-Articles">Team Details</h1>
                    </div>

                    <div class="report-body">
                        <!-- top hedding -->
                        <div class="table">
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">Sr No</th>
                                        <th scope="col">Team Name</th>
                                        <th scope="col">Mentor</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $srno = 0;
                                    while ($mentor = $teamName->fetch_assoc()) {
                                        $srno++;
                                        $team_name = $mentor['team_name'];
                                        $teamDetails = mysqli_query($conn, "SELECT * FROM all_team_members WHERE team_name = '$team_name'");
                                        $mentorEmail = $teamDetails->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td><?php echo $srno ?></td>
                                            <td><?php echo $mentor['team_name'] ?></td>
                                            <td><?php echo $mentorEmail['mentor'] ?></td>
                                            <td>
                                                <!-- <form action="" method="POST" class="d-inline"> -->
                                                <input type="hidden" name="noti_id" value="<?php echo $mentorEmail['email']; ?>">
                                                <button class="my-primary-btn" style="cursor: pointer;" data-id="<?php echo $mentor['team_name']; ?>">View</button>
                                                <!-- </form> -->
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