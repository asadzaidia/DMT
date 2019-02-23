
<?php
include('connection/conn.php');
include('functions/function.php');

include('functions/emailvalidator/examples/single-check.php');


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
				//now checking email exist in real world or not
				$status;
    			$queryc="select status from viemails where email='$email'";
    			$resultc = mysqli_query($conn,$queryc);

    
    			$check=mysqli_num_rows($resultc);
				if($check>0){
					while($rowsd = mysqli_fetch_array($resultc)) { 
						$status= $rowsd['status'];
						 
				  }
				  if($status==0){
					$inserting="insert into registers(username,email,password) values('$username','$email','$more_secure')";


					$runq_3=mysqli_query($conn,$inserting);
	
					if($runq_3){
						$_SESSION['username']=$username;
					echo "<script>window.open('user_area/index.php','_self')</script>";
					
					}
	
					else{
						echo mysqli_error($conn);
					}
				  }

				  if($status==1){
					$err = "Email is not exists in real world";
     				echo "<script>var error=document.getElementById('result');
					error.innerHTML='$err';</script>"; 	
				}	
			
				}
				else{
					// echo "Not already exist";
				$verification = \NeverBounce\Single::check($email, true, true);
				//checking valid or invalid
				if($verification->result_integer==1){//invalid valid


					$query3="insert into viemails(email,status) values('$email','1')";
					$result3 = mysqli_query($conn,$query3);

					$err = "Email is not exists in real world";
     				echo "<script>var error=document.getElementById('result');
					error.innerHTML='$err';</script>";   
				}
				if($verification->result_integer==0){//valid
					$queryin="insert into viemails(email,status) values('$email','0')";
            		$resultin = mysqli_query($conn,$queryin);


					$inserting="insert into registers(username,email,password) values('$username','$email','$more_secure')";


					$runq_3=mysqli_query($conn,$inserting);
	
					if($runq_3){
						$_SESSION['username']=$username;
					echo "<script>window.open('user_area/index.php','_self')</script>";
					
					}
	
					else{
						echo mysqli_error($conn);
					}		

				}
		
		
			}
				
				

				

			}
		}


}

?>