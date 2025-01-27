<?php
session_start();
if ($_SESSION['admin_logged_in'] != true) {
    header("location:loginPage.php");
}

require 'db.php';
$contactQueries = mysqli_query($conn, "SELECT * FROM contact_us");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Payment</title>
    <link rel="stylesheet" href="admin_dash_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            margin: auto;
            width: 100%;
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
            cursor: pointer;
        }

        td {
            font-size: 13px;
        }

        .popup {
            border: 1px solid black;
            border-radius: 10px;
            width: 500px;
            height: auto;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 0 30px 30px;
            visibility: hidden;
        }

        .open-popup {
            visibility: visible;
        }

        .modal-header h2 {
            padding-top: 25px;
            margin-bottom: 20px;
            color: #5500cb;
        }

        .primary-btn {
            background-color: rgb(47, 141, 70);
            color: white;
            width: 80px;
            height: 30px;
            border-radius: 5px;
            border: none;
        }

        .primary-btn:hover {
            background-color: rgb(31, 91, 46);
            color: white;
        }

        .primary-btn:active {
            box-shadow: 2px 2px 5px #fc894d;
            background-color: rgb(47, 141, 70);
        }

        .filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px;
        }

        .filter-container label {
            margin: 10px;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .filter-container input {
            margin: 10px;
            margin-bottom: 10px;
            width: 100%;
            height: 40px;
            border-radius: 5px;
            border: 1px solid rgb(200, 200, 200);
            padding: 1rem;
        }

        .report-container {
            margin-top: 20px;
            min-height: auto;
        }

        .nav-upper-options {
            gap: 0px;
            justify-content: center;
            align-items: center;
        }

        .nav-upper-options h3 {
            font-size: 16px;
            font-weight: bold;
            padding-left: 10px;
            text-decoration: none;
        }

        .nav-option i {
            font-size: 160%;
        }

        .report-body {
            padding: 0px 20px 20px 20px;
        }


        /* General styles for the popup */
        .popup {
            /* display: none; */
            /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            width: 90%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: fadeIn 0.3s ease-out;
        }

        /* Fade-in animation for the modal */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Modal header styling */
        .modal-header {
            /* background-color: #007BFF;
            color: #fff;
            padding: 16px;
            text-align: center; */
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        /* Modal body styling */
        .modal-body {
            padding: 16px;
            font-family: Arial, sans-serif;
            font-size: 1rem;
            color: black;
            line-height: 1.5;
            text-align: left;
        }

        .modal-body p {
            /* margin-bottom: 12px; */
        }

        .modal-body strong {
            color: black;
        }

        .modal-body textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            margin-top: 10px;
            color: black;
        }

        /* Modal footer styling */
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
        }


        /* Background overlay for the modal */
        .popup::before {
            /* content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: block; */
        }


        @media screen and (max-width: 400px) {
            .popup {
                width: 300px;
            }
        }
    </style>

</head>

<body>
    <!-- for header part -->
    <header>

        <div class="logosec">
            <a href="admin_dashboard.php" style="text-decoration: none;">
                <div class="logo">Admin</div>
            </a>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png" class="icn menuicn" id="menuicn" alt="menu-icon">
        </div>

        <div>
            <H1>Profile</H1>
        </div>

        <div class="message">
            <div class="circle"></div>
            <a href="admin_show_notifications.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt=""></a>
            <div class="dp">
                <a href="admin_profile.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp"></a>
            </div>
        </div>

    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <a href="admin_dashboard.php" style="text-decoration: none;">
                        <div class="nav-option option2" style="color: black;">
                            <i class="bi-columns"></i>
                            <h3> Dashboard</h3>
                        </div>
                    </a>

                    <a href="admin_profile.php" style="text-decoration: none;">
                        <div class="nav-option option3" style="color: black;">
                            <i class="bi-file-person"></i>
                            <h3> Profile</h3>
                        </div>
                    </a>

                    <a href="admin_all_teams.php" style="text-decoration: none;">
                        <div class="nav-option option2" style="color: black;">
                            <i class="bi-people-fill"></i>
                            <h3> Teams</h3>
                        </div>
                    </a>

                    <a href="admin_round.php" style="text-decoration: none;">
                        <div class="nav-option option2" style="color: black;">
                            <i class="bi-award"></i>
                            <h3> Rounds</h3>
                        </div>
                    </a>

                    <a href="admin_payment_approved.php" style="text-decoration: none;">
                        <div class="nav-option option2" style="color: black;">
                            <i class="bi-credit-card"></i>
                            <h3> Payment</h3>
                        </div>
                    </a>

                    <a href="admin_queries.php" style="text-decoration: none;">
                        <div class="nav-option option1" style="color: black;">
                            <i style="color: #fff;" class="bi bi-patch-question"></i>
                            <h3 style="color: #fff"> Queries</h3>
                        </div>
                    </a>

                    <a href="logout.php" style="text-decoration: none;">
                        <div class="nav-option logout" style="color: black;">
                            <i class="bi-arrow-left-circle"></i>
                            <h3>Logout</h3>
                        </div>
                    </a>

                </div>
            </nav>
        </div>

        <div class="main">



            <!-- team detail table -->
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">All Queries</h1>
                </div>

                <div class="filter-container">
                    <!-- <label for="filterInput">Search</label> -->
                    <input type="text" id="filterInput" placeholder="Search by Team Name or Transaction ID" onkeyup="filterTable()">
                </div>
                <script>
                    function filterTable() {
                        const input = document.getElementById('filterInput');
                        const filter = input.value.toLowerCase();
                        const table = document.querySelector('table tbody');
                        const rows = table.getElementsByTagName('tr');

                        for (let i = 0; i < rows.length; i++) {
                            const teamName = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
                            const transactionId = rows[i].getElementsByTagName('td')[2].textContent.toLowerCase();
                            if (teamName.includes(filter) || transactionId.includes(filter)) {
                                rows[i].style.display = '';
                            } else {
                                rows[i].style.display = 'none';
                            }
                        }
                    }
                </script>
                <div class="report-body">
                    <!-- top hedding -->
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">Sr No</th>
                                    <th scope="col">Name</th>
                                    <!-- <th scope="col">Email</th> -->
                                    <th scope="col">Contact</th>
                                    <th scope="col">Query</th>
                                    <!-- <th scope="col">Description</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 0;
                                while ($query = $contactQueries->fetch_assoc()) {
                                    // Fetch teamName from team_and_leader_details
                                    $srno++;
                                ?>
                                    <tr>
                                        <td><?php echo $srno ?></td>
                                        <td><?php echo $query['name'] ?></td>
                                        <!-- <td><?php //echo $query['email'] 
                                                    ?></td> -->
                                        <td><?php echo $query['contact'] ?></td>
                                        <td><?php
                                            $queryHeading = $query['query'];
                                            if ($queryHeading == "login") echo "Login credentials not received";
                                            if ($queryHeading == "registration") echo "Registration page is not working";
                                            if ($queryHeading == "ppt") echo "Error in submitting the idea PPT";
                                            if ($queryHeading == "elimination") echo "Why my team is eliminated?";
                                            if ($queryHeading == "details") echo "Details filled by mistake, how to change it";
                                            ?></td>
                                        <!-- <td><?php //echo $query['optional_message'] 
                                                    ?></td> -->
                                        <td>
                                            <button class="primary-btn w-100 reply-btn" style="cursor: pointer;" data-id="<?php echo $query['id']; ?>">
                                                Reply
                                            </button>

                                            <div class="popup" id="popup-<?php echo $query['id']; ?>">
                                                <div class="modal-header">
                                                    <h2>Query Details</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Name:</strong>
                                                    <p id="name"><?php echo $query['name']; ?></p>
                                                    </p>
                                                    <p><strong>Email:</strong>
                                                    <p id="email"> <?php echo $query['email']; ?> </p>
                                                    </p>
                                                    <p><strong>Contact:</strong> <?php echo $query['contact']; ?></p>
                                                    <p><strong>Query:</strong> <?php
                                                                                $queryHeading = $query['query'];
                                                                                if ($queryHeading == "login") echo "Login credentials not received";
                                                                                if ($queryHeading == "registration") echo "Registration page is not working";
                                                                                if ($queryHeading == "ppt") echo "Error in submitting the idea PPT";
                                                                                if ($queryHeading == "elimination") echo "Why my team is eliminated?";
                                                                                if ($queryHeading == "details") echo "Details filled by mistake, how to change it";
                                                                                ?></p>
                                                    <p><strong>Description:</strong> <?php echo $query['optional_message']; ?></p>
                                                    <textarea
                                                        id="replyMessage-<?php echo $query['id']; ?>"
                                                        placeholder="Type your reply here..."
                                                        value="<?php
                                                                if ($queryHeading == 'login') echo 'Login credentials not received';
                                                                if ($queryHeading == 'registration') echo 'Registration page is not working';
                                                                if ($queryHeading == 'ppt') echo 'Error in submitting the idea PPT';
                                                                if ($queryHeading == 'elimination') echo 'Why my team is eliminated?';
                                                                if ($queryHeading == 'details') echo 'Details filled by mistake, how to change it';
                                                                ?>"><?php if ($queryHeading == 'login') echo 'Sorry for the inconvinience, Our team will soon respond you after looking into the matter';
                                                                    if ($queryHeading == 'registration') echo 'Try the registration page in icognitive mode';
                                                                    if ($queryHeading == 'ppt') echo 'You can mail your idea ppt on encartaitcell@ghrcacs.raisoni.net';
                                                                    if ($queryHeading == 'elimination') echo 'The reasone of elimination is sent to your mail if you think this is mistake then contact 8390686640';
                                                                    if ($queryHeading == 'details') echo 'We appreciate that you accept your mistake send mail to encartaircell@ghrcacs.raisoni.net with your correct details';
                                                                    if ($queryHeading == 'others') echo ''; ?></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="primary-btn" id="sendBtn" onclick="sendReply(<?php echo $query['id']; ?>)">Send</button>
                                                    <button class="primary-btn" onclick="closePopup(<?php echo $query['id']; ?>)">Close</button>
                                                </div>
                                            </div>

                                            <script>
                                                document.querySelectorAll('.reply-btn').forEach(button => {
                                                    button.addEventListener('click', () => {
                                                        const id = button.getAttribute('data-id');
                                                        document.getElementById(`popup-${id}`).classList.add('open-popup');
                                                    });
                                                });

                                                function closePopup(id) {
                                                    document.getElementById(`popup-${id}`).classList.remove('open-popup');
                                                }

                                                function sendReply(id) {
                                                    const button = document.getElementById('sendBtn');
                                                    button.disabled = true;
                                                    button.textContent = 'Sending...';
                                                    const message = document.getElementById(`replyMessage-${id}`).value;
                                                    const name = document.getElementById('name').textContent;
                                                    const email = document.getElementById('email').textContent;
                                                    if (message.trim() === '') {
                                                        alert('Please enter a reply message.');
                                                        return;
                                                    }

                                                    const data = new FormData();
                                                    data.append('id', id);
                                                    data.append('message', message);
                                                    data.append('name', name);
                                                    data.append('email', email);

                                                    fetch('processReply.php', {
                                                            method: 'POST',
                                                            body: data,
                                                        })
                                                        .then(response => response.json())
                                                        .then(result => {
                                                            if (result.success) {
                                                                alert(result.message);
                                                                closePopup(id);
                                                                button.disabled = false;
                                                                button.textContent = 'Send';
                                                            } else {
                                                                alert(result.message);
                                                                button.disabled = false;
                                                                button.textContent = 'Send';
                                                            }
                                                        })
                                                        .catch(error => {
                                                            console.error('Error:', error);
                                                            button.disabled = false;
                                                            button.textContent = 'Send';
                                                        });
                                                }
                                            </script>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('th').click(function() {
                let table = $(this).closest('table');
                let rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
                this.asc = !this.asc;

                if (!this.asc) {
                    rows.reverse();
                }

                // Append rows efficiently
                let fragment = document.createDocumentFragment();
                rows.forEach(row => fragment.appendChild(row));
                table.find('tbody').append(fragment);

                // Update sorting indicator
                $('th').removeClass('asc desc'); // Reset all headers
                $(this).addClass(this.asc ? 'asc' : 'desc'); // Highlight current column
            });

            function comparer(index) {
                return function(a, b) {
                    let valA = getCellValue(a, index);
                    let valB = getCellValue(b, index);

                    if ($.isNumeric(valA) && $.isNumeric(valB)) {
                        return parseFloat(valA) - parseFloat(valB); // Numeric comparison
                    } else {
                        return valA.localeCompare(valB); // String comparison
                    }
                };
            }

            function getCellValue(row, index) {
                return $(row).children('td').eq(index).text().trim();
            }
        });
    </script>

    <script>
        // function sendReply(queryId) {
        //     // Get the modal elements
        //     const popup = document.getElementById(`popup-${queryId}`);
        //     const replyMessage = document.getElementById(`replyMessage-${queryId}`).value;

        //     // Extract the data from the modal
        //     const name = popup.querySelector('p strong:contains("Name")').parentNode.textContent.replace("Name:", "").trim();
        //     const email = popup.querySelector('p strong:contains("Email")').parentNode.textContent.replace("Email:", "").trim();
        //     const contact = popup.querySelector('p strong:contains("Contact")').parentNode.textContent.replace("Contact:", "").trim();
        //     const query = popup.querySelector('p strong:contains("Query")').parentNode.textContent.replace("Query:", "").trim();
        //     const optionalMessage = popup.querySelector('p strong:contains("Description")').parentNode.textContent.replace("Description:", "").trim();

        //     // Create a FormData object
        //     const formData = new FormData();
        //     formData.append('id', queryId);
        //     formData.append('name', name);
        //     formData.append('email', email);
        //     formData.append('contact', contact);
        //     formData.append('query', query);
        //     formData.append('optional_message', optionalMessage);
        //     formData.append('replyMessage', replyMessage);

        //     // Send the data to the PHP file
        //     fetch('processReply.php', {
        //             method: 'POST',
        //             body: formData
        //         })
        //         .then(response => response.text())
        //         .then(data => {
        //             // Handle the response
        //             console.log(data);
        //             alert('Reply sent successfully!');
        //             closePopup(queryId); // Close the popup after success
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //             alert('Failed to send reply. Please try again.');
        //         });
        // }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</body>

</html>