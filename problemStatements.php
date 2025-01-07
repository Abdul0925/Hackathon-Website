<?php
session_start();
require 'db.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RTH 25 Problem Statements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #fff;
        }

        .table {
            margin-bottom: 0px;
        }

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
        }

        .close-btn-div button {
            background-color: rgb(200, 0, 0);
            color: white;
            width: 60px;
            height: 30px;
            border-radius: 5px;
            border: none;
            padding: 0px;
            margin-top: 20px;
        }

        .close-btn-div button:hover {
            background-color: rgb(150, 0, 0);
            color: white;
        }

        .close-btn-div button:active {
            box-shadow: 2px 2px 5pxrgb(252, 77, 77);
            background-color: rgb(200, 0, 0);
        }

        .report-container {
            border: 1px solid black;
            min-height: 300px;
            max-width: 1200px;
            margin: 80px auto 140px auto;
            background-color: #ffffff;
            border-radius: 30px;
            box-shadow: 3px 3px 10px rgb(188, 188, 188);
            padding: 0px 20px 20px 20px;
        }

        .report-header {
            height: 80px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 20px 10px 20px;
            border-bottom: 2px solid rgba(0, 20, 151, 0.59);
        }

        .recent-Articles {
            font-size: 30px;
            font-weight: 600;
            color: #5500cb;
        }

        .form-body {
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
        }

        .heading-font {
            font-family: "Playwrite GB S", cursive;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .font-style-text {
            font-family: "Oxanium", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .c-black {
            color: black;
        }

        .my-primary-btn {
            width: 100%;
            border-radius: 8px;
        }

        .popup-body p {
            padding: 0px;
            margin: 0px;
        }

        .popup-head h2 {
            color: #5500cb;
            border-bottom: 2px solid rgba(0, 20, 151, 0.59);
            margin-bottom: 10px;
            padding-bottom: 10px;
            padding-left: 0px;
        }

        .popup-head {
            padding: 10px 0px 10px 0px;
        }

        .heading-font {
            font-family: "Playwrite GB S", cursive;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .heading-font1 {
            font-size: 28px;
            font-weight: 400;
            color: #000000;
            padding-top: 10;
            font-family: "Oxanium", sans-serif;
        }

        .font-style-text {
            font-family: "Oxanium", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .c-black {
            color: black;
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

        /* Responsive Text Size */
        @media (max-width: 768px) {
            .image-container {
                width: 75%
            }

            .overlay-text1 {
                font-size: 1.5rem;
                padding: 8px 15px;
            }

            .cover-container>p {
                margin: 50px 15px 50px 15px;
                display: flex;
                justify-content: center;
            }

            .hero-content {
                display: flex;
                justify-content: center
            }

            .hero-content .btn {
                margin-left: 0px;
            }
        }
    </style>
</head>


<body class="font-style-text">

    <nav class="navbar" style="background-color: #5C0F8B;">
        <div class="container-fluid">
            <!-- Left: Logo -->
            <a class="navbar-brand" href="https://ghrstu.edu.in/">
                <img src="./picture/ghrce-logo-white.png" alt="Error Loading" height="" width="100px">
            </a>

            <div class="d-flex">
                <a class="navbar-brand" href="index.php">
                    <img src="./picture/encarta-logo.png" alt="" height="" width="150px">
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
                            echo "</tr>";

                            // Modal for each problem statement
                            echo '
                            <div class="popup" id="' . $row['ps_id'] . '" tabindex="-1">
                                <div class="popup-head">
                                    <h2>Problem Statement Details</h2>
                                </div>
                                <div class="popup-body">
                                    <p><strong>PS ID:</strong> ' . $row['ps_id'] . '</p>
                                    <p><strong>Name:</strong> ' . $row['ps_name'] . '</p>
                                    <p><strong>Organization:</strong> ' . $row['ps_given_by'] . '</p>
                                    <p><strong>Description:</strong> ' . $row['ps_description'] . '</p>
                                    <p><strong>Total Participation:</strong> ' . $row['no_of_participation'] . '</p>
                                    <p><strong>Difficulty Level:</strong> ' . $row['ps_difficulty_level'] . '</p>
                                </div>
                                <div class="close-btn-div">
                                    
                                    <button type="button" data-id="' . $row['ps_id'] . '" onclick="closePopup(this)">Close</button
                        
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
                    <p>✉️ <a href="mailto:encarta@ghrcacs.edu.in">encarta@ghrcacs.edu.in</a></p>
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

    <!-- Font Awesome for Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- For open and close popup  -->
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