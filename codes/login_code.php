
<?php
include('connection/conn.php');
include('functions/function.php');
if(isset($_POST['login'])){
	 $email=trimming($_POST['email']);
	 $pass=trimming($_POST['pass']);
	$encrypted_txt = encrypt_decrypt1('encrypt', $pass);
	 $more_secure=encrypt_decrypt2('encrypt', $encrypted_txt);

	 $query="select * from registers where email='$email' AND password='$more_secure'";
	 $run=mysqli_query($conn,$query);
	 $check=mysqli_num_rows($run);
	 if($check==0){
	 	$err='Wrong Credentials!';
	  echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";

	 }else{

	 	$row=mysqli_fetch_array($run);
		$username=$row['username'];
	 	$_SESSION['username']=$username;
	 	$_SESSION['last_login_time']=time();
		echo "<script>window.open('user_area/user_area.php','_self')</script>";
	 }



}


?>