<?php
// Include database connection
require_once '../connect4.php';

// Check if the necessary POST data is provided
if (isset($_POST['action']) && isset($_POST['orgId']) && isset($_POST['date'])) {
    $action = $_POST['action'];
    $orgId = $_POST['orgId'];
    $date = $_POST['date'];

    // Handle APPROVE action
    if ($action === 'approve') {
        try {
            // Update status to APPROVE
            $stmt = $pdo->prepare("UPDATE studorg SET STATUS = 'APPROVE', ENROLLED_DATE = ? WHERE id = ?");
            $stmt->execute([$date, $orgId]);

            echo json_encode(['success' => true, 'message' => 'Organization approved successfully.']);
        } catch (Exception $e) {
            error_log("Error approving organization: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Failed to approve organization.']);
        }
    }

    // Handle DISAPPROVE action
    if ($action === 'disapprove' && isset($_POST['reason'])) {
        $reason = $_POST['reason'];

        try {
            // Update status to DISAPPROVE and add reason
            $stmt = $pdo->prepare("UPDATE studorg SET STATUS = 'DISAPPROVE', ENROLLED_DATE = ?, REASON = ? WHERE id = ?");
            $stmt->execute([$date, $reason, $orgId]);

            echo json_encode(['success' => true, 'message' => 'Organization disapproved successfully.']);
        } catch (Exception $e) {
            error_log("Error disapproving organization: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Failed to disapprove organization.']);
        }
    }
}
?>
