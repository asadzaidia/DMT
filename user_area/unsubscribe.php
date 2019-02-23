<?php
session_start();

include('../connection/conn.php');
if(isset($_GET['eid'])){
    // debug_to_console("agaya2!");
    
    $a=$_GET['eid'];
    $query="delete from email_type where EID='$a'";
    $results=mysqli_query($conn,$query);
    echo "You Have unsubscribed successfully";

}

?>