<?php
include('../includes/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM lost_and_found WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($record) {
        echo json_encode(['success' => true, 'id' => $record['id'], 'item_name' => $record['item_name'], 'description' => $record['description'], 'status' => $record['status']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Record not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
