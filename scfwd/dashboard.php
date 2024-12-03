<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>

<head>
    <style>
        .sidebar-menu li.active a {
            color: #009900;
            background-color: #ffffff;
        }

        #chat-overlay {
            display: none; /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8); /* Dark background */
            z-index: 1000; /* Ensure it's above other elements */
        }

        #chat-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        #close-chat {
            position: absolute;
            margin-top: 35px;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }

        #close-chat:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active">
                    <a href="dashboard.php"><i class="fa fa-file-text-o"></i> <span>Good Moral</span></a>
                </li>
                <li>
                        <a href="javascript:void(0);" onclick="loadChatSystem()">
                            <i class="fa fa-comments"></i> 
                            <span>Chat</span>
                        </a>
                    </li>
                <li>
                    <a href="laf.php"><i class="fa fa-list-ul"></i> <span>Lost and Found</span></a>
                </li>
                
                <li>
                    <a href="violations.php"><i class="fa fa-exclamation-triangle"></i> <span>Violations</span></a>
                </li>
                <li><a href="kickouts.php"><i class="fa fa-ban"></i> <span>List of Kickouts</span></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Good Moral Requests</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
            <button class="btn btn-success btn-rounded float-right" data-toggle="modal" data-target="#addGmrModal">
            <i class="fa fa-plus"></i> Add
        </button>
    </div>
</div>

<!-- Modal Structure -->
<div id="addGmrModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addGmrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGmrModalLabel">Add Good Moral Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addGmrForm">
                <div class="modal-body">
                    <!-- Form Fields -->
                    <input type="hidden" id="gmrId" name="gmr_id"> <!-- Hidden field for ID, used in edit mode -->
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
                        <input type="date" class="form-control" id="dateOfRelease" name="date_of_release" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="saveBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Student No.</th>
                        <th>Last Enrollment</th>
                        <th>Remarks</th>
                        <th>Date of Release</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_students");
                while ($row = mysqli_fetch_array($fetch_query)) {
                    ?>
                    <tr data-id="<?php echo $row['id']; ?>">
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['section']; ?></td>
                        <td><?php echo $row['student_no']; ?></td>
                        <td><?php echo date('Y', strtotime($row['last_enrollment'])); ?></td>
                        <td><?php echo $row['remarks']; ?></td>
                        <td>
    <?php
    // Check if the date_of_release is NULL
    if ($row['date_of_release'] === NULL) {
        echo "TBA"; // Display "TBA" if date_of_release is NULL
    } else {
        // Format and display the date if it's not NULL
        echo date('Y-m-d', strtotime($row['date_of_release']));
    }
    ?>
</td>

                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#" onclick="editGmr(<?php echo $row['id']; ?>)">
                <i class="fa fa-pencil m-r-5"></i> Edit
            </a>
            <a class="dropdown-item" href="#" onclick="deleteStudent(<?php echo $row['id']; ?>)">
                <i class="fa fa-trash-o m-r-5"></i> Delete
            </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="chat-overlay">
    <button id="close-chat" onclick="closeChat()">Close Chat</button>
    <iframe id="chat-iframe" src=""></iframe>
</div>
<?php include('footer.php'); ?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script>

function loadChatSystem() {
    var chatIframe = document.getElementById('chat-iframe');
    var chatOverlay = document.getElementById('chat-overlay');
    var pageWrapper = document.querySelector('.page-wrapper'); // The whole dashboard content

    if (!chatIframe || !chatOverlay) {
        console.error("Iframe or overlay element not found.");
        return;
    }

    // Set the iframe source to the chat system URL
    chatIframe.src = 'CHATBOX/chat.php'; // Replace with your chat system URL

    // Show the overlay and the iframe
    chatOverlay.style.display = 'block';

    // Hide the rest of the dashboard content
    pageWrapper.style.display = 'none'; // This will hide the entire dashboard content

    // Event listeners for load and error handling
    chatIframe.onload = function() {
        console.log("Chat iframe loaded successfully.");
    };
    
    chatIframe.onerror = function() {
        console.error("Error loading the chat iframe.");
    };
}

function closeChat() {
    var chatOverlay = document.getElementById('chat-overlay');
    var pageWrapper = document.querySelector('.page-wrapper');
    
    // Hide the overlay
    chatOverlay.style.display = 'none';

    // Show the rest of the dashboard content
    pageWrapper.style.display = 'block';

    // Clear the iframe source to stop any ongoing chat session
    var chatIframe = document.getElementById('chat-iframe');
    chatIframe.src = '';
}
    function confirmDelete() {
        return confirm('Are you sure you want to delete this student record?');
    }

    function deleteStudent(id) {
        if (confirmDelete()) {
            $.ajax({
                url: 'delete_student.php', // The PHP file that handles the deletion
                type: 'POST',
                data: { ids: id },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Remove the row from the table
                        $('tr[data-id="' + id + '"]').fadeOut(300, function () {
                            $(this).remove();
                        });
                    } else {
                        alert('Error deleting record: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while deleting the record.');
                }
            });
        }
    }


    // JavaScript to handle Add and Edit functionality
$(document).ready(function () {
    // Handle form submission (Add or Edit)
    $('#addGmrForm').submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way

        var formData = $(this).serialize(); // Get form data
        
        // Determine whether we're adding or editing
        var url = ($('#gmrId').val()) ? 'goodmoral/updategmr.php' : 'goodmoral/addgmr.php';

        // Use AJAX to submit the form data
        $.ajax({
            url: url, // Either add or update based on the presence of gmrId
            type: 'POST',
            data: formData, // Serialize the form data
            success: function (response) {
                if (response.success) {
                    alert(response.message); // Show success message
                    $('#addGmrModal').modal('hide'); // Close the modal
                    location.reload(); // Reload the page or refresh the table
                } else {
                    location.reload()
                }
            },
            error: function () {
                location.reload();
            }
        });
    });
});

// Function to load data for editing
function editGmr(id) {
    // Fetch data using AJAX to populate the modal
    $.ajax({
        url: 'goodmoral/fetchgmr.php', // Create a fetchgmr.php file to fetch data based on ID
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Populate the modal with the fetched data
                $('#gmrId').val(response.data.id);
                $('#name').val(response.data.name);
                $('#section').val(response.data.section);
                $('#studentNo').val(response.data.student_no);
                $('#lastEnrollment').val(response.data.last_enrollment);
                $('#remarks').val(response.data.remarks);
                $('#dateOfRelease').val(response.data.date_of_release);
                
                // Change the modal title and button text for Edit mode
                $('#addGmrModalLabel').text('Edit Good Moral Request');
                $('#saveBtn').text('Update');
                $('#addGmrModal').modal('show'); // Show the modal
            } else {
                alert('Error fetching data: ' + response.message);
            }
        },
        error: function () {
            alert('An error occurred while fetching the data.');
        }
    });
}

</script>
