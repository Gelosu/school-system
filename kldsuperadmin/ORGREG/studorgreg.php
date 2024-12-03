<?php
// Include database connection
require_once '../connect4.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $orgname = $_POST['orgname'];
        $status = $_POST['status'];
        
        // Handle checklist data: if no checklist selected, set as empty JSON array
        $checklist = isset($_POST['checklist']) ? json_encode($_POST['checklist']) : '[]'; // Convert to JSON

        // Get the current date and time for ENROLLED_DATE
        $enrolledDate = date('Y-m-d H:i:s'); // Current date and time in the correct format

        // Insert the new organization into the studorg table
        $stmt = $pdo->prepare("INSERT INTO studorg (NAME, CHECKLIST, STATUS, ENROLLED_DATE) VALUES (:orgname, :checklist, :status, :enrolledDate)");
        $stmt->execute([
            ':orgname' => $orgname,
            ':checklist' => $checklist,
            ':status' => $status,
            ':enrolledDate' => $enrolledDate
        ]);

        // Return success response
        echo json_encode(['success' => true, 'message' => 'Organization registered successfully']);
    } catch (Exception $e) {
        // Handle error
        echo json_encode(['success' => false, 'message' => 'Error registering organization: ' . $e->getMessage()]);
    }
}
?>
