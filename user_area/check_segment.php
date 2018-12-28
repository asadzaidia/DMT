<?php

session_start();
if(isset($_SESSION['username'])){
	//inactivity constraint
      $aa=$_SESSION['username'];
     
  }
 else{

 	echo "no session created";
 }

 

include('../connection/conn.php');
include('../functions/function.php');

if(isset($_POST["segmentname"])){

    $segmentname=trimming($_POST["segmentname"]);


//getting id from function getID which used SP
$id= getID($aa);

    if(empty($segmentname)){
        echo '<span class="label label-danger"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Segment Name Can Not be Empty!</span>';


    }else{
        //now checking segment_name available or not
   

    $check="CALL checkSegmentName('$segmentname','$id')";
	$results=mysqli_query($conn,$check);
	if(mysqli_num_rows($results)>0){
		echo '<span class="label label-danger"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>You have already Segment with this Name!</span>';
		
	}

	else{
		echo '<span class="label label-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>You can take this Segment Name!</span>';
	
	}


    }

   
}

?>