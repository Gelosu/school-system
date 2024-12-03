<?php
include('../includes/connection.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Sanitize the input
    $id = $connection->real_escape_string($id);

    // Fetch the image path before deletion
    $query = "SELECT photo FROM tbl_lost_and_found WHERE id = '$id'";
    $result = $connection->query($query);
    $row = $result->fetch_assoc();

    if ($row) {
        // Get the image file path from the database
        $imagePath = $row['photo'];

        // Delete the image file from the server if it exists
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the record from the database
        $deleteQuery = "DELETE FROM tbl_lost_and_found WHERE id = '$id'";
        if ($connection->query($deleteQuery)) {
            $response = [
                'success' => true,
                'message' => 'Record and image deleted successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error deleting record: ' . $connection->error
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'Record not found.'
        ];
    }

    // Return a JSON response
    echo json_encode($response);
} else {
    // If no ID is passed
    $response = [
        'success' => false,
        'message' => 'Invalid request.'
    ];
    echo json_encode($response);
}
?>
