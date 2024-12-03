<?php
// Include database connection
require_once 'connect2.php';

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

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.all.min.js"></script>

<style>
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
    .table th, .table td {
        text-align: center;
    }
</style>

<!-- Search and Filter Section -->
<div class="container">
    <h2 class="mt-4">Student Organizations</h2>

    <div class="d-flex justify-content-between mb-3">
        <input type="text" class="form-control w-50" id="searchInput" placeholder="Search by name or email..." onkeyup="filterTable()">
        <select class="form-control w-25" id="monthFilter" onchange="filterTable()">
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

        <select class="form-control w-25" id="yearFilter" onchange="filterTable()">
            <option value="">Select Year</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
        </select>

        <button class="btn btn-primary" data-toggle="modal" data-target="#registerStudentModal">Register</button>
    </div>

    <table class="table table-bordered mt-3" id="studentsTable">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>   
                <th>Status</th>
                <th>Enrolled Date</th>
                <th>ACTION</th>
            </tr>
        </thead>
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
</div>

<!-- Modal for Registering a New Student -->
<div class="modal fade" id="registerStudentModal" tabindex="-1" role="dialog" aria-labelledby="registerStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="registrationForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerStudentModalLabel">Register New Organization</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="orgname">Organization Name</label>
                        <input type="text" class="form-control" id="orgname" name="orgname" required>
                    </div>

                    <div class="form-group">
                        <label for="checklist">Checklist</label><br>
                        <?php if (!empty($fileNames)): ?>
                            <?php foreach ($fileNames as $file): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="checklist[]" value="<?= htmlspecialchars($file['name']) ?>" id="checklist_<?= htmlspecialchars($file['name']) ?>">
                                    <label class="form-check-label" for="checklist_<?= htmlspecialchars($file['name']) ?>">
                                        <?= htmlspecialchars($file['name']) ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No checklist items available.</p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="Subject for Approval" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submitButton" onclick="submitOrganizationRegistration()">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Disapproval Reason -->
<div class="modal fade" id="disapproveModal" tabindex="-1" role="dialog" aria-labelledby="disapproveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="disapproveForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="disapproveModalLabel">Reason for Disapproval</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="disapproveReason">Reason</label>
                        <textarea class="form-control" id="disapproveReason" name="disapproveReason" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="disapproveOrgId" name="orgId">
                    <button type="button" class="btn btn-primary" onclick="submitDisapproval()">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function filterTable() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const monthFilter = document.getElementById("monthFilter").value;
        const yearFilter = document.getElementById("yearFilter").value;

        const rows = document.querySelectorAll("#studentsTable tbody tr");

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

    function submitOrganizationRegistration() {
    const form = document.getElementById("registrationForm");
    const formData = new FormData(form);
    
    // Get all checklist items (checkboxes)
    const checklistItems = document.querySelectorAll('input[name="checklist[]"]');
    
    // Check if all checklist items are checked
    let allChecked = true;
    checklistItems.forEach(item => {
        if (!item.checked) {
            allChecked = false; // If any item is not checked, set allChecked to false
        }
    });

    // Update the status field based on whether all items are checked
    const statusField = document.getElementById("status");
    if (allChecked) {
        statusField.value = "Approve"; // Change status to "Approve" if all checkboxes are checked
    } else {
        statusField.value = "Pending"; // Keep status as "Pending" if any checkbox is unchecked
    }
    
    // Proceed with the AJAX request to submit the form
    $.ajax({
        url: 'ORGREG/studorgreg.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response); // Log the response
            const jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
                Swal.fire("Success", jsonResponse.message, "success");
                location.reload(5000);
            } else {
                Swal.fire("Error", jsonResponse.message, "error");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + error); // Log any AJAX error
            Swal.fire("Error", "There was an error with the request. Please try again.", "error");
        }
    });
}

// Function to approve the organization
function approveOrganization(orgId) {
    // Show confirmation before proceeding
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to approve this organization?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, approve it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send an AJAX request to update the status to 'Approved'
            $.ajax({
                url: 'ORGREG/update_status.php',  // The PHP file that handles the update
                type: 'POST',
                data: {
                    id: orgId,
                    status: 'Approved'
                },
                success: function(response) {
                    console.log("Response from server (Approve):", response);  // Log the raw response
                    try {
                        const jsonResponse = JSON.parse(response);
                        if (jsonResponse.success) {
                            Swal.fire("Success", "Organization approved successfully!", "success");
                            // Call refreshTable to update the table content
                            refreshTable();
                        } else {
                            Swal.fire("Error", "There was an issue with approving the organization. Please try again.", "error");
                        }
                    } catch (e) {
                        Swal.fire("Error", "Unexpected error occurred. Please try again.", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error (Approve):", error);
                    Swal.fire("Error", "There was an error updating the status. Please try again.", "error");
                }
            });
        }
    });
}

// Open the Disapprove Modal
function disapproveOrganization(orgId) {
    $('#disapproveModal').modal('show');  // Show the disapproval modal
    document.getElementById("disapproveOrgId").value = orgId;  // Set the organization ID in the hidden input
}

// Submit the disapproval action
function submitDisapproval() {
    const orgId = document.getElementById("disapproveOrgId").value;
    const reason = document.getElementById("disapproveReason").value;

    // Check if the reason is provided
    if (!reason) {
        Swal.fire("Error", "Please provide a reason for disapproval.", "error");
        return;
    }

    // Send the reason and status update to the server
    $.ajax({
        url: 'ORGREG/update_status.php',  // The PHP file that handles the update
        type: 'POST',
        data: {
            id: orgId,
            status: 'Disapproved',
            reason: reason
        },
        success: function(response) {
            console.log("Response from server (Disapprove):", response);  // Log the raw response
            try {
                const jsonResponse = JSON.parse(response);
                if (jsonResponse.success) {
                    Swal.fire("Success", "Organization disapproved successfully!", "success");
                    // Close the modal
                    $('#disapproveModal').modal('hide');
                    // Call refreshTable to update the table content
                    refreshTable();
                } else {
                    Swal.fire("Error", "There was an issue with disapproving the organization. Please try again.", "error");
                }
            } catch (e) {
                Swal.fire("Error", "Unexpected error occurred. Please try again.", "error");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error (Disapprove):", error);
            Swal.fire("Error", "There was an error updating the status. Please try again.", "error");
        }
    });
}

// Function to refresh the table after approval/disapproval
function refreshTable() {
    $.ajax({
        url: 'ORGREG/fetchstudorg.php', // Path to fetch the updated table
        type: 'GET',
        success: function(response) {
            // Update the content of the table body with the fetched data
            $('#studentsTable tbody').html(response);
        },
        error: function(xhr, status, error) {
            alert('Error fetching updated table data');
        }
    });
}

</script>
