<?php
session_start();

// Check if the user is logged in by verifying if the session contains the 'employeeID'
if (!isset($_SESSION['employeeID'])) {
    // If not logged in, redirect to the login page
    header("Location: ../login.php");
    exit();
}

// Sanitize the employee ID to prevent XSS attacks
$employeeID = htmlspecialchars($_SESSION['employeeID'], ENT_QUOTES, 'UTF-8');

// You might want to fetch user details from a database based on $employeeID here
// For example purposes, hardcoding the details
$profileName = "Asmita Maharjan Gopali";
$profilePosition = "Brand Executive, Brand & Finance";
$profileEmail = "asmita@antlerproduction.com";
$profileImage = "pp/AP1001.jpg";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            background-color: #e7f0ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            width: 90%;
            max-width: 1200px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .left-section {
            width: 30%;
        }

        .right-section {
            width: 65%;
        }

        .tabs {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .tab {
            flex: 1;
            padding: 10px;
            background: #e7f0ff;
            color: #33425c;
            text-align: center;
            cursor: pointer;
            margin: 5px;
            border-radius: 8px;
        }

        .tab.active {
            background: #33425c;
            color: white;
        }

        .profile-card, .tab-content {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: block;
        }

        .profile-details h3 {
            font-family: 'Oswald', sans-serif;
            color: #33425c;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .logout-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #33425c;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
        }

        .logout-button:hover {
            background-color: #22304a;
        }

        @media(max-width: 768px) {
            .left-section, .right-section {
                width: 100%;
            }

            .tabs {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <!-- Left section (profile summary) -->
        <div class="left-section">
            <div class="profile-card">
                <img src="<?php echo $profileImage; ?>" alt="Profile Picture" class="profile-img">
                <div class="profile-details">
                    <h3><?php echo $profileName; ?></h3>
                    <p>Employee ID: <?php echo $employeeID; ?></p>
                    <p><?php echo $profilePosition; ?></p>
                    <p>Email: <?php echo $profileEmail; ?></p>
                    <!-- Logout Button -->
                    <button class="logout-button" onclick="logout()">Logout</button>
                </div>
            </div>
        </div>

        <!-- Right section (tabs) -->
        <div class="right-section">
            <div class="tabs">
                <div class="tab active" onclick="showTab('attendance')">Attendance</div>
                <div class="tab" onclick="showTab('email')">Employee Webmail</div>
                <div class="tab" onclick="showTab('assets')">Asset Tag</div>
                <div class="tab" onclick="showTab('requisition')">Requisition Form</div>
                <div class="tab" onclick="showTab('reimbursement')">Reimbursement Form</div>
            </div>

            <!-- Tab content -->
            <div id="attendance" class="tab-content active">
                <h3>Attendance Records</h3>
                <iframe src="https://docs.google.com/spreadsheets/d/1LpZb2POa6pUvRJvs8AGwckHA47bDZ-qpj4mOie2khRA/edit?rm=minimal&gid=831267370#gid=831267370" 
                    width="100%" 
                    height="600px" 
                    frameborder="0" 
                    style="border: none; border-radius: 12px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                </iframe>
            </div>

            <div id="email" class="tab-content">
                <h3>Employee Webmail</h3>
                <p>Employee's email details go here...</p>
            </div>
            <div id="assets" class="tab-content">
                <h3>Asset Tag</h3>
                <p>Employee's assets go here...</p>
            </div>
            <div id="requisition" class="tab-content">
                <h3>Requisition Form</h3>
                <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScXPIft2_Et5IvcaziYSy0M7TCqnOwNe0cots6wlWSrX8Dt-g/viewform?embedded=true" 
                        width="100%" 
                        height="2207px" 
                        frameborder="0" 
                        marginheight="0" 
                        marginwidth="0"
                        style="border: none; border-radius: 12px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    Loading…
                </iframe>
            </div>

            <div id="reimbursement" class="tab-content">
                <h3>Reimbursement Form</h3>
                <p>Employee's reimbursement details go here...</p>
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            if (tab === 'email') {
                window.open('https://www.antlerproduction.com:2096', '_blank');
                return;
            }

            document.querySelectorAll('.tab').forEach((el) => el.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach((el) => el.classList.remove('active'));
            document.getElementById(tab).classList.add('active');
            document.querySelector(`[onclick="showTab('${tab}')"]`).classList.add('active');
        }

        function logout() {
            sessionStorage.removeItem('loggedIn'); // Clear the login flag
            window.location.href = '../login.php'; // Redirect to login page
        }
    </script>
</body>
</html>
