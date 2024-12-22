<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackathon Process Flow</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: radial-gradient(circle, #1e1e2f, #111118);
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
            color: #09d6f3;
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
</body>
</html>