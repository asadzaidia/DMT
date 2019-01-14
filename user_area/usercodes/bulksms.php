<?php

if(isset($_POST['send-sms'])){
    $invalid_numbers='';
     $signature=$_POST['signature'];
    $sms=$_POST['emailcampaign'];

      $sms.='\n'.'From: '.$signature;
    
    

    // $newmsg = str_replace(' ', '%20', $sms);
    $mobilenumbers='';
    foreach($MobileList as $m){
      if(strlen($m)>12){
        $invalid_numbers.=$m.',';
      }else{
        $mobilenumbers.=$m.',';

      }
      
    }
    $invalid_numbers=substr_replace($invalid_numbers ,"",-1);
    $mobilenumbers=substr_replace($mobilenumbers ,"",-1);  
    //  debug_to_console($mobilenumbers);
    //  debug_to_console($invalid_numbers);
  


    $post = "sender=".urlencode('Alert')."&mobile=".urlencode($mobilenumbers)."&message=".urlencode($sms)."";
    $url = "https://sendpk.com/api/sms.php?username=923152574917&password=5384";

      
        $ch=curl_init();
        $timeout = 30; // set to zero for no timeout
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result=curl_exec($ch); 

        if(curl_exec($ch)){
          $count=substr_count($result,"OK"); 
         
          $query2="insert into campaigns(start_date,camp_title,Description,segment_id,Not_valid_emails,
          segment_type_id,Userid,invalid_numbers,countM)
          values(NOW(),'-','$sms','$s_id','-','$s_type','$id','$invalid_numbers','$count')";
         
          $runq_4=mysqli_query($conn,$query2);
  
      if($runq_4){
        
            echo "<script>window.open('index.php?success=Campaign Sucessfully Send!','_self')</script>";
            curl_close($ch);
              };
        }
        





  }








?>