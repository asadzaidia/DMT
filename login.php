<?php
session_start();
if(isset($_SESSION['username'])){
	//inactivity constraint
	echo "<script>window.open('user_area/index.php','_self')</script>";
  }
  

?>

<!DOCTYPE html>
<html>
	<head>
		<?php  include('includes/header_includes.php'); ?>
		<link rel="stylesheet" href="styles/style.css">
		<link rel="stylesheet" href="styles/navbar.css">
		<link rel="stylesheet" href="styles/foot.css">
		<script src="js/login.js"></script>
		<title>Login</title>

	</head>

	<body>
			
			<?php include('includes/navbar.php');  ?>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-12 col-md-5" style="margin-top: 38px;">

						
							<center>
							<br>

							<!-- inactivity error-->
							
							<h1 class="label label-danger" id="result"></h1>
							<img class="img-responsive" src="images/logo.png" ></center>
							<center><h1 style="margin-top:-20px;">Login!</h1></center>
							<hr class="hr-style">
							<form action="" method="post">
								<div class="form-group">
									<label class="design">Email</label>
									<input type="email" class="form-control style" name="email" required>
								</div>

								<div class="form-group">
									<label class="design">Password</label>
									<input type="password" class="form-control style" name="pass" required>
								</div>
								<div class="form-group ">
									<button type="submit" class="btn btn-info btn-lg style form-control" name="login">Login</button>
								</div>
							</form>
							<br>
							<a href="forgot.php">Forgot Password?</a>

							
						</div>

						<div class="col-md-12 col-md-7">
							<img class="img-responsive" src="images/login.jpg">
						</div>

					</div>
				</div>
		</div>

			
			<br>
			<div style="margin-top: 200px;">

			<?php include('includes/footer.php');  ?>
			</div>

	</body>

</html>

<?php
include('codes/login_code.php'); 
?>
