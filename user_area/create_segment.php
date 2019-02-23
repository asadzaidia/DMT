<?php
session_start();
if(isset($_SESSION['username'])){
	//inactivity constraint
      $aa=$_SESSION['username'];
     
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
    
    <script src="js/create_segment.js"></script>
    <title>Campaign Bird</title>

  </head>

  <body>

  	<?php  include('UserAreaIncludes/inside_navbar.php'); ?>

          <!-- Body-->
          <div class="container" >
        
         <center>
             
            <h1 style="margin-top:90px;">Create New Segment</h1>
            <hr class="hr-style" />
            <div id="wait" style="display:none;">
          	<center><img src="../images/loader.gif" height="50" width="50" alt="loader"/></center>
            </div>
            <h1 class="label label-danger" id="err"></h1>
        
        </center>

        <div class="row">
            
            <div style="margin-top:30px;">
           
                <form action="" method="post" class="form-inline">
                <div class="col-md-12">
                    <center>
                    <div class="form-group">
                        <label for="sn" style="float: left;">Segment Name</label><span  id="snavailable"></span>
                        <br>
                        <input type="text" class="form-control style" name="segment_name"  style="width:350px;font-weight: bold;" required id="sn" placeholder="Segment Name">
                    
                    </div>
                    <span style="margin-right: 50px;"></span>
                    <div class="form-group">
                            <label for="type" style="float: left;">Segment Type</label>
                            <br>
                           <select name="stype" class="form-control style2"  id="type" style="width:350px;font-weight: bold;" required>
                               <option value="">Select Type</option>
                               <option value="1">Email Type</option>
                               <option value="2">Mobile Type</option>
                           </select>
                    </div>
                </center>
                <br>
                <br>
               <center>
                   <button type="submit" class="btn btn-success btn-lg style" id="segmentButton" name="create-segment" >Create Segment</button>
                </center>    

                </div>

                </form>
                

                

            
        </div>
          </div>
          </div>


          <!--Body-->
          <div style="margin-top:190px;">

                <?php include('UserAreaIncludes/inside_footer.php');?> 
          </div>
          <script>
$(document).ready(function(){
  $(document).ajaxStart(function(){
     $("#wait").css("display", "block");
 });
      $(document).ajaxComplete(function(){
       $("#wait").css("display", "none");
 });
});
</script>
   
</body>

<html>




<?php
include('../connection/conn.php');
include('../functions/function.php');

//getting id from function getID which used SP
$id= getID($aa);
include('usercodes/segment_create.php');

?>
