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
<div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <?php
                if ($_SESSION['role'] == 1) { ?>
                    
                <?php } else { ?>
                    <ul>
                        <li class = "active">
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
    
    <?php


// Fetch all athletes from the database
$fetch_query = mysqli_query($connection, "SELECT * FROM tbl_athletes");
$athletes = mysqli_fetch_all($fetch_query, MYSQLI_ASSOC);

// Calculate analytics data
$total_athletes = count($athletes);

$sports_count = array();
$section_count = array();

foreach ($athletes as $athlete) {
    $sports_count[$athlete['sports']] = ($sports_count[$athlete['sports']] ?? 0) + 1;
    $section_count[$athlete['section']] = ($section_count[$athlete['section']] ?? 0) + 1;
}

arsort($sports_count);
arsort($section_count);

?>

<head>
    <style>
        .sidebar-menu li.active a {
            color: #009900;
            background-color: #ffffff;
        }
        .dashboard-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .dashboard-card h3 {
            margin-top: 0;
            color: #333;
        }
        .chart-container {
            height: 300px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<!-- Existing sidebar code here -->

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Student Athletes Dashboard</h4>
            </div>
        </div>
        
        <!-- Analytics Dashboard -->
        <div class="row">
            <div class="col-md-4">
                <div class="dashboard-card">
                    <h3>Total Athletes</h3>
                    <p class="h2"><?php echo $total_athletes; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <h3>Sports Distribution</h3>
                    <div class="chart-container">
                        <canvas id="sportsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <h3>Section Distribution</h3>
                    <div class="chart-container">
                        <canvas id="sectionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Existing table code here -->
    </div>
</div>
</div>
</div>
<div id="chat-overlay">
    <button id="close-chat" onclick="closeChat()">Close Chat</button>
    <iframe id="chat-iframe" src=""></iframe>
</div>
</body>
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
// Sports Distribution Chart
var sportsCtx = document.getElementById('sportsChart').getContext('2d');
var sportsChart = new Chart(sportsCtx, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode(array_keys($sports_count)); ?>,
        datasets: [{
            data: <?php echo json_encode(array_values($sports_count)); ?>,
            backgroundColor: [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

// Section Distribution Chart
var sectionCtx = document.getElementById('sectionChart').getContext('2d');
var sectionChart = new Chart(sectionCtx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode(array_keys($section_count)); ?>,
        datasets: [{
            label: 'Number of Athletes',
            data: <?php echo json_encode(array_values($section_count)); ?>,
            backgroundColor: '#36A2EB'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
</script>

<?php
include('footer.php');
?>
