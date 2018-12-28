<?php
session_start();
 include('../connection/conn.php');
 include('../functions/function.php');
if(isset($_SESSION['username'])){
	//inactivity constraint
	  $aa=$_SESSION['username'];
	  //getting id
		  $id= getID($aa);

		  
         
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
		  <p style="margin-top: 110px;"></p>

		  <!-- Heading-->
 			<div class="container">
			<h1 class='page-header'>Campaigns List</h1>
			</div>
		  <!-- Heading-->

			<!-- On successfull campaign send-->
			<?php  if(!empty($_GET['success'])){
				$notification=$_GET['success'];
				echo "
			<div class='container'>
			<div class='col-md-4 col-md-offset-3'>
			   
				<div class='alert alert-success alert-dismissible' role='alert'>
				 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 <strong>$notification</strong>
			   </div>
			   
			   </div>
			   </div>
				
				";

			}
			?>
			<!-- On successfull campaign send-->

		
				<!-- getting the campaigns -->
				<div class="container">
					<div class="row">
				<?php
				$query="select * from campaigns where Userid='$id' order by campaign_id desc";
				$run=mysqli_query($conn,$query);
				$count=mysqli_num_rows($run);
				//if  campaigns send
					if($count>0){
						while($rows=mysqli_fetch_array($run)){
							$campaign_id=$rows['campaign_id'];
							$start_date=date("d-M-y", strtotime($rows['start_date']));
							$camp_title=$rows['camp_title'];
							$segment_id=$rows['segment_id'];
							$segment_type_id=$rows['segment_type_id'];
							$segmenttype="";
							$segmentName="";
		
							if($segment_type_id==1){
								$segmenttype="Email Type";
							}else{
								$segmenttype="Mobile Type";
							}
		
							//getsegmentname
							$procedure = "CALL GetSegmentName('$segment_id',@segmentname)";
							$results1 = $conn->query($procedure);
							$results2 = $conn->query("SELECT @segmentname");
							$num_rows = $results2->num_rows;
							 if ($num_rows > 0) {
					
							   while($row = $results2->fetch_object())
								 {
								   $segmentName=$row->{"@segmentname"};
					
								   }
								 }
								 $results2->close();
								 $conn->next_result();
								 
							//encrypting parameters
							$campaign_id_crypted=url_crypt($campaign_id,'e');
							$segment_id_crypted=url_crypt($segment_id,'e');
							$segment_type_id_crypted=url_crypt($segment_type_id,'e');
		
							echo
								"
								
							<div class='jumbotron styling container'>
								<div class='col-md-12'>
										<div class='col-md-8'>
											
										<h2>$camp_title&nbsp;<span class='badge' style='background:-moz-linear-gradient();'>$segmenttype</span></h2>
										<p><span class='badge' style='background:#D4AF37;border-radius:0px;font-size: 20px;'>
											Campaign Send On: $start_date</span></p>
											<p><span class='badge' style='background:#777455;border-radius:0px;font-size: 20px;'>
													To: $segmentName</span></p>
										</div>
									
		
										<div class='col-md-4'>
											<center>
											<a href='campaign_statistics.php?a=$campaign_id_crypted&&b=$segment_id_crypted&&c=$segment_type_id_crypted' style='text-decoration: none;'><img src='../images/stats4.png' height='150' width='170' alt='View Statistics'/>
											<p style='color:white;'>View Statistics</p></a>
											</center>
											
										</div>	
									</div>
							</div>
						
						
					
								
								";
						}

					}
					else{
						echo "
						<div class='jumbotron styling container'>
						<div class='col-md-12'>
								<h1>No Campaigns have been send yet!</h1>	
							</div>
					</div>

						";

					}

				

				?>
				</div>
				</div>


				
			

		 <!-- Body-->


	<?php include('UserAreaIncludes/inside_footer.php');?> 


  </body>

  </html>