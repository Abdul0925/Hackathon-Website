<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f7f6;
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

        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background-color: #efe4ff;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .login-container h3 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #343a40;
        }

        .form-control {
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .my-primary-btn {
            width: 100%;
            border-radius: 8px;
        }

        .extra-links {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .extra-links a {
            font-size: 14px;
            color: #5C0F8B;
        }

        .dropdown-menu {
            border-radius: 8px;
        }

        .class-control {
            border-color: #f4f7f6;
        }





        .login-container
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

        .login-container h2
        {
        font-size: 30px;
        color: #333;
        font-weight: 500;
        }

        .login-container .inputBox
        {
        position: relative;
        width: 100%;
        margin-top: 10px;
        }

        .login-container .inputBox input,
        .login-container .inputBox textarea
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

        .login-container .inputBox span
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

        .login-container .inputBox input:focus ~ span,
        .login-container .inputBox input:valid ~ span,
        .login-container .inputBox textarea:focus ~ span,
        .login-container .inputBox textarea:valid ~ span
        {
        color: #e91e63;
        font-size: 12px;
        transform: translateY(-20px);
        }
    </style>
</head>
<body>


    <div class="contactForm">
        <h3>Login to Your Account</h3>
        <form method="POST" action="loginProcess.php">
            <!-- Email -->
            <div class="inputBox">
                <input type="email" name="email" id="email" required>
                <span>Enter your email</span>
            </div>

            <!-- Password -->
            <div class="inputBox">
                <input type="password" name="password" id="password" required>
                <span>Enter your password</span>
            </div>

            <!-- Role Dropdown -->
            <div class="form-group">
                <select class="inputBox" name="role" id="role" required>
                    <option selected disabled>Please Select Your Role</option>
                    <option value="super-admin">Super Admin</option>
                    <!-- <option value="institute-college">Institute/College</option> -->
                    <!-- <option value="team-leader">Team Leader</option> -->
                    <option value="mentor">Mentor</option>
                </select>
            </div>
    
            <!-- Submit Button -->
            <button type="submit" class="btn my-primary-btn" name="loginBtn">Login</button>

            <!-- Extra Links (Register and Forget Password) -->
            <div class="extra-links">
                <a href="registerPage.php">Register Now</a>
                <a href="forgetPassword.php">Forget Password?</a>
            </div>
        </form>
    </div>



    <div class="contactForm">
        <form>
            <h2>Send Message</h2>
            <div class="inputBox">
                <input type="text" name="" required="required">
                <span>Full Name</span>
            </div>
            <div class="inputBox">
                <input type="text" name="" required="required">
                <span>Email</span>
            </div>
            <div class="inputBox">
                <input type="text" name="" required="required">
                <span>Contact </span>
            </div>
            <div class="inputBox">
                <input type="text" name="" required="required">
                <span>Type your Message...</span>
            </div>
            <div class="inputBox">
                <input type="submit" name="" value="Send">
            </div>
        </form>
    </div>


</body>
</html>






