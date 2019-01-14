<?php
session_start();
include('../connection/conn.php');
include('../functions/function.php');

//getting id from function getID which used SP
if(isset($_SESSION['username'])){
	//inactivity constraint
	  $aa=$_SESSION['username'];
       $s_id=url_crypt($_GET['a'],'d');
       $s_type=url_crypt($_GET['b'],'d');
    //    debug_to_console($s_id);
    //    debug_to_console($s_type);

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
          <p style="margin-top: 110px;"></p>
          <!-- Body-->
          <div class="container">
              <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                      <h1 class="page-header">Import Contacts</h1>
                      <div class="panel panel-default">
                            <div class="panel-body">
                                <form action=" " method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                    <input type="file" class="form-control" name="files" accept="text/plain" required/>
                                    </div>

                                <button type="submit" class="btn btn-success btn-lg style" name="importcontacts">Import Subscribers</button>     
                                </form>
                                <br/>

                                <?php
                                if($s_type==1){
                                    echo "
                                    <p style='float:right;color:red;'>** We only accept .txt file for details
                                     how to submit bulk contacts see the <a href='files/email.txt' download>example</a></p>

                                     ";
                                }
                                if($s_type==2){
                                    echo "
                                    <p style='float:right;color:red;'>** We only accept .txt file for details
                                     how to submit bulk contacts see the <a href='files/mobile.txt' download>example</a></p>
                                     ";

                                }
                                ?>
                               
                        </div>
                        </div>
                  </div>
              </div>
          </div>
         
         

        <!--footer-->
	    <div style="margin-top:260px;">

        <?php include('UserAreaIncludes/inside_footer.php');?> 
        </div>
        <!--footer-->


  </body>

  </html>

  <?php
    if(isset($_POST['importcontacts'])){
        
        $fileContent = file_get_contents($_FILES['files']['tmp_name']);
        
        $members=explode(",",$fileContent);
        if($s_type==1){
            foreach($members as $m){
                $query="insert into email_type(segment_id,Email,registerdates)
                values('$s_id','$m',NOW())";
                $run=mysqli_query($conn,$query);
            }
            echo "<script>window.open('segment.php?success=Subscribers Added','_self')</script>";

        }
        if($s_type==2){
            foreach($members as $m){
                $query="insert into mobile_type(segment_id,Number,registerdate)
                values('$s_id','$m',NOW())";
                $run=mysqli_query($conn,$query);
            }
            echo "<script>window.open('segment.php?success=Subscribers Added','_self')</script>";


        }
        
        }
    