
<?php
// include('../connection/conn.php');
// include('../functions/function.php');
include('../functions/emailvalidator/examples/single-check.php');
@session_start();
if(isset($_SESSION['username'])){
}else{
    echo "<script>window.open('../index.php','_self')</script>";

}


$not_valid_emails="Emails Not send:";
$emails_send=array();
$track_code_array=array();


$id= getID($aa);

$base_url='http://localhost/dmt/user_area/';





?>



<?php
if(isset($_POST['send-mail'])){
    require 'phpmailer/PHPMailerAutoload.php';
     $un=$_POST['username'];
     $subject=$_POST['subject'];
     $body=$_POST['emailCampaign'];
     $test='';
     //checking if attachments are attached
    
     foreach($_FILES['attachment']['tmp_name'] as $key => $tmp_name ){
          if(!empty($_FILES['attachment']['tmp_name'][$key])){
          $test='uploaded'; 
      }
      else{
        //   echo "No file uploaded";
      }
  }


if(strlen($test)>0){
    foreach($EmailList as $index =>$email){
    $status;
    $query2="select status from viemails where email='$email'";
    $result2 = mysqli_query($conn,$query2);


    $check=mysqli_num_rows($result2);

       //if email already exist then we get directly valid or invalid status
        if($check>0){
        while($rows = mysqli_fetch_array($result2)) { 
        $status= $rows['status'];
   
    }

    
    
    //now checking valid or invalid if status==0 means valid if status==1 means invalid
    if($status==0){
        sendmailwithAttachment($un,$body,$subject,$email,$EmailID[$index]); 
    }
    if($status==1){
       
        $not_valid_emails.=$email." ";
            continue;
}
}
    //if emails is not in available then we have to check and save into our table for future
    else{
        // echo "Not already exist";
    $verification = \NeverBounce\Single::check($email, true, true);
    //checking valid or invalid
    if($verification->result_integer==0){//means valid
        // echo "and valid" .$email;
        $query3="insert into viemails(email,status) values('$email','0')";
        $result3 = mysqli_query($conn,$query3);
        sendmailwithAttachment($un,$body,$subject,$email,$EmailID[$index]);  
    }
    if($verification->result_integer==1){//invalid valid
        // echo "and invalid" .$email;
        $query3="insert into viemails(email,status) values('$email','1')";
        $result3 = mysqli_query($conn,$query3);
        $not_valid_emails.=$email." ";
            continue;   
    }


}

            
        }
        
        //inserting into campaign table after successfully send campaign
        $not_valid_emails=mb_substr($not_valid_emails, 0, -1);
        
      

        $query3="insert into campaigns(start_date,camp_title,Description,segment_id,Not_valid_emails,
        segment_type_id,Userid,invalid_numbers,countM)
        values(NOW(),'$subject','$body','$s_id','$not_valid_emails','$s_type','$id','-',0)";
       
        $runq_5=mysqli_query($conn,$query3);

      if($runq_5){
          $latest_campaign_id = mysqli_insert_id($conn);

          foreach(array_combine($emails_send,$track_code_array) as $email => $code){
              
              
              $quer="insert into email_open_tracking(campaign_id,s_id,email,email_trackcode,open)
              values('$latest_campaign_id','$s_id','$email','$code',0)";
              $ru=mysqli_query($conn,$quer);
              if($ru){
                  echo "<script>window.open('index.php?success=Campaign Sucessfully Send!','_self')</script>";
              }
              

              
          }
          
      
              
          }



        


}
else{

    // $codes as $index => $code
    foreach($EmailList as $index =>$email ){
        $status;
        $query2="select status from viemails where email='$email'";
        $result2 = mysqli_query($conn,$query2);
    
    
        $check=mysqli_num_rows($result2);
    
           //if email already exist then we get directly valid or invalid status
            if($check>0){
            while($rows = mysqli_fetch_array($result2)) { 
            $status= $rows['status'];
       
        }
    
        
        
        //now checking valid or invalid if status==0 means valid if status==1 means invalid
        if($status==0){
            sendmailWithoutAttachment($un,$body,$subject,$email,$EmailID[$index]); 
        }
        if($status==1){
           
            $not_valid_emails.=$email." ";
                continue;
    }
    }
        //if emails is not in available then we have to check and save into our table for future
        else{
            // echo "Not already exist";
        $verification = \NeverBounce\Single::check($email, true, true);
        //checking valid or invalid
        if($verification->result_integer==0){//means valid
            // echo "and valid" .$email;
            $query3="insert into viemails(email,status) values('$email','0')";
            $result3 = mysqli_query($conn,$query3);
            sendmailWithoutAttachment($un,$body,$subject,$email,$EmailList[$index]); 
        }
        if($verification->result_integer==1){//invalid valid
            // echo "and invalid" .$email;
            $query3="insert into viemails(email,status) values('$email','1')";
            $result3 = mysqli_query($conn,$query3);
            $not_valid_emails.=$email." ";
                continue;   
        }
    
    
    }
    
                
            }


        //inserting into campaign table after successfully send campaign
       
        $not_valid_emails=mb_substr($not_valid_emails, 0, -1);
        
        $query3="insert into campaigns(start_date,camp_title,Description,segment_id,Not_valid_emails,
          segment_type_id,Userid,invalid_numbers,countM)
          values(NOW(),'$subject','$body','$s_id','$not_valid_emails','$s_type','$id','-',0)";
         
          $runq_5=mysqli_query($conn,$query3);

		if($runq_5){
            $latest_campaign_id = mysqli_insert_id($conn);

            foreach(array_combine($emails_send,$track_code_array) as $email => $code){
                
                
                $quer="insert into email_open_tracking(campaign_id,s_id,email,email_trackcode,open)
                values('$latest_campaign_id','$s_id','$email','$code',0)";
                $ru=mysqli_query($conn,$quer);
                if($ru){
                    echo "<script>window.open('index.php?success=Campaign Sucessfully Send!','_self')</script>";
                }
                

                
            }
            
		
				
            }

}


}



//functions
function sendmailWithoutAttachment($user,$body,$subject,$email,$email_id){
    global $not_valid_emails;
    global $emails_send;
    global $track_code_array;
    global $base_url;
    global $s_id;
    

    //always generating unique number
    $value=getUniquenumber();
    $track_code=md5($value);
    
$mail=new PHPMailer(true);//exception handling
$mail->isSMTP();//using in localhost
// $mail->SMTPDebug = 2;
//stackoverflow to connect smtp server
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth = true;
$mail->SMTPSecure='tls';


$mail->Username ='campaignbird@gmail.com';
$mail->Password='asadzaidi625';

$mail->setFrom('campaignbird@gmail.com',$user);//Sent from //user name


    
     $mail->addAddress($email);
    


$mail->isHTML(true);
// $body.='<a href='."http://localhost/dmt".'><img src="'.$base_url.'email_track.php?code='.$track_code.'"
//  width="1" height="1" alt="Campaign Bird"/></a>';
// $body.='<img src="'.$base_url.'email_track.php?code='.$track_code.'"
// width="1" height="1" alt="Campaign Bird"/>';
 $body.='<center><a href="'.$base_url.'addd.php?code='.$track_code.'"
 style="background-color: #4CAF50;
 border: none;
 color: white;
 padding: 15px 32px;
 text-align: center;
 text-decoration: none;
 display: inline-block;
 font-size: 16px;
 margin: 4px 2px;
 cursor: pointer;">Mark As Read</a>
 <p style="color:blue;font-size:20px;">&copy;2019 by Campaing Bird</p></center>';
 



$body.='<center><a href="'.$base_url.'unsubscribe.php?eid='.$email_id.'">Unsubscribe</a></center>';
$mail->Subject=$subject;
$mail->Body=$body;
if($mail->send()){
    // echo "Email  send";

    //adding to array so that store in email_track_table to track
    array_push($emails_send,$email);
    array_push($track_code_array,$track_code);
   
}
else{
    // echo "Email not send" .$mail->ErrorInfo;
}


}



//attachment
function sendmailwithAttachment($user,$body,$subject,$email,$email_id){
    global $not_valid_emails;
    global $emails_send;
    global $track_code_array;
    global $base_url;
    global $s_id;

    //always generating unique number
    $value=getUniquenumber();
    $track_code=md5($value);
   
    
$mail=new PHPMailer(true);//exception handling
$mail->isSMTP();//using in localhost
// $mail->SMTPDebug = 2;
//stackoverflow to connect smtp server
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth = true;
$mail->SMTPSecure='tls';


$mail->Username ='campaignbird@gmail.com';
$mail->Password='asadzaidi625';

$mail->setFrom('campaignbird@gmail.com',$user);//Sent from //user name


    
     $mail->addAddress($email);
    


$mail->isHTML(true);

$body.='<center><a href="'.$base_url.'addd.php?code='.$track_code.'"
style="background-color: #4CAF50;
border: none;
color: white;
padding: 15px 32px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin: 4px 2px;
cursor: pointer;">Mark As Read</a>
<p style="color:blue;font-size:20px;">&copy;2019 by Campaing Bird</p></center>';
$body.='<center><a href="'.$base_url.'unsubscribe.php?eid='.$email_id.'">Unsubscribe</a></center>';



 
    foreach($_FILES["attachment"]["name"] as $k=>$v){
        $mail->addAttachment($_FILES["attachment"]["tmp_name"][$k],
                      $_FILES["attachment"]["name"][$k]
    );
}




$mail->Subject=$subject;
$mail->Body=$body;
if($mail->send()){
    array_push($emails_send,$email);
    array_push($track_code_array,$track_code);
   
}
else{
    // echo "Email not send" .$mail->ErrorInfo;
}




}

// debug_to_console($not_valid_emails);


?>