<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('header.php');
include('includes/connection.php');
// Fetch kickouts data
$query = "SELECT * FROM kickouts";
$result = $connection->query($query);
$kickouts = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kickouts[] = $row;
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
                
                <li ><a href="violations.php"><i class="fa fa-exclamation-triangle"></i> <span>Violations</span></a></li>
                <li class="active"><a href="kickouts.php"><i class="fa fa-ban"></i> <span>List of Kickouts</span></a></li>

            </ul>
        </div>
    </div>
</div>
</body>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">List of Kickouts</h4>
            </div>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Section</th>
                        <th>Student No.</th>
                        <th>Violation List</th>
                        <th>Date Kickout</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kickouts as $kickout): ?>
                        <tr>
                            <td><?= htmlspecialchars($kickout['student_name']); ?></td>
                            <td><?= htmlspecialchars($kickout['section']); ?></td>
                            <td><?= htmlspecialchars($kickout['student_no']); ?></td>
                            <td>
    <?php
        // Decode the JSON-encoded violation list (if it's in JSON format)
        $violations = json_decode($kickout['violationlist']);
        
        if (is_array($violations)) {
            // Join the array elements with commas and display them
            echo implode(", ", $violations);
        } else {
            // If it's not a valid array, just display the raw value
            echo htmlspecialchars($kickout['violationlist']);
        }
    ?>
</td>
                            <td><?= htmlspecialchars($kickout['datekickout']); ?></td>
                        </tr>
                    <?php endforeach; ?>
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