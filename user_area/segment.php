<?php
@session_start();
include('../connection/conn.php');
include('../functions/function.php');

//getting id from function getID which used SP
if(isset($_SESSION['username'])){
	//inactivity constraint
	  $aa=$_SESSION['username'];
	  $id= getID($aa);
	  
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
    <title>The Marketer</title>

  </head>

  <body>

  	<?php  include('UserAreaIncludes/inside_navbar.php'); ?>

  		<!-- Body-->
		  <p style="margin-top: 110px;"></p>
 			<div class="container">
					<div class="row">
						<div class="col-md-12">

						<div class="col-md-3">
							 <h2>Your Segments</h2>
							 <hr>
						</div>
						<div class="col-md-2">
							
						</div>

						<div class="col-md-3">
							
						</div>

						<div class="col-md-4">
							<a href="create_segment.php" class="btn btn-success btn-lg style">Create New Segment!</a>
						</div>

						</div>

					</div>
				</div>
				<!-- On successfull addition of subscriber-->
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
				 <!-- On successfull addition of subscriber-->

				 <!-- On successfull deletion of segment-->
 				<?php  if(!empty($_GET['delete'])){
					 $notification=$_GET['delete'];
					 echo "
				 <div class='container'>
				 <div class='col-md-4 col-md-offset-3'>
					
					 <div class='alert alert-danger alert-dismissible' role='alert'>
  					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  					<strong>$notification</strong>
					</div>
					
					</div>
					</div>
					 
					 ";

				 }
				 ?>
				 <!-- On successfull deletion of segment-->
			<br>
				
				<div class='panel panel-default' style="border-color:forestgreen;margin-left:5px;margin-right:5px;">
			  	<div class='panel-body' style='min-height: 700px; max-height: 700px;overflow-y: scroll;'>

				
<?php
	$sql= "select * from segments where user_id='$id'";
	$run=mysqli_query($conn,$sql);

	while($rows=mysqli_fetch_array($run)){
		$s_id=$rows['segment_id'];
		$sname=$rows['segment_name'];
		$created_on=date("d-M-y", strtotime($rows['created_on']));
		$s_type=$rows['segment_type_id'];
		$Count=0;
		$segmenttype="";
		
		
		if($s_type==1){
			//Email type
			$segmenttype="Email Type";

		$procedure = "CALL GetSubscribersCountEmail('$s_id',@c)";
		$results1 = $conn->query($procedure);
		$results2 = $conn->query("SELECT @c");
		$num_rows = $results2->num_rows;
		if ($num_rows > 0) {

    		while($row = $results2->fetch_object())
    	{
    		$Count=$row->{"@c"};

    		}
		}

			$results2->close();
     		$conn->next_result();

		}
		else{
			$segmenttype="Mobile Type";
			//Mobile Type
		$procedure = "CALL GetSubscribersCountMobile('$s_id',@m)";
		$results1 = $conn->query($procedure);
		$results2 = $conn->query("SELECT @m");
		$num_rows = $results2->num_rows;
		if ($num_rows > 0) {

    		while($row = $results2->fetch_object())
    	{
    		$Count=$row->{"@m"};

    		}
		}

			$results2->close();
     		$conn->next_result();
		}

	

		echo "
		<div class='container'>
		<div class='row'>

		<div class='col-md-12'>

		<div class='panel panel-default'>
			  
		  <div class='panel-body'>
			  <div class='row'>
			<div class='col-md-4'>
				<p><strong>$sname</strong>&nbsp;&nbsp;<strong><span class='badge'>$segmenttype</span></strong></p>
			
				<p><strong>Created: </strong>$created_on</p>
			</div>
		
			<div class='col-md-2'>
				<p><strong>$Count</strong>
				
				</p>
				
				<p>Subscribers</p> 
			</div>

			

			<div class='col-md-6'>
				";
				//encrypting segment_id and segment type and passing it to add_subscribers
				$sid_crypted=url_crypt($s_id,'e');
				$stype_crypted=url_crypt($s_type,'e');
				echo "

				<a href='add_subscriber.php?a=$sid_crypted&&b=$stype_crypted'><span class='fas fa-user fa-3x'
					  data-toggle='tooltip' 
					  title='Add Subscriber'>
					</span>
					</a>
				&nbsp;&nbsp;

				<span><button class='btn btn-success' 
				style='border-radius:0px;margin-top:-20px; text-decoration: none;' value='$s_id'
				onclick='getAPI(this.value)'>API KEY</button></span>
				
				&nbsp;&nbsp;
				<span><a href='segmentstats.php?a=$sid_crypted' class='btn btn-warning' style='border-radius:0px;margin-top:-20px;'>Stats</a></span>

				 &nbsp;&nbsp;
				<span>
						<span class='dropdown' style='margin-top:-8px;'>
								<button class='btn btn-primary dropdown-toggle' style='margin-top:-20px;' type='button' data-toggle='dropdown'>
								<span class='caret'></span></button>
								<ul class='dropdown-menu'>
								  <li><a href='deletesegment.php?a=$sid_crypted'>Delete Segment</a></li>
								  <li><a href='viewsegment.php?a=$sid_crypted'>View Segment</a></li>
								  <li role='separator' class='divider'></li>
								  <li><a href='importcontacts.php?a=$sid_crypted&&b=$stype_crypted'>Import Contacts</a></li>
								</ul>
						</span>

				</span>
				";
				if($Count>0){
					echo"
				<span><a href='create_campaign.php?a=$sid_crypted&&b=$stype_crypted' class='btn btn-danger' 
					style='border-radius:0px;border:2px solid gold;margin-top:10px;float:right;font-weight: bold;'>Start Campaign!
									</a></span>";
				}
				else{
					echo "
					<span><button href='create_campaign.php?a=$sid_crypted&&b=$stype_crypted' class='btn btn-danger' disabled
					data-toggle='tooltip' data-placement='left' title='0 Subscribers!'
					style='border-radius:0px;border:2px solid gold;margin-top:10px;float:right;font-weight: bold;'>Start Campaign!
									</button></span>

					";
				}
				echo "

			</div>
			  </div>



			  </div>
		</div>
			

		</div>

		</div>

 </div>
 
		
		";
	}

	?>	
	</div>
	</div>
	
	

		 <!-- Body-->


		 <!-- Modal to show api-->
<div class="modal fade" id="APIMODEL" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content style">
		<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:#d65c99;">API KEY</h4>
            </div>
            
            <div class="modal-body">
				<br>
				
				<center><p id="apidata" style="font-weight:bold;"></p></center>
            </div>
            
        </div>
    </div>
</div>
	<!-- Modal to show api-->


	 <div style="margin-top:190px;">

<?php include('UserAreaIncludes/inside_footer.php');?> 


</div>


  </body>

  </html>

<script>

	function getAPI(a){

	var s_id=a;
	//call to get api of clicked segment
	$.ajax({
            url:"get_api.php",
            method:"POST",
            data:{
                segment_id:s_id
            },
            dataType:"text",
            success:function(html){
				console.log(html);
				document.getElementById('apidata').innerHTML=html;
      			  $('#APIMODEL').modal({show:true});
            }
        });
   
    

	}

</script>