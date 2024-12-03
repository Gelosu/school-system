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
                <?php
                if ($_SESSION['role'] == 1) { ?>
                    
                <?php } else { ?>
                    <ul>
                        <li>
                            <a href="dashboard.php"><i class="fa fa-file-text-o"></i> <span>Dashboard</span></a>
                        </li>
                        <li>
                        <a href="javascript:void(0);" onclick="loadChatSystem()">
                            <i class="fa fa-comments"></i> 
                            <span>Chat</span>
                        </a>
                    </li>
                        <li class = "active">
                            <a href="Student Athletes.php"><i class="fa fa-file-text-o"></i> <span>Student Athletes</span></a>
                        </li>
                        <li >
                            <a href="athleteapply.php"><i class="fa fa-file-text-o"></i> <span>Student Applications</span></a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Student Athletes</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <!-- Button to open the modal -->
                    <button class="btn btn-success btn-rounded float-right" data-toggle="modal" data-target="#addAthleteModal">
                        <i class="fa fa-plus"></i> Add Student Athlete Application
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="datatable table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Section</th>
                            <th>Sports</th>
                            <th>Coach</th>
                            <th>Student Number</th>
                            <th>Picture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Database connection
                        $connection = mysqli_connect('127.0.0.1', 'root', '12345', 'swdd');

                        // Check connection
                        if (!$connection) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Fetch all athletes
                        $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_athletes");
                        while ($row = mysqli_fetch_array($fetch_query)) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['section']); ?></td>
                                <td><?php echo htmlspecialchars($row['student_no']); ?></td>
                                <td><?php echo htmlspecialchars($row['sports']); ?></td>
                                <td><?php echo htmlspecialchars($row['coach']); ?></td>
                                
                                <td>
                                    <img src="<?php echo htmlspecialchars($row['picture']); ?>" alt="Picture" style="width: 50px; height: 50px;">
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)">
                                                <i class="fa fa-trash-o m-r-5"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for adding athlete -->
    <div class="modal fade" id="addAthleteModal" tabindex="-1" role="dialog" aria-labelledby="addAthleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAthleteModalLabel">Add Student Athlete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addAthleteForm" enctype="multipart/form-data">
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
                            <label for="student_number">Student Number</label>
                            <input type="text" class="form-control" id="student_number" name="student_number" required>
                        </div>

                        <div class="form-group">
                            <label for="sports">Sports</label>
                            <input type="text" class="form-control" id="sports" name="sports" required>
                        </div>
                        <div class="form-group">
                            <label for="coach">Coach</label>
                            <input type="text" class="form-control" id="coach" name="coach" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="picture">Picture</label>
                            <input type="file" class="form-control" id="picture" name="picture" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Athlete</button>
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
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this student record?')) {
        // Send AJAX request to delete the record
        $.ajax({
            url: 'athleteprofiling/deleteathlete.php',
            method: 'GET',
            data: { ids: id },
            success: function(response) {
                alert(response);
                location.reload(); // Reload the page to update the list
            },
            error: function() {
                alert("There was an error deleting the record.");
            }
        });
    }
}


        // Handle form submission with AJAX
        $(document).ready(function() {
            $('#addAthleteForm').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: 'athleteprofiling/addathlete.php',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response);
                        $('#addAthleteModal').modal('hide');
                        location.reload(); // Reload the page to reflect the new athlete
                    },
                    error: function() {
                        alert("There was an error adding the athlete.");
                    }
                });
            });
        });
    </script>
</body>
