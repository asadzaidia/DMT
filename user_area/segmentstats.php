<?php
session_start();
include('../connection/conn.php');
include('../functions/function.php');

//getting id from function getID which used SP
if(isset($_SESSION['username'])){
	//inactivity constraint
	  $aa=$_SESSION['username'];
	$s_id=url_crypt($_GET['a'],'d');
	  //getting segment name and created on
	  $sql= "select * from segments where segment_id='$s_id'";
	  $run=mysqli_query($conn,$sql);

  while($rows=mysqli_fetch_array($run)){
	  $segment_type_id=$rows['segment_type_id'];
  }
	//  debug_to_console($segment_type_id);


  }
 else{

	
		echo "<script>window.open('../index.php','_self')</script>";
	
	
 }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <?php  include('../includes/header_includes.php'); ?>
    <link rel="stylesheet" href="userAreaStyles/userareastyle.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	    <title>Campaign Bird</title>

  </head>

  <body>

  	<?php  include('UserAreaIncludes/inside_navbar.php'); ?>

  		<!-- Body-->
          <p style="margin-top: 80px;"></p>
          <div class="container">
              <div class="row">
                <div class="col-md-12">
				<?php
				if($segment_type_id==1)
				{
					include('email_statistic.php');
				
				}


   //for mobile camapign
             if($segment_type_id==2)
   
			{
				include('mobile_Statistic.php');
		        }
              ?>
				</div>
                
            </div> 
            </div>
           <!-- Body-->
<!--footer-->
		

<?php include('UserAreaIncludes/inside_footer.php');?> 
<!--footer-->
</body>
</html>





