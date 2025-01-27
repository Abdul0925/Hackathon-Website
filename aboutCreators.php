<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackathon Process Flow</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        .team-section {
            padding: 50px 15px;
            background-color: #f8f9fa;
        }

        .team-member img {
            border-radius: 25%;
            width: 200px;
            height: 230px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .team-member h5 {
            margin: 10px 0 5px;
        }

        .team-member p {
            margin: 0;
            font-size: 0.9rem;
            color: #6c757d;
        }

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


        h1,
        h2,
        h3 {
            font-family: 'Arial', sans-serif;
            text-transform: uppercase;
            color: #333;
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 2.5rem;
            color: #501987;
        }

        header p.lead {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
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
        @media (max-width: 767px) {
            .team-member img {
                border-radius: 12%;
                width: 100px;
                height: 130px;
                object-fit: cover;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
</head>

<body>
    <?php include('indexNavbar.php'); ?>
    <!-- Header -->
    <header class="text-center py-4">
        <h1 class="">About Creators</h1>
        <p class="lead">We, the students of BCA 3rd Year at G H Raisoni College of Arts, Commerce, and Science, Nagpur, have created a website to streamline the hackathon process. Our platform provides an intuitive user interface for both users and administrators, ensuring the best user experience. We hope our work will be appreciated and motivate us for future projects.</p>
    </header>

    <!-- Team Section -->
    <!-- Team Section -->
    <div class="team-section text-center py-5">
        <img src="./picture/ourteam/AbdulandShad.jpg" class="img-fluid " alt="Abdul Rahim" height="100px" width="250px">
        <div class="container">
            <h2 class="mb-5">Our Team</h2>
            <div class="row justify-content-center">
                <!-- Team Member 1 -->
                <div class="col-lg-6 col-md-8 mb-4">
                    <div class="row align-items-center">
                        <!-- Left Column: Photo -->
                        <div class="col-4 team-member">
                            <img src="./picture/ourteam/Abdul2.jpg" class="img-fluid " alt="Abdul Rahim">
                        </div>
                        <!-- Right Column: Info -->
                        <div class="col-8 text-start">
                            <h5 class="mb-1">Abdul Rahim</h5>
                            <p class="text-muted">Backend Developer</p>
                            <p class="small">Abdul is responsible for creating and maintaining robust backend solutions for our web applications. His expertise in server-side technologies ensures that our platform runs smoothly and efficiently. Abdul's dedication to optimizing performance and implementing secure practices is crucial for the reliability and scalability of our services.</p>
                            <a href="mailto:abdulrahim74264@gmail.com" class="btn btn-link p-0">abdulrahim74264@gmail.com</a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 2 -->
                <div class="col-lg-6 col-md-8 mb-4">
                    <div class="row align-items-center">
                        <!-- Left Column: Photo -->
                        <div class="col-4 team-member">
                            <img src="./picture/ourteam/shadman.png" class="img-fluid " alt="Shadman Hayat">
                        </div>
                        <!-- Right Column: Info -->
                        <div class="col-8 text-start">
                            <h5 class="mb-1">Shadman Hayat</h5>
                            <p class="text-muted">Frontend Developer</p>
                            <p class="small">Shadman crafts intuitive and visually appealing user interfaces. With expertise in frontend technologies, he ensures our applications are functional, engaging, and user-friendly. His dedication to continuous learning keeps him at the forefront of web development trends, delivering a seamless user experience for our platform's visitors.</p>
                            <a href="mailto:shadmanhayat9992@gmail.com" class="btn btn-link p-0">shadmanhayat9992@gmail.com</a>
                        </div>
                    </div>
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