<?php
session_start();

// Check if the user is logged in by verifying if the session contains the 'employeeID'
if (!isset($_SESSION['employeeID'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Sanitize the employee ID to prevent XSS attacks
$employeeID = htmlspecialchars($_SESSION['employeeID'], ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            background-color: #e7f0ff;
            display: flex;
            justify-content: center;
            align-items: center;
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
            margin: 0 auto;
            display: block;
            object-fit: cover;
        }

        .profile-info {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="left-section">
            <div class="profile-card">
                <img src="path/to/profile.jpg" alt="Profile Image" class="profile-img">
                <div class="profile-info">
                    <h2>Employee ID: <?php echo $employeeID; ?></h2>
                    <p>Welcome to your dashboard!</p>
                </div>
            </div>
        </div>
        <div class="right-section">
            <div class="tabs">
                <div class="tab active" onclick="showTab('tab1')">Tab 1</div>
                <div class="tab" onclick="showTab('tab2')">Tab 2</div>
                <div class="tab" onclick="showTab('tab3')">Tab 3</div>
            </div>
            <div id="tab1" class="tab-content">
                <h2>Tab 1 Content</h2>
                <p>This is the content for Tab 1.</p>
            </div>
            <div id="tab2" class="tab-content" style="display: none;">
                <h2>Tab 2 Content</h2>
                <p>This is the content for Tab 2.</p>
            </div>
            <div id="tab3" class="tab-content" style="display: none;">
                <h2>Tab 3 Content</h2>
                <p>This is the content for Tab 3.</p>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(function(tab) {
                tab.style.display = 'none';
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.classList.remove('active');
            });

            // Show the selected tab
            document.getElementById(tabId).style.display = 'block';
            document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
        }
    </script>
</body>
</html>
