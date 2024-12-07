<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Us</title>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">
        <style>

            .contact1
            {
            position: relative;
            min-height: 100vh;
            padding: 50px 100px;
            display: flex;
            justify-content: center;
            align-items: center; flex-direction: column;
            background-color: rgb(254, 254, 254) ;
            background-size: cover;
            }

            .contact1 .content1
            {
            max-width: 800px;
            text-align: center;
            } 

            .container1
            {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            }

            .container1 .contactInfo
            {
            width: 50%;
            display: flex;
            flex-direction: column;
            }

            .container1 .contactInfo .box
            {
            position: relative;
            padding: 20px 0;
            display: flex;
            }

            .container1 .contactInfo .box .icon
            {
            min-width: 60px;
            height: 60px;
            background: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 22px;
            }

            .container1 .contactInfo .box .text
            {
            display: flex;
            margin-left: 20px;
            font-size: 16px;
            color: #000000;
            flex-direction: column;
            font-weight: 300;
            }

            .container1 .contactInfo .box .text h3
            {
            font-weight: 500;
            color: black;
            }

            .container1 .contactInfo .box .text p
            {
            color: #000000;
            font-weight: 350;
            }

            .contactForm
            {
            width: 40%;
            padding: 40px;
            background: #ffffff;
            border: black;
            border-radius: 15px;
            border-bottom: 10px;
            border-right: 10px;
            border-style: solid;
            }

            .contactForm h2
            {
            font-size: 30px;
            color: #333;
            font-weight: 500;
            }

            .contactForm .inputBox
            {
            position: relative;
            width: 100%;
            margin-top: 10px;
            }

            .contactForm .inputBox input,
            .contactForm .inputBox textarea
            {
            width: 100%;
            padding: 5px 0;
            font-size: 16px;
            margin: 10px 0;
            border: none;
            border-bottom: 2px solid #333;
            outline: none;
            resize: none;
            }

            .contactForm .inputBox span
            {
            position: absolute;
            Left: 0;
            padding: 5px 0;
            font-size: 16px;
            margin: 10px 0;
            pointer-events: none;
            transition: 0.5s;
            color: #948686;
            }

            .contactForm .inputBox input:focus ~ span,
            .contactForm .inputBox input:valid ~ span,
            .contactForm .inputBox textarea:focus ~ span,
            .contactForm .inputBox textarea:valid ~ span
            {
            color: #5C0F8B;
            font-size: 12px;
            transform: translateY(-20px);
            }

            .contactForm .inputBox input[type="submit"]
            {
            width: 100px;
            background: #6f42c1;
            color: #ffffff;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: 18px;
            }

            @media (max-width: 991px)
            {
            .contact1
            {
            padding: 50px;
            }

            .container1
            {
            flex-direction: column;
            }

            .container1 .contactInfo
            {
            margin-bottom: 40px;
            }

            .container1.contactInfo,
            .contactForm
            {
            width: 100%;
            } 

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
                    <img src="https://ghrstu.edu.in/assets/images/ghru-nagpur.png" alt="" height="" width="100px">
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
                        <span class="heading-font">Raisoni Junior Hackfest</span>
                    </a>

                    <a>
                        <span class="heading-font1">Contact Us</span>
                    </a>

                    <!-- Login/Register Button visible only on larger screens -->
                    <div class="d-none d-lg-flex">
                        <a href="loginPage.php" class="btn my-primary-btn">Login/Register</a>
                    </div>
                </div>
            </nav>
        </div>
        
        <section class="contact1">
                <div class="content1">
                    <!-- <h2>Contact Us</h2> -->
                </div>
                <div class="container1">
                    <div class="contactInfo">
                        <div class="box">
                            <div class="icon"><i class="bi-geo-alt-fill"></i></div>
                            <div class="text">
                                <h3>Address</h3>
                                <p>Riaan Tower, Mangalwari Bazar Rd, <br>Sadar, Nagpur, Maharashtra <br>440001</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="icon"><i class="bi-telephone-fill"></i></div>
                            <div class="text">
                                <h3>Phone</h3>
                                <p>8275435110 / 9307900682</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="icon"><i class="bi-envelope-fill"></i></i></div>
                            <div class="text">
                                <h3>Email</h3>
                                <p><a href="mailto:encarta@ghrcacs.edu.in">encarta@ghrcacs.edu.in</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="contactForm">
                        <form method="POST">
                            <h2>Send Message</h2>
                            <div class="inputBox">
                                <input type="text" name="name" required="required">
                                <span>Full Name</span>
                            </div>
                            <div class="inputBox">
                                <input type="email" name="email" required="required">
                                <span>Email</span>
                            </div>
                            <div class="inputBox">
                                <input type="text" name="contact" required="required">
                                <span>Contact </span>
                            </div>
                            <div class="inputBox">
                                <input type="text" name="msg" required="required">
                                <span>Type your Message...</span>
                            </div>
                            <div class="inputBox">
                                <input type="submit" name="send" value="Send"/>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        <!-- Footer  -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <!-- Logo and University Name -->
                    <div class="col-md-3 text-center text-md-start mb-4 mt-5">
                        <a class="navbar-brand" href="https://ghrstu.edu.in/">
                            <img src="https://ghrstu.edu.in/assets/images/ghru-nagpur.png" alt="University Logo" style="width: 270px;">
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
                        <a href="https://www.facebook.com/raisoniworld" class="me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://instagram.com/raisoniworld" class="me-2"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/raisoniworld" class="me-2"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/school/raisoniworld" class="me-2"><i class="fab fa-linkedin-in"></i></a>
                        <a href="http://youtube.com/raisoniworld" class="me-2"><i class="fab fa-youtube"></i></a>
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

    </body>
</html>


<?php include "contactUs_connection.php";?>