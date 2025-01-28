<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackathon Process Flow</title>
    <link rel="icon" href="./picture/rthlogotest1.png" type="image/x-icon">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #002B5B;
            color: #FFFFFF;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .timeline {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            gap: 20px;
        }

        .event {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background: #001F3F;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
            gap: 10px;
        }

        .event-date {
            font-size: 1.2rem;
            color: #FFC107;
            font-weight: bold;
            flex-shrink: 0;
        }

        .event-icon {
            font-size: 2.5rem;
            color: #FFC107;
            margin: 0 10px;
            flex-shrink: 0;
        }

        .event-content {
            text-align: left;
            flex: 1;
        }

        .event-title {
            font-size: 1.5rem;
            margin: 0;
            color: #FFFFFF;
        }

        .event-description {
            margin-top: 10px;
            font-size: 1rem;
            color: #F1F1F1;
        }

        @media (max-width: 768px) {
            .event {
                flex-direction: column;
                text-align: center;
                align-items: center;
                gap: 15px;
            }

            .event-date {
                order: 1;
            }

            .event-icon {
                order: 2;
            }

            .event-content {
                order: 3;
                text-align: center;
            }
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

            0%,
            100% {
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
        <h1>Event Timeline</h1>
        <div class="timeline">
            <div class="event">
                <span class="event-date">15th Feb</span>
                <div class="event-icon">📝</div>
                <div class="event-content">
                    <h3 class="event-title">Registration</h3>
                    <p class="event-description">Begin your journey by signing up for the event.</p>
                </div>
            </div>
            <div class="event">
                <span class="event-date">17th Feb</span>
                <div class="event-icon">🏆</div>
                <div class="event-content">
                    <h3 class="event-title">Round 1</h3>
                    <p class="event-description">The first step to showcase your talent.</p>
                </div>
            </div>
            <div class="event">
                <span class="event-date">19th Feb</span>
                <div class="event-icon">🎯</div>
                <div class="event-content">
                    <h3 class="event-title">Nominations</h3>
                    <p class="event-description">The best performers get nominated.</p>
                </div>
            </div>
            <div class="event">
                <span class="event-date">24th Feb - 25th Feb</span>
                <div class="event-icon">🎤</div>
                <div class="event-content">
                    <h3 class="event-title">Grand Finale</h3>
                    <p class="event-description">The final stage to shine and perform.</p>
                </div>
            </div>
            <div class="event">
                <span class="event-date">25th Feb</span>
                <div class="event-icon">🎉</div>
                <div class="event-content">
                    <h3 class="event-title">Awards & Prizes</h3>
                    <p class="event-description">Celebrate success and receive awards.</p>
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