<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackathon Process Flow</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: radial-gradient(circle,rgb(161, 161, 255), #111118);
            color: #fff;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            color:rgb(220, 234, 31);
            text-shadow: 0 0 15px #09d6f3, 0 0 25px #09d6f3;
        }

        .header p {
            font-size: 1.2rem;
            color: #e6e6e6;
            margin-bottom: 40px;
        }

        .timeline {
            position: relative;
            margin: 50px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #09d6f3, #c800ff);
            z-index: 1;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 50px;
            padding: 20px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            width: 60%;
            z-index: 2;
        }

        .timeline-item-box {
            background-color: #1e1e2f; 
            border: 2px solid #09d6f3;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .timeline-item h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: #fff;
            text-shadow: 0 0 10px #c800ff;
        }

        .timeline-item p {
            font-size: 1rem;
            line-height: 1.6;
            color: #e6e6e6;
        }

        .timeline-item i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #09d6f3;
            animation: bounce 2s infinite;
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


        @keyframes glow {
            from {
                box-shadow: 0 0 10px #c800ff, 0 0 20px #09d6f3;
            }
            to {
                box-shadow: 0 0 20px #c800ff, 0 0 40px #09d6f3;
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @media (max-width: 768px) {
            .timeline-item {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <?php include('indexNavbar.php'); ?>
    
    <div class="container">
        <div class="header">
            <h1>Hackathon Process Flow</h1>
            <p>Embark on an exciting journey to innovate and create!</p>
        </div>

        <div class="timeline">
            <!-- Step 1 -->
            <div class="timeline-item">
                <div class="timeline-item-box">
                    <i class="fas fa-user-plus"></i>
                    <h2>Step 1: Registration</h2>
                    <p>Sign up online and secure your slot for the hackathon. Make sure to fill out all required details.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="timeline-item">
                <div class="timeline-item-box">
                    <i class="fas fa-users"></i>
                    <h2>Step 2: Team Formation</h2>
                    <p>Collaborate with others to form a team or participate solo. Let the creativity flow!</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="timeline-item">
                <div class="timeline-item-box">
                    <i class="fas fa-laptop-code"></i>
                    <h2>Step 3: Start Hacking</h2>
                    <p>Begin developing your solution. Utilize our tools, resources, and mentors for guidance.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="timeline-item">
                <div class="timeline-item-box">
                    <i class="fas fa-upload"></i>
                    <h2>Step 4: Submission</h2>
                    <p>Submit your project through the portal with all documentation before the deadline.</p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="timeline-item">
                <div class="timeline-item-box">
                    <i class="fas fa-trophy"></i>
                    <h2>Step 5: Judging & Awards</h2>
                    <p>Present your project to the judges. Winners will be announced during the closing ceremony.</p>
                </div>
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>