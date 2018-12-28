<?php
header('Content-Type: application/json');
error_reporting(E_ERROR | E_PARSE);
include('../connection/conn.php');
include('../functions/function.php');

if($_GET['Apikey']&&$_GET['content']){
$content=trimming($_GET['content']);
$apikey=trimming($_GET['Apikey']);

 $sql= "select * from segments where API='$apikey'";
 $run=mysqli_query($conn,$sql);

 if(mysqli_num_rows($run)==0){
  echo json_encode("API KEY NOT VALID HTTP/1.1 400 BAD REQUEST");

 }else{
 
  while($rows=mysqli_fetch_array($run)){
    $segment_id=$rows['segment_id'];
    $segment_type_id=$rows['segment_type_id'];

    if($segment_type_id==1)
    {
      if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $content)) { 

        $sql1="insert into email_type(segment_id,Email,registerdates) values('$segment_id','$content',NOW())";
        $run1=mysqli_query($conn,$sql1);
     
        echo json_encode("Submitted HTTP/1.1 200 OK");
      } 
      else { 
        echo json_encode("EMAIL NOT VALID HTTP/1.1 400 BAD REQUEST"); 
      } 

      
       
       
    }
    else
    {
      $sql2="insert into mobile_type(segment_id,Number,registerdate) values('$segment_id','$content',NOW())";
      $run2=mysqli_query($conn,$sql2);
      echo json_encode("Submitted HTTP/1.1 200 OK");
    }

  }

    

    }
  }
  else{
    echo json_encode("NOT FOUND url parameter HTTP/1.1 404 NOT FOUND");
  }

?>