<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Registration Form</title>
    <!-- Bootstrap and Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /* .container {
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        } */
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-section {
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
        }

        .btn-verify {
            margin-top: 32px;
        }

        .qr-code img {
            max-width: 200px;
            display: block;
            margin: 10px auto;
        }

        .form-footer {
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar" style="background-color: #5C0F8B;">
        <div class="container-fluid">
            <!-- Left: Logo -->
            <a class="navbar-brand" href="https://ghrstu.edu.in/">
                <img src="./picture/ghrce-logo-white.png" alt="Error Loading" height="" width="100px">
            </a>

            <div class="d-flex">
                <a class="navbar-brand" href="index.php">
                    <img src="./picture/encarta-logo.png" alt="" height="" width="150px">
                    <!-- <img src="uploads\images\671fd3dce42cb1.48550005.png" alt="" height="50px" width="100px"> -->
                </a>
            </div>
        </div>
    </nav>

    <div style="background-color: #5C0F8B;">
        <nav class="navbar navbar-expand-lg " style="background-color: rgb(255, 251, 221); border:0px solid black; border-radius:23px 0px 23px 0px">
            <div class="container-fluid font-style-text">
                <!-- Left: Logo -->
                <a class="navbar-brand" href="index.php">
                    <span class="heading-font">Raisoni Tech Hackathon</span>
                </a>

                <!-- Toggle Button for Mobile View (Right aligned) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Center: Links with Dropdowns and Login/Register Button -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav c-black">
                        <!-- Dropdown: About RTH -->
                        <li class="nav-item dropdown">
                            <a class="nav-link c-black dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About RTH
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                <li><a class="dropdown-item" href="processFlow.php">RTH Process Flow</a></li>
                                <li><a class="dropdown-item" href="themes.php">RTH Themes</a></li>
                                <li><a class="dropdown-item" href="implementationTeam.php">Implementation Team</a></li>
                                <li><a class="dropdown-item" href="pastHackathons.php">Our Past Hackathons</a></li>
                            </ul>
                        </li>

                        <!-- Dropdown: Guidelines -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle c-black" href="#" id="guidelinesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Guidelines
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="guidelinesDropdown">
                                <li><a class="dropdown-item" href="./downloadable/Hackfest Booklet.pdf" target="_blank">For Institutes</a></li>
                                <li><a class="dropdown-item" href="./downloadable/Idea-Presentation-Format-SIH2023-College[1].pptx" target="_blank" rel="noopener noreferrer">Idea PPT</a></li>
                                <li><a class="dropdown-item" href="hackProcess.php">Hackathon Process</a></li>
                                <li><a class="dropdown-item" href="hackTimeline.php">Hackathon Timeline</a></li>
                            </ul>
                        </li>

                        <!-- Other Links -->
                        <li class="nav-item">
                            <a class="nav-link c-black" href="problemStatements.php">Problem Statements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link c-black" href="contactUs.php">Contact Us</a>
                        </li>
                    </ul>

                    <!-- Login/Register Button inside collapsible section -->
                    <div class="d-lg-none mt-2">
                        <!-- Hidden on larger screens, visible on mobile within collapsible area -->
                        <a href="loginPage.php" class="btn my-primary-btn w-100 cmn-button">Login/Register</a>
                    </div>
                </div>

                <!-- Login/Register Button visible only on larger screens -->
                <div class="d-none d-lg-flex">
                    <a href="loginPage.php" class="btn my-primary-btn">Login/Register</a>
                </div>
            </div>
        </nav>

    </div>

    <div class="container my-5">
    <h1 class="text-center mb-4">Team Registration Form</h1>
    <form action="submitRegistration.php" method="POST" enctype="multipart/form-data">

        <!-- Team Details Section -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Team Details</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="teamName" class="form-label">Team Name</label>
                    <input type="text" id="teamName" name="teamName" class="form-control" placeholder="Enter your team name" required>
                </div>
                <div class="mb-3">
                    <label for="psId" class="form-label">Problem Statement</label>
                    <div class="d-flex">
                        <select id="psId" name="psId" class="form-select me-2" required>
                            <option value="" disabled selected>Select Problem Statement</option>
                            <option value="PS1">Problem Statement 1</option>
                            <option value="PS2">Problem Statement 2</option>
                            <option value="PS3">Problem Statement 3</option>
                        </select>
                        <a href="problemStatements.php" target="_blank" class="btn btn-link">View PS Page</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Leader Details Section -->
        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Team Leader Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="leaderName" class="form-label">Team Leader Name</label>
                        <input type="text" id="leaderName" name="leaderName" class="form-control" placeholder="Enter leader's name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="leaderEmail" class="form-label">Team Leader Email</label>
                        <div class="input-group">
                            <input type="email" id="leaderEmail" name="leaderEmail" class="form-control" placeholder="Enter leader's email" required>
                            <button type="button" class="btn btn-outline-success">Verify</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div>

                        <label for="leaderMobile" class="form-label">Team Leader Mobile No</label>
                        <input type="tel" id="leaderMobile" name="leaderMobile" class="form-control" placeholder="Enter mobile number" required>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Mentor Details Section -->
        <div class="card shadow mb-4">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Mentor Details (Optional)</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="mentorName" class="form-label">Mentor Name</label>
                    <input type="text" id="mentorName" name="mentorName" class="form-control" placeholder="Enter mentor name">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="mentorMobile" class="form-label">Mobile No</label>
                        <input type="tel" id="mentorMobile" name="mentorMobile" class="form-control" placeholder="Enter mobile number">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mentorEmail" class="form-label">Email</label>
                        <input type="email" id="mentorEmail" name="mentorEmail" class="form-control" placeholder="Enter email">
                    </div>
                </div>
            </div>
        </div>

        <!-- Member Details Section -->
        <div class="card shadow mb-4">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Member Details</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="member1" class="form-label">Member Name</label>
                        <input type="text" id="member1" name="memberName" class="form-control" placeholder="Enter member name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="memberMobile1" class="form-label">Mobile No</label>
                        <input type="tel" id="memberMobile1" name="memberMobile" class="form-control" placeholder="Enter mobile number" required>
                    </div>
                    <div class="col-md-4">
                        <label for="memberEmail1" class="form-label">Email</label>
                        <input type="email" id="memberEmail1" name="memberEmail" class="form-control" placeholder="Enter email" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Details Section -->
        <div class="card shadow mb-4">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Payment Details</h4>
            </div>
            <div class="card-body text-center">
                <img src="https://myonlinevipani.com/wp-content/uploads/2023/05/PhonePe-My-Online-Vipani-large.png" alt="QR Code" class="img-fluid mb-3" style="max-width: 200px;">
                <p>Scan the QR code to make the payment.</p>
                <div class="mb-3">
                    <label for="transactionId" class="form-label">Transaction ID</label>
                    <input type="text" id="transactionId" name="transactionId" class="form-control" placeholder="Enter transaction ID" required>
                </div>
                <div class="mb-3">
                    <label for="paymentScreenshot" class="form-label">Upload Payment Screenshot</label>
                    <input type="file" id="paymentScreenshot" name="paymentScreenshot" class="form-control" accept="image/*" required>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-success px-4">Register</button>
        </div>
    </form>
</div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ppjTxyf5i0I8sOJ1PHqFCqVbF+3kexW8PaKhycVBKpoM5K2W0S3UCZT60GU4hR9A" crossorigin="anonymous"></script>
</body>

</html>