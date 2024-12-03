<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection2.php');
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
                        <li>
                            <a href="Student Athletes.php"><i class="fa fa-file-text-o"></i> <span>Student Athletes</span></a>
                        </li>
                        <li class = "active">
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
                    <h4 class="page-title">Student Applications</h4>
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
                            <th>Sport</th>
                            <th>PSA</th>
                            <th>Grade</th>
                            <th>Student ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    // Database connection
    $connection = mysqli_connect('127.0.0.1', 'root', '12345', 'studentsectiondb');

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch all student applications
    $fetch_query = mysqli_query($connection, "SELECT * FROM sportdb");
    while ($row = mysqli_fetch_array($fetch_query)) {
    ?>
        <tr>
            <td><?php echo htmlspecialchars($row['NAME']); ?></td>
            <td><?php echo htmlspecialchars($row['SECTION']); ?></td>
            <td><?php echo htmlspecialchars($row['SPORT']); ?></td>
            <td>
                <a href="<?php echo htmlspecialchars($row['PSA_PATH']); ?>" target="_blank" class="btn btn-info btn-sm">VIEW FILE</a>
            </td>
            <td>
                <a href="<?php echo htmlspecialchars($row['GRADEPATH']); ?>" target="_blank" class="btn btn-info btn-sm">VIEW FILE</a>
            </td>
            <td>
                <a href="<?php echo htmlspecialchars($row['IDPATH']); ?>" target="_blank" class="btn btn-info btn-sm">VIEW FILE</a>
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
                        <label for="sportslist">List of Sports in KLD:</label><br>
        <select id="sportslist" name="sportslist" required>
            <option value="">Select a sport</option>
            <option value="badminton">Badminton (Men & Women)</option>
            <option value="basketball-men">Basketball (Men)</option>
            <option value="basketball-women">Basketball (Women)</option>
            <option value="cheerdance">Cheerdance</option>
            <option value="sepak-takraw">Sepak Takraw</option>
            <option value="table-tennis">Table Tennis (Men & Women)</option>
            <option value="volleyball-men">Volleyball (Men)</option>
            <option value="volleyball-women">Volleyball (Women)</option>
            <option value="chess">Chess</option>
        </select><br>
</div>

                        <div class="form-group">
                            <label for="psa">PSA Document</label>
                            <input type="file" class="form-control" id="psa" name="psa" required>
                        </div>

                        <div class="form-group">
                            <label for="grade">Grade Document</label>
                            <input type="file" class="form-control" id="grade" name="grade" required>
                        </div>

                        <div class="form-group">
                            <label for="school-id">ID Document</label>
                            <input type="file" class="form-control" id="school-id" name="school-id" required>
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
        // Confirm delete function with AJAX
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this student application?')) {
                // Send AJAX request to delete the record
                $.ajax({
                    url: 'athleteapp/deleteapply.php',
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
                    url: 'athleteapp/addapply.php',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response);
                        $('#addAthleteModal').modal('hide');
                        location.reload(); // Reload the page to reflect the new application
                    },
                    error: function() {
                        alert("There was an error adding the application.");
                    }
                });
            });
        });
    </script>
</body>
