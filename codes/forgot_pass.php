<?php
if(isset($_POST['send'])){
    $email=trimming($_POST['emailadd']);
    $query="select password,username from registers where email='$email'";
    $run=mysqli_query($conn,$query);
   $check=mysqli_num_rows($run);
   
if($check==0){
    $err='Email Not Exists In The System!';
 echo "<script>var error=document.getElementById('result');
error.innerHTML='$err';</script>";

}else{
   $row=mysqli_fetch_array($run);
   $pass=$row['password'];
   $un=$row['username'];
   $more_secure=encrypt_decrypt2('decrypt', $pass);
   $decrypted_txt = encrypt_decrypt1('decrypt', $more_secure);
   require 'user_area/phpmailer/PHPMailerAutoload.php';
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

   $mail->setFrom('campaignbird@gmail.com','Campaign Bird');//Sent from //user name



   $mail->addAddress($email);



   $mail->isHTML(true);
   $body='
       <h1>Hello  '.$un.' </h1>
       <p>We Noticed That You tried to recover your password!</p>
       <p><b>Here is your recovered password: '.$decrypted_txt.'</b></p>
       <br />
       <br />
           <center>
           
           <p style="color:blue;font-size:20px;">&copy;2019 by Campaing Bird</p></center>
           </center>

   ';





   $mail->Subject='Password Recovery!';
   $mail->Body=$body;
   if($mail->send()){
  
       $err='Recovery Process Send to your email kindly check!';
       echo "<script>var error=document.getElementById('result1');
       error.innerHTML='$err';</script>";
   
    
       }

}
}

?>