<?php
// Include database connection
require_once '../connect4.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $firstname = trim($_POST['firstname']);
    $middleinitial = trim($_POST['middleinitial']);
    $lastname = trim($_POST['lastname']);
    $course = trim($_POST['course']);
    $year = trim($_POST['year']);
    $section = trim($_POST['section']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Combine names
    $fullName = "$firstname";
    if (!empty($middleinitial)) {
        $fullName .= " $middleinitial.";
    }
    $fullName .= " $lastname";

    // Create domain account
    $domainAccount = strtolower("$firstname.$lastname@kld.edu");

    // Prepare SQL query
    $stmt = $pdo->prepare("INSERT INTO studentaccs (NAME, SECTION, COURSE, EMAIL, DOMAINACC, PASSWORD, DATECREATED) 
        VALUES (:name, :section, :course, :email, :domainacc, :password, :datecreated)");

    // Execute query with prepared statement
    $success = $stmt->execute([
        ':name' => $fullName,
        ':section' => $section,
        ':course' => $course,
        ':email' => $email,
        ':domainacc' => $domainAccount,
        ':password' => password_hash($password, PASSWORD_BCRYPT), // Encrypt the password
        ':datecreated' => date('Y-m-d'), // Current date
    ]);

    // Redirect or display a success message
    if ($success) {
        header('Location: studentreg.php?success=1'); // Redirect to the main page with a success message
        exit;
    } else {
        echo "Error: Could not register the student. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>
