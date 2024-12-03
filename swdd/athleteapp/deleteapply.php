<?php
// Include the database connection file
include('../includes/connection2.php');

// Check if the ID is set in the GET request
if (isset($_GET['ids'])) {
    $id = intval($_GET['ids']); // Get the ID from the GET parameter

    try {
        // Prepare the DELETE query
        $delete_query = "DELETE FROM sportdb WHERE id = :id";
        
        // Prepare the statement
        $stmt = $pdo->prepare($delete_query);
        
        // Bind the ID parameter to the query
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Execute the query
        if ($stmt->execute()) {
            echo "Application successfully deleted!";
        } else {
            echo "Error: Could not delete the record.";
        }
    } catch (PDOException $e) {
        // Catch any exceptions and display the error
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
