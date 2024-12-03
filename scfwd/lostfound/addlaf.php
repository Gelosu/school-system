<?php
session_start();
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data
    $item_name = mysqli_real_escape_string($connection, $_POST['item_name']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
    $dateadded = date('Y-m-d H:i:s');  // Current timestamp

    // Initialize variable to store photo info
    $photo_url = null;

    // Define the upload directory
    $upload_dir = 'uploads/lost_and_found_images/';

    // Check if the directory exists, if not, create it
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true); // 0777 sets the permissions to allow read/write/execute
    }

    // Check if an image is uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $file_name = $_FILES['photo']['name'];
        $file_tmp_name = $_FILES['photo']['tmp_name'];
        $file_size = $_FILES['photo']['size'];
        $file_error = $_FILES['photo']['error'];

        // Validate the uploaded file type (allow only image files)
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($file_ext, $allowed_extensions)) {
            // Generate a unique name for the image to avoid overwriting
            $unique_file_name = time() . '_' . basename($file_name);
            $target_file_path = $upload_dir . $unique_file_name;

            // Move the uploaded file to the designated directory
            if (move_uploaded_file($file_tmp_name, $target_file_path)) {
                // Create the full URL for the photo
                $photo_url = 'http://localhost/scfwd/lostfound/' . $target_file_path;  // Add the base URL
            } else {
                echo json_encode(['success' => false, 'message' => 'Error uploading the image']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid file type. Only images are allowed']);
            exit;
        }
    }

    // Check if a photo URL is set
    if ($photo_url === null) {
        echo json_encode(['success' => false, 'message' => 'No photo uploaded']);
        exit;
    }

    // SQL query to insert data into the tbl_lost_and_found table
    $query = "INSERT INTO tbl_lost_and_found (item_name, description, status, photo, dateadded) 
              VALUES ('$item_name', '$description', '$status', '$photo_url', '$dateadded')";

    if (mysqli_query($connection, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add item']);
    }
}
?>
