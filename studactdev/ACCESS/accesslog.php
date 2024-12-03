<?php
// Include database connection
require_once 'connect2.php';

try {
    $sql = "SELECT * FROM accesslogs";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $accessLogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $accessLogs = [];
    error_log("Error fetching access logs: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Filter Form -->
        <div class="d-flex justify-content-between mb-3">
        <input type="text" class="form-control w-50" id="searchInput2" placeholder="Search..." onkeyup="filterTable()">
        <select class="form-control w-25" id="monthFilter2" onchange="filterTable()">
            <option value="">Select Month</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>

        <select class="form-control w-25" id="yearFilter2" onchange="filterTable()">
            <option value="">Select Year</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
        </select>
        </div>

        <!-- Access Logs Table -->
        <table class="table table-bordered" id="logsTable">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Domain Account</th>
                    <th>File Name</th>
                    <th>Access Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($accessLogs) > 0): ?>
                    <?php foreach ($accessLogs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['id']) ?></td>
                            <td><?= htmlspecialchars($log['NAME']) ?></td>
                            <td><?= htmlspecialchars($log['DOMAINACC']) ?></td>
                            <td><?= htmlspecialchars($log['FILENAME']) ?></td>
                            <td><?= date('Y-m-d', strtotime($log['DTACCESS'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
   function filterTable() {
        const searchInput = document.getElementById("searchInput2").value.toLowerCase();
        const monthFilter = document.getElementById("monthFilter2").value;
        const yearFilter = document.getElementById("yearFilter2").value;

        const rows = document.querySelectorAll("#logsTable tbody tr");

        rows.forEach(row => {
            const name = row.children[1].textContent.toLowerCase();
            const dateCreated = row.children[4].textContent;
            const [dateYear, dateMonth] = dateCreated.split('-');

            const matchesSearch = name.includes(searchInput);
            const matchesMonth = !monthFilter || dateMonth === monthFilter;
            const matchesYear = !yearFilter || dateYear === yearFilter;

            row.style.display = matchesSearch && matchesMonth && matchesYear ? "" : "none";
        });
    }
    </script>
</body>
</html>
