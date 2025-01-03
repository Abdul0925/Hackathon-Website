<?php
session_start();
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}

require 'db.php';
$adminDetails = mysqli_query($conn, "SELECT * FROM admin_details");
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
            background-color: rgb(220, 0, 0);
            color: white;
            width: 60px;
            height: 30px;
            border-radius: 5px;
            border: none;
        }

        .primary-btn:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .primary-btn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(220, 0, 0);
        }

        .report-container {
            min-height: 0px;
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
                        <div class="nav-option option1">
                            <i class="bi-file-person"></i>
                            <h3> Profile</h3>
                        </div>
                    </a>

                    <a href="admin_payment_approved.php" style="text-decoration: none;">
                        <div class="nav-option option2" style="color: black;">
                            <i class="bi-patch-check"></i>
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
                    <h1 class="recent-Articles">Admin List</h1>
                </div>

                <div class="report-body">
                    <!-- top hedding -->
                    <div class="table">
                        <table>
                            <thead>

                                <tr>

                                    <th scope="col">Sr No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Contact</th>
                                    <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 0;
                                while ($admin = $adminDetails->fetch_assoc()) {
                                    $srno++;
                                ?>
                                    <tr>
                                        <td><?php echo $srno ?></td>
                                        <td><?php echo $admin['username'] ?></td>
                                        <td><?php echo $admin['password'] ?></td>
                                        <td><?php echo $admin['contact'] ?></td>
                                        <!-- <td><button class="primary-btn w-100 view-details-btn" onclick="" style="cursor: pointer;" data-id="<?php //echo $admin['id']; 
                                                                                                                                                    ?>" disabled>Delete</button></td> -->
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

</body>

</html>