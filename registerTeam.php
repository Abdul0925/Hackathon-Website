<?php

session_start();
if (!isset($_SESSION['members'])) {
    $_SESSION['members'] = [];
}
$_SESSION['isVerified'] = false;
// $_SESSION['members'] = [];
// echo $_SESSION['isVerified'];
?>


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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/components/alerts/" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }

        .heading-font {
            font-family: "Playwrite GB S", cursive;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

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

        .container {
            max-width: 70%;
            margin: 10px auto;
            background: #ffffff;
            padding: 30px;
            /* border-radius: 15px; */
            /* border-bottom: 8px;
            border-right: 8px; */
            /* border-style: solid; */
            /* background-color: #5C0F8B; */
        }


        .box-body .inputBox {
            position: relative;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .box-body .inputBox input,
        .box-body .inputBox textarea {
            width: 100%;
            padding: 5px 0;
            font-size: 16px;
            margin: 10px 0;
            border: none;
            border-bottom: 2px solid #333;
            outline: none;
            resize: none;
        }

        .box-body .inputBox span {
            position: absolute;
            Left: 0;
            padding: 5px 0;
            font-size: 16px;
            margin: 10px 0;
            pointer-events: none;
            transition: 0.5s;
            color: #948686;
        }

        .box-body .inputBox input:focus~span,
        .box-body .inputBox input:valid~span,
        .box-body .inputBox textarea:focus~span,
        .box-body .inputBox textarea:valid~span {
            color: #5C0F8B;
            font-size: 12px;
            transform: translateY(-20px);
        }




        .container-two {
            border-radius: 15px;
            /* border-bottom: 8px;
            border-right: 8px; */
            border-style: solid;
            /* border-color: rgb(193, 124, 235); */
            padding: 4px 5px 0px 5px;
            margin-bottom: 30px;
            /* background-color: #5C0F8B; */
        }

        .boxF {
            border-radius: 15px;
            border-style: solid;
            /* border-color: rgb(193, 124, 235); */
            margin-bottom: 15px;
            margin-top: 15px;
            background-color: #ffffff;
            /* padding: 15px 0px 15px 0px; */
            /* border-bottom: 8px; */
            /* border-right: 8px; */
            /* border-top: 5px; */
        }

        .box {
            border-radius: 15px;
            border-style: solid;
            /* border-color: rgb(193, 124, 235); */
            margin-bottom: 15px;
            background-color: #ffffff;
            /* padding: 15px 0px 15px 0px; */
            /* border-bottom: 8px; */
            /* border-right: 8px; */
            /* border-top: 5px; */
        }

        .boxL {
            border-radius: 15px;
            border-style: solid;
            /* border-color: rgb(193, 124, 235); */
            margin-bottom: 15px;
            background-color: #ffffff;
            /* padding: 15px 0px 15px 0px; */
            /* border-bottom: 8px; */
            /* border-right: 8px; */
            /* border-top: 5px; */
        }

        .head-title {
            border-bottom: solid rgb(0, 0, 0);
            padding: 13px 13px 13px 20px;
            color: rgb(255, 255, 255);

        }

        .head-div {
            /* border: black; */
            border-radius: 10px 10px 0px 0px;
            background-color: #5C0F8B;
        }

        .box-body {
            padding: 0px 20px 0px 20px;
        }

        .boxL .box-body {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }

        /* .payment-box {
            margin-left: 20px;
        } */

        .QR-code {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .verify-btn-div {
            display: flex;
            flex-direction: row;
        }

        /* .direction{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        } */

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            /* color: #ffffff; */
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


        .form-footer {
            text-align: center;
        }

        .verify-btn button {
            color: white;
            width: 80px;
            margin-top: 6px;
            height: 40px;
            background-color: rgb(47, 141, 70);
            border-radius: 5px 5px 5px 0px;
            border: none;
        }

        .verify-btn button:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .verify-btn button:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
            /* color: white; */
        }

        .prob-btn button {
            color: white;
            width: 80px;
            /* margin-top: 5px; */
            height: 40px;
            background-color: rgb(47, 141, 70);
            border-radius: 5px;
            border: none;
        }

        .prob-btn button:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .prob-btn button:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
            /* color: white; */
        }

        .add-btn button {
            color: white;
            width: 120px;
            margin: 5px 0px 5px 0px;
            height: 40px;
            background-color: rgb(47, 141, 70);
            border-radius: 5px;
            border: none;
        }

        .add-btn button:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .add-btn button:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
            /* color: white; */
        }

        .register-btn {
            color: white;
            width: 50%;
            height: 50px;
            background-color: rgb(47, 141, 70);
            border-radius: 5px;
            border: none;
        }

        .register-btn:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .register-btn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
            /* color: white; */
        }

        /* Modal Overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent black */
            z-index: 999;
            /* Ensures overlay is above all other elements */
            display: none;
            /* Initially hidden */
        }

        /* Modal Window */
        .modal {
            position: fixed;
            top: 50%;
            left: 50%;
            height: 30%;
            transform: translate(-50%, -50%);
            /* Center the modal */
            background-color: #fff;
            /* White background */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            z-index: 1000;
            /* Above the overlay */
            width: 90%;
            /* Responsive width */
            max-width: 400px;
            /* Max width for desktop */
            padding: 20px;
            /* Inner padding */
            text-align: center;
            /* Center the text */
            font-family: Arial, sans-serif;
            /* Font style */
        }

        /* Modal Header */
        .modal h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #333;
            /* Darker text color */
        }

        /* Modal Input */
        .modal input[type="text"] {
            width: 100%;
            /* Full width */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            /* Light gray border */
            border-radius: 4px;
            /* Rounded corners */
            font-size: 1rem;
            box-sizing: border-box;
            /* Ensures padding doesn't affect width */
        }

        /* Modal Buttons */
        .modal button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            /* Smooth transition */
        }

        .modal button[type="button"]:first-of-type {
            background-color: #4CAF50;
            /* Green */
            color: white;
        }

        .modal button[type="button"]:first-of-type:hover {
            background-color: #45a049;
            /* Darker green on hover */
        }

        .modal button[type="button"]:last-of-type {
            background-color: #f44336;
            /* Red */
            color: white;
        }

        .modal button[type="button"]:last-of-type:hover {
            background-color: #d32f2f;
            /* Darker red on hover */
        }

        @media screen and (max-width: 400px) {
            .boxL .box-body {
                display: flex;
                flex-direction: column;
            }

            .container {
                max-width: 100%;
                margin: 0px auto;
                border-radius: 0px;
                border: none;
                padding: 20px 0px 30px 0px;
            }

            .container-two {
                border-style: none;
            }
        }

        @media screen and (max-width: 600px) {
            .boxL .box-body {
                display: flex;
                flex-direction: column;
            }

            .container {
                max-width: 100%;
                margin: 0px auto;
                border-radius: 0px;
                border: none;
                padding: 20px 0px 30px 0px;
            }

            .container-two {
                border-style: none;
            }
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
                        <a href="loginPage.php" class="btn my-primary-btn w-100 cmn-button">Login</a>
                    </div>
                </div>

                <!-- Login/Register Button visible only on larger screens -->
                <div class="d-none d-lg-flex">
                    <a href="loginPage.php" class="btn my-primary-btn">Login</a>
                </div>
            </div>
        </nav>

    </div>

    <div class="container">
        <h1>Team Registration Form</h1>

        <!-- <form action="submitRegistration.php" method="POST" enctype="multipart/form-data"> -->
        <!-- <form method="POST" action="register_form_process.php" id="mainForm"> -->
        <form id="mainForm">
            <div class="container-two">
                <!-- Team Leader Details Section -->
                <div class="direction">
                    <!-- Team Details Section -->
                    <div class="box">
                        <div class="head-div">
                            <h4 class="head-title">Team Details</h4>
                        </div>
                        <div class="box-body">
                            <div class="inputBox">
                                <input type="text" id="teamName" name="teamName" required>
                                <span>Enter your Team name</span>
                            </div>
                            <div class="mb-3">
                                <label for="psId" class="form-label">Problem Statement</label>
                                <div class="d-flex">
                                    <select id="psId" name="psId" class="form-select me-2" required>
                                        <option value="" disabled selected>Select Problem Statement</option>
                                        <option value="rth01">RTH01</option>
                                        <option value="rth02">RTH02</option>
                                        <option value="rth03">RTH03</option>
                                    </select>
                                    <div class="prob-btn">
                                        <a href="problemStatements.php"><button type="button">Problems</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="boxF">
                    <div class="head-div">
                        <h4 class="head-title">Team Leader Details</h4>
                    </div>
                    <div class="box-body">

                        <div class="inputBox">
                            <input type="text" id="leaderName" name="leaderName" required>
                            <span>Enter leader's name</span>

                            <div class="verify-btn-div">

                                <input type="email" id="leaderEmail" name="leaderEmail" required>
                                <span>Enter leader's email</span>
                                <div class="verify-btn">
                                    <button
                                        type="button"
                                        onclick="openOtpModal()"
                                        id="verify-otp">
                                        Verify
                                    </button>

                                </div>
                                <!-- <span id="verification-status" style="color: green; display: none;">Verified</span> -->
                            </div>

                            <div>
                                <input type="tel" id="leaderMobile" name="leaderMobile" required>
                                <span>Enter mobile number</span>
                            </div>

                            <div>
                                <label for="leaderGender" class="form-label">Leader Gender: </label>
                                <select class="form-select me-2" name="leaderGender" id="leaderGender">
                                    <option value="" selected disabled>Choose Only One Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                        </div>


                    </div>
                </div>




                <!-- Mentor Details Section -->
                <div class="box">
                    <div class="head-div">
                        <h4 class="head-title">Mentor Details (Optional)</h4>
                    </div>
                    <div class="box-body">
                        <div class="inputBox">
                            <input type="text" id="mentorName" name="mentorName" placeholder="(Optional)">
                            <span>Enter mentor name</span>
                        </div>
                        <div class="inputBox">
                            <div class="">
                                <input type="tel" id="mentorMobile" name="mentorMobile" placeholder="(Optional)">
                                <span>Enter mobile number</span>
                            </div>
                            <div class="">
                                <input type="email" id="mentorEmail" name="mentorEmail" placeholder="(Optional)">
                                <span>Enter email</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member Details Section -->
                <div class="box">
                    <div class="head-div">
                        <h4 class="head-title">Member Details</h4>
                    </div>
                    <div class="box-body" id="add_member_form">
                        <div class="inputBox">
                            <input type="text" id="memberName" name="memberName">
                            <span>Enter member name</span>
                        </div>
                        <div class="inputBox">
                            <input type="tel" id="memberMobile" name="memberMobile">
                            <span>Enter mobile number</span>
                        </div>
                        <div class="inputBox">
                            <input type="email" id="memberEmail" name="memberEmail">
                            <span>Enter email</span>
                        </div>
                        <div class="inputBox">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="add-btn">
                            <button type="button" name="add_member" onclick="submitAddMemberForm()">Add Member</button>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Gender</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['members'] as $index => $member): ?>
                                    <tr data-id="<?php echo $index; ?>">
                                        <td><?php echo $member['name']; ?></td>
                                        <td><?php echo $member['email']; ?></td>
                                        <td><?php echo $member['mobile']; ?></td>
                                        <td><?php echo $member['gender']; ?></td>
                                        <td>
                                            <button type="button" onclick="openEditModal(<?php echo $index; ?>)">Edit</button>
                                            <button type="button" onclick="deleteMember(<?php echo $index; ?>)">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- <div id="member-list"></div>  -->
                    </div>
                </div>

                <!-- Payment Details Section -->
                <div class="boxL">
                    <div class="head-div">
                        <h4 class="head-title">Payment Details</h4>
                    </div>
                    <div class="box-body">
                        <div class="inputBox">
                            <div class="QR-code">

                                <img src="./picture//payment.jpg" alt="QR Code" class="img-fluid mb-3" style="max-width: 200px;">
                                <p>Scan the QR code to make the payment.</p>
                            </div>
                            <div class="payment-box">

                                <div class="">
                                    <label for="transactionId" class="form-label">Transaction ID</label>
                                    <input type="text" id="transactionId" name="transactionId" required>
                                    <span>Enter transaction ID</span>
                                </div>
                                <div class="mb-3">
                                    <label for="paymentScreenshot" class="form-label">Upload Payment Screenshot</label>
                                    <input type="file" id="paymentScreenshot" name="paymentScreenshot" class="form-control" accept="image/*" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="register-btn">Register</button>
            </div>
        </form>
    </div>
    <?php //foreach ($_SESSION['members'] as $index => $member): 
    ?>
    <!-- <tr>
            <td><?php //echo $member['name']; 
                ?></td>
            <td><?php //echo $member['email']; 
                ?></td>
            <td><?php //echo $member['mobile']; 
                ?></td>
            <td><?php //echo $member['gender']; 
                ?></td>
            <td> -->
    <!-- <form method="POST" style="display: inline;">
                            <input type="hidden" name="index" value="<?php //echo $index; 
                                                                        ?>">
                            <button type="button" onclick="openEditModal(<?php //echo $index; 
                                                                            ?>)">Edit</button>
                        </form> -->
    <!-- <button type="button" onclick="openEditModal(<?php //echo $index; 
                                                        ?>)">Edit</button>
                <button type="button" onclick="deleteMember(<?php //echo $index; 
                                                            ?>)">Delete</button>
            </td>
        </tr> -->
    <?php //endforeach; 
    ?>

    <!-- OTP Modal -->
    <div class="modal-overlay" id="modal-overlay" style="display: none;"></div>
    <div class="modal" id="otp-modal" style="display: none;">
        <div>
            <h2>Enter OTP</h2>
            <input type="text" id="otp-input" placeholder="Enter OTP">
            <button type="button" onclick="verifyOtp()">Submit</button>
            <button type="button" onclick="closeOtpModal()">Cancel</button>
        </div>
    </div>

    <!-- Modal for editing members -->
    <div class="modal-overlay" id="modal-overlay"></div>
    <div class="modal" id="edit-modal">
        <form id="edit-member-form">
            <input type="hidden" id="edit-index" name="index">
            <label for="edit-name">Name:</label>
            <input type="text" id="edit-name" name="name" required>

            <label for="edit-email">Email:</label>
            <input type="email" id="edit-email" name="email" required>

            <label for="edit-mobile">Mobile:</label>
            <input type="text" id="edit-mobile" name="mobile" required>

            <label for="edit-gender">Gender:</label>
            <select id="edit-gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <button type="submit" name="edit_member">Save</button>
            <button type="button" onclick="closeEditModal()">Cancel</button>
        </form>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ppjTxyf5i0I8sOJ1PHqFCqVbF+3kexW8PaKhycVBKpoM5K2W0S3UCZT60GU4hR9A" crossorigin="anonymous"></script>

    <script>
        const members = [];

        function getMemberDetails(index) {
            const member = members[index];
            console.log(member);
            return member;
        }

        function openOtpModal() {
            const email = document.getElementById('leaderEmail').value;

            if (!email) {
                alert('Please enter an email before verifying.');
                return;
            }

            const otp = Math.floor(100000 + Math.random() * 900000);

            fetch('send_otp.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `email=${encodeURIComponent(email)}&otp=${otp}`
                })
                .then(response => response.json())
                .then(result => {
                    // console.log(result);
                    if (result.success) {
                        alert(result.message + result.email);
                    } else {
                        alert(result.message);
                        document.getElementById('modal-overlay').style.display = 'none';
                        document.getElementById('otp-modal').style.display = 'none';
                    }
                })
                .catch(error => console.error('Error:', error));

            // Show modal
            document.getElementById('modal-overlay').style.display = 'block';
            document.getElementById('otp-modal').style.display = 'block';

            // Here you can send an OTP to the email entered by the user via an AJAX call to your server
            // sessionStorage.setItem('otp', otp);
            // console.log(`OTP sent to ${email}`);
        }

        function closeOtpModal() {
            // Hide modal
            document.getElementById('modal-overlay').style.display = 'none';
            document.getElementById('otp-modal').style.display = 'none';
        }

        function verifyOtp() {
            const enteredOtp = document.getElementById('otp-input').value;

            // Send entered OTP to server for verification
            fetch('verify_otp.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `otp=${enteredOtp}`,
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        // Hide modal and show verification status
                        // closeOtpModal();
                        // // const status = document.getElementById('verification-status');
                        // const verifyOtp = document.getElementById('verify-otp');
                        // // status.style.display = 'inline';
                        // // status.textContent = 'Verified';
                        // verifyOtp.disabled = true;
                        // alert('Account Verified');
                        closeOtpModal();
                        const verifyOtp = document.getElementById('verify-otp');
                        verifyOtp.disabled = true;
                        verifyOtp.textContent = "Verified"; // Update button text
                        alert('Account Verified');
                    } else {
                        alert('Incorrect OTP. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function openEditModal(index) {
            console.log(index)
            const modal = document.getElementById('edit-modal');
            const overlay = document.getElementById('modal-overlay');

            const member = (getMemberDetails(index)) ? getMemberDetails(index) : <?php echo json_encode($_SESSION['members']); ?>[index];
            console.log(member);
            document.getElementById('edit-index').value = index;
            document.getElementById('edit-name').value = member.name;
            document.getElementById('edit-email').value = member.email;
            document.getElementById('edit-mobile').value = member.mobile;
            document.getElementById('edit-gender').value = member.gender;
            modal.style.display = 'block';
            overlay.style.display = 'block';
            modal.classList.add('active');
            overlay.classList.add('active');
        }

        document.getElementById('edit-member-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission (page reload)

            const formData = new FormData(this); // Create a FormData object

            fetch('register_edit_member.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) // Parse JSON response
                .then(result => {
                    if (result.success) {
                        alert('Member updated successfully!');
                        closeEditModal();
                        // Optionally refresh the UI to reflect changes
                        // location.reload(); // Uncomment to reload page
                        // Update the UI dynamically without refreshing
                        const index = formData.get('index');
                        console.log(index);
                        const row = document.querySelector(`tr[data-id="${index}"]`);
                        console.log(row);
                        if (row) {
                            row.children[0].textContent = result.name;
                            row.children[1].textContent = formData.get('email');
                            row.children[2].textContent = formData.get('mobile');
                            row.children[3].textContent = formData.get('gender');
                        }
                    } else {
                        alert('Failed to update member: ' + result.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        });


        function closeEditModal() {
            const modal = document.getElementById('edit-modal');
            const overlay = document.getElementById('modal-overlay');
            modal.classList.remove('active');
            overlay.classList.remove('active');
            modal.style.display = 'none';
            overlay.style.display = 'none';
        }

        function submitAddMemberForm() {
            // const form = document.getElementById('mainForm');
            // form.action = 'register_add_member.php';
            // form.submit();
            const name = document.getElementById('memberName').value;
            const mobile = document.getElementById('memberMobile').value;
            const email = document.getElementById('memberEmail').value;
            const gender = document.getElementById('gender').value;

            // Validate inputs (optional)
            if (!name || !mobile || !email) {
                alert("All fields are required.");
                return;
            }

            // Prepare data to send
            const data = new FormData();
            data.append('name', name);
            data.append('mobile', mobile);
            data.append('email', email);
            data.append('gender', gender);
            console.log(data);
            fetch('register_add_member.php', {
                    method: 'POST',
                    body: data,
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        members.push(result.member);
                        // Dynamically append the new member row to the table

                        const tableBody = document.querySelector('.table tbody');
                        const newRow = document.createElement('tr');
                        newRow.setAttribute('data-id', result.member.id || members.length - 1);
                        newRow.innerHTML = `
                        <td>${result.member.name}</td>
                            <td>${result.member.email}</td>
                            <td>${result.member.mobile}</td>
                            <td>${result.member.gender || '-'}</td>
                            <td>
                                <button type="button" onclick="openEditModal(${result.index})">Edit</button>
                                <button type="button" onclick="deleteMember(${result.index})">Delete</button>
                            </td>
                        `;
                        tableBody.appendChild(newRow);
                        // Append member to the list dynamically
                        // const memberList = document.getElementById('member-list');
                        // const memberDiv = document.createElement('div');
                        // memberDiv.textContent = `Name: ${result.member.name}, Mobile: ${result.member.mobile}, Email: ${result.member.email}`;
                        // memberList.appendChild(memberDiv);

                        // Clear input fields
                        document.getElementById('memberName').value = '';
                        document.getElementById('memberMobile').value = '';
                        document.getElementById('memberEmail').value = '';
                    } else {
                        alert(result.error || "Failed to add member.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function deleteMember(index) {
            console.log(index);
            if (confirm("Are you sure you want to delete this member?")) {
                // Use AJAX to send the deletion request to the server
                fetch('register_delete_member.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `index=${index}&delete_member=true`
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            // console.log(result);

                            console.log('Member deleted successfully.');
                            const table = document.querySelector('.table tbody');
                            const row = table.rows[index]; // Get the corresponding row by index
                            if (row) {
                                row.remove();
                            }
                            // Optionally refresh the member list or remove the deleted row
                            // location.reload(); // Reload the page to update the list
                        } else {
                            console.error('Error:', result.error);
                            alert('Failed to delete member: ' + (result.error || 'Unknown error.'));
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        document.getElementById('mainForm').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log("test1");
            const registerBtn = document.querySelector('.register-btn');
            registerBtn.disabled = true;
            // Get the form data or the necessary values to send
            const formData = new FormData();
            console.log("test2");
            formData.append('teamName', document.getElementById('teamName').value);
            console.log("test3");
            formData.append('psId', document.getElementById('psId').value);
            console.log("test4");
            console.log(formData);
            console.log("test5");

            formData.append('leaderName', document.getElementById('leaderName').value);
            formData.append('leaderEmail', document.getElementById('leaderEmail').value);
            formData.append('leaderMobile', document.getElementById('leaderMobile').value);
            formData.append('leaderGender', document.getElementById('leaderGender').value);

            console.log("test6");
            formData.append('transactionId', document.getElementById('transactionId').value);
            formData.append('paymentScreenshot', document.getElementById('paymentScreenshot').files[0]); // Assuming this is a file input

            console.log("test7");
            // Get the members from the session (assuming they're in a variable already)
            const members = (getMemberDetails()) ? getMemberDetails() : <?php echo json_encode($_SESSION['members']); ?>;
            console.log("test8");
            console.log(members);
            console.log("test9");
            formData.append('members', members); // Send members as a JSON string
            console.log("test10");
            // Send the data using fetch
            fetch('register_form_process.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert(result.message); // You can log the data received for debugging
                        alert("You will receive your login credentials via email. If you do not receive an email regarding your submission, please contact the hackathon volunteers.")
                        window.location.href = "loginPage.php";
                    } else {
                        // alert('Failed to submit form: ' + result.message);
                        alert(result.name + ' is ' + result.message); // You can show a success message
                        registerBtn.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>


</body>

</html>