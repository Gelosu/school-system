<?php
// Start session
session_start();

// Include the database connection
require_once '../connect2.php';

// Check if the form for GMC request is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $section = $_POST['section'];
    $student_no = $_POST['student_no'];
    $last_enrollment = $_POST['last_enrollment'];
    $remarks = $_POST['remarks'];
    
    // Handle "Date of Release" field (if the value is the default message, set it to NULL)
    $date_of_release = ($_POST['date_of_release'] === "Go to the guidance to know release date") ? NULL : $_POST['date_of_release'];

    // Insert GMC request into the database
    $gmcQuery = "INSERT INTO tbl_students (name, section, student_no, last_enrollment, remarks, date_of_release) 
                 VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($gmcQuery)) {
        $stmt->bind_param('ssssss', $name, $section, $student_no, $last_enrollment, $remarks, $date_of_release);
        if ($stmt->execute()) {
            // Send success response
            echo "Good Moral Certificate request submitted successfully!";
        } else {
            // Send error response
            echo "Error submitting the request.";
        }
        $stmt->close();
    }
}
?>
