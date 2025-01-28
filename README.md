# Raisoni Hackathon Website

Welcome to the official repository for the **Raisoni Tech Hackathon Season 2 (RTH S2)** registration website! This project is open source and designed to facilitate the registration process for participants. Whether you're a seasoned developer or a beginner in your learning phase, this project offers an excellent opportunity to contribute and grow your skills.

---

## Features

- User registration for the hackathon
- Team management
- OTP-based email verification
- Dynamic form validations
- Admin dashboard for managing registrations

---

## Tech Stack

- **Backend**: PHP, MySQL
- **Frontend**: HTML, CSS, Bootstrap, JavaScript, JQuery
- **Email Services**: PHP Mailer

---

## Installation

Follow these steps to set up the project locally:

1. **Fork the Repository**: Create your own copy of the repo on GitHub.
2. **Clone the Project**: Clone the repository into your XAMPP `htdocs` folder.

    ```bash
    git clone https://github.com/Abdul0925/Hackathon-Website
    ```

3. **Navigate to the Project Directory**:

    ```bash
    cd Hackathon-Website
    ```

4. **Start XAMPP Server**:
    - Enable `Apache` and `MySQL` in XAMPP.

5. **Create a Database**:
    - Open `PHPMyAdmin` and create a new database named `raisoni_jr_hackathon`.

6. **Import Database Schema**:
    - Import the provided `.sql` file into the newly created database.

7. **Run the Application**:
    - Access the website on `http://localhost/Hackathon-Website/`.

---

## Contribution Guidelines

Contributions are always welcome! Here's how you can contribute:

1. **Create a New Branch**:

    ```bash
    git checkout -b your-branch-name
    ```

2. **Explore Issues**:
    - Check the [Issues section](https://github.com/Abdul0925/Hackathon-Website/issues) on GitHub.
    - Identify a bug or feature request to work on.

3. **Solve and Commit**:
    - Fix the issue or add a feature.
    - Commit your changes:

      ```bash
      git add .
      git commit -m "Fixed issue #<issue-number>: <description>"
      ```

4. **Push Your Changes**:

    ```bash
    git push origin your-branch-name
    ```

5. **Create a Pull Request**:
    - Submit a pull request to the main repository.

6. **Review and Merge**:
    - Once reviewed, your changes will be merged into the project.

---

## Important Notes

1. **Email Configuration**:
    - Update your Gmail credentials for **PHP Mailer** in the following files:
      - `send_otp.php`
      - `registerTeamProcess.php`
      - `forget_password.php`

    Steps to find your Gmail SMTP password:
    - Visit [Google Account Settings](https://myaccount.google.com/security).
    - Enable "Allow less secure apps" or create an app-specific password.

2. **Database Name**:
    - Ensure the database is named `raisoni_jr_hackathon`.

---

## Learning Opportunity

This project provides a great learning opportunity for:

- Understanding how PHP interacts with MySQL databases
- Implementing email services using PHP Mailer
- Building responsive and dynamic web pages
- Exploring team collaboration using GitHub

---

## License

This project is licensed under the MIT License. See the `LICENSE` file for more details.

---

## Contact

For queries or suggestions, feel free to reach out:

- **Project Maintainer**: Abdul and Team
- **Email**: [encartaitcell@ghrcacs.raisoni.net](mailto:encartaitcell@ghrcacs.raisoni.net)

---

We hope you enjoy contributing to this project and building your skills! 🚀
