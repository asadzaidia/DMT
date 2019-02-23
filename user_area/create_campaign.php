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

        //finding segment name from id by calling procedure
        $procedure = "CALL GetSegmentName('$s_id',@segmentname)";
        $results1 = $conn->query($procedure);
        $results2 = $conn->query("SELECT @segmentname");
        $num_rows = $results2->num_rows;
         if ($num_rows > 0) {

           while($row = $results2->fetch_object())
             {
               $segmentName=$row->{"@segmentname"};

               }
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
    <script type='text/javascript' src='../JavaScriptSpellCheck/include.js' ></script>
    <title>Campaign Bird</title>


    <style>
      /*For input type file for email sender*/
  label{
    padding: 10px;
    background: purple; 
    display: table;
    color: #fff;
     }



input[type="file"] {
    display: none;
}
    </style>


  </head>

  <body>

  	<?php  include('UserAreaIncludes/inside_navbar.php'); ?>

  		<!-- Body-->
          <p style="margin-top: 50px;"></p>

          <!-- Spell check validator that checks text area-->
          <script type='text/javascript'> $Spelling.LiveFormValidation  ('emailcampaign', 'message1'  );
          
            var names='emailcampaign';
          </script>

          

          

          
        <?php

          if($s_type==1){
            //getting emails of that segment

            $query = "select EID,Email from email_type where segment_id=$s_id";
            $result = mysqli_query($conn,$query);
            $EmailList = array();
            $EmailID=array();
            while($row = mysqli_fetch_assoc($result)) {
              $EmailID[]=$row['EID']; 
              $EmailList[] = $row['Email']; 
              
          }
      
         
            // print_r($EmailList); // to check if the results have been saved in the variable
           
            

            echo "
            <div class='container'>
            <div class='row'>
              <div class='col-md-12'>
            <h1 class='page-header'>Email Campaign!</h1>
         
          </div>
        </div>
      

            <div class='row'>
              <div class='col-md-7'>
              <form method='post' action=''  enctype='multipart/form-data'>
                <div class='form-group'>
                <input type='text' class='form-control' name='subject' style='height:40px;
                 border-radius: 0px;'  placeholder='Enter Campaign Subject*' required> 
                </div>
                <div class='form-group'>
                    <input type='text' class='form-control' name='username' style='height:40px;
                     border-radius: 0px;'  placeholder='Enter Username for Email*' required> 
                    </div>

                  <div class='panel panel-default'>
                      <div class='panel-heading'>
                        &nbsp;&nbsp;
                        <label for='emailcampaign'
                         style='border-bottom: 2px solid purple;float:left;'>Write Your Campaign!
                         <i class='fas fa-pencil-alt'></i> </label>

                         <label style='float:right; background:red;'>To: $segmentName</label>

                        </div>
                      
                      <div class='panel-body'>
                          
                              <div class='form-group'>
                                  

                                  <textarea class='form-control' rows='14' id='emailcampaign'
                                   name='emailCampaign' style='font-size:15px; display:block; font-weight: bold;' 
                                   required></textarea>
                                  
      
                              </div>
                              <div class='form-group'>

                              <label id='#bb'> Add Attachment If Any
                              <input type='file'  name='attachment[]'  multiple/><i class='fas fa-paperclip'></i>
                              </label> 
                                  
                                 
                              </div>
                              <button type='submit' class='btn btn-success btn-lg style' id='sendbutton'
                               name='send-mail' onClick='confSubmit(this.form);'>Send Campaign 
                                <i class='fas fa-share-square'></i></button>
                                ";
?>
                                <span id='message1' style='color:red;float:right;'>*
                                  <a href='#' class='btn btn-info btn-lg' style='border-radius: 0px;' onclick="$Spelling.SpellCheckInWindow('emailcampaign'); return false;">Check Spelling</a>
                                  </span>
<?php 
                               echo"

                          
                        
                      </div>

                   </div>

                        
                          </form> 

              
            </div>

            <div class='col-md-5'>
                <br><br><br>
              <ul class='list-group list-group-horizontal'>
                <li class='list-group-item'><button onmouseover='hoverHeadingin()' onclick='putHeading()' onmouseout='hoverHeadingout()' class='btn btn-default'>Heading</button></li>
                <li class='list-group-item'><button onmouseover='hoverParagaphin()' onclick='putParagraph()' onmouseout='hoverParagaphout()' class='btn btn-default'>Paragraph</button></li>
                <li class='list-group-item'><button class='btn btn-default' onclick='inputfield()'>Links</button></li>
                <li class='list-group-item'><button onmouseover='hoverboldin()' onclick='putBold()' onmouseout='hoverboldout()' class='btn btn-default'>Bold Text</button></li>
                <li class='list-group-item'><button onclick='newLine()' class='btn btn-default'>New Line</button></li>
              </ul>

              <br><br>
              <p id='action' style='font-size: 20px; font-weight: bold;'></p>
              <div id='linkfield'></div>
            
          
              </div>

             
            </div>
          
        </div>

            </div>
            
            
            ";
           
          }
          
          ?>
         
    <?php
          if($s_type==2){

              //getting emails of that segment

              $query = "select Number from mobile_type where segment_id=$s_id";
              $result = mysqli_query($conn,$query);
              $MobileList = array();
              while($row = mysqli_fetch_assoc($result)) { 
                $MobileList[] = $row['Number']; 
            }
            echo "
            <div class='container'>
            <div class='row'>
              <div class='col-md-12'>
            <h1 class='page-header'>Mobile Campaign!</h1>
              </div>
              </div>
              <div class='row'>
              <div class='col-md-7'>
              <form method='post' action=''>
                <div class='form-group'>
                    <input type='text' class='form-control' name='signature' style='height:40px;
                     border-radius: 0px;'  placeholder='SMS Signature or Sender Name' required> 
                    </div>

                  <div class='panel panel-default'>
                      <div class='panel-heading'>
                        &nbsp;&nbsp;
                        <label for='emailcampaign'
                         style='border-bottom: 2px solid purple;float:left;'>Write Your Message!
                         <i class='fas fa-pencil-alt'></i> </label>

                         <label style='float:right; background:red;'>To: $segmentName</label>

                        </div>
                      
                      <div class='panel-body'>
                          
                              <div class='form-group'>
                                  

                                  <textarea class='form-control' rows='14' id='emailcampaign'
                                   name='emailcampaign' onkeypress='checklength()' onkeydown='checklength2()'  style='font-size:15px; display:block; font-weight: bold;' 
                                   required></textarea>
                                  
      
                              </div>
                              <button type='submit' onClick='confSubmit(this.form);' class='btn btn-success btn-lg style' id='sendsms'
                               name='send-sms'>Send Campaign 
                                <i class='fas fa-share-square'></i></button>
                                <span style='color:red;'>&nbsp;&nbsp;MaxLength:250 Characters!</span>
                                <br/>
                                
                                ";
                                ?>

                                 <span id='message1' style='color:red;float:right;'>*
                                  <a href='#' class='btn btn-info btn-lg' style='border-radius: 0px;' onclick="$Spelling.SpellCheckInWindow('emailcampaign'); return false;">Check Spelling</a>
                                  </span>

              

<?php

          echo "                          

          <span style='color:blue;'>Remaining:</span><span id='rem'></span>
                        
                      </div>

                   </div>

                        
                          </form>
                          </div>
                          
                          <div class='col-md-5'>
                <br><br><br>
              <ul class='list-group list-group-horizontal'>
                <li class='list-group-item'><button class='btn btn-default' onclick='inputfield()'>Links</button></li>
                <li class='list-group-item'><button onclick='newLine()' class='btn btn-default'>New Line</button></li>
              </ul>

              <br><br>
              <p id='action' style='font-size: 20px; font-weight: bold;'></p>
              <div id='linkfield'></div>
            
          
              </div>


              
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

<!--script for html rmail builder -->
  <script src="js/htmlemail.js"></script>
  <script src="js/htmlSMS.js"></script>

  <script>
    function confSubmit(form) {
    if (confirm("Are you sure you want to send this campaign?")) {
      form.submit();
  }

  }

  </script>


  <?php
  
  include('usercodes/bulkmail.php');
  ?>


  <?php
    include('usercodes/bulksms.php')
  ?>


