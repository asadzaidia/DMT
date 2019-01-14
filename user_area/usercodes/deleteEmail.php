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


if(isset($_POST["EID"])){

    $eid=trimming($_POST["EID"]);

    $query="delete from email_type where EID='$eid'";
    $results=mysqli_query($conn,$query);
    echo "Deleted";



}





?>