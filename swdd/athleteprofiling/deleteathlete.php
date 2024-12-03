<?php
include('../includes/connection.php');

if (isset($_GET['ids'])) {
    $athlete_id = mysqli_real_escape_string($connection, $_GET['ids']);
    
    // Delete query
    $query = "DELETE FROM tbl_athletes WHERE id = '$athlete_id'";
    
    if (mysqli_query($connection, $query)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
} else {
    echo "Invalid request.";
}
?>
