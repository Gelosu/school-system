<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login | Online Document Sharing System</title>
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    position: fixed;
	    top:0;
	    left: 0;
	    align-items: center;
	}
	main#main{
		width:100%;
		height: calc(100%);
		display: flex;
	}

</style>

<body>


  <main id="main" >
  <a href="../index.php"> <img src="../assets/img/BACK.png" alt="Back" class="button-image" margin-top = "35px" width="45px" height="45px"></a>
  		<div class="align-self-center w-100">
		<h4 class="text-black text-center"><b>STUDENT PUBLICATION</b></h4>
  		<div id="login-center">
  			<div class="card col-md-4">
  				<div class="card-body ">
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="email" class="control-label text-dark">Email</label>
  							<input type="text" id="email" name="email" class="form-control form-control-sm">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label text-dark">Password</label>
  							<input type="password" id="password" name="password" class="form-control form-control-sm">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
  		</div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
	$('.number').on('input',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9 \,]/, '');
        $(this).val(val)
    })
</script>	
</html>

<style>
	body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: url('../assets/img/kldbuilding.jpg') no-repeat center center fixed;
    background-size: cover;
    color: rgb(0, 0, 0); /* White text */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    position: relative; /* Make the body container positioned */
    filter: brightness(90%); /* Adjust the brightness of the image */
}

body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.1); /* Add a semi-transparent overlay */
    z-index: -1;
}


#login-center {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

.card {
    width: 100%;
    max-width: 400px;  /* Limit the maximum width of the login card */
    margin: auto;
}

.card-body {
    padding: 20px;
}

button {
    width: 100%;
    margin-top: 15px;
	color: green;
}

h4 {
    margin-bottom: 20px;
}

/* Override the default primary button color to green */
.btn-primary {
    background-color: #28a745; /* Green color */
    border-color: #28a745; /* Green border */
}

/* Optionally, if you want the green button to appear with a hover effect */
.btn-primary:hover {
    background-color: #218838; /* Darker green on hover */
    border-color: #1e7e34; /* Darker green border on hover */
}

</style>