<?php

session_start();

include('../../connection/conn.php');
include('../../functions/function.php');
if(isset($_SESSION['username'])){
    //inactivity constraint
    $aa=$_SESSION['username'];
}
else{

    echo "<script>window.open('../index.php','_self')</script>";
}


if(isset($_POST["MID"])){

    $mid=trimming($_POST["MID"]);

    $query="delete from mobile_type where MID='$mid'";
    $results=mysqli_query($conn,$query);
    echo "Deleted";



}





?>