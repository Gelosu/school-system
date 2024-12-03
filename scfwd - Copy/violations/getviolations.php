<?php
include('../includes/connection.php');

$query = "SELECT v.*, vt.violation_name 
          FROM violations v 
          JOIN violation_types vt ON v.violation_type = vt.violation_type_id";
$result = $connection->query($query);

$output = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= '<tr id="violation-row-' . $row['id'] . '">
                        <td>' . htmlspecialchars($row['student_name']) . '</td>
                        <td>' . htmlspecialchars($row['section']) . '</td>
                        <td>' . htmlspecialchars($row['student_no']) . '</td>
                        <td>' . htmlspecialchars($row['violation_name']) . '</td>
                        <td>' . htmlspecialchars($row['description']) . '</td>
                        <td>' . htmlspecialchars($row['date']) . '</td>
                        <td>
                            <button class="btn btn-danger delete-violation" data-id="' . $row['id'] . '">Delete</button>
                        </td>
                    </tr>';
    }
} else {
    $output .= '<tr><td colspan="7">No records found</td></tr>';
}
echo $output;
?>
