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
        include('usercodes/add-emails-mobile.php');

        ?>