<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('header.php');
include('includes/connection.php');

$query = "SELECT violation_type_id, violation_name FROM violation_types";
$result = $connection->query($query); // Use $connection here
$violation_types = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $violation_types[] = $row;
    }
}
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
                <li><a href="dashboard.php"><i class="fa fa-file-text-o"></i> <span>Good Moral</span></a></li>
                <li>
                        <a href="javascript:void(0);" onclick="loadChatSystem()">
                            <i class="fa fa-comments"></i> 
                            <span>Chat</span>
                        </a>
                    </li>
                <li><a href="laf.php"><i class="fa fa-list-ul"></i> <span>Lost and Found</span></a></li>
                
                <li class="active"><a href="violations.php"><i class="fa fa-exclamation-triangle"></i> <span>Violations</span></a></li>
                <li><a href="kickouts.php"><i class="fa fa-ban"></i> <span>List of Kickouts</span></a></li>

            </ul>
        </div>
    </div>
</div>
</body>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Violations</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <button class="btn btn-success btn-rounded float-right" id="addViolationBtn">Add Violation</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Section</th>
                        <th>Student No.</th>
                        <th>Violation Type</th>
                        <th>Description</th>
                        <th>Date of Violation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="violationsTable">
                    <!-- Data will be populated by AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Violation Modal -->
<div id="addViolationModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addViolationForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add Violation</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Student Name</label>
                        <input type="text" name="student_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Section</label>
                        <input type="text" name="section" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Student No.</label>
                        <input type="text" name="student_no" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Violation Type</label>
                        <select name="violation_type" class="form-control" required>
                            <option value="">Select Violation Type</option>
                            <?php foreach ($violation_types as $type): ?>
                                <option value="<?= $type['violation_type_id']; ?>">
                                    <?= htmlspecialchars($type['violation_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="actionstaken">Actions Taken</label>
                        <textarea class="form-control" id="actionstaken" name="actionstaken"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="chat-overlay">
    <button id="close-chat" onclick="closeChat()">Close Chat</button>
    <iframe id="chat-iframe" src=""></iframe>
</div>

<?php include('footer.php'); ?>

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
$(document).ready(function() {
    // Fetch violations and populate the table
    function fetchViolations() {
        $.ajax({
            url: 'violations/getviolations.php',
            method: 'GET',
            dataType: 'html',
            success: function(data) {
                $('#violationsTable').html(data);
            }
        });
    }

    fetchViolations();

    // Show Add Violation Modal
    $('#addViolationBtn').on('click', function() {
        $('#addViolationForm')[0].reset();
        $('#addViolationModal').modal('show');
    });

    $('#addViolationForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'violations/addviolations.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                if (response.success) {
                    $('#addViolationModal').modal('hide');
                    fetchViolations();
                }
            },
            error: function(xhr, status, error) {
                alert('AJAX Error: ' + error + '\nResponse: ' + xhr.responseText);
            }
        });
    });

    $(document).on('click', '.delete-violation', function() {
    var violationId = $(this).data('id'); // Get the violation ID from the button

    if (confirm('Are you sure you want to delete this violation?')) {
        $.ajax({
            url: 'violations/deleteviolations.php',
            method: 'POST',
            data: { violation_id: violationId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message); // Show success message
                    $('#violation-row-' + violationId).remove(); // Remove the deleted row from the UI
                } else {
                    alert('Error: ' + response.message); // Show error message
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error + '\nResponse: ' + xhr.responseText);
            }
        });
    }
});

});
</script>
