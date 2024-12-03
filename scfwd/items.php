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
               
                        <li class="active" >
                        <a href="items.php"><i class="fa fa-info"></i> <span>Items</span></a>
                        </li>

                        <li>
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
                                 
                        <li class="active">
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
</body>






        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Items</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-items.php" class="btn btn-success btn-rounded float-right"><i class="fa fa-plus"></i> Add Items</a>
                    </div>
                </div>
                <div class="table-responsive">
                                    <table class="datatable table table-stripped ">
                                    <thead>
                                        <tr>
                                            <th>Name/Items</th>
                                            <th>Description</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                
                                </table>
                            </div>
                
            </div>
            
        </div>
        
   
<?php
include('footer.php');
?>
<script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return confirm('Are you sure want to delete this request?');
}
</script>