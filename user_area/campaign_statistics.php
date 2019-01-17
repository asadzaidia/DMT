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
          $invalid_numbers=$row['invalid_numbers'];
          $countM=$row['countM'];
          $Not_valid_emails= substr($Not_valid_emails,16);
         
          //for email not valid
          $nv=explode(" ",$Not_valid_emails);
          //for mobile numbers not valid
          $iv=explode(",",$invalid_numbers);
          


       }
   

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

          <?php

          if($s_type==1){
            echo"
            <div class='container'>
            <div class='row'>
                <div class='col-md-12'>
                      
                  <div class='col-md-7'>
                    
                      <div class='panel panel-default' style='border-radius:0px;'>
                              <div class='panel-heading' style='background-color:#cc99ff;'>
                              <label style='background:red;'>Campaign Content!</label>
                              </div>
                              <div class='panel-body' style='min-height: 430px; max-height: 430px;overflow-y: scroll;'>
                               <h4>Dated: $start_date</h4>
                               <hr/>
                               <br />
                               <p>$desc</p>
                              
                              </div>
                            </div>
                  </div>

                  <div class='col-md-5'>
                      <div class='col-md-10'>
                              <div class='panel panel-default' style='border-radius:0px;'>
                                      <div class='panel-heading' style='background-color:#cc99ff;'>
                                        
                                        <label style='background:red;'>Duplicate Emails!</label>
                                      </div>
                                      <div class='panel-body'
                                       style='min-height: 170px; max-height: 170px;overflow-y: scroll;'>
                                       <ul class='list-group'>";
                                    
                                    
                                    if($s_type==1){
                                    $query2="SELECT Email as dup FROM email_type where segment_id='$s_id' 
                                    GROUP BY Email
                                    HAVING COUNT(*) > 1";
                                    $run2=mysqli_query($conn,$query2);
                                    $count=mysqli_num_rows($run2);
                                    if($count>0){
                                      $sid_crypted=url_crypt($s_id,'e');
                                      while($rows=mysqli_fetch_array($run2)){
                                        $flag=$rows['dup'];
                                        
                                      echo "
                                <li class='list-group-item' 
                                style='background-color:white;border:1px solid black;'>$flag</li>
                                
                                        ";
                                      }
                                      echo"
                                      <li class='list-group-item' 
                                      style='background-color:white;border:1px solid black;'>
                                    <a href='viewsegment.php?a=$sid_crypted' class='btn btn-danger'>Remove Duplication</a></li>
                                      
                                      ";
                                    }else{
                                      echo "
                                      <li class='list-group-item' 
                                      style='background-color:white;border:1px solid black;'>No Duplicate Emails!</li>
                                              ";

                                    }
                                   
                                  }
                                  
                                  echo "
                                  
                                    
                                  </ul>

                                      
                                      
                                    
                                      
                                      </div>
                                    </div>
                      </div>
                      <div class='col-md-10'>
                              <div class='panel panel-default' style='border-radius:0px;'>
                                      <div class='panel-heading' style='background-color:#cc99ff;'>
                                        
                                        <label style='background:red;'>Emails Not Send!</label>
                                      </div>
                                      <div class='panel-body'
                                       style='min-height: 170px; max-height: 170px;overflow-y: scroll;'>
                                    ";
                                       
                                        
                                          if(count($nv)>0){
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
                                            </ul>";
                                          }
                                          
                                        

                                        echo"
                                      
                                      </div>
                                    </div>
                      </div>

                  </div>

                </div>

            </div>";

            //total viewed count 
            $countopen=0;
            $qu="select count(EopenId) as countopen from email_open_tracking where campaign_id='$c_id' and s_id='$s_id' and open=1";
            $ru=mysqli_query($conn,$qu);
                                while($rowss=mysqli_fetch_array($ru)){
                                 $countopen=$rowss['countopen']; 
                                }
            
            
        echo"



            <div class='row'>
              <div class='col-md-9 col-md-offset-1'>
                <div class='panel panel-default' style='border-radius:0px;'>
                  <div class='panel-heading' style='background-color:#cc99ff;'>
                      <label style='background:red;'>Total Emails Viewed! 
                       &nbsp;<span class='badge'>$countopen</span></label>
                   
                    </div>

                    <div class='panel-body' style='min-height: 350px; max-height: 350px;overflow-y: scroll;'>

                        <table class='table'>
                            <thead>
                              <tr>
                                
                                  <th><strong>Email</strong></th>
                                  <th><strong>Viewed on DateTime</strong></th>
                                <th><strong>Viewed By User</strong></th>
                                
                                  
                                
                                
                               
                              </tr>
                            </thead>
                            <tbody>
";
                                         
                                $query="select * from email_open_tracking where campaign_id='$c_id'";
                                $run=mysqli_query($conn,$query);
                                while($row=mysqli_fetch_array($run)){
                                  $a=$row['email'];
                                  $b=$row['open'];
                                  $datetime=$row['datetime'];
                                  echo "
                                  <tr>
                                  <td>$a</td>
                                  
                                  ";
                                  if($b==0){
                                    echo "
                                    <td>-</td>
                                    <td>
                                    <label style='background:red;'>Not Viewed!</label>
                                    
                                    </td>
                                    
                                    ";
                                  }else{
                                    echo "
                                    <td>$datetime</td>
                                    <td>
                                    <label style='background:green;'>Viewed!</label>
                                    
                                    </td>
                                    
                                    ";
                                  }
                                  echo"
                                   
                                  
                                  </tr>
                                  
                                  ";
                                  
                                }

                               
                               echo "

                              </tbody>
                              </table>

                    </div>


                    </div>
              </div>
            
            </div>
        </div>

            
            ";


          }

          if($s_type==2){
            echo"
            <div class='container'>
            <div class='row'>
                <div class='col-md-12'>
                      
                  <div class='col-md-7'>
                    
                      <div class='panel panel-default' style='border-radius:0px;'>
                              <div class='panel-heading' style='background-color:#cc99ff;'>
                              <label style='background:red;'>Message Content!</label>
                              </div>
                              <div class='panel-body' style='min-height: 430px; max-height: 430px;overflow-y: scroll;'>
                               <h4>Dated: $start_date</h4>
                               <hr/>
                               <br />
                               <p>$desc</p>
                              
                              </div>
                            </div>
                  </div>

                  <div class='col-md-5'>
                      <div class='col-md-10'>
                              <div class='panel panel-default' style='border-radius:0px;'>
                                      <div class='panel-heading' style='background-color:#cc99ff;'>
                                        
                                        <label style='background:red;'>Duplicate Phone Numbers!</label>
                                      </div>
                                      <div class='panel-body'
                                       style='min-height: 170px; max-height: 170px;overflow-y: scroll;'>
                                       <ul class='list-group'>";
                                    
                                    
                                    if($s_type==2){
                                    $query2="SELECT Number as dup FROM mobile_type where segment_id='$s_id' 
                                    GROUP BY Number
                                    HAVING COUNT(*) > 1";
                                    $run2=mysqli_query($conn,$query2);
                                    $count=mysqli_num_rows($run2);
                                    if($count>0){
                                      $sid_crypted=url_crypt($s_id,'e');
                                      while($rows=mysqli_fetch_array($run2)){
                                        
                                        $flag=$rows['dup'];
                                      echo "
                                <li class='list-group-item' 
                                style='background-color:white;border:1px solid black;'>$flag</li>
                                        ";
                                      }
                                      echo"
                                      <li class='list-group-item' 
                                      style='background-color:white;border:1px solid black;'>
                                    <a href='viewsegment.php?a=$sid_crypted' class='btn btn-danger'>Remove Duplication</a></li>
                                      
                                      ";
                                    }else{
                                      echo "
                                      <li class='list-group-item' 
                                      style='background-color:white;border:1px solid black;'>No Duplicate Phone Numbers!</li>
                                              ";

                                    }
                                   
                                  }
                                  echo "</ul>

                                      
                                      
                                    
                                      
                                      </div>
                                    </div>
                      </div>
                      <div class='col-md-10'>
                              <div class='panel panel-default' style='border-radius:0px;'>
                                      <div class='panel-heading' style='background-color:#cc99ff;'>
                                        
                                        <label style='background:red;'>Messange Not Send To!</label>
                                      </div>
                                      <div class='panel-body'
                                       style='min-height: 170px; max-height: 170px;overflow-y: scroll;'>
                                    ";
                                       
                                        
                                          if(count($iv)>0){
                                            echo '<ul class="list-group">';
                                            foreach($iv as $n ){
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
                                            style='background-color:white;border:1px solid black;'>All Messages are send!</li>
                                            </ul>";
                                          }
                                          
                                        

                                        echo"
                                      
                                      </div>
                                    </div>
                      </div>

                  </div>

                </div>

            </div>


            <div class='row'>
               
               <div class='col-md-12'>
               <div class='well well-lg'>Total Messages Send:
                <span class='badge' style='background:green;'>$countM</span></div>
               </div>                           
             </div>

            
            ";



          }
          
          
          
          ?>

          

         </div>
          
          

          <!-- Body-->
         
         
            
        <!--footer-->
	    <div style="margin-top:200px;">

<?php include('UserAreaIncludes/inside_footer.php');?> 
</div>
<!--footer-->


  </body>

  </html>


          