<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $section = $_POST['section'];
    $student_no = $_POST['student_no'];
    $last_enrollment = $_POST['last_enrollment'];
    $remarks = $_POST['remarks'];
    $date_of_release = $_POST['date_of_release'];

    // Insert into the tbl_students table
    $query = "INSERT INTO tbl_students (name, section, student_no, last_enrollment, remarks, date_of_release) 
              VALUES ('$name', '$section', '$student_no', '$last_enrollment', '$remarks', '$date_of_release')";

    if (mysqli_query($connection, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}
?>
