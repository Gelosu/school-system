<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

// Fetching the appointment record
$id = $_GET['id'];
$fetch_query = mysqli_query($connection, "SELECT * FROM aptstuddb WHERE id='$id'");
$row = mysqli_fetch_array($fetch_query);

if(isset($_POST['save-appointment'])) {
    // Updating appointment details
    $name = $_POST['name'];
    $section = $_POST['section'];
    $counselor = $_POST['counselor'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];

    $update_query = mysqli_query($connection, 
        "UPDATE aptstuddb 
         SET NAME='$name', SECTION='$section', COUNSELOR='$counselor', DATE='$date', TIME='$time', MESSAGE='$message' 
         WHERE id='$id'");

    if($update_query) {
        $msg = "Appointment updated successfully";
        $fetch_query = mysqli_query($connection, "SELECT * FROM aptstuddb WHERE id='$id'");
        $row = mysqli_fetch_array($fetch_query);   
    } else {
        $msg = "Error updating appointment!";
    }
}
?>

<head>
<style>
     
        .dash-widget {
            border: 2px solid;
            border-radius: 16px;
            margin-bottom: 30px;
            padding: 20px;
            position: relative;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.5);
        }
        .dash-widget-bg1 {
            width: 65px;
            float: left;
            color: #fff;
            display: block;
            font-size: 50px;
            text-align: center;
            line-height: 65px;
            background: #009efb;
            border-radius: 50%;
            font-size: 40px;
            height: 65px;
        }
        .dash-widget-bg2 {
            width: 65px;
            float: left;
            color: #fff;
            display: block;
            font-size: 50px;
            text-align: center;
            line-height: 65px;
            background: #ffbc35;
            border-radius: 50%;
            font-size: 40px;
            height: 65px;
        }
        .dash-widget-bg3 {
            width: 65px;
            float: left;
            color: #fff;
            display: block;
            font-size: 50px;
            text-align: center;
            line-height: 65px;
            background: #9933FF;
            border-radius: 50%;
            font-size: 40px;
            height: 65px;
        }
        .dash-widget-bg4 {
            width: 65px;
            float: left;
            color: #fff;
            display: block;
            font-size: 50px;
            text-align: center;
            line-height: 65px;
            background: #55ce63;
            border-radius: 50%;
            font-size: 40px;
            height: 65px;
        }
        .dash-widget-bg5 {
            width: 65px;
            float: left;
            color: #fff;
            display: block;
            font-size: 50px;
            text-align: center;
            line-height: 65px;
            background: #ff3333;
            border-radius: 50%;
            font-size: 40px;
            height: 65px;
        }

        .dash-widget-info span i {
            width: 16px;
            background: #fff;
            border-radius: 50%;
            color: #666666;
            font-size: 9px;
            height: 16px;
            line-height: 16px;
            text-align: center;
            margin-left: 5px;
        }
        .dash-widget-info > span.widget-title1 {
            background: #009efb;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
        }
        .dash-widget-info > span.widget-title2 {
            background: #ffbc35;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
        }
        .dash-widget-info > span.widget-title3 {
            background: #9933FF;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
        }
        .dash-widget-info > span.widget-title4 {
            background: #55ce63;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
        }
        .dash-widget-info > span.widget-title5 {
            background: #ff3333;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
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


<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <?php
            if ($_SESSION['role'] == 1) { // Admin Role
                ?>
                <ul>
                    <li class="active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                    
                    <!-- Updated Chat Section -->
                    <li>
                        <a href="javascript:void(0);" onclick="loadChatSystem()">
                            <i class="fa fa-comments"></i> 
                            <span>Chat</span>
                        </a>
                    </li>

                    <li><a href="doctors.php"><i class="fa fa-user-md"></i> <span>Counselors</span></a></li>
                    <li><a href="patients.php"><i class="fa fa-wheelchair"></i> <span>Patients</span></a></li>
                    <li><a href="appointments.php"><i class="fa fa-calendar"></i> <span>Appointments</span></a></li>
                    <li><a href="schedule.php"><i class="fa fa-calendar-check-o"></i> <span>Counselors Schedule</span></a></li>
                    <li><a href="departments.php"><i class="fa fa-hospital-o"></i> <span>Services</span></a></li>
                    <li><a href="employees.php"><i class="fa fa-user"></i> <span>Employees</span></a></li>
                    <li><a href="studentaptloa.php"><i class="fa fa-user"></i> <span>Students</span></a></li>
                </ul>
            <?php } else { // Employee Role ?>
                <ul>
                    <li class="active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                    <li><a href="doctors.php"><i class="fa fa-user-md"></i> <span>Doctors</span></a></li>
                    <li><a href="patients.php"><i class="fa fa-wheelchair"></i> <span>Patients</span></a></li>
                    <li><a href="appointments.php"><i class="fa fa-calendar"></i> <span>Appointments</span></a></li>
                    <li><a href="schedule.php"><i class="fa fa-calendar-check-o"></i> <span>Doctor Schedule</span></a></li>
                    <li><a href="departments.php"><i class="fa fa-hospital-o"></i> <span>Departments</span></a></li>
                    <li><a href="employees.php"><i class="fa fa-user"></i> <span>Employees</span></a></li>
                    <li><a href="studentaptloa.php"><i class="fa fa-user"></i> <span>Students</span></a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>


<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Edit Student Appointment</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="studentaptloa.php" class="btn btn-success btn-rounded float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row['NAME']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Section</label>
                        <input type="text" class="form-control" name="section" value="<?php echo $row['SECTION']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Counselor</label>
                        <input type="text" class="form-control" name="counselor" value="<?php echo $row['COUNSELOR']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="<?php echo $row['DATE']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" class="form-control" name="time" value="<?php echo $row['TIME']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="message" rows="4" required><?php echo $row['MESSAGE']; ?></textarea>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-success submit-btn" name="save-appointment">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="chat-overlay">
    <button id="close-chat" onclick="closeChat()">Close Chat</button>
    <iframe id="chat-iframe" src=""></iframe>
</div>

<script type="text/javascript">
    <?php
    if(isset($msg)) {
        echo 'swal("' . $msg . '");';
    }
    ?>
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
    chatIframe.src = 'CHATBOX/chatbox.php'; // Replace with your chat system URL

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
<?php include('footer.php'); ?>
