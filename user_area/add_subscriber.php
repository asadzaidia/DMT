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
          <p style="margin-top: 160px;"></p>
          <div class="container">
              <div class="row">
                  
                  <?php 
                  if($s_type==1){
                      echo "
                      <div class='col-md-6 col-md-offset-3'>
                            <h1 class='page-header'>Add Subscriber Email </h1>
                            <div class='panel panel-default'>
                            <div class='panel-body'>
                          <form method='post' action=''>
                              <div class='form-group'>
                                  <label for='em'>Email</label>
                                  <input type='email' class='form-control' id='em' 
                                  style='height:55px; border-radius: 0px;' name='emailadd' required>
      
                              </div>
                              <button type='submit' class='btn btn-success btn-lg style' name='addemail'>Add</button>
                              
                          </form>  
      
                        </div>
                        </div>
                        </div>
                      
                      ";
                    }
                      else{
                        echo "
                        <div class='col-md-6 col-md-offset-3'>
                            <h1 class='page-header'>Add Subscriber Mobile Number </h1>
                            <div class='panel panel-default'>
                            <div class='panel-body'>
                              <form method='post' action=''>
                                  <div class='form-group'>
                                      <label for='t'>Mobile Number</label>
                                      <select name='callingcode' required>
                                      <option value='92' selected>+92 (Pakistan)</option>
                                      <option value='91' >+91 (India)</option>
                                      <option value='93' >+93 (Afghanistan)</option>
                                      <option value='44' >+44 (UK)</option>
                                      <option value='61' >+61 (Australia)</option>
                                      
                                      </select>
                                      <input type='tel' class='form-control' id='t'
                                      style='height:55px; border-radius: 0px;' name='mobileadd' required
                                      placeholder='3338976541'>
          
                                  </div>
                                  <button type='submit' class='btn btn-success btn-lg style' name='addmobile'>Add</button>
                                  
                              </form>  
          
                            </div>
                            </div>
                        </div>
                            ";

                      }
                  
                  
                  ?>

                 
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

        if(isset($_POST['addemail'])){

            $email=trimming($_POST['emailadd']);

                $query="insert into email_type(segment_id,Email,registerdates) 
                values('$s_id','$email',NOW())
                ";
                $runq_3=mysqli_query($conn,$query);

			    if($runq_3){
			
			    echo "<script>window.open('segment.php?success=Subscriber Added','_self')</script>";
				
                };

        }

        if(isset($_POST['addmobile'])){

            $code=trimming($_POST['callingcode']);

            $mobile=trimming($_POST['mobileadd']);
            $number=$code.$mobile;
           

                $query2="insert into mobile_type(segment_id,Number,registerdate) 
                values('$s_id','$number',NOW())
                ";
                $runq_4=mysqli_query($conn,$query2);

			    if($runq_4){
			
			    echo "<script>window.open('segment.php?success=Subscriber Added','_self')</script>";
				
                };

        }

        ?>