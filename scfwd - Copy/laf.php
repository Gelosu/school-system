<?php
session_start();
if(empty($_SESSION['name']))
{
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
<<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php"><i class="fa fa-file-text-o"></i> <span>Good Moral</span></a>
                </li>
                <li>
                        <a href="javascript:void(0);" onclick="loadChatSystem()">
                            <i class="fa fa-comments"></i> 
                            <span>Chat</span>
                        </a>
                    </li>
                <li class="active">
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
<div id="chat-overlay">
    <button id="close-chat" onclick="closeChat()">Close Chat</button>
    <iframe id="chat-iframe" src=""></iframe>
</div>
        
</body>






        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Lost and Found</h4>
                    </div>
                  
                </div>
               <!-- Add Button -->
<div class="col-sm-8 col-9 text-right m-b-20">
    <button class="btn btn-success btn-rounded float-right" data-toggle="modal" data-target="#addLafModal">
        <i class="fa fa-plus"></i> Add
    </button>
</div>

<!-- Modal for Adding Lost and Found Item -->
<div id="addLafModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addLafModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLafModalLabel">Add Lost and Found Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addLafForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="itemName">Item Name</label>
                        <input type="text" class="form-control" id="itemName" name="item_name" required>
                    </div>
                    <div class="form-group">
                        <label for="itemDescription">Description</label>
                        <textarea class="form-control" id="itemDescription" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="itemStatus">Status</label>
                        <select class="form-control" id="itemStatus" name="status" required>
                            <option value="Found">Found</option>
                            <option value="Lost">Lost</option>
                        </select>
                    </div>
                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="itemImage">Item Image</label>
                        <input type="file" class="form-control" id="itemImage" name="photo" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="table-responsive">
    <table class="datatable table table-striped">
        <thead>
            <tr>
                <th>NAME/ITEM</th>
                <th>DESCRIPTION</th>
                <th>IMAGE</th>
                <th>Status</th>
                <th>DATE LISTED</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dynamic data will be loaded here -->
        </tbody>
    </table>
</div>


<?php
include('footer.php');
?>
<script language="JavaScript" type="text/javascript">

function confirmDelete(){
    return confirm('Are you sure want to delete this request?');
}

$(document).ready(function() {
    // Load table data when page loads
    loadTableData();

    // Handle form submission using AJAX
    $('#addLafForm').on('submit', function(e) {
        e.preventDefault();

        // Collect form data
        var formData = new FormData(this);  // Use FormData for file uploads

        // Make AJAX request to insert the data into the database
        $.ajax({
            url: 'lostfound/addlaf.php',  // File to handle the insert request
            type: 'POST',
            data: formData,
            processData: false,  // Don't process the data
            contentType: false,  // Don't set content type
            success: function(response) {
                console.log("Response Text: ", response);  // Log the raw response for debugging
                
                // Now you can also check if the response is valid and proceed with any actions
                // Example: If response is JSON
                try {
                    var result = JSON.parse(response);  // Parse the response as JSON
                    if (result.success) {
                        // If successful, close the modal
                        $('#addLafModal').modal('hide');
                        // Reload the table with the latest data
                        loadTableData();
                    } else {
                        console.error("Error Message: ", result.message);  // Log the error message from response
                        alert('Error: ' + result.message);
                    }
                } catch (e) {
                    // Error handling for invalid JSON response
                    console.error("Response Parsing Error: ", e.message);  // Log error if JSON parsing fails
                    console.error("Original Response: ", response);  // Log the raw response for debugging
                    alert("Error parsing response: " + e.message);
                }
            },
            error: function(xhr, status, error) {
                // Log AJAX errors
                console.error("AJAX Request Error:", status, error);  // Log AJAX error details
                alert('Error while submitting data! Please try again later.');
            }
        });
    });

    // Function to reload the table data
    function loadTableData() {
        $.ajax({
            url: 'lostfound/getlaf.php',  // File to fetch the latest data from the database
            type: 'GET',
            success: function(response) {
                // Log the raw response to console for debugging
                console.log("Table Data Response: ", response);
                
                // Update the table with the latest data (replace content of table body)
                if(response.trim()) {
                    $('table.datatable tbody').html(response);
                } else {
                    console.warn("Empty response received while loading table data");
                    alert("No data found to display.");
                }
            },
            error: function(xhr, status, error) {
                // Log errors for loading table data
                console.error("Error loading table data: ", status, error);
                alert('Error loading table data! Please try again later.');
            }
        });
    }
});


</script>

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
</script>