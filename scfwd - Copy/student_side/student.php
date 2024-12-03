<?php
session_start();
include('includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $section = mysqli_real_escape_string($connection, $_POST['section']);
    $student_no = mysqli_real_escape_string($connection, $_POST['student_no']);
    $last_enrollment = mysqli_real_escape_string($connection, $_POST['last_enrollment']);
    $remarks = mysqli_real_escape_string($connection, $_POST['remarks']);
    $date_of_release = mysqli_real_escape_string($connection, $_POST['date_of_release']);

    // Insert data into the database
    $insert_query = "INSERT INTO tbl_students (name, section, student_no, last_enrollment, remarks, date_of_release) 
                     VALUES ('$name', '$section', '$student_no', '$last_enrollment', '$remarks', '$date_of_release')";
    
    if (mysqli_query($connection, $insert_query)) {
        // Redirect to dashboard.php
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Student Information Form</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="section">Section</label>
            <input type="text" class="form-control" id="section" name="section" required>
        </div>
        <div class="form-group">
            <label for="student_no">Student No.</label>
            <input type="text" class="form-control" id="student_no" name="student_no" required>
        </div>
        <div class="form-group">
            <label for="last_enrollment">Last Enrollment</label>
            <input type="text" class="form-control" id="last_enrollment" name="last_enrollment" required>
        </div>
        <div class="form-group">
            <label for="remarks">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" required></textarea>
        </div>
        <div class="form-group">
            <label for="date_of_release">Date of Release</label>
            <input type="date" class="form-control" id="date_of_release" name="date_of_release" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>