<?php

include('functions/verifyEmail.php');
$vmail = new verifyEmail(); 
$vmail->setStreamTimeoutWait(50); 
$vmail->Debugoutput= 'html';
$email='asadzaidi625@hotmail.com';

if($vmail->check($email)){
    echo "valid email";   
}
else{
    echo "not valid email";
}

// require 'user_area/phpmailer/PHPMailerAutoload.php';
// $mail=new PHPMailer(true);//exception handling
// $mail->isSMTP();//using in localhost
// $mail->SMTPDebug = 2;
// $body='Testing ';
// //stackoverflow to connect smtp server
// $mail->SMTPOptions = array(
//     'ssl' => array(
//         'verify_peer' => false,
//         'verify_peer_name' => false,
//         'allow_self_signed' => true
//     )
// );
// $mail->Host='smtp.gmail.com';
// $mail->Port=587;
// $mail->SMTPAuth = true;
// $mail->SMTPSecure='tls';


// $mail->Username ='campaignbird@gmail.com';
// $mail->Password='asadzaidi625';

// $mail->setFrom('campaignbird@gmail.com','Test');//Sent from //user name


    
// $mail->addAddress('asadzaidi625@hotmail.com');
    


// $mail->isHTML(true);
// // $body.='<a href='."http://localhost/dmt".'><img src="'.$base_url.'email_track.php?code='.$track_code.'"
// //  width="1" height="1" alt="Campaign Bird"/></a>';
// // $body.='<img src="'.$base_url.'email_track.php?code='.$track_code.'"
// // width="1" height="1" alt="Campaign Bird"/>';
//  $body.='
//  <p style="color:blue;font-size:20px;">&copy;2019 by Campaing Bird</p></center>';
 




// $mail->Subject='Testing';
// $mail->Body=$body;
// if($mail->send()){

// echo "send successfully";

// }else{
//     "not send";
// }







?>