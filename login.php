<?php
// Start session
session_start();

// Include database connection
require_once 'connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the query to select user with the given DOMAINACC (username)
    $stmt = $conn->prepare("SELECT * FROM studentaccs WHERE DOMAINACC = ?");
    $stmt->bind_param('s', $username); // Bind the username parameter to the query

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists and verify the password
    if ($user && password_verify($password, $user['PASSWORD'])) {
        // Set session variables
        $_SESSION['user'] = $user['DOMAINACC']; // Set the DOMAINACC as the user session
        $_SESSION['user_id'] = $user['id'];      // Set user ID session variable

        // Redirect to the dashboard or the appropriate page
        header("Location: index2.php");
        exit();
    } else {
        echo "<p class='error-message'>Invalid username or password.</p>";
    }
}
?>


<style>
/* Global Styles */
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: Arial, sans-serif;
}

/* Background image */
body {
    background: url('assets/img/kldbuilding.jpg') no-repeat center center fixed;
    background-size: cover;
    height: 100%;
}

/* Create a semi-transparent overlay to make the login form more visible */
body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity for a darker background */
    z-index: -1; /* Place the overlay behind the content */
}

/* Center the login form on the page */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
}

/* Style the login box */
.login-box {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
}

/* Style for input fields */
.login-box input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

/* Style the login button */
.login-box button {
    width: 80%;
    padding: 12px;
    background-color: #28a745;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 15px;
}

/* Button hover effect */
.login-box button:hover {
    background-color: #218838;
}

/* Error message styling */
.error-message {
    color: red;
    font-size: 14px;
    text-align: center;
}

/* Tooltip style */
.tooltip {
    position: relative;
    display: flex;
    cursor: pointer;
    margin-bottom:5px;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 200px;
    background-color: rgba(0, 0, 0);
    color: #fff;
    text-align: center;
    border-radius: 5px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    margin-left: 10px; /* Adjust the tooltip position */
    margin-bottom: 10px;
    opacity: 0;
    transition: opacity 0.3s;
}

/* Show the tooltip text when hovered */
.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login</title>
</head>
<body>

<id="backToback" class="image-button">
    <a href="index.php"><img src="assets/img/BACK.png" alt="Back" class="button-image" margin-left = "50px" width="50px" height="50px"></a>
</div>
<!-- Login Form -->
<div class="login-container">
    <div class="login-box">
        <h2>Student Login</h2>
        <form method="POST">
            <!-- Username input with tooltip -->
            <div class="tooltip">
                <input type="text" name="username" placeholder="Username" required>
                <img src="assets/img/info.png" alt="Info Icon" width="10px" height="10px"> <!-- Replace with your icon image -->
                <span class="tooltiptext">Your username is the firstname.lastname@kld.edu (add spaces if your first name has spaces. All inputs are lowercase)</span>
            </div>

            <!-- Password input with tooltip -->
            <div class="tooltip">
                <input type="password" name="password" placeholder="Password" required>
                <img src="assets/img/info.png" alt="Info Icon" width="10px" height="10px"> <!-- Replace with your icon image -->
                <span class="tooltiptext">Please contact your admin. To provide the password, please bring your student id for account verification.</span>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</div>

</body>
</html>
