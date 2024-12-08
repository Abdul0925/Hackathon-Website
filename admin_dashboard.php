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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
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

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Add Notification -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Notification</h5>
                        <a href="add_notifications.php" class="btn btn-primary w-100">Add</a>
                    </div>
                </div>

                <!-- See Team Details -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">See Team Details</h5>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#teamDetailsModal">View</button>
                        </div>
                    </div>
                </div>

                <!-- Announce Result -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Announce Result</h5>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#announceResultModal">Announce</button>
                        </div>
                    </div>
                </div>

                <!-- Create Problem Statement -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Problem Statement</h5>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createProblemModal">Create</button>
                        </div>
                    </div>
                </div>

                <!-- Add Guidelines -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Guidelines</h5>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addGuidelinesModal">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals -->

        <!-- Other Modals (similar structure) -->
        <!-- Example for Team Details Modal -->
        <div class="modal fade" id="teamDetailsModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Team Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Team information will appear here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>