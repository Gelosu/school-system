<?php
// Include database connection
require_once 'connect4.php';

try {
    // Fetch all students from the database
    $stmt = $pdo->query("SELECT * FROM studentaccs ORDER BY DATECREATED DESC");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as an associative array
} catch (Exception $e) {
    // Handle any errors
    $students = []; // Initialize as an empty array if there's an error
    error_log("Error fetching students: " . $e->getMessage());
}
?>


<!-- Modal for Registering a New Student -->
<div class="modal fade" id="registerStudentModal2" tabindex="-1" role="dialog" aria-labelledby="registerStudentModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="registrationForm2">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerStudentModalLabel2">Register New Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="middleinitial">Middle Initial</label>
                        <input type="text" class="form-control" id="middleinitial" name="middleinitial">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" class="form-control" id="course" name="course" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" id="year" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <input type="text" class="form-control" id="section" name="section" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
                        <small id="passwordMatchMessage" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submitButton2" disabled onclick="submitStudentRegistration()">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Register Button Only -->
<div class="container">
    <h2 class="mt-4">Student Accounts</h2>
   
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#registerStudentModal2">Register</button>
    </div>

    <table class="table table-bordered mt-3" id="studentsTable">
        <thead class="thead-dark">
            <tr>
                
                <th>Name</th>
                <th>Section</th>
                <th>Course</th>
                <th>Email</th>
                <th>Domain Account</th>
                <th>PASSWORD</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)): ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        
                        <td><?= htmlspecialchars($student['NAME']) ?></td>
                        <td><?= htmlspecialchars($student['SECTION']) ?></td>
                        <td><?= htmlspecialchars($student['COURSE']) ?></td>
                        <td><?= htmlspecialchars($student['EMAIL']) ?></td>
                        <td><?= htmlspecialchars($student['DOMAINACC']) ?></td>
                        <td>*********</td>
                        <td><?= htmlspecialchars($student['DATECREATED']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No student records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<style>
    /* Custom styles for the modal */
    .modal-header {
        background-color: #007bff;
        color: #fff;
    }
    .modal-content {
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    }
    .modal-title {
        font-weight: bold;
    }
    .modal-footer {
        justify-content: center;
    }
    #registerStudentModal .form-control {
        border-radius: 5px;
    }
    #submitButton {
        width: 100%;
    }
    /* Custom table styling */
    .table th, .table td {
        text-align: center;
    }
</style>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.all.min.js"></script>
<script>
    // Password validation logic
    function validatePassword() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmpassword').value;
        const message = document.getElementById('passwordMatchMessage');
        const submitButton = document.getElementById('submitButton2');

        if (password === confirmPassword) {
            message.textContent = "Passwords match.";
            message.style.color = "green";
            submitButton.disabled = false;
            return true;
        } else {
            message.textContent = "Passwords do not match.";
            message.style.color = "red";
            submitButton.disabled = true;
            return false;
        }
    }

    document.getElementById('password').addEventListener('input', validatePassword);
    document.getElementById('confirmpassword').addEventListener('input', validatePassword);

    // Submit registration form
    function submitStudentRegistration() {
        const form = document.getElementById("registrationForm2");
        const formData = new FormData(form);

        // Display loading SweetAlert
        Swal.fire({
            title: "Submitting...",
            text: "Please wait while we process your request.",
            icon: "info",
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        // Submit the form data using fetch
        fetch("STUDENTREG/registration.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json()) // Expect JSON response from server
            .then((data) => {
                Swal.close(); // Close the loading alert

                if (data.success) {
                    // Success SweetAlert
                    Swal.fire({
                        title: "Success",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK",
                    }).then(() => {
                        location.reload(); // Reload the page to show updated data
                    });
                } else {
                    // Error SweetAlert
                    Swal.fire({
                        title: "Error",
                        text: data.message,
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            })
            .catch((error) => {
                Swal.close(); // Close the loading alert
                
            });
    }
</script>