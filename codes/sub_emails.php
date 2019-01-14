<?php
include('connection/conn.php');
include('functions/function.php');

if(isset($_POST['subscribe']))
{
    $email=$_POST['email'];
    $check="select * from subscribers where subscriber_email='$email'";
    $run1=mysqli_query($conn,$check);
    $count=mysqli_num_rows($run1);

   
    if($count>0)
    {
        $message = "You have already Subscribed the Newsletter";
        echo "<script>alert('$message');</script>";
    }
else
{
$query="INSERT INTO subscribers(subscriber_email) VALUES ('$email')";
$run=mysqli_query($conn,$query);


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
<center>
    <h1>THANKYOU </h1>
   <h2> '.$email.' </h2> 
   <h2> FOR SUBSCRIBE OUR NEWSLETTER!</h2>
    <p>.....</p>

    <br />
    <br />
       
        
    <p style="color:blue;font-size:20px;">&copy;2019 by Campaing Bird</p></center>
        </center>

';

$mail->Subject='Thanks For Subscription';
   $mail->Body=$body;

   if($mail->send()){
  
    $err='Recovery Process Send to your email kindly check!';
    echo "<script>var error=document.getElementById('result1');
    error.innerHTML='$err';</script>";

 
    }

}

}

?>