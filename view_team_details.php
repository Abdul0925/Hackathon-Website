<?php
session_start();
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}

require 'db.php';
$result = mysqli_query($conn, "SELECT * FROM mentor_details");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Notification</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            /* Unique Green Theme */
            --secondary-color: #f4f4f4;
            --text-color: #333;
        }

        body {
            background-color: var(--secondary-color);
            color: var(--text-color);
        }

        .navbar {
            background-color: var(--primary-color);
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: white !important;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: #388E3C;
        }

        body {
            background-color: #f8f9fa;
            /* padding: 20px; */
        }

        .badge-reject {
            background-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            border-radius: 12px;
        }

        .form-container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .table-container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 4%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">


        <!-- Team Detail Section -->
        <div class="table-container">
            <h4 class="mb-3">Team Details</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Sr No</th>
                            <th scope="col">Mentor name</th>
                            <!-- <th scope="col">Email</th> -->
                            <th scope="col">Mobile</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $srno = 0;

                        while ($mentor = $result->fetch_assoc()) {
                            $srno++;

                        ?>
                            <tr>
                                <td><?php echo $srno ?></td>
                                <td><?php echo $mentor['first_name'] . " " . $mentor['last_name']; ?></td>
                                <td><?php //echo htmlspecialchars($mentor['email']); 
                                    ?></td>
                                <td><?php echo $mentor['mobile'] ?></td>
                                <td>
                                    <!-- <form action="" method="POST" class="d-inline"> -->
                                    <input type="hidden" name="noti_id" value="<?php echo $mentor['first_name']; ?>">
                                    <!-- <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#teamDetailsModal">View</button> -->
                                    <button class="btn btn-primary w-100 view-details-btn" data-id="<?php echo $mentor['id']; ?>">
                                        View
                                    </button>
                                    <!-- </form> -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="teamDetailsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Team Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <div id="student-details"></div>
                </div>
                <!-- <div>
                    <p><strong>Name:</strong> <span id="mentorName"></span></p>
                    <p><strong>Email:</strong> <span id="mentorEmail"></span></p>
                    <p><strong>Mobile:</strong> <span id="mentorMobile"></span></p>
                    <p><strong>Team Details:</strong> <span id="teamDetails"></span></p>
                </div> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // When 'View Details' button is clicked
            $('.view-details-btn').click(function() {
                var team_id = $(this).data('id'); // Get student ID from button data attribute
                
                // Make an AJAX request to fetch additional student details
                $.ajax({
                    url: 'fetch_team_details.php',
                    type: 'POST',
                    data: {
                        id: team_id
                    },
                    success: function(data) {
                        console.log(data);
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