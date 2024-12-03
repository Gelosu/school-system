<?php
// Include the database connection
require_once '../connect.php';

// Check if required data is passed through GET request
if (isset($_GET['file'], $_GET['name'], $_GET['domainAcc'])) {
    $file = $_GET['file'];
    $userName = $_GET['name'];
    $domainAcc = $_GET['domainAcc'];

    // Get the current date and time
    $dtAccess = date('Y-m-d H:i:s'); // Current timestamp

    // Insert download details into the accesslogs table
    $sql_insert = "INSERT INTO accesslogs (NAME, DOMAINACC, FILENAME, DTACCESS) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);

    if ($stmt_insert) {
        // Bind parameters
        $stmt_insert->bind_param("ssss", $userName, $domainAcc, $file, $dtAccess);

        // Execute the query
        if ($stmt_insert->execute()) {
            // Redirect to the file for download
            header("Location: $file");
            exit; // Ensure script stops after redirect
        } else {
            // Handle execution error
            error_log("Error inserting into accesslogs: " . $stmt_insert->error);
            echo "Error logging download: " . $stmt_insert->error;
        }

        // Close the statement
        $stmt_insert->close();
    } else {
        // Handle statement preparation error
        error_log("Error preparing SQL statement: " . $conn->error);
        echo "Error preparing SQL statement: " . $conn->error;
    }
} else {
    echo "Missing required parameters.";
}

// Close the database connection
$conn->close();
?>
