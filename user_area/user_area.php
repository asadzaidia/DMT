<?php
session_start();


if(isset($_SESSION['username'])){
	//inactivity constraint
 	 $aa=$_SESSION['username'];
        
         
	}
 else{

 	echo "no session created";
 }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <?php  include('../includes/header_includes.php'); ?>
    <link rel="stylesheet" href="userAreaStyles/userareastyle.css">
    <title>The Marketer</title>

  </head>

  <body>

  	<?php  include('UserAreaIncludes/inside_navbar.php'); ?>

  		<!-- Body-->
  		
		 <p style="margin-top: 50px;">User Area</p>
		

		 <!-- Body-->


	<?php include('UserAreaIncludes/inside_footer.php');?> 


  </body>

  </html>