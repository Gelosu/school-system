
<?php
// Include database connection
require_once '../connect2.php';

try {
    // Fetch all students from the studorg table
    $stmt = $pdo->query("SELECT * FROM studorg ORDER BY ENROLLED_DATE DESC");
    $studorgs = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as an associative array
} catch (Exception $e) {
    // Handle any errors
    $studorgs = []; // Initialize as an empty array if there's an error
    error_log("Error fetching studorgs: " . $e->getMessage());
}

try {
    // Fetch names from filemanage table
    $fileStmt = $pdo->query("SELECT name FROM filemanage");
    $fileNames = $fileStmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as an associative array
} catch (Exception $e) {
    $fileNames = [];
    error_log("Error fetching filemanage data: " . $e->getMessage());
}
?>
<table class="table table-bordered mt-3" id="studentsTable">
   
    <tbody>
        <?php if (!empty($studorgs)): ?>
            <?php foreach ($studorgs as $org): ?>
                <tr>
                    <td><?= htmlspecialchars($org['id']) ?></td>
                    <td><?= htmlspecialchars($org['NAME']) ?></td>
                    <td><?= htmlspecialchars($org['STATUS']) ?></td>
                    <td><?= htmlspecialchars($org['ENROLLED_DATE']) ?></td>
                    <td>
                        <button class="btn btn-success" onclick="approveOrganization(<?= htmlspecialchars($org['id']) ?>)">Approve</button>
                        <button class="btn btn-danger" onclick="disapproveOrganization(<?= htmlspecialchars($org['id']) ?>)">Disapprove</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No student organization found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
