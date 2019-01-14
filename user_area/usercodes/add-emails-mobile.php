<?php
if(isset($_SESSION['username'])){
}else{
    echo "<script>window.open('../index.php','_self')</script>";

}

if(isset($_POST['addemail'])){

    $email=trimming($_POST['emailadd']);

        $query="insert into email_type(segment_id,Email,registerdates) 
        values('$s_id','$email',NOW())
        ";
        $runq_3=mysqli_query($conn,$query);

        if($runq_3){
    
        echo "<script>window.open('segment.php?success=Subscriber Added','_self')</script>";
        
        };

}

if(isset($_POST['addmobile'])){

    $code=trimming($_POST['callingcode']);

    $mobile=trimming($_POST['mobileadd']);
    $number=$code.$mobile;
   

        $query2="insert into mobile_type(segment_id,Number,registerdate) 
        values('$s_id','$number',NOW())
        ";
        $runq_4=mysqli_query($conn,$query2);

        if($runq_4){
    
        echo "<script>window.open('segment.php?success=Subscriber Added','_self')</script>";
        
        };

}








?>