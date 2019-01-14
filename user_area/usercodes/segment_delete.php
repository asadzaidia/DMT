<?php

if(isset($_POST['yes'])){
    // debug_to_console("yessss!");
    $query="delete from segments where segment_id='$s_id'";
    $run=mysqli_query($conn,$query);
    if($run){
        echo "<script>window.open('segment.php?delete=Segment deleted Successfully!','_self')</script>";
    }
  }
  if(isset($_POST['no'])){
    echo "<script>window.open('segment.php','_self')</script>";
}





?>