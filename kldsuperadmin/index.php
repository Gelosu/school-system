<?php
// Start session
session_start();

// Include database connection
require_once 'connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the query to select user with given username and password
    $stmt = $pdo->prepare("SELECT * FROM accounts WHERE username = :username AND password = :password");
    $stmt->execute(['username' => $username, 'password' => $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and password matches
    if ($user) {
        // Check if username is superadminkld
        if ($username == 'superadminkld') {
            // Set session variables
            $_SESSION['user'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];  // Set user ID session variable

            // Redirect to dashboard
            header("Location: dashboard.php?chat_with=2");
            exit();
        } else {
            // Show ACCESS DENIED message for invalid username
            echo "<script>alert('ACCESS DENIED: Invalid username.'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<p class='error-message'>Invalid username or password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<!-- Login Form -->
<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</div>

</body>
</html>
