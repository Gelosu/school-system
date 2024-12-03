<?php
session_start();
include('includes/connection.php');

if (isset($_POST['ids'])) {
    $id = mysqli_real_escape_string($connection, $_POST['ids']);
    $delete_query = mysqli_query($connection, "DELETE FROM tbl_students WHERE id='$id'");

    if ($delete_query) {
        // Return a success response
        echo json_encode(['success' => true]);
    } else {
        // Return an error response
        echo json_encode(['success' => false, 'message' => mysqli_error($connection)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No ID provided.']);
}
?>