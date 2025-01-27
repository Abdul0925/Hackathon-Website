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
            border-radius: 50%;
            width: 120px;
            height: 150px;
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
    </style>
</head>

<body>
    <?php include('indexNavbar.php'); ?>
    <!-- Header -->
    <header class="text-center py-4">
        <h1 class="">ENCARTA IT CELL</h1>
        <p class="lead">Encarta IT Cell is a dedicated team of students and faculty members at GHRCACS Nagpur, focused on fostering technological innovation and excellence. Our mission is to provide a platform for students to enhance their technical skills, collaborate on projects, and participate in various tech-related events and hackathons. We aim to bridge the gap between academic knowledge and industry requirements, preparing our members for successful careers in the IT sector.</p>
    </header>

    <!-- Team Section -->
    <div class="team-section text-center">

        <!-- Incharge -->
        <h3 class="mb-4">Incharges</h3>
        <div class="row">
            <div class="col-md-4 team-member gallery-item">
                <img src="./picture/ourteam/vishalSir.png" alt="Incharge">
                <h5>Vishal Dhabaliya</h5>
                <p>Incharge</p>
            </div>
            <div class="col-md-4 team-member gallery-item">
                <img src="./picture/ourteam/yashSir.jpg" alt="Incharge">
                <h5>Yash Bansod</h5>
                <p>Incharge</p>
            </div>
            <div class="col-md-4 team-member gallery-item">
                <img src="./picture/ourteam/prajaktaMam.jpg" alt="Incharge">
                <h5>Prajakta Kotkar</h5>
                <p>Incharge</p>
            </div>
        </div>

        <!-- Advisors -->
        <h3 class="my-4">Advisors</h3>
        <div class="row">
            <div class="col-md-3 team-member gallery-item">
                <img src="./picture/ourteam/abd-removebg-preview-transformed1.png" alt="Advisor">
                <h5>Abdul Rahim</h5>
                <p>Advisor</p>
            </div>
            <div class="col-md-3 team-member gallery-item">
                <img src="./picture/ourteam/vedant.jpg" alt="Advisor">
                <h5>Vedant Dodke</h5>
                <p>Advisor</p>
            </div>
            <div class="col-md-3 team-member gallery-item">
                <img src="./picture/ourteam/khushii.jpg" alt="Advisor">
                <h5>Khushi Majithiya</h5>
                <p>Advisor</p>
            </div>
            <div class="col-md-3 team-member gallery-item">
                <img src="./picture/ourteam/siddesh.jpg" alt="Advisor">
                <h5>Siddesh Bhalotiya</h5>
                <p>Advisor</p>
            </div>
        </div>
        <!-- President & Vice President -->
        <h3 class="my-4">President and Vice President</h3>
        <div class="row justify-content-center mb-5">
            <div class="col-md-4 team-member gallery-item">
                <img src="./picture/ourteam/Neeraj.png" alt="President">
                <h5>Neeraj Paswan</h5>
                <p>President</p>
            </div>
            <div class="col-md-4 team-member gallery-item">
                <img src="./picture/ourteam/Andrea.jpg" alt="Vice President">
                <h5>Andrea Kulthe</h5>
                <p>Vice President</p>
            </div>
        </div>

        <h3 class="my-4">Student Co-ordinator</h3>
        <div class="row justify-content-center mb-5">
            <div class="col-md-4 team-member gallery-item">
                <img src="./picture/ourteam/nidhi.jpg" alt="Head">
                <h5>Shrinidhi Tembhare</h5>
                <p>Student Coordinator</p>
            </div>
        </div>

        <!-- Heads -->
        <h3 class="my-4">Heads</h3>
        <div class="row justify-content-center">
            <div class="col-md-3 team-member text-center gallery-item">
                <img src="./picture/ourteam/anjali.jpg" alt="Head">
                <h5>Anjali Rathod</h5>
                <p>Marketing Head</p>
            </div>
            <div class="col-md-3 team-member text-center gallery-item">
                <img src="./picture/ourteam/.jpg" alt="Head">
                <h5>Unknown</h5>
                <p>Technical Head</p>
            </div>
            <div class="col-md-3 team-member text-center gallery-item">
                <img src="./picture/ourteam/pawan.jpg" alt="Head">
                <h5>Pawan Kadam</h5>
                <p>PR Head</p>
            </div>
        </div>
    </div>

    <h1>Gallery </h1>
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