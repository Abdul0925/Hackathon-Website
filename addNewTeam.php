<?php
session_start();
require "db.php";
if ($_SESSION['mentor_logged_in'] != true) {
    header("location:loginPage.php");
}
if($_SESSION['totalTeams']>=3){
    header("location:mentor_my_teams.php");
}

$no_of_members = isset($_POST['no_of_members']) && $_POST['no_of_members'] >= 2 && $_POST['no_of_members'] <= 5
    ? (int)$_POST['no_of_members']
    : 2;

    if (isset($_POST['submit'])) {
        $team_name = $_POST["team_name"];
        $ps = $_POST["ps"];
        $mentorEmail = $_SESSION["email"];
    
        echo "<h5 class='text-center text-success mt-5'>Team Information Submitted Successfully:</h5>";
    
        // Prepare the SQL statement outside the loop
        $stmt = $conn->prepare("INSERT INTO all_team_members (mentor, name, email, phone, team_name, ps, is_leader) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters to the prepared statement
        for ($i = 1; $i <= $no_of_members; $i++) {
            $name = $_POST["name$i"];
            $email = $_POST["email$i"];
            $phone = $_POST["phone$i"];
            $isLeader = isset($_POST['team_leader']) && $_POST['team_leader'] === "name$i" ? 1 : 0;
    
            $stmt->bind_param("ssssssi", $mentorEmail, $name, $email, $phone, $team_name, $ps, $isLeader);
            
            if ($stmt->execute()) {
                echo "<p class='text-center'>Team Member $i - <strong>$name</strong>: Saved successfully.</p>";
            } else {
                echo "<p class='text-danger text-center'>Error saving Team Member $i: " . $conn->error . "</p>";
            }
        }
    
        $stmt->close();
        $conn->close();
        header('Location: mentor_my_teams.php');
        exit(); // To ensure the rest of the script doesn't run after the redirect
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Team</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="nav-link">
            <a href="mentor_my_teams.php">Back to Dashboard</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Team Information Form</h3>
            </div>
            <div class="card-body">
                <!-- Member Count Form -->
                <form method="post" class="mb-4">
                    <label for="no_of_members">Enter Number of Members in your Team (2-5):</label>
                    <input type="number" name="no_of_members" min="2" max="5" value="<?= $no_of_members ?>" required>
                    <button type="submit" class="btn btn-primary btn-sm">Set Members</button>
                </form>

                <!-- Team Information Form -->
                <form method="post">
                    <div class="mb-4">
                        <label for="team_name" class="font-weight-bold">Enter Team Name:</label>
                        <input type="text" class="form-control" id="team_name" name="team_name" required>
                    </div>
                    <div class="mb-4">
                        <label for="ps" class="font-weight-bold">Choose Your Problem Statement:</label>
                        <select name="ps" id="" class="form-control" required>
                            <option value="0" selected disabled>Choose Your Problem Statement</option>
                            <option value="RJH01">RJH01 - Career Path Navigator</option>
                            <option value="RJH02">RJH02 - Event Connect: Bridging Opportunities for Students</option>
                            <option value="RJH03">RJH03 - Healthy Pocket: Smart Budgeting and Nutrition for ...</option>
                            <option value="RJH03">RJH04 - FitLife: Overcoming Mobile Addiction with Exercise...</option>
                            <option value="RJH05">RJH05 - Think Before You Like: Shaping Positive Online Beh...</option>
                            <option value="RJH06">RJH06 - Ensuring Women's Safety in the Modern Era</option>
                            <option value="RJH07">RJH07 - Combatting the Influence of Betting, Trading, and ...</option>
                            <option value="RJH08">RJH08 - Beyond Degrees: Bridging the Gap for Freshers in t...</option>
                            <option value="RJH09">RJH09 - Bridging the Book Gap: A Marketplace for Students</option>
                        </select>
                    </div>

                    <div class="row">
                        <?php for ($i = 1; $i <= $no_of_members; $i++): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card border-secondary">
                                    <div class="card-header bg-secondary text-white">
                                        <h5>Team Member <?= $i ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <label for="name<?= $i ?>" class="font-weight-bold">Name:</label>
                                        <input type="text" class="form-control mb-2" id="name<?= $i ?>" name="name<?= $i ?>" required>

                                        <label for="email<?= $i ?>" class="font-weight-bold">Email:</label>
                                        <input type="email" class="form-control mb-2" id="email<?= $i ?>" name="email<?= $i ?>" required>

                                        <label for="phone<?= $i ?>" class="font-weight-bold">Phone:</label>
                                        <input type="tel" class="form-control mb-2" id="phone<?= $i ?>" name="phone<?= $i ?>" pattern="[0-9]{10}" required>

                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="leader<?= $i ?>" name="team_leader" value="name<?= $i ?>" <?= $i === 1 ? 'checked' : '' ?>>
                                            <label for="leader<?= $i ?>" class="form-check-label">Team Leader</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>