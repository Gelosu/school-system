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
               
                        <li class="active">
                        <a href="items.php"><i class="fa fa-info"></i> <span>Items</span></a>
                        </li>

						<li>
                    <a href="violations.php"><i class="fa fa-exclamation-triangle"></i> <span>Violations</span></a>
                        </li>
												                       
                    </ul>
                <?php } else {?>
                    <ul>
                        
                    <li >
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
                        <h4 class="page-title">Add Items</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="items.php" class="btn btn-success btn-rounded float-right"> Back</a>
                    </div>
                </div>
                <div class="table-responsive">
                <div class="card-body">
				<div class="container-fluid mt-3">
					<form action="" id="items-form">
						<input type="hidden" name ="id" value="">
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="category_id" class="form-label">Category</label>
							<select name="category_id" id="category_id" class="form-select" required="required">
								<option value="" disabled selected></option>
																<option value="2" >School Supply</option>
																<option value="1" >Personal Product</option>
																<option value="3" >Others</option>
															</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="fullname" class="control-label">Founder Name</label>
								<input type="text" name="fullname" id="fullname" class="form-control form-control-sm rounded-0" value=""  autofocus required/>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="title" class="control-label">Title</label>
								<input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" value=""  required/>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="contact" class="control-label">Contact #</label>
								<input type="text" name="contact" id="contact" class="form-control form-control-sm rounded-0" value=""  required/>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="description" class="control-label">Description</label>
								<textarea rows="5" name="description" id="description" class="form-control form-control-sm rounded-0"  required></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label for="" class="control-label">Item Image</label>
								<div class="custom-file">
								<input type="file" class="form-control" id="customFile" name="image" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group d-flex justify-content-center">
								<img src="" alt="" id="cimg" class="img-fluid img-thumbnail">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="status" class="control-label">Status</label>
								<select name="status" id="status" class="form-select form-select-sm rounded-0" required="required">
									<option value="0" >Pending</option>
									<option value="1" >Publish</option>
									<option value="2" >Claimed</option>
								</select>
							</div>
						</div>
                        <div class="m-t-20 text-center">

                                <button name="add-items.php" class="btn btn-success submit-btn">Add Item</button>
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
function confirmDelete(){
    return confirm('Are you sure want to delete this request?');
}
</script>