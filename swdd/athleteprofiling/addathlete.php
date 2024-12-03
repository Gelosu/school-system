<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and capture form data
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $section = mysqli_real_escape_string($connection, $_POST['section']);
    $sports = mysqli_real_escape_string($connection, $_POST['sports']);
    $coach = mysqli_real_escape_string($connection, $_POST['coach']);
    $student_number = mysqli_real_escape_string($connection, $_POST['student_number']);
    
    // Define the upload directory (relative path)
    $targetDir = "uploads/";

    // Check if the directory exists, if not, create it
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
    }

    // Handle file upload
    $fileName = basename($_FILES["picture"]["name"]);
    $targetFile = $targetDir . $fileName;

    // Define the full URL path for the picture (this will be saved in the database)
    $fileUrl = "http://localhost/swdd/athleteprofiling/" . $targetFile;
    
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
        // Insert data into the database
        $sql = "INSERT INTO tbl_athletes (name, section, student_no, sports, coach, picture) 
                VALUES ('$name', '$section', '$student_number', '$sports', '$coach', '$fileUrl')";
        
        if (mysqli_query($connection, $sql)) {
            echo "Student athlete added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
