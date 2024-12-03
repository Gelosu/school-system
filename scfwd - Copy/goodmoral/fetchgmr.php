<?php
include('../includes/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch data based on ID
    $query = "SELECT * FROM tbl_students WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Return the data as JSON
        echo json_encode(['success' => true, 'data' => $row]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No record found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
}
?>
