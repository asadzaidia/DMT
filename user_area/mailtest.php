
<?php
// include('../connection/conn.php');
// include('../functions/function.php');
include('../functions/verifyEmail.php');

$not_valid_emails="Emails Not send:";
$emails_send=array();
$track_code_array=array();

$vmail = new verifyEmail(); 
$vmail->setStreamTimeoutWait(50); 
$id= getID($aa);
// $vmail->Debug= TRUE; 
$vmail->Debugoutput= 'html';
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
    foreach($EmailList as $email){
       
        
        if(!$vmail->check($email)){
    
            $not_valid_emails.=$email." ";
            continue;
        
            }
            else{
                sendmailwithAttachment($un,$body,$subject,$email);
             
        }
            
        }
        
        //inserting into campaign table after successfully send campaign
        $not_valid_emails=mb_substr($not_valid_emails, 0, -1);
        
      

        $query2="insert into campaigns(start_date,camp_title,Description,segment_id,Not_valid_emails,
          segment_type_id,Userid,invalid_numbers,countM)
          values(NOW(),'$subject','$body','$s_id','$not_valid_emails','$s_type','$id','-',0)";
         
          $runq_4=mysqli_query($conn,$query2);
		if($runq_4){

            //query for email_open_tracking
            $last_id = mysqli_insert_id($conn);
            // debug_to_console($last_id);
			
		echo "<script>window.open('index.php?success=Campaign Sucessfully Send!','_self')</script>";
				
            };



        


}
else{
    foreach($EmailList as $email){
        
        if(!$vmail->check($email)){
    
            $not_valid_emails.=$email." ";
            continue;
        
            }
            else{
                sendmailWithoutAttachment($un,$body,$subject,$email);
             
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
            
		
				
            };

}


}



//functions
function sendmailWithoutAttachment($user,$body,$subject,$email){
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
$body.='<img src="'.$base_url.'email_track.php?code='.$track_code.'"
 width="1" height="1" alt=""/>';
//  $body.='<a href="'.$base_url.'email_track.php?code='.$track_code.'"
//  >Viewed</a>';
 




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
function sendmailwithAttachment($user,$body,$subject,$email){
global $not_valid_emails;
   
    
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



 
    foreach($_FILES["attachment"]["name"] as $k=>$v){
        $mail->addAttachment($_FILES["attachment"]["tmp_name"][$k],
                      $_FILES["attachment"]["name"][$k]
    );
}




$mail->Subject=$subject;
$mail->Body=$body;
if($mail->send()){
    // echo "Email  send";
   
}
else{
    // echo "Email not send" .$mail->ErrorInfo;
}




}

// debug_to_console($not_valid_emails);


?>