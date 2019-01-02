<?php
session_start();
include('connection/conn.php');
include('functions/function.php');
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
        <link rel="stylesheet" href="user_area/userAreaStyles/userareastyle.css">
		<title>Forgot Password</title>

	</head>

	<body>
			
			<?php include('includes/navbar.php');  ?>
        <p style="margin-top:80px;"></p>   
			<div class="container">
				<div class="row">
					<div class="col-md-12">	
                            <h1 class="heading">Do You Forgot Your Password?</h1>
                            <hr class="hr-style">
							<div class='col-md-6 col-md-offset-3'>
                            <h4 class='page-header'>Enter Your Email We will help you to recover
                                 your password!</h4>
                            <h1 class="label label-danger" id="result"></h1>
                            <h1 class="label label-success" id="result1"></h1>
                            <div class='panel panel-default'>
                            <div class='panel-body'>
                          <form method='post' action=''>
                              <div class='form-group'>
                                  <label for='em'>Your Email!</label>
                                  <input type='email' class='form-control' id='em' 
                                  style='height:55px; border-radius: 0px;' name='emailadd' required>
      
                              </div>
                              <button type='submit' class='btn btn-success btn-lg style' name='send'>Send!</button>
                              
                          </form>  
      
                        </div>
                        </div>
                        </div>
                      
					</div>
				</div>
			</div>

			
			<br>

			<div style="margin-top: 350px;">

			<?php include('includes/footer.php');  ?>
			</div>

	</body>

</html>

<?php
	include('codes/forgot_pass.php')

?>

