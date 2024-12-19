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

    <div class="container">
        <h1>Team Registration Form</h1>

        <form action="submitRegistration.php" method="POST" enctype="multipart/form-data">
            <div class="container-two">
                <!-- Team Leader Details Section -->
                <div class="direction">

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
                                        <button type="button">Verify</button>
                                    </div>

                                </div>

                                <div>
                                    <input type="tel" id="leaderMobile" name="leaderMobile" required>
                                    <span>Enter mobile number</span>
                                </div>

                            </div>


                        </div>
                    </div>

                    <!-- Team Details Section -->
                    <div class="box">
                        <div class="head-div">
                            <h4 class="head-title">Team Details</h4>
                        </div>
                        <div class="box-body">
                            <div class="inputBox">
                                <input type="text" name="" value="" required>
                                <span>Enter your Team name</span>
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
                                    <div class="prob-btn">
                                        <a href="problemStatements.php"><button type="button">Problems</button></a>
                                    </div>
                                </div>
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
                    <div class="box-body">
                        <div class="inputBox">
                            <input type="text" id="member1" name="memberName" required>
                            <span>Enter member name</span>
                        </div>
                        <div class="inputBox">
                            <input type="tel" id="memberMobile1" name="memberMobile" required>
                            <span>Enter mobile number</span>
                        </div>
                        <div class="inputBox">
                            <input type="email" id="memberEmail1" name="memberEmail" required>
                            <span>Enter email</span>
                            <div class="add-btn">
                                <button type="button">Add Member</button>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>sr no</th>
                                    <th>member name</th>
                                    <th>mobile number</th>
                                    <th>member email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                </tr>
                                <tr>
                                    <th>2</th>
                                </tr>
                                <tr>
                                    <th>3</th>
                                </tr>
                                <tr>
                                    <th>4</th>
                                </tr>
                                <tr>
                                    <th>5</th>
                                </tr>
                            </tbody>
                        </table>
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

                                <img src="https://myonlinevipani.com/wp-content/uploads/2023/05/PhonePe-My-Online-Vipani-large.png" alt="QR Code" class="img-fluid mb-3" style="max-width: 200px;">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ppjTxyf5i0I8sOJ1PHqFCqVbF+3kexW8PaKhycVBKpoM5K2W0S3UCZT60GU4hR9A" crossorigin="anonymous"></script>
</body>

</html>