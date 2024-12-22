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
        }

        td {
            font-size: 13px;
        }

        .table {
            overflow-x: auto;

        }

        textarea {
            width: 100%;
            /* Fixed width */
            min-height: 100px;
            /* Minimum height */
            resize: vertical;
            /* Allow resizing only vertically */
            overflow: hidden;
            /* Hide overflow */
        }

        .popup {
            border: 1px solid black;
            border-radius: 10px;
            height: auto;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 0 30px 30px;
            visibility: hidden;
            width: 60%;
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

        .close-btn {
            background-color: rgb(220, 0, 0);
            color: white;
            width: 60px;
            height: 30px;
            border-radius: 5px;
            border: none;
            margin-top: 25px;
        }

        .close-btn:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .close-btn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(220, 0, 0);
            /* color: white; */
        }

        @media screen and (max-width: 400px) {
            .popup {
                width: 98%;
            }
        }

        @media screen and (max-width: 600px) {
            .popup {
                width: 98%;
            }
        }

        .view-btn {
            color: white;
            width: 60px;
            height: 30px;
            background-color: rgb(47, 141, 70);
            border-radius: 5px;
            border: none;
        }

        .view-btn:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .view-btn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
            /* color: white; */
        }

        .delete-btn {
            background-color: rgb(200, 0, 0);
            color: white;
            width: 60px;
            height: 30px;
            border-radius: 5px;
            border: none;
        }

        .delete-btn:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .delete-btn:active {
            box-shadow: 2px 2px 5pxrgb(252, 77, 77);
            background-color: rgb(200, 0, 0);
            /* color: white; */
        }

        .report-container {
            margin-top: 20px;
            margin-bottom: 20px;

        }

        .btn-primary {
            color: white;
            width: 100px;
            height: 40px;
            background-color: rgb(47, 141, 70);
            border-radius: 5px;
            border: none;
            margin-top: 10px;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .btn-primary:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
        }

        /* .form-body {
            padding-bottom: 10px;
        }

        .form-body .form-label {
            font-weight: 500;
        }

        .form-control {
            padding-left: 5px;
            width: 300px;
            height: 40px;
            margin-left: 5px;
        }

        .form-body select {
            padding-left: 5px;
            width: 120px;
            height: 40px;
            margin-left: 5px;
        } */

        .report-body {
            /* max-width: 600px; */
            margin: auto;
            padding: 20px;
            /* border: 1px solid #ddd; */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgb(255, 255, 255);
        }

        .form-body {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-body label {
            font-weight: 600;
            width: 150px;
            /* Fixed width for labels */
        }

        .form-control,
        select,
        textarea {
            padding: 10px;
            width: 100%;
            /* Full width for inputs */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: rgb(97, 19, 207);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #5500cb;
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
            <!-- team detail table -->
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Add New Problem</h1>
                </div>

                <div class="report-body">
                    <form action="admin_add_ps_process.php" method="POST">
                        <div class="form-body">
                            <label for="psId" class="form-label">Id: </label>
                            <input type="text" name="psId" id="psId" class="form-control" placeholder="Enter PS ID" required>
                        </div>
                        <div class="form-body">
                            <label for="psName" class="form-label">Title: </label>
                            <input type="text" name="psName" id="psName" class="form-control" placeholder="Enter PS Title" required>
                        </div>
                        <div class="form-body">
                            <label for="psCategory" class="form-label">Category: </label>
                            <input type="text" name="psCategory" id="psCategory" class="form-control" placeholder="Enter PS Category" required>
                        </div>
                        <div class="form-body">
                            <label for="psGivenBy" class="form-label">Organization: </label>
                            <input type="text" name="psGivenBy" id="psGivenBy" class="form-control" placeholder="Enter PS Organization Name" required>
                        </div>
                        <div class="form-body">
                            <label for="psDificulty" class="form-label">Dificulty Level:</label>
                            <select name="psDificulty" id="psDificulty" required>
                                <option value="" selected disabled>Select Level</option>
                                <option value="">None</option>
                                <option value="easy">Easy</option>
                                <option value="medium">Medium</option>
                                <option value="hard">Hard</option>
                            </select>
                        </div>
                        <div class="form-body">
                            <label for="psDescription" class="form-label">Description:</label>
                            <textarea name="psDescription" id="psDescription" style="padding: 5px 0px 0px 8px; overflow-y: auto;" rows="4" placeholder="Type your description here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
                <!-- </div> -->
            </div>
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Problems</h1>
                </div>

                <!-- <div class="report-body"> -->
                <!-- top hedding -->
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Sr No</th>
                                <th scope="col">PS ID</th>
                                <th scope="col">PS Name</th>
                                <th scope="col">PS Category</th>
                                <th scope="col">View</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // SQL query to fetch all records from the problem_statements table
                            $sql = "SELECT * FROM problem_statements"; // Assuming your table name is 'ps_data'
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $sr_no = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $sr_no . "</td>";
                                    echo "<td>" . $row['ps_id'] . "</td>";
                                    echo "<td>" . $row['ps_name'] . "</td>";
                                    echo "<td>" . $row['ps_category'] . "</td>";
                                    echo '<td> <button class="view-btn" onclick="openPopup(this)" data-id="' . $row['ps_id'] . '">View</button> </td>';
                                    echo '<td> <button class="delete-btn" onclick="deletePs(this)" data-id="' . $row['ps_id'] . '">Delete</button>';
                                    echo "</tr>";

                                    // Modal for each problem statement
                                    echo '
                                        <div class="popup" id="' . $row['ps_id'] . '" tabindex="-1">
                                            <div class="modal-header">
                                                <h2 class="modal-title">Problem Statement Details</h2>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>PS ID:</strong> ' . $row['ps_id'] . '</p>
                                                <p><strong>Name:</strong> ' . $row['ps_name'] . '</p>
                                                <p><strong>Organization:</strong> ' . $row['ps_given_by'] . '</p>
                                                <p><strong>Description:</strong> ' . $row['ps_description'] . '</p>
                                                <p><strong>Total Participation:</strong> ' . $row['no_of_participation'] . '</p>
                                                <p><strong>Difficulty Level:</strong> ' . $row['ps_difficulty_level'] . '</p>
                                            </div>
                                            <div class="modal-footer">
                                                
                                                <button type="button" class="close-btn" data-id="' . $row['ps_id'] . '" onclick="closePopup(this)">Close</button>

                                            </div>
                                        </div>';
                                    $sr_no++; // Increment the serial number
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No problem statements found</td></tr>";
                            }

                            $conn->close();

                            ?>
                        </tbody>
                    </table>
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
        document.getElementById('listBtn').addEventListener('click', () => {
            if (document.getElementById("sidebar").style.display == 'block') {
                document.getElementById("sidebar").style.display = 'none';
            } else {
                document.getElementById("sidebar").style.display = 'block';
            }
        })

        document.getElementById('backBtn').addEventListener('click', () => {
            if (document.getElementById("sidebar").style.display == 'block') {
                document.getElementById("sidebar").style.display = 'none';
            } else {
                document.getElementById("sidebar").style.display = 'block';
            }
        })

        document.getElementById('myProfile').addEventListener('click', () => {
            window.location.href = "myProfile.php";
        })
        // yahan pe jo si bhi id dalenga vo popup open honga
        // let popup = document.getElementById("RJH01");

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

        function deletePs(button) {
            const psId = button.getAttribute("data-id");

            if (confirm("Are you sure you want to delete this problem statement?")) {
                fetch("delete_ps.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: `ps_id=${encodeURIComponent(psId)}`,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            alert(data.message);
                            // Remove the row from the table
                            const row = button.closest("tr");
                            if (row) {
                                row.remove();
                            }
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("An error occurred while deleting the problem statement.");
                    });
            }
        }
    </script>
</body>

</html>