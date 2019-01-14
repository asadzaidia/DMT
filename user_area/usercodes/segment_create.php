<?php

if(isset($_POST['create-segment'])){

    $sname=trimming($_POST['segment_name']);
    $stype=trimming($_POST['stype']);

    $check="CALL checkSegmentName('$sname','$id')";
	$results=mysqli_query($conn,$check);
	if(mysqli_num_rows($results)>0){
        $error="Segment Already Exists With That Name";
		echo "<script>document.getElementById('err').innerHTML='$error';</script>";
		
    }
    else{
    
  $api_key=api_generator($sname,$id);
     $currentDateTime = date('Y-m-d H:i:s');
     $results->close();
     $conn->next_result();

        
            $inserting="insert into segments(segment_name,API,user_id,segment_type_id,created_on) values
            ('$sname','$api_key','$id','$stype','$currentDateTime')";

        
			$runq_3=mysqli_query($conn,$inserting);

			if($runq_3){
			
			echo "<script>window.open('segment.php','_self')</script>";
				
            }
            else{
                echo mysqli_error($conn);
                $error="You cannot create segment for now!";
                echo "<script>document.getElementById('err').innerHTML='$error';</script>";
            }

    }



}



?>