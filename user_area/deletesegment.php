<?php
session_start();
include('../connection/conn.php');
include('../functions/function.php');

//getting id from function getID which used SP
if(isset($_SESSION['username'])){
	//inactivity constraint
	  $aa=$_SESSION['username'];
       $s_id=url_crypt($_GET['a'],'d');
     
      //  debug_to_console($s_id);
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
    <title>Campaign Bird</title>

  </head>

  <body>

  	<?php  include('UserAreaIncludes/inside_navbar.php'); ?>

  		<!-- Body-->
          <p style="margin-top: 240px;"></p>

          <div class="container">
              <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                      <h1 class="page-header">Delete Segment!</h1>
                      <div class="panel panel-default">
                          <div class="panel-body">
                      <h3>Are You Sure?</h3>
                      <form method="post" action="">
                        <button type="submit" class="btn btn-danger btn-lg" style="border-radius:0px;" name="yes">Yes</button>
                        <button type="submit" class="btn btn-info btn-lg" style="border-radius:0px;" name="no">No</button>
                      </form>
                  </div>
                  </div>
                                        
                  </div>
              </div>
          </div>

          <!-- Body-->
         
         

        <!--footer-->
	    <div style="margin-top:200px;">

<?php include('UserAreaIncludes/inside_footer.php');?> 
</div>
<!--footer-->


  </body>

  </html>

  <?php
  include('usercodes/segment_delete.php');


  ?>