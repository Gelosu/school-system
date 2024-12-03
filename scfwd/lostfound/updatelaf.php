<?php
include('../includes/connection.php');

if(isset($_POST['laf_id'])) {
    $laf_id = $_POST['laf_id'];
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Update the record
    $query = "UPDATE lost_and_found SET item_name = ?, description = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $item_name, $description, $status, $laf_id);
    
    if($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Record updated successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update record.']);
    }
}
?>
