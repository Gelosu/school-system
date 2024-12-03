<?php
// Start session
// Include the database connection
require_once 'connect2.php';

// Fetch the lost and found items
$query = "SELECT * FROM tbl_lost_and_found";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welfare Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Your CSS File -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
</head>
<body>
    <div class="container">
        <h2>Lost and Found Items</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Date Added</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td>
    <a href="<?php echo htmlspecialchars($row['photo']); ?>" target="_blank">
        <img src="<?php echo htmlspecialchars($row['photo']); ?>" alt="Item Image" width="100">
    </a>
</td>

                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><?php echo htmlspecialchars($row['dateadded']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No lost and found items available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Button to request Good Moral Certificate -->
        <button type="button" class="btn-primary" id="openModalBtn">
            Request Good Moral Certificate
        </button>

        <!-- Modal for Good Moral Certificate Request -->
        <div id="addGmrModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h5 class="modal-title">Add Good Moral Request</h5>
                </div>
                <form id="gmcForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="section">Section</label>
                            <input type="text" class="form-control" id="section" name="section" required>
                        </div>
                        <div class="form-group">
                            <label for="studentNo">Student No.</label>
                            <input type="text" class="form-control" id="studentNo" name="student_no" required>
                        </div>
                        <div class="form-group">
                            <label for="lastEnrollment">Last Enrollment</label>
                            <input type="date" class="form-control" id="lastEnrollment" name="last_enrollment" required>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="dateOfRelease">Date of Release</label>
                            <input type="text" class="form-control" id="dateOfRelease" name="date_of_release" value="Go to the guidance to know release date" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" id="closeModalBtn">Close</button>
                        <button type="submit" class="btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Open Modal
        document.getElementById('openModalBtn').addEventListener('click', function() {
            document.getElementById('addGmrModal').style.display = 'block';
        });

        // Close Modal
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('addGmrModal').style.display = 'none';
        });

        document.querySelector('.close').addEventListener('click', function() {
            document.getElementById('addGmrModal').style.display = 'none';
        });

        // Handle form submission via AJAX
        $(document).ready(function() {
            $("#gmcForm").submit(function(e) {
                e.preventDefault();  // Prevent form from submitting the usual way

                // Serialize the form data
                var formData = $(this).serialize();

                // Send the data to gmcreq.php using AJAX
                $.ajax({
                    type: "POST",
                    url: "WELFARE/gmcreq.php",  // File handling the form submission
                    data: formData,
                    success: function(response) {
                        alert("Good Moral Certificate request submitted successfully!");
                        $('#addGmrModal').hide();
                        $('#gmcForm')[0].reset();  // Reset form fields
                    },
                    error: function() {
                        alert("Error in submitting the request.");
                    }
                });
            });
        });
    </script>

    <style>
        /* Modal styles */
      /* Basic container for the form */
.modal-content {
    border-radius: 10px;
    background-color: #f8f9fa;
    padding: 20px;
}

/* Form-group styling */
.form-group {
    margin-bottom: 1.5rem;
}

/* Label styling */
.form-group label {
    font-size: 16px;
    font-weight: bold;
    color: #495057;
}

/* Input field styling */
.form-group input, 
.form-group textarea {
    width: 50%;
    padding: 15px;

    border: 1px solid #ced4da;
    border-radius: 5px;
    
    height: 12px;
}

/* Input and textarea focus styling */
.form-group input:focus, 
.form-group textarea:focus {
    border-color: black;
    
}

/* Date input styling */
.form-group input[type="date"] {
    padding: 0.75rem;
    font-size: 1rem;
}

/* Textarea styling */
.form-group textarea {
    height: 30px;
    resize: vertical;
}

/* Button styling inside the modal */
.modal-footer button {
    font-size: 1rem;
    padding: 0.75rem 1.5rem;
    border-radius: 5px;
}

/* Button styling for save button */
.modal-footer .btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

.modal-footer .btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

/* Button styling for close button */
.modal-footer .btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

.modal-footer .btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}




    </style>
</body>
</html>
