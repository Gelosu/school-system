<?php
session_start();
include('../includes/connection.php');

// Check if all required fields are set
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['student_no'])) {
    $student_name = $_POST['student_name'];
    $section = $_POST['section'];
    $student_no = $_POST['student_no'];
    $violation_type = $_POST['violation_type'];
    $description = $_POST['description'];
    $actionstaken = $_POST['actionstaken'];
    $date = $_POST['date'];

    // Insert the violation into the violations table
    $stmt = $connection->prepare("INSERT INTO violations (student_name, section, student_no, violation_type, description, actionstaken, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $student_name, $section, $student_no, $violation_type, $description, $actionstaken, $date);
    $stmt->execute();

    // Get the count of violations for the student
    $countQuery = "SELECT COUNT(*) AS violation_count FROM violations WHERE student_no = ?";
    $countStmt = $connection->prepare($countQuery);
    $countStmt->bind_param("s", $student_no);
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $countRow = $countResult->fetch_assoc();
    $violationCount = $countRow['violation_count'];

    // If the violation count reaches 3, insert into kickouts table
    if ($violationCount >= 3) {
        // Get the violation list
        $violationListQuery = "SELECT violation_name FROM violations v JOIN violation_types vt ON v.violation_type = vt.violation_type_id WHERE student_no = ?";
        $violationListStmt = $connection->prepare($violationListQuery);
        $violationListStmt->bind_param("s", $student_no);
        $violationListStmt->execute();
        $violationListResult = $violationListStmt->get_result();
        $violations = [];
        while ($violationRow = $violationListResult->fetch_assoc()) {
            $violations[] = $violationRow['violation_name'];
        }
        $violationListJson = json_encode($violations);

        // Insert into kickouts table
        $kickoutStmt = $connection->prepare("INSERT INTO kickouts (student_name, section, student_no, violationlist, datekickout) VALUES (?, ?, ?, ?, NOW())");
        $kickoutStmt->bind_param("ssss", $student_name, $section, $student_no, $violationListJson);
        $kickoutStmt->execute();
    }

    echo json_encode(['success' => true, 'message' => 'Violation added successfully.']);
}
?>
