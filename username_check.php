<?php
include('connection/conn.php');
include('functions/function.php');

//
if(isset($_POST["user_name"])){

	$un=$_POST["user_name"];
	if(strlen($un)<8){
	echo '<span class="label label-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>  Username minimum of eight characters long</span>';
	
	echo '<script>document.getElementById("register").disabled = true;</script>';	
	}

	else if(!ctype_alnum($un)){
		echo '<span class="label label-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>  Can only contains letters and digits</span>';
		echo '<script>document.getElementById("register").disabled = true;</script>';
	}

	else{
	$sql="CALL check_username('$un')";
	$result=$conn->query($sql);
	if(mysqli_num_rows($result)>0){
		echo '<span class="label label-danger"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>  Username is not available</span>';
		echo '<script>document.getElementById("register").disabled = true;</script>';
	}

	else{
		echo '<span class="label label-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  Username Available</span>';
		echo '<script>document.getElementById("register").disabled = false;</script>';
	}
	

}
}

?>