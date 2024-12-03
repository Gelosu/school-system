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

<body>
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

</body>






        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Patients</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-patient.php" class="btn btn-success btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
                    </div>
                </div>
                <div class="table-responsive">
                                    <table class="datatable table table-stripped ">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['ids'])){
                                        $id = $_GET['ids'];
                                        $delete_query = mysqli_query($connection, "delete from tbl_patient where id='$id'");
                                        }
                                        $fetch_query = mysqli_query($connection, "select * from tbl_patient");
                                        while($row = mysqli_fetch_array($fetch_query))
                                        {
                                            $dob = $row['dob'];
                                            $date = str_replace('/', '-', $dob); 
                                            $dob = date('Y-m-d', strtotime($date));
                                            $year = (date('Y') - date('Y',strtotime($dob)));
                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                                            <td><?php echo $year; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                             <?php if($row['patient_type']=="InPatient") { ?>
                                            <td><span class="custom-badge status-red"><?php echo $row['patient_type']; ?></span></td>
                                        <?php } else {?>
                                            <td><span class="custom-badge status-green"><?php echo $row['patient_type']; ?></span></td>
                                        <?php } ?>
                                            <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="edit-patient.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="patients.php?ids=<?php echo $row['id'];?>" onclick="return confirmDelete()"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
        
        <div id="chat-overlay">
    <button id="close-chat" onclick="closeChat()">Close Chat</button>
    <iframe id="chat-iframe" src=""></iframe>
</div>
<?php
include('footer.php');
?>
<script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return confirm('Are you sure want to delete this Patient?');
}

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