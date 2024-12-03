<?php
include('../includes/connection.php');

if (isset($_POST['violation_id'])) {
    $violation_id = $_POST['violation_id'];
    
    // Sanitize the input
    $violation_id = $connection->real_escape_string($violation_id);

    // Delete query
    $query = "DELETE FROM violations WHERE id = '$violation_id'";
    if ($connection->query($query)) {
        $response = ['success' => true, 'message' => 'Violation deleted successfully.'];
    } else {
        $response = ['success' => false, 'message' => 'Error deleting violation: ' . $connection->error];
    }

    echo json_encode($response);
}
?>
