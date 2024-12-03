<?php
require_once '../connect2.php';

$search = isset($_POST['search']) ? trim($_POST['search']) : '';
$month = isset($_POST['month']) ? trim($_POST['month']) : '';
$year = isset($_POST['year']) ? trim($_POST['year']) : '';

try {
    $sql = "SELECT * FROM accesslogs WHERE 1=1";

    // Dynamically build the query based on filters
    if (!empty($search)) {
        $sql .= " AND (NAME LIKE :search OR DOMAINACC LIKE :search OR FILENAME LIKE :search)";
    }
    if (!empty($month)) {
        $sql .= " AND MONTH(DTACCESS) = :month";
    }
    if (!empty($year)) {
        $sql .= " AND YEAR(DTACCESS) = :year";
    }

    $stmt = $pdo->prepare($sql);

    // Bind parameters
    if (!empty($search)) {
        $stmt->bindValue(':search', "%$search%");
    }
    if (!empty($month)) {
        $stmt->bindValue(':month', $month, PDO::PARAM_INT);
    }
    if (!empty($year)) {
        $stmt->bindValue(':year', $year, PDO::PARAM_INT);
    }

    $stmt->execute();
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($logs); // Return data as JSON
} catch (Exception $e) {
    echo json_encode([]);
    error_log("Error fetching filtered logs: " . $e->getMessage());
}
