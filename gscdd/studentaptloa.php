<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}

include('header.php');
include('includes/connection.php');

// Handle Add Appointment form submission
if (isset($_POST['add_appointment'])) {
    $name = $_POST['name'];
    $section = $_POST['section'];
    $counselor = $_POST['counselor'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];
    
    $query = "INSERT INTO aptstuddb (NAME, SECTION, COUNSELOR, DATE, TIME, MESSAGE) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $section, $counselor, $date, $time, $message);
    $insert_result = mysqli_stmt_execute($stmt);
    
    $alertMessage = $insert_result ? "Appointment added successfully" : "Error adding appointment";
}

// Handle Add Leave of Absence form submission
if (isset($_POST['add_leave'])) {
    $name = $_POST['name'];
    $csyrsc = $_POST['csyrsc'];
    $date = $_POST['date'];
    $interview = $_POST['interview'];
    $lstart = $_POST['lstart'];
    $reason = $_POST['reason'];
    
    $query = "INSERT INTO studloa_db (NAME, CSYRSC, DATE, INTERVIEW, LSTART, REASON) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $csyrsc, $date, $interview, $lstart, $reason);
    $insert_result = mysqli_stmt_execute($stmt);
    
    $alertMessage = $insert_result ? "Leave of Absence added successfully" : "Error adding Leave of Absence";
}

// Handle record deletion
if (isset($_GET['ids'])) {
    $record_id = $_GET['ids'];
    $table = isset($_GET['table']) ? $_GET['table'] : '';

    // Delete from aptstuddb
    if ($table == 'appointment') {
        $delete_query = "DELETE FROM aptstuddb WHERE id = ?";
        $stmt = mysqli_prepare($connection, $delete_query);
        mysqli_stmt_bind_param($stmt, "i", $record_id);
        $delete_result = mysqli_stmt_execute($stmt);

        $alertMessage = $delete_result ? "Appointment deleted successfully" : "Error deleting appointment";
    }

    // Delete from studloa_db
    if ($table == 'leave') {
        $delete_query = "DELETE FROM studloa_db WHERE id = ?";
        $stmt = mysqli_prepare($connection, $delete_query);
        mysqli_stmt_bind_param($stmt, "i", $record_id);
        $delete_result = mysqli_stmt_execute($stmt);

        $alertMessage = $delete_result ? "Leave of Absence deleted successfully" : "Error deleting Leave of Absence";
    }
}

// Fetch all data from aptstuddb (Appointments) table
$fetch_appointments = mysqli_query($connection, "SELECT * FROM aptstuddb");

// Fetch all data from studloa_db (Leave of Absence) table
$fetch_leave = mysqli_query($connection, "SELECT * FROM studloa_db");
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Student Dashboard</h4>
            </div>
        </div>

        <!-- Display the alert message if any -->
        <?php if (isset($alertMessage)): ?>
            <script type="text/javascript">
                alert("<?php echo $alertMessage; ?>");
            </script>
        <?php endif; ?>

        <!-- Buttons to open modals -->
        <button class="btn btn-success" data-toggle="modal" data-target="#addAppointmentModal">Add Appointment</button>
        <button class="btn btn-warning" data-toggle="modal" data-target="#addLeaveModal">Add Leave of Absence</button>

        <!-- Tabs for Appointments and Leave of Absence -->
        <ul class="nav nav-tabs" id="studentTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="appointments-tab" data-toggle="tab" href="#appointments" role="tab" aria-controls="appointments" aria-selected="true">Appointments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="leave-tab" data-toggle="tab" href="#leave" role="tab" aria-controls="leave" aria-selected="false">Leave of Absence</a>
            </li>
        </ul>

        <div class="tab-content" id="studentTabsContent">
            <!-- Appointments Tab -->
            <div class="tab-pane fade show active" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
                <div class="table-responsive mt-3">
                    <table class="datatable table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Section</th>
                                <th>Counselor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($fetch_appointments) {
                                while ($row = mysqli_fetch_assoc($fetch_appointments)) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['NAME']); ?></td>
                                        <td><?php echo htmlspecialchars($row['SECTION']); ?></td>
                                        <td><?php echo htmlspecialchars($row['COUNSELOR']); ?></td>
                                        <td><?php echo htmlspecialchars($row['DATE']); ?></td>
                                        <td><?php echo htmlspecialchars($row['TIME']); ?></td>
                                        <td><?php echo htmlspecialchars($row['MESSAGE']); ?></td>
                                        <td class="text-right">
                                            <a href="edit-studapt.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="?ids=<?php echo urlencode($row['id']); ?>&table=appointment" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                        </td>
                                    </tr>
                            <?php }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Leave of Absence Tab -->
            <div class="tab-pane fade" id="leave" role="tabpanel" aria-labelledby="leave-tab">
                <div class="table-responsive mt-3">
                    <table class="datatable table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>CSYRSC</th>
                                <th>Date</th>
                                <th>Interview Date</th>
                                <th>Leave Start</th>
                                <th>Reason</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($fetch_leave) {
                                while ($row = mysqli_fetch_assoc($fetch_leave)) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['NAME']); ?></td>
                                        <td><?php echo htmlspecialchars($row['CSYRSC']); ?></td>
                                        <td><?php echo htmlspecialchars($row['DATE']); ?></td>
                                        <td><?php echo htmlspecialchars($row['INTERVIEW']); ?></td>
                                        <td><?php echo htmlspecialchars($row['LSTART']); ?></td>
                                        <td><?php echo htmlspecialchars($row['REASON']); ?></td>
                                        <td class="text-right">
                                            <a href="edit-studentloa.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="?ids=<?php echo urlencode($row['id']); ?>&table=leave" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                        </td>
                                    </tr>
                            <?php }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Appointment Modal -->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAppointmentModalLabel">Add Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
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
                        <label for="counselor">Counselor</label>
                        <input type="text" class="form-control" id="counselor" name="counselor" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="add_appointment" class="btn btn-primary">Add Appointment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Leave of Absence Modal -->
<div class="modal fade" id="addLeaveModal" tabindex="-1" role="dialog" aria-labelledby="addLeaveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveModalLabel">Add Leave of Absence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="csyrsc">CSYRSC</label>
                        <input type="text" class="form-control" id="csyrsc" name="csyrsc" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="interview">Interview Date</label>
                        <input type="date" class="form-control" id="interview" name="interview" required>
                    </div>
                    <div class="form-group">
                        <label for="lstart">Leave Start</label>
                        <input type="date" class="form-control" id="lstart" name="lstart" required>
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="add_leave" class="btn btn-primary">Add Leave</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="chat-overlay">
    <button id="close-chat" onclick="closeChat()">Close Chat</button>
    <iframe id="chat-iframe" src=""></iframe>
</div>

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