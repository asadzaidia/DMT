<?php
session_start();
include('../connection/conn.php');
include('../functions/function.php');


if(isset($_GET['code'])){
    debug_to_console("agaya2!");
    
    $a=$_GET['code'];
    $query="UPDATE email_open_tracking
    set open='1'
    WHERE email_trackcode='$a'";

    $run=mysqli_query($conn,$query);

   
}







?>