<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $section = mysqli_real_escape_string($connection, $_POST['section']);
    $sports = mysqli_real_escape_string($connection, $_POST['sports']);
    $coach = mysqli_real_escape_string($connection, $_POST['coach']);
    
    // Handle file upload for picture
$target_dir = "uploads/";
$original_file_name = basename($_FILES["picture"]["name"]);
$target_file = $target_dir . time() . '_' . $original_file_name; // Unique file name
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["picture"]["tmp_name"]);
if($check === false) {
    echo "File is not an image.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["picture"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    // Attempt to move the uploaded file
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        // Insert data into database
        $insert_query = "INSERT INTO tbl_athletes (name, section, student_no, sports, coach, picture) VALUES ('$name', '$section', '$student_no', '$sports', '$coach', '$target_file')";
        if (mysqli_query($connection, $insert_query)) {
            // Redirect to the dashboard after successful insertion
            header('Location: dashboard.php?message=Student athlete added successfully');
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($connection);
        }
    } else {
        // Provide more detailed error information
        echo "Sorry, there was an error uploading your file. Please check the following:";
        echo "<ul>";
        echo "<li>Ensure the 'uploads' directory exists.</li>";
        echo "<li>Ensure the 'uploads' directory has write permissions.</li>";
        echo "<li>Check if the file name contains invalid characters.</li>";
        echo "<li>Check PHP configuration settings.</li>";
        echo "</ul>";
    }
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
            <?php if($_SESSION['role'] == 1) { ?>
                <ul>
                        <li>
                    <a href="dashboard.php"><i class="fa fa-file-text-o"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="active">
                    <a href="Student Athletes.php"><i class="fa fa-file-text-o"></i> <span>Student Athletes</span></a>
                        </li>
                </ul>
            <?php } else { ?>
                <ul>
                        <li>
                    <a href="dashboard.php"><i class="fa fa-file-text-o"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="active">
                    <a href="Student Athletes.php"><i class="fa fa-file-text-o"></i> <span>Student Athletes</span></a>
                        </li>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>

<div class="page-wrapper">
    <div class="content">
    <div class="col-sm-8 col-9 text-right m-b-40">
                <a href="Student Athletes.php" class="btn btn-success btn-rounded float-right"> Back</a>
            </div>
        <h4 class="page-title">Add Student Athlete</h4>  

        

        <form action="add_student_athlete.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="section">Section:</label>
                <input type="text" name="section" id="section" class="form-control" required>
            </div>
           


            <div class="form-group <label for="sports">Sports:</label>
                <input type="text" name="sports" id="sports" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="coach">Coach:</label>
                <input type="text" name="coach" id="coach" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" name="picture" id="picture" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Student Athlete</button>
        </form>
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