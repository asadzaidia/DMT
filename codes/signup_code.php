
<?php
include('connection/conn.php');
include('functions/function.php');
include_once ('functions/verifyEmail.php');
$vmail = new verifyEmail(); 
        $vmail->setStreamTimeoutWait(20); 
        $vmail->Debug= TRUE; 
        $vmail->Debugoutput= 'html'; 

if(isset($_POST['register'])){

	 $username=trimming($_POST['username']);
	 $email=trimming($_POST['email']);
	 $pass=trimming($_POST['password']);
	 $cp=trimming($_POST['c-password']);

	  if($username==''){

	$err='Username is required';
	  echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";
		}

		elseif(!ctype_alnum($username)){
	$err="Username Can only contain letter and digits";
	  echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";
		}

	elseif(strlen($username)<8){
		$err="Username minimum of eight characters long";
		echo "<script>var error=document.getElementById('result');
         error.innerHTML='$err';</script>";
		}

	   elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
   		$err = "Invalid email";
     	echo "<script>var error=document.getElementById('result');
    	error.innerHTML='$err';</script>"; 
		}

		elseif(!$vmail->check($email)){
		$err = "Email is not exists in real world";
     	echo "<script>var error=document.getElementById('result');
    	error.innerHTML='$err';</script>"; 
		}

		elseif($pass==' '){

		$err='Password is Required';
		echo "<script>var error=document.getElementById('result');
    	error.innerHTML='$err';</script>";
		}

		elseif(strlen($pass)<8){
		$err="Password minimum of eight characters long";
		echo "<script>var error=document.getElementById('result');
    	error.innerHTML='$err';</script>";
		}
		
		elseif(!ctype_alnum($pass)){
		$err="Password Can only contain letter and digits";
		echo "<script>var error=document.getElementById('result');
    	error.innerHTML='$err';</script>";
		}

		elseif($pass!==$cp){

		$err='Password does not match';
	 	echo "<script>var error=document.getElementById('result');
    	error.innerHTML='$err';</script>";
		}

		else{
			//encryption of password 2 walls
			$encrypted_txt = encrypt_decrypt1('encrypt', $pass);
			$more_secure=encrypt_decrypt2('encrypt', $encrypted_txt);

			//checking email already exists
			$email_exists="CALL check_email('$email')";
			$results=mysqli_query($conn,$email_exists);
			$count=mysqli_num_rows($results);
			if($count>0){
				$err='Email Already Exist';
				echo "<script>var error=document.getElementById('result');
   				 error.innerHTML='$err';</script>";
   				 exit();
			}

			else{

				//due to stroed procedure i am clearing buffer
				$results->close();
    			$conn->next_result();
				
				

				$inserting="insert into registers(username,email,password) values('$username','$email','$more_secure')";


				$runq_3=mysqli_query($conn,$inserting);

				if($runq_3){
					$_SESSION['username']=$username;
				echo "<script>window.open('user_area/user_area.php','_self')</script>";
				
				}

				else{
					echo mysqli_error($conn);
				}

			}
		}


}

?>