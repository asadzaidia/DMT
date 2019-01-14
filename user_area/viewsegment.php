<?php
session_start();
include('../connection/conn.php');
include('../functions/function.php');
include('../functions/verifyEmail.php');
$vmail = new verifyEmail(); 
$vmail->setStreamTimeoutWait(50); 
$vmail->Debugoutput= 'html';

//getting id from function getID which used SP
if(isset($_SESSION['username'])){
	//inactivity constraint
	  $aa=$_SESSION['username'];
       $s_id=url_crypt($_GET['a'],'d');

       //getting segment name and created on
       $sql= "select * from segments where segment_id='$s_id'";
	    $run=mysqli_query($conn,$sql);

	while($rows=mysqli_fetch_array($run)){
        $segment_name=$rows['segment_name'];
        $segment_created=date("d-M-y", strtotime($rows['created_on']));
        $segment_type_id=$rows['segment_type_id'];
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

  </head>

  <body>

  	<?php  include('UserAreaIncludes/inside_navbar.php'); ?>

  		<!-- Body-->
          <p style="margin-top: 80px;"></p>
        <div class="container">
        <p id="result" style="color:red;font-weight:bold;font-size:20px;"></p>
        <div class="row">
        <h3><?php echo $segment_name;?></h3>
        <span><p>Created On: <?php echo $segment_created;?></p></span>

        <hr>
            <div class="panel panel-default">
                    <div class="panel-body">
                    <table class="table">
                            <thead>
                              <tr>
                                <th> <h3><strong>Contacts</strong></h3></th>
                                <th><h3><strong>Subscribed On</strong></h3></th>
                               
                              </tr>
                            </thead>
                            <tbody>
                              

                                <?php


                                    if($segment_type_id==1){
                                        //from email type segment
                                        $sql2= "select * from email_type where segment_id='$s_id'";
                                        $run2=mysqli_query($conn,$sql2);
                                        $label='';
                                    while($row=mysqli_fetch_array($run2)){
                                        if(@!$vmail->check($row['Email'])){
                                            $label='<span class="label label-danger">Invalid</span>';
                                            
                                        }
                                        else{
                                            $label='<span class="label label-success">Valid</span>'; 
                                        }

                                        $a=$row['Email'];
                                        $b=date("d-M-y", strtotime($row['registerdates']));
                                        $c=$row['EID'];

                                        echo "
                                        <tr id='delete$c'>
                                        <td>$a       $label</td>
                                        <td>$b</td>
                                        <td><span><button class='btn btn-danger' 
                                        style='border-radius:0px;text-decoration: none;' value='$c'
                                        onclick='getEID(this.value)'>Delete</button></span></td>
                                        </tr>
                                         ";

                                     }

                                    }
                                    if($segment_type_id==2){
                                        //from mobile type segment
                                        $sql2= "select * from mobile_type where segment_id='$s_id'";
                                        $run2=mysqli_query($conn,$sql2);
                                        $label='';
                         
                                    while($row=mysqli_fetch_array($run2)){
                                        
                                        if(strlen($row['Number'])>12){
                                        $label='<span class="label label-danger">Invalid</span>';
                                        }elseif(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $row['Number'])){
                                        $label='<span class="label label-danger">Invalid</span>';
                                        }else{
                                            $label='<span class="label label-success">Valid</span>';
                                        }
                                        $a=$row['Number'];
                                        $b=date("d-M-y", strtotime($row['registerdate']));
                                        $c=$row['MID'];

                                        echo "
                                        <tr id='delete$c'>
                                        <td>$a    $label</td>
                                        <td>$b</td>
                                        <td><span><button class='btn btn-danger' 
                                        style='border-radius:0px;text-decoration: none;' value='$c'
                                        onclick='getMID(this.value)'>Delete</button></span></td>
                                        </tr>
                                         ";

                                     }

                                    }
                                
                                ?>
                               
                            </tbody>
                          </table>
                </div>
            </div>
        </div>
        </div>
           <!-- Body-->
         
         

        <!--footer-->
	    <div style="margin-top:240px;">

<?php include('UserAreaIncludes/inside_footer.php');?> 
</div>
<!--footer-->


  </body>

  </html>

<script src="js/mobile_email_delete.js"></script>

  