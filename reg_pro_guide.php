<?php

session_start();
require 'db.php';
if (!isset($_SESSION['members'])) {
    $_SESSION['members'] = [];
}
$_SESSION['isVerified'] = false;
$_SESSION['leaderGender'] = '';
$_SESSION['maleCount'] = 0;

$_SESSION['members'] = [];
// print_r($_SESSION['members']);
// echo $_SESSION['isVerified'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTH 25 Team Registration Form</title>
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
            font-family: "Oxanium", sans-serif;
            background-color: #ffffff;
        }

        .c-black {
            color: black;
        }

        .heading-font {
            font-family: "Playwrite GB S", cursive;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

.container{
    padding: 10px;
}

        .alert-heading {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .alert ul {
        margin-top: 10px;
    }

    .alert ul li {
        margin-bottom: 5px;
    }

    .alert p.mb-0 {
        margin-top: 10px;
        font-weight: bold;
    }
    /* Footer Section */
    footer {
            background: #333;
            color: #ffffff;
            padding: 40px 20px;
            text-align: center;
        }

        footer p {
            font-size: 0.9rem;
        }

        .footer {
            background-color: #501987;
            color: #ffffff;
            padding: 40px 20px;
            font-family: Arial, sans-serif;
        }

        .footer h3 {
            font-size: 1.1rem;
            color: #A48FB6;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer a:hover {
            color: #f44f36;
        }

        .social-icons a {
            font-size: 1.5rem;
            margin: 0 10px;
            color: #ffffff;
        }

        .social-icons a:hover {
            color: #f44f36;
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
                <img src="./picture/ghru-nagpur.webp" alt="Error Loading" height="" width="100px">
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
                        <!-- Dropdown: About Us -->
                        <li class="nav-item dropdown">
                            <a class="nav-link c-black dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About Us
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                <li><a class="dropdown-item" href="processFlow.php">RTH Process Flow</a></li>
                                <li><a class="dropdown-item" href="pastHackathons.php">Our Past Hackathons</a></li>
                                <li><a class="dropdown-item" href="aboutEncarta.php">About Encarta</a></li>
                                <li><a class="dropdown-item" href="aboutCreators.php">About Creators</a></li>
                            </ul>
                        </li>

                        <!-- Dropdown: Guidelines -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle c-black" href="#" id="guidelinesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Guidelines
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="guidelinesDropdown">
                                <li><a class="dropdown-item" href="reg_pro_guide.php">Registration Process</a></li>
                                <li><a class="dropdown-item" href="./downloadable/Idea-Presentation-Format-SIH2023-College[1].pptx" target="_blank" rel="noopener noreferrer">Idea PPT</a></li>
                                <li><a class="dropdown-item" href="./downloadable/Hackfest Booklet.pdf" target="_blank" href="hackProcess.php">Hackathon Process</a></li>
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
    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Instructions for Filling the Form</h4>
        <p>Please follow the instructions below to complete the registration form:</p>
        <ul>
            <li>Ensure all fields are filled out accurately and completely.</li>
            <li>Enter a valid <strong>Team Name</strong> consisting of alphabets, numbers, underscores, and hyphens only.</li>
            <li>Provide a valid <strong>Problem Statement ID</strong> (PS ID).</li>
            <li>Enter the <strong> Name</strong> using alphabets only.</li>
            <li>Provide a valid <strong> Email</strong> address.</li>
            <li>Enter a valid <strong> Mobile Number</strong> starting with 6, 7, 8, or 9 and consisting of 10 digits.</li>
            <li>Select the <strong> Gender</strong> from the dropdown menu. Make sure you have atleast <strong>1 female member</strong></li>
            <li>Provide a valid <strong>Transaction ID</strong> for the payment.</li>
            <li>Upload a clear <strong>Payment Screenshot</strong> in the specified format.</li>
            <li>Ensure that all <strong>Team Members' Details</strong> are accurate and complete.</li>
        </ul>
        <p class="mb-0">Note: Providing incorrect information such as wrong name, email, mobile number, gender, transaction ID, or payment screenshot will result in elimination from the hackathon.</p>
    </div>
</div>
<div class="container">
    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Eligibility Criteria</h4>
        <p>Please ensure you meet the following eligibility criteria for this hackathon:</p>
        <ul>
            <li>Teams can have a maximum of 4 members.</li>
            <li>This hackathon is open to all students.</li>
            <li>All participants must be currently enrolled in an educational institution.</li>
            <li>Intercollege teams are allowed and encouraged.</li>
            <li>You can include members from different colleges.</li>
            <li>Each team must have at least one female member.</li>
        </ul>
        <p class="mb-0">Note: Providing incorrect information will result in disqualification from the hackathon.</p>
    </div>
</div>

<!-- Footer  -->
<footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Logo and University Name -->
                <div class="col-md-3 text-center text-md-start mb-4 mt-5">
                    <a class="navbar-brand" href="https://ghrstu.edu.in/">
                        <img src="./picture/ghru-nagpur.webp" alt="University Logo" style="width: 270px;">
                    </a>
                </div>

                <!-- Important Links -->
                <div class="col-md-3 mb-4 text-md-start" style="text-align: left;">
                    <h3>IMPORTANT LINKS</h3>
                    <ul class="list-unstyled p-2">
                        <li class="mt-2"><a href="https://ghrcacsn.raisoni.net/events">Events</a></li>
                        <li class="mt-2"><a href="https://ghrcacsn.raisoni.net/about-institute">About Institute</a></li>
                        <li class="mt-2"><a href="https://ghrcacsn.raisoni.net/student-speak">Sutdent Speak</a></li>
                        <li class="mt-2"><a href="https://ghrcacsn.raisoni.net/alumni-events">Alumini Events</a></li>
                        <li class="mt-2"><a href="https://ghrcacsn.raisoni.net/iqac">IQAC</a></li>
                    </ul>
                </div>

                <!-- Portals -->
                <div class="col-md-3 mb-4 text-md-start" style="text-align: left;">
                    <h3>PORTALS</h3>
                    <ul class="list-unstyled p-2">
                        <li class="mt-2"><a href="https://alumni.raisoni.net/">Alumni Portal</a></li>
                        <li class="mt-2"><a href="https://www.rashtriyachhatrasansad.in/">NSP</a></li>
                        <li class="mt-2"><a href="http://nationalagricultureconclave.com/">NAC</a></li>
                        <li class="mt-2"><a href="https://sgrkf.com/">SGRKF</a></li>
                        <li class="mt-2"><a href="http://ghrscf.com/">GHRTSCF</a></li>
                    </ul>
                </div>

                <!-- Contact Information -->
                <div class="col-md-3 mb-4 text-md-start" style="text-align: left;">
                    <h3>GHRCACS NAGPUR</h3>
                    <p>Riaan Tower, Mangalwari Bazar Rd, Sadar, Nagpur, Maharashtra 440001</p>
                    <p>📞 8275435110 / 9307900682</p>
                    <p>✉️ <a href="mailto:encarta@ghrstu.edu.in">encarta@ghrstu.edu.in</a></p>
                </div>
            </div>

            <!-- Social Media and Legal Links -->
            <div class="row text-center mt-2">
                <div class="col-12 social-icons">
                    <a href="https://www.facebook.com/raisoniworld" class="me-2"><i class="bi-facebook"></i></a>
                    <a href="https://instagram.com/raisoniworld" class="me-2"><i class="bi-instagram"></i></a>
                    <a href="https://twitter.com/raisoniworld" class="me-2"><i class="bi-twitter"></i></a>
                    <a href="https://www.linkedin.com/school/raisoniworld" class="me-2"><i class="bi-linkedin"></i></a>
                    <a href="http://youtube.com/raisoniworld" class="me-2"><i class="bi-youtube"></i></a>
                </div>
                <div class="col-12 mt-3">
                    <p>
                        <a href="https://raisoni.net/document/privacy_policy.html">Privacy Policy</a> |
                        <a href="https://raisoni.net/document/terms_and_conditions.html">Terms & Conditions</a> |
                        <a href="https://raisoni.net/document/refund_and_cancellation.html">Refund & Cancellation</a>
                    </p>
                    <p class="mt-2">© 2024 All Rights Reserved. Design & Developed by Encarta IT Cell's Advisor.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ppjTxyf5i0I8sOJ1PHqFCqVbF+3kexW8PaKhycVBKpoM5K2W0S3UCZT60GU4hR9A" crossorigin="anonymous"></script>
    

</body>

</html>