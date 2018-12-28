<?php
session_start();
include('../connection/conn.php');
include('../functions/function.php');

//getting id from function getID which used SP
if(isset($_SESSION['username'])){
	//inactivity constraint
      $aa=$_SESSION['username'];

       $c_id=url_crypt($_GET['a'],'d');
       $s_id=url_crypt($_GET['b'],'d');
       $s_type=url_crypt($_GET['c'],'d');

       $query="Select * from campaigns where campaign_id='$c_id'";
       $run=mysqli_query($conn,$query);
       while($row=mysqli_fetch_array($run)){
          $desc=$row['Description'];
          $start_date=date("d-M-y", strtotime($row['start_date']));
          $Not_valid_emails=$row['Not_valid_emails'];
          $Not_valid_emails= substr($Not_valid_emails,16);
         
          
          $nv=explode(" ",$Not_valid_emails);
          
        
          // print_r($nv);
          


       }
   

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

      <style>
      /*For input type file for email sender*/
  label{
    padding: 10px;
    background: purple; 
    display: table;
    color: #fff;
     }
     </style>

  </head>

  <body>

  	<?php  include('UserAreaIncludes/inside_navbar.php'); ?>

  		<!-- Body-->
          <p style="margin-top: 110px;"></p>

          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                        
                    <div class="col-md-7">
                      
                        <div class="panel panel-default" style="border-radius:0px;">
                                <div class="panel-heading" style="background-color:#cc99ff;">
                                <label style='background:red;'>Campaign Content!</label>
                                </div>
                                <div class="panel-body" style="min-height: 430px; max-height: 430px;overflow-y: scroll;">
                                 <h4>Dated: <?php echo $start_date;?></h4>
                                 <hr/>
                                 <br />
                                 <p>
                                  <?php
                                      echo $desc;
                                  ?>
                                 </p>
                                
                                </div>
                              </div>
                    </div>

                    <div class="col-md-5">
                        <div class="col-md-10">
                                <div class="panel panel-default" style="border-radius:0px;">
                                        <div class="panel-heading" style="background-color:#cc99ff;">
                                          
                                          <label style='background:red;'>Duplicate Emails!</label>
                                        </div>
                                        <div class="panel-body"
                                         style="min-height: 170px; max-height: 170px;overflow-y: scroll;">
                                         <ul class="list-group">
                                      <?php
                                      
                                      if($s_type==1){
                                      $query2="SELECT Email as dup FROM email_type where segment_id='$s_id' 
                                      GROUP BY Email
                                      HAVING COUNT(*) > 1";
                                      $run2=mysqli_query($conn,$query2);
                                      $count=mysqli_num_rows($run2);
                                      if($count>0){
                                        while($rows=mysqli_fetch_array($run2)){
                                          $flag=$rows['dup'];
                                        echo "
                                  <li class='list-group-item' 
                                  style='background-color:white;border:1px solid black;'>$flag</li>
                                          ";
                                        }
                                      }else{
                                        echo "
                                        <li class='list-group-item' 
                                        style='background-color:white;border:1px solid black;'>No Duplicate Emails!</li>
                                                ";

                                      }
                                     
                                    }

                                        ?>
                                        </ul>
                                      
                                        
                                        </div>
                                      </div>
                        </div>
                        <div class="col-md-10">
                                <div class="panel panel-default" style="border-radius:0px;">
                                        <div class="panel-heading" style="background-color:#cc99ff;">
                                          
                                          <label style='background:red;'>Emails Not Send!</label>
                                        </div>
                                        <div class="panel-body"
                                         style="min-height: 170px; max-height: 170px;overflow-y: scroll;">

                                         
                                            <?php
                                            if(count($nv)>1){
                                              echo '<ul class="list-group">';
                                              foreach($nv as $n ){
                                                echo "
                                                <li class='list-group-item' 
                                                style='background-color:white;border:1px solid black;'>$n</li>
                                                ";
                                              }
                                              echo ' </ul>';
                                            }
                                            else{
                                              echo"
                                              <li class='list-group-item' 
                                              style='background-color:white;border:1px solid black;'>All Emails are send!</li>
                                              ";
                                            }
                                            ?>
                                          
  
                                          
                                        
                                        </div>
                                      </div>
                        </div>

                    </div>

                  </div>

              </div>


              <div class="row">
                <div class="col-md-9 col-md-offset-1">
                  <div class="panel panel-default" style="border-radius:0px;">
                    <div class="panel-heading" style="background-color:#cc99ff;">
                        <label style='background:red;'>Total Emails Viewed! Count</label>
                     
                      </div>

                      <div class="panel-body" style="min-height: 350px; max-height: 350px;overflow-y: scroll;">

                          <table class="table">
                              <thead>
                                <tr>
                                  
                                    <th><strong>Email</strong></th>
                                  <th><strong>Viewed By User</strong></th>
                                  <th><strong>Viewed on DateTime</strong></th>
                                    
                                  
                                  
                                 
                                </tr>
                              </thead>
                              <tbody>

                                            <?php
                                  $query="select * from email_open_tracking where campaign_id='$c_id'";
                                  $run=mysqli_query($conn,$query);
                                  while($row=mysqli_fetch_array($run)){
                                    $a=$row['email'];
                                    $b=$row['open'];
                                    echo "
                                    <tr>
                                    <td>$a</td>
                                    ";
                                    if($b==0){
                                      echo "
                                      <td>
                                      <label style='background:red;'>Not Viewed!</label>
                                      
                                      </td>
                                      
                                      ";
                                    }else{
                                      echo "
                                      <td>
                                      <label style='background:green;'>Viewed!</label>
                                      
                                      </td>
                                      
                                      ";
                                    }
                                    echo"
                                     
                                    
                                    </tr>
                                    
                                    ";
                                    
                                  }

                                 ?>

                                </tbody>
                                </table>

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


          