<?php
// Include the database connection using MySQLi
$conn = new mysqli('127.0.0.1', 'root', '12345', 'studentsectiondb');

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in and fetch their domain account and name
if (isset($_SESSION['user'])) {
    $domainAcc = $_SESSION['user']; // Assuming DOMAINACC is stored in session

    // First query to fetch the NAME of the logged-in user based on DOMAINACC
    $sql_user = "SELECT NAME FROM studentaccs WHERE DOMAINACC = ?";
    if ($stmt_user = $conn->prepare($sql_user)) {
        $stmt_user->bind_param("s", $domainAcc); // Bind the parameter as string
        $stmt_user->execute();
        $stmt_user->bind_result($username); // Bind result to $username
        $stmt_user->fetch();
        $stmt_user->close();

        // If user is not found, set defaults
        if (!$username) {
            $username = 'Guest';
            $domainAcc = 'Not Available'; // Default if not found
        }
    } else {
        // Query preparation error
        $username = 'Guest';
        $domainAcc = 'Not Available';
    }
} else {
    $username = 'Guest';  // If not logged in
    $domainAcc = 'Not Available'; // If not logged in
}

// Second query to fetch files from the filemanage table
$sql_files = "SELECT id, name, description, path FROM filemanage";
$result_files = $conn->query($sql_files);

// Check if the query executed successfully
if ($result_files) {
    $files = $result_files->fetch_all(MYSQLI_ASSOC);
} else {
    $files = [];
    // Handle any errors related to the files query
    echo "Error fetching files: " . $conn->error;
}

// Close the connection when done
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #cccccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #ffffff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #cccccc;
            border-radius: 8px;
            width: 400px;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }
        .modal-body p {
            margin: 10px 0;
        }
        .modal-footer {
            text-align: right;
            margin-top: 20px;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>

<body>
<div class="container">
    
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name of the File</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($files as $file): ?>
    <tr>
        <td><?php echo htmlspecialchars($file['id']); ?></td>
        <td><?php echo htmlspecialchars($file['name']); ?></td>
        <td><?php echo htmlspecialchars($file['description']); ?></td>
        <td>
            <button 
                class="btn btn-primary open-modal" 
                data-file-id="<?php echo htmlspecialchars($file['id']); ?>" 
                data-file-name="<?php echo htmlspecialchars($file['name']); ?>" 
                data-file-description="<?php echo htmlspecialchars($file['description']); ?>" 
                data-file-path="<?php echo htmlspecialchars($file['path']); ?>"
                data-user-name="<?php echo htmlspecialchars($username); ?>"  
                data-domain-acc="<?php echo htmlspecialchars($domainAcc); ?>">  
                Open
            </button>
        </td>
    </tr>
<?php endforeach; ?>

        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="fileModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Do you want to download this file?</h3>
         
        </div>
        <div class="modal-body">
            <!--<p><strong>User Name:</strong> <span id="userName"></span></p> -->
            <!--<p><strong>Domain Account:</strong> <span id="domainAcc"></span></p> -->
            <p><strong>File Name:</strong> <span id="fileName"></span></p><!-- Display domain account -->
        </div>
        <div class="modal-footer">
            <a id="downloadButton" href="#" class="btn btn-primary" download>Download</a>
            <button class="btn btn-secondary close">Close</button>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.open-modal').forEach(button => {
    button.addEventListener('click', function () {
        
        const fileName = this.getAttribute('data-file-name');
   
        const filePath = this.getAttribute('data-file-path');
        const userName = this.getAttribute('data-user-name'); // Get user name
        const domainAcc = this.getAttribute('data-domain-acc'); // Get domain account
        //document.getElementById('userName').textContent = userName; // Set user name in modal
      //  document.getElementById('domainAcc').textContent = domainAcc; // Set domain account in modal
        document.getElementById('fileName').textContent = fileName;
        document.getElementById('downloadButton').setAttribute('href', 'STUDACTS/sendaccess.php?file=' + encodeURIComponent(filePath) + '&name=' + encodeURIComponent(userName) + '&domainAcc=' + encodeURIComponent(domainAcc));

        document.getElementById('fileModal').style.display = 'block';
    });
});

document.querySelectorAll('.close').forEach(close => {
    close.addEventListener('click', function () {
        document.getElementById('fileModal').style.display = 'none';
    });
});

window.addEventListener('click', function (event) {
    if (event.target == document.getElementById('fileModal')) {
        document.getElementById('fileModal').style.display = 'none';
    }
});

</script>
</body>
</html>
