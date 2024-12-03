<?php
include('../includes/connection.php');

// Fetch records from the table
$query = "SELECT * FROM tbl_lost_and_found ORDER BY id DESC";
$result = mysqli_query($connection, $query);

$output = '';
while ($row = mysqli_fetch_assoc($result)) {
    // Assuming 'photo' column contains the full URL to the image
    $imagePath = $row['photo'];  // Directly use the full URL stored in the database

    // Wrap the image in a link to allow users to view the full image
    $output .= '<tr>
                    <td>' . $row['item_name'] . '</td>
                    <td>' . $row['description'] . '</td>
                    <td>
                        <a href="' . $imagePath . '" target="_blank">
                            <img src="' . $imagePath . '" alt="Item Image" width="100">
                        </a> 
                    </td>  <!-- Display the image with a width of 100px and a link to view it in full size --> 
                    <td>' . $row['status'] . '</td>
                    <td>' . $row['dateadded'] . '</td>
                    <td>
                        <!-- Delete button, triggers deleteItem function via AJAX -->
                        <button class="btn btn-danger btn-sm" onclick="deleteItem(' . $row['id'] . ')">Delete</button>
                    </td>
                </tr>';
}

echo $output;
?>

<script>
// JavaScript function to handle the delete operation
function deleteItem(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'lostfound/deletelaf.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        // Send the ID of the record to delete
        xhr.send('id=' + id);
        
        // Handle the response
        xhr.onload = function () {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert(response.message);
                location.reload(); // Reload the page to reflect the changes
            } else {
                alert(response.message);
            }
        };
    }
}
</script>
