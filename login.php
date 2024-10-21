<?php
session_start();

// Debugging output
if (isset($_SESSION['employeeID'])) {
    header("Location: dashboard.php");
    exit();
}

// Initialize variables to store error message
$errorMessage = "";

// Generate a CSRF token if one doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $errorMessage = "Invalid CSRF token.";
    } else {
        // Sanitize form data
        $employeeId = htmlspecialchars($_POST['employeeId'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

        // Hardcoded employee credentials (for demo purposes)
        $employees = [
            "AP1001" => "CalendarNKS<3",
            "AP2002" => "Calendargirl<3",
            "AP3003" => "Ashp@123",
            "AP4004" => "Nischal099",
            "AP5005" => "@ntler5005",
            "AP6006" => "Mamba17",
            "AP2255" => "@NtlerNKS2255"
        ];

        // Check if the credentials match
        if (array_key_exists($employeeId, $employees) && $employees[$employeeId] === $password) {
            // Store the Employee ID in the session to keep the user logged in
            $_SESSION['employeeID'] = $employeeId;

            // Redirect based on employee ID
            if ($employeeId === "AP2255") {
                header("Location: dashboard.php");
            } else {
                header("Location: employees/employee" . substr($employeeId, -1) . ".php");
            }
            exit();
        } else {
            $errorMessage = "Invalid Employee ID or Password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Lato', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .video-container iframe {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        h2 {
            font-family: 'Oswald', sans-serif;
            color: #33425c;
            margin-bottom: 20px;
        }

        input {
            width: calc(100% - 24px);
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Raleway', sans-serif;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .password-container {
            position: relative;
        }

        .password-container input {
            padding-right: 40px;
        }

        .password-container .toggle-password {
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #333;
            cursor: pointer;
            z-index: 1;
        }

        button {
            width: calc(100% - 24px);
            padding: 12px;
            background-color: #33425c;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #2b3b4f;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="home" class="video-container">
        <iframe width="1920" height="911" src="https://www.youtube.com/embed/nOmWTzDSdoo?controls=0&loop=1&autoplay=1&vq=4k2160&mute=1&showinfo=0&rel=0&playlist=nOmWTzDSdoo" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="login-container">
        <h2>Login to Antler Production</h2>
        <form method="POST" action="">
            <input type="text" name="employeeId" placeholder="Employee ID" required>
            
            <div class="password-container">
                <input type="password" name="password" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePassword()">
                    <i id="eyeIcon" class="fas fa-eye"></i>
                </span>
            </div>

            <!-- Add CSRF token field -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
            
            <button type="submit">Login</button>
            <p class="error"><?php echo $errorMessage; ?></p>
        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.querySelector('input[name="password"]');
            var eyeIcon = document.getElementById("eyeIcon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
