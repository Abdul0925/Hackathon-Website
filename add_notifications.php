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
            margin: 15px;
        }
        .table-container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
    <!-- Form Section -->
    <div class="form-container mb-4">
        <h4 class="mb-3">Add New Notification</h4>
        <form action="add_noti_process.php" method="POST">
            <div class="mb-3">
                <label for="notification" class="form-label">Enter New Notification:</label>
                <textarea name="notification" id="notification" class="form-control" rows="4" placeholder="Type your notification here..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Notifications Section -->
    <div class="table-container">
        <h4 class="mb-3">Notifications</h4>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
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
                                <form action="delete_noti_process.php" method="POST" class="d-inline">
                                    <input type="hidden" name="noti_id" value="<?php echo $noti['id']; ?>">
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

