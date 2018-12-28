<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php  include('includes/header_includes.php'); ?>
		<link rel="stylesheet" href="styles/style.css">
		<link rel="stylesheet" href="styles/navbar.css">
		<link rel="stylesheet" href="styles/foot.css">
		<script src="js/signup.js"></script>
		<title>Signup</title>

	</head>

	<body>
			
			<?php include('includes/navbar.php');  ?>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-3">
						<center><img class="img-responsive" src="images/logo.png" width="300" height="300" style="margin-top: 80px;"></center>
						</div>
						
						<div class="col-md-9">
						<br>
						<br>
						<br>
						
						
							<h1 class="heading">Signup to Get Started!</h1>
							<hr class="hr-style">
                             <!--Error -->
							<p  class="label label-danger" id="result"></p>
							<br>
							
							<div class="col-md-8">
								<form action="" method="post">
									<div class="form-group">
									<div id="wait" style="display:none;">
          							 <center><img src="images/loader.gif" height="50" width="50" alt="loader"/></center>
            						</div>
									<label class="design">Username</label>
									<input type="text" class="form-control style" id="username" name="username" required autocomplete="off" onfocus="OnUserNamefocus()" onblur="onUserNameblur()" onkeypress="resultout()"><span id="availablity"></span>
									</div>
									<p style="font-size:12px; font-weight: bold; " id="un"></p>

									<div class="form-group">
									<label class="design">Email</label>
									<input type="email" class="form-control style" name="email" required>
									</div>

									<div class="form-group">
									<label class="design">Password</label>
									<input type="password" class="form-control style" name="password" required onfocus="OnPasswordfocus()" onblur="onPasswordblur()">
									</div>
									<p style="font-size:12px; font-weight: bold;" id="password-hover"></p>

									<div class="form-group">
									<label class="design">Confirm Password</label>
									<input type="password" class="form-control style" name="c-password" required>
									</div>
									<br>

									<button type="submit" class="btn btn-info btn-lg style" name="register" id="register" disabled>Get Started</button> 
								</form>
							</div>
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
	include('codes/signup_code.php');

?>

