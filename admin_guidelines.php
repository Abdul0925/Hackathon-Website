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
    <title>Add Guidelines</title>
    <link rel="stylesheet" href="admin_dash_style.css">
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



        .delete-btn {
            color: white;
            width: 100%;
            height: 30px;
            background-color: rgb(141, 50, 47);
            border-radius: 5px;
            border: none;
        }

        .delete-btn:hover {
            background-color: rgb(91, 31, 31);
            color: white;
        }

        .delete-btn:active {
            box-shadow: 2px 2px 5pxrgb(252, 77, 77);
            background-color: rgb(181, 1, 1);
            /* color: white; */
        }

        .btn-primary {
            color: white;
            width: 120px;
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

        .report-body .form-body .form-label {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .report-body .form-body .form-control {
            border-radius: 5px;
            width: 100%;
            height: 150px;
            padding-left: 10px;
            padding-top: 10px;
        }

        .report-container {
            margin-top: 20px ;
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
            <H1>Add Guidelines</H1>
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
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Add New Guidelines</h1>
                </div>

                <div class="report-body">
                    <form action="admin_add_guide_process.php" method="POST">
                        <div class="form-body">
                            <label for="guideline" class="form-label">Enter New Guideline:</label>
                            <textarea name="guideline" id="guideline" class="form-control" rows="4" placeholder="Type your notification here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Guideline</button>
                    </form>
                </div>
            </div>
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Guidelines</h1>
                </div>

                <div class="report-body">
                    <!-- top hedding -->
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">Sr No</th>
                                    <th scope="col">Guidelines</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // SQL query to fetch all records from the problem_statements table
                                $sql = "SELECT * FROM guidelines"; // Assuming your table name is 'ps_data'
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $sr_no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $sr_no . "</td>";
                                        echo "<td>" . $row['guideline'] . "</td>";
                                        echo '<td>
                                                <button class="delete-btn" onclick="deleteGuide(this)" data-id="' . $row['id'] . '">Delete</button>
                                            </td>';
                                        echo "</tr>";

                                        $sr_no++; // Increment the serial number
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No guidelines found</td></tr>";
                                }

                                $conn->close();

                                ?>
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

        function deleteGuide(button) {
            const Id = button.getAttribute("data-id");

            if (confirm("Are you sure you want to delete this guideline?")) {
                fetch("delete_guide.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: `id=${encodeURIComponent(Id)}`,
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
                        alert("An error occurred while deleting the guideline.");
                    });
            }
        }
    </script>
</body>

</html>