<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
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
            <?php if ($_SESSION['role'] == 1) { ?>
                <ul>
                    <li class="active">
                        <a href="dashboard.php"><i class="fa fa-file-text-o"></i> <span>Good Moral</span></a>
                    </li>
                    <li>
                        <a href="laf.php"><i class="fa fa-list-ul"></i> <span>Lost and Found</span></a>
                    </li>
                    <li>
                        <a href="items.php"><i class="fa fa-info"></i> <span>Items</span></a>
                    </li>
                    <li>
                        <a href="violations.php"><i class="fa fa-exclamation-triangle"></i> <span>Violations</span></a>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h2 class="page-title">Student Information</h2>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="dashboard.php" class="btn btn-success btn-rounded">Back</a>
                <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#addStudentModal">
                    Add Student
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addStudentForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
                        <label for="student_no">Student No.</label>
                        <input type="text" class="form-control" id="student_no" name="student_no" required>
                    </div>
                    <div class="form-group">
                        <label for="last_enrollment">Last Enrollment</label>
                        <input type="text" class="form-control" id="last_enrollment" name="last_enrollment" required>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date_of_release">Date of Release</label>
                        <input type="date" class="form-control" id="date_of_release" name="date_of_release" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#addStudentForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'addgmr.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    alert('Student added successfully!');
                    $('#addStudentModal').modal('hide');
                    location.reload();
                },
                error: function () {
                    alert('An error occurred while adding the student.');
                }
            });
        });
    });
</script>
</body>

<?php include('footer.php'); ?>
