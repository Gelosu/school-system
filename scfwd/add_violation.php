<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $student_name = $_POST['student_name'];
    $section = $_POST['section'];
    $student_no = $_POST['student_no'];
    $violation_type = $_POST['violation_type'];
    $description = $_POST['description'];
    $remarks = $_POST['remarks'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    // Prepare the SQL statement
    $sql = "INSERT INTO violations (student_name, section, student_no, violation_type, description, remarks, date, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissss", $student_name, $section, $student_no, $violation_type, $description, $remarks, $date, $status);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the violations page after successful insertion
        header("Location: violations.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


<head>
    <style>
        .sidebar-menu li.active a {
            color: #009900;
            background-color: #ffffff;
        }
    </style>
</head>

<body>
<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <?php
                    
                    if($_SESSION['role']==1){?>
                    <ul>
                        
                    <li>
                    <a href="dashboard.php"><i class="fa fa-file-text-o"></i> <span>Good Moral</span></a>
                        </li>
                
                        <li>
                    <a href="laf.php"><i class="fa fa-list-ul"></i> <span>Lost and Found</span></a>
                        </li>
               
                        <li>
                    <a href="items.php"><i class="fa fa-info"></i> <span>Items</span></a>
                        </li>

                        <li class="active">
                    <a href="violations.php"><i class="fa fa-exclamation-triangle"></i> <span>Violations</span></a>
                        </li>
												                       
                    </ul> 
                <?php } else {?>
                    <ul>
                        
                    <li>
                    <a href="dashboard.php"><i class="fa fa-file-text-o"></i> <span>Good Moral</span></a>
                        </li>
                        
                        <li>
                        <a href="laf.php"><i class="fa fa-list-ul"></i> <span>Lost and Found</span></a>
                        </li>
                                 
                        <li>
                    <a href="items.php"><i class="fa fa-info"></i> <span>Items</span></a>
                        </li>

                        <li class="active">
                    <a href="violations.php"><i class="fa fa-exclamation-triangle"></i> <span>Violations</span></a>
                        </li>
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
                <h4 class="page-title">Add Violation</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="violations.php" class="btn btn-success btn-rounded float-right"> Back</a>
            </div>
        </div>
        <div class="table-responsive">
            <div class="card-body">
                <div class="container-fluid mt-3">
                    <form action="" id="violation-form">
                        <input type="hidden" name="id" value="">
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="student_name" class="control-label">Student Name</label>
                                <input type="text" name="student_name" id="student_name" class="form-control form-control-sm rounded-0" value="" autofocus required/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="section" class="control-label">Section</label>
                                <input type="text" name="section" id="section" class="form-control form-control-sm rounded-0" value="" required/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="student_no" class="control-label">Student No.</label>
                                <input type="text" name="student_no" id="student_no" class="form-control form-control-sm rounded-0" value="" required/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="violation_type" class="form-label">Violation Type</label>
                                <select name="violation_type" id="violation_type" class="form-select" required="required">
                                    <option value="" disabled selected></option>
                                    <option value="1">Minor Violation</option>
                                    <option value="2">Major Violation</option>
                                    <option value="3">Severe Violation</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="description" class="control-label">Description</label>
                                <textarea rows="5" name="description" id="description" class="form-control form-control-sm rounded-0" required></textarea>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="remarks" class="control-label">Remarks</label>
                                <textarea rows="3" name="remarks" id="remarks" class="form-control form-control-sm rounded-0" required></textarea>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="date" class="control-label">Date of Violation</label>
                                <input type="date" name="date" id="date" class="form-control form-control-sm rounded-0" value="" required/>
                            </div>
                        </div>
                        
                        
                        
                        <div class=" m-t-20 text-center">
                            <button name="add-violation.php" class="btn btn-success submit-btn">Add Violation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
   
<?php
include('footer.php');
?>
<script language="JavaScript" type="text/javascript">
function confirmDelete() {
    return confirm('Are you sure you want to delete this student record?');
}

function deleteStudent(id) {
    if (confirmDelete()) {
        $.ajax({
            url: 'delete_student.php', // The PHP file that handles the deletion
            type: 'POST',
            data: { ids: id },
            success: function(response) {
                // If the response is successful, remove the row from the table
                if (response.success) {
                    // Remove the row from the table
                    $('tr[data-id="' + id + '"]').remove();
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
</script>