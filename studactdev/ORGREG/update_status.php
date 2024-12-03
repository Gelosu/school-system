<?php
require_once '../connect2.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    try {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $reason = isset($_POST['reason']) ? $_POST['reason'] : null;  // Reason for disapproval (optional)

        // Get the current date
        $date = date('Y-m-d H:i:s');
        $statusMessage = '';

        if ($status === 'Disapproved' && $reason) {
            // Construct the message for disapproval
            $statusMessage = "DISAPPROVE at $date due to $reason";
        } else if ($status === 'Approved') {
            // Construct the message for approval
            $statusMessage = "APPROVE at $date";
        }

        // Update status message and enrollment date
        $stmt = $pdo->prepare("UPDATE studorg SET STATUS = :status, ENROLLED_DATE = :date WHERE id = :id");
        $stmt->execute(['status' => $statusMessage, 'date' => $date, 'id' => $id]);

        echo json_encode(['success' => true, 'message' => 'Status updated successfully!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error updating status.']);
    }
}
?>
