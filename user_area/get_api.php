<?php

session_start();

include('../connection/conn.php');
include('../functions/function.php');
if(isset($_SESSION['username'])){
    //inactivity constraint
    $aa=$_SESSION['username'];
}
else{

    echo "no session created";
}


if(isset($_POST["segment_id"])){

    $segmentid=trimming($_POST["segment_id"]);

    $query="select 	API from segments where segment_id='$segmentid'";
    $results=mysqli_query($conn,$query);

    while($rows=mysqli_fetch_array($results)){
        $api=$rows['API'];
    }
    echo $api;



}





?>