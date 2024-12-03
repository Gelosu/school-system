<?php
// Start session

// Include database connection
require_once 'connect4.php';

// Fetch records from the filemanage table
$stmt = $pdo->query("SELECT id, name, description, path, dateuploaded FROM filemanage");
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Management</title>
    <!-- Include Bootstrap CSS for styling and modal -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">File Management</h2>
    <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#uploadModal">Upload File</button>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>File Name</th>
            <th>Description</th>
            <th>Path</th>
            <th>Date Uploaded</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($files as $file): ?>
            <tr>
                <td><?php echo htmlspecialchars($file['id']); ?></td>
                <td><?php echo htmlspecialchars($file['name']); ?></td>
                <td><?php echo htmlspecialchars($file['description']); ?></td>
                <td><?php echo htmlspecialchars($file['path']); ?></td>
                <td><?php echo htmlspecialchars($file['dateuploaded']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal for Upload Form -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="uploadForm" onsubmit="uploadFile(event)">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fileName">File Name</label>
                        <input type="text" class="form-control" id="fileName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="fileDescription">Description</label>
                        <textarea class="form-control" id="fileDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="filePath">Choose File</label>
                        <input type="file" class="form-control-file" id="filePath" name="file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
// JavaScript function to handle form submission
function uploadFile(event) {
    event.preventDefault(); // Prevent the default form submission

    // Collect form data
    const form = document.getElementById('uploadForm');
    const formData = new FormData(form);

    // Send the data using fetch
    fetch('FILEMANAGE/uploadfile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        alert('File uploaded successfully!');
        location.reload(); // Reload the page to see the updated table
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while uploading the file.');
    });
}
</script>
</body>
</html>
