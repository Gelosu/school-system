<?php
require_once '../connect2.php'; // Include guidance database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $newPassword = $_POST['new_password'] ?? null;

    if ($id && $newPassword) {
        try {
            $query = "UPDATE tbl_employee SET password = :new_password WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':new_password' => $newPassword, ':id' => $id]);
            echo json_encode(['status' => 'success', 'message' => 'Password updated for Admin']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data provided']);
    }
}