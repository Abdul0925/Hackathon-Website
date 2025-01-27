<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackathon Process Flow</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        

        .gallery-container {
            padding: 50px 15px;
        }

        .gallery-item img {
            border-radius: 8px;
            transition: transform 0.3s ease-in-out;
        }

        .gallery-item img:hover {
            transform: scale(1.05);
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


        
    </style>
</head>
<body>
    <?php include('indexNavbar.php'); ?>
    <!-- Header -->
    <header class="text-center py-4">
        <h1 class="">Past Hackthon Glimps</h1>
        <p class="lead">Explore our collection of beautiful images</p>
    </header>

    <!-- Gallery Section -->
    <div class="container gallery-container">
        <div class="row g-4">
            <div class="col-md-4 col-sm-6 gallery-item">
                <img src="./picture/pasthackathon/SWRJ5197.JPG" alt="Gallery Image 1" class="img-fluid shadow">
            </div>
            <div class="col-md-4 col-sm-6 gallery-item">
                <img src="./picture/pasthackathon/SWRJ5229.JPG" alt="Gallery Image 2" class="img-fluid shadow">
            </div>
            <div class="col-md-4 col-sm-6 gallery-item">
                <img src="./picture/pasthackathon/SWRJ5230.JPG" alt="Gallery Image 3" class="img-fluid shadow">
            </div>
            <div class="col-md-4 col-sm-6 gallery-item">
                <img src="./picture/pasthackathon/SWRJ5231.JPG" alt="Gallery Image 4" class="img-fluid shadow">
            </div>
            <div class="col-md-4 col-sm-6 gallery-item">
                <img src="./picture/pasthackathon/SWRJ5231.JPG" alt="Gallery Image 5" class="img-fluid shadow">
            </div>
            <div class="col-md-4 col-sm-6 gallery-item">
                <img src="./picture/pasthackathon/SWRJ5232.JPG" alt="Gallery Image 6" class="img-fluid shadow">
            </div>
            <div class="col-md-4 col-sm-6 gallery-item">
                <img src="./picture/pasthackathon/SWRJ5233.JPG" alt="Gallery Image 6" class="img-fluid shadow">
            </div>
            <div class="col-md-4 col-sm-6 gallery-item">
                <img src="./picture/pasthackathon/SWRJ5360.JPG" alt="Gallery Image 6" class="img-fluid shadow">
            </div>
            <div class="col-md-4 col-sm-6 gallery-item">
                <img src="./picture/pasthackathon/SWRJ5361.JPG" alt="Gallery Image 6" class="img-fluid shadow">
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