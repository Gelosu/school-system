<?php
include('../includes/connection.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $id = isset($_POST['gmr_id']) ? (int)$_POST['gmr_id'] : 0;  // Cast to integer to prevent injection
    $name = isset($_POST['name']) ? mysqli_real_escape_string($connection, $_POST['name']) : '';
    $section = isset($_POST['section']) ? mysqli_real_escape_string($connection, $_POST['section']) : '';
    $student_no = isset($_POST['student_no']) ? mysqli_real_escape_string($connection, $_POST['student_no']) : '';
    $last_enrollment = isset($_POST['last_enrollment']) ? mysqli_real_escape_string($connection, $_POST['last_enrollment']) : '';
    $remarks = isset($_POST['remarks']) ? mysqli_real_escape_string($connection, $_POST['remarks']) : '';
    $date_of_release = isset($_POST['date_of_release']) ? mysqli_real_escape_string($connection, $_POST['date_of_release']) : NULL;

    // Validate required fields
    if (empty($name) || empty($section) || empty($student_no) || empty($last_enrollment)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit();
    }

    // Prepare the update query using prepared statements
    $query = "UPDATE tbl_students SET 
                name = ?, 
                section = ?, 
                student_no = ?, 
                last_enrollment = ?, 
                remarks = ?, 
                date_of_release = ? 
              WHERE id = ?";

    // Prepare statement
    if ($stmt = mysqli_prepare($connection, $query)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssssi", $name, $section, $student_no, $last_enrollment, $remarks, $date_of_release, $id);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'Record updated successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error executing update query.']);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error preparing query.']);
    }
}
?>
