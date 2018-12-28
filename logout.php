<?php
session_start();
session_destroy();
@$err=$_GET['logout'];
if(!empty($err)){
echo "<script>window.open('inactivity.php','_self')</script>";
}
else{
	echo "<script>window.open('login.php','_self')</script>";

}




?>