<?php
// Include database connection
require_once '../connect4.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $dateUploaded = date('Y-m-d'); // Current date

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $uploadDir = 'uploads/';  // Path relative to the server document root

        // Check if the target directory exists, and create it if it doesn't
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory with proper permissions
        }

        // Construct the file path and URL
        $filePath = $uploadDir . basename($fileName); // File path on the server
        $fileUrl = 'http://localhost/KLDSUPERADMIN/FILEMANAGE/' . $filePath; // Full URL to the file

        // Move the uploaded file to the target directory
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            // Insert data into the database (saving the URL to the file)
            $stmt = $pdo->prepare("INSERT INTO filemanage (name, description, path, dateuploaded) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $description, $fileUrl, $dateUploaded]);

            header('Location: filemanagement.php');
            exit();
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "Error uploading the file.";
    }
}
?>
