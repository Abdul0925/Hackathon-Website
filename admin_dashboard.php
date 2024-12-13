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
            .popup{
                border: 1px solid black;
                border-radius: 10px;
                width: 500px;
                height: auto;
                background: white;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                padding: 0 30px 30px;
                visibility: hidden;
            }
            .open-popup{
                visibility: visible;
            }
            .modal-header h2{
                padding-top: 25px;
                margin-bottom: 20px;
                color: #5500cb;
            }
            .my-primary-btn{
                background-color: rgb(220, 0, 0);
                color: white;
                width: 60px;
                height: 30px;
                border-radius: 5px;
                border: none;
                margin-top: 25px;
            }
            .my-primary-btn:hover{
                background-color: rgb(150, 0, 0);
                color: white;
            }
            .my-primary-btn:active {
                box-shadow: 2px 2px 5px #fc894d;
                background-color: rgb(220, 0, 0);
                /* color: white; */
            }
            @media screen and (max-width: 400px){
                .popup{
                    width: 300px;
                }
            }
            .primary-btn{
                color: white;
                width: 100%;
                height: 30px;
                background-color: rgb(47, 141, 70);
                border-radius: 5px;
                border: none;
            }
            .primary-btn:hover{
                background-color: rgb(31, 91, 46);
                color: white;
            }
            .primary-btn:active {
                box-shadow: 2px 2px 5px #fc894d;
                background-color: rgb(47, 141, 70);
                /* color: white; */
            }

        </style>
        
    </head>

    <body>
        <!-- for header part -->
        <header>

            <div class="logosec">
                <a href="admin_dashboard.php" style="text-decoration: none;"><div class="logo">Admin</div></a>
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png" class="icn menuicn" id="menuicn" alt="menu-icon">
            </div>

            <div>
                <H1>Dashboard</H1>
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
                                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png" class="nav-img" alt="dashboard">
                                <h3> Dashboard</h3>
                            </div>
                        </a>

                        <a href="admin_profile.php" style="text-decoration: none;">
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

                    <a href="admin_problem_statements.php">
                        <div class="box box1">
                            <div class="text">
                                <h2 class="topic-heading">See</h2>
                                <h2 class="topic">Problems</h2>
                            </div>
                            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(31).png" alt="Views">
                        </div>
                    </a>

                    <div class="box box2">
                        <a href="admin_guidelines.php">
                        <div class="text">
                                <h2 class="topic-heading">Add</h2>
                                <h2 class="topic">Guidelines</h2>
                            </div>
                        </a>                            
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185030/14.png" alt="likes">
                    </div>

                    <a href="admin_add_notifications.php">
                        <div class="box box3">
                            <div class="text">
                                <h2 class="topic-heading">Add</h2>
                                <h2 class="topic">Notification</h2>
                            </div>                            
                            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(32).png" alt="comments">
                        </div>
                    </a>

                    <div class="box box4">
                        <a href="admin_result_announcement.php">
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
                        <h1 class="recent-Articles">Teams</h1>
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
                                                <button class="primary-btn w-100 view-details-btn" onclick="openPopup()" style="cursor: pointer;" data-id="<?php echo $mentor['team_name']; ?>">View</button>
                                                <!-- </form> -->
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
                    function openPopup(){
                        popup.classList.add("open-popup")
                    }
                    function closePopup(){
                        popup.classList.remove("open-popup")
                    }
        </script>
    </body>
</html>