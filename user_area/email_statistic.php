<?php
include('../functions/verifyEmail.php');
$vmail = new verifyEmail(); 
$vmail->setStreamTimeoutWait(50); 
$vmail->Debugoutput= 'html';
//valid and invalid email counts
$valid_emails=array();
$invalid_emails=array();
$countvalidinvalid=array();

$query = "select Email from email_type where segment_id=$s_id";
            $result = mysqli_query($conn,$query);
            $EmailList = array();
            while($row = mysqli_fetch_assoc($result)) { 
              $EmailList[] = $row['Email']; 
}

foreach($EmailList as $email){
    if(@!$vmail->check($email)){

        $invalid_emails[]=$email;
    } 
    else{
        $valid_emails[]=$email;
    } 
}
$countvalidinvalid[]=sizeof($invalid_emails);
$countvalidinvalid[]=sizeof($valid_emails);
$sid_crypted=url_crypt($s_id,'e');







//campaign statistics last sevendays
$lastsevendates=array();
                $m = date("m"); $de= date("d"); $y= date("Y");
                 for($i=6; $i>=0; $i--){
	              $lastsevendates[] =date('Y-m-d', mktime(0,0,0,$m,($de-$i),$y)); 
	
                }

                 //query to get data

                 $query=" 
                 select Count(campaign_id) as counts,date(start_date) as dates from campaigns where segment_id=$s_id
                 and date(start_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 DAY) AND CURDATE()
                 group by date(start_date)
                 ";

                 $run=mysqli_query($conn,$query);
                 $count=array();

                 while($rows=mysqli_fetch_array($run)){
	             $counts=$rows['counts'];
	             $dates=$rows['dates'];
                 //matching dates of counts and saving on that particular index
	             for($i=0;$i<=6;$i++){
		         if($dates==$lastsevendates[$i]){
				   $count[$i]=$counts;
				}
		 
	            }
           }

             //saving 0 on dates where there is no count
             for($i=0;$i<=6;$i++){
	         if(empty($count[$i])){
		     $count[$i]=0;
	         }
	         else{
		      continue;
	         }
           }
            

             $count1=array();
             $total_count=0;
            for($i=0;$i<=6;$i++)
             {
	          $count1[$i]=$count[$i];
	          $total_count=$total_count+$count1[$i];
             }

            //********************************************************************************** */
            //finding dates of last 30 days and saving it into an array.
             $lastthirtydates=array();

            $m = date("m"); $de= date("d"); $y= date("Y");
             for($i=29; $i>=0; $i--){
	         $lastthirtydates[] =date('Y-m-d', mktime(0,0,0,$m,($de-$i),$y)); 
	
             }


//query to find count of subscribers on last 30 days 
            $query2=" 
            select Count(EID) as subscribers,date(registerdates) as dates from email_type
            where segment_id=$s_id and 
            date(registerdates) BETWEEN DATE_SUB(CURDATE(),INTERVAL 29 DAY) AND CURDATE()
            group by date(registerdates)
            ";

            $run2=mysqli_query($conn,$query2);
            $countsubscribers=array();

            while($rows=mysqli_fetch_array($run2)){
	        $subscribers=$rows['subscribers'];
	        $dates=$rows['dates'];
            //matching dates of counts and saving on that particular index
	        for($i=0;$i<=29;$i++){
		     if($dates==$lastthirtydates[$i]){
              $countsubscribers[$i]=$subscribers;
			 }
		 }
		}
         //saving 0 on dates where there is no count
         for($i=0;$i<=29;$i++){
	      if(empty($countsubscribers[$i])){
		   $countsubscribers[$i]=0;
		}
	    else{
		continue;
	    }
        }
        

         $count2=array();
         $total_Subscriber=0;
         for($i=0;$i<=29;$i++)
          {
	        $count2[$i]=$countsubscribers[$i];
	        $total_Subscriber=$total_Subscriber+$count2[$i];
          }

              echo" <h2 >CAMPAIGN STATISTICS LAST 7 DAYS <span class='badge' style='padding:0.9%; background-color:#993366; font-size:18px; '>$total_count</span></h2>
				<hr>
				<canvas id='bar-chart' width='800' height='250'></canvas>
				<br>
				<br>
				<h2 >SUBSCRIBER STATISTICS LAST 30 DAYS <span class='badge' style='padding:0.9%;  background-color:#993366; font-size:18px;'>$total_Subscriber</span></h2>
				<hr>
                <canvas id='line-chart' width='800' height='250'></canvas>
                
                <h2>VALID AND INVALID EMAILS STATISTICS</h2>
				<hr>
                <canvas id='pie-chart' width='800' height='250'></canvas> 
                <br>
                <center><a href='viewsegment.php?a=$sid_crypted' 
                class='btn btn-info btn-lg' style='border-radius:0px;'>View Details</a></center>";
               
           ;
                
?>

<script>

var con=<?php echo json_encode($count1) ?>;
				//console.log(con);
				var date=<?php echo json_encode($lastsevendates) ?>;
				//console.log(con);
				var ctx = document.getElementById("bar-chart");
				var myChart = new Chart(ctx, {
                 type: 'bar',
                 data: {
                    labels:date,
                 datasets: [{
                     label: 'campaign statistics last 7 days',
					 backgroundColor: " #993366",
                     data:con
					         }]
    },
	options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true,
				steps: 10,
              stepValue: 5,
            max: 10
            }
        }]
    },
}    
});



				var s_con=<?php echo json_encode($count2) ?>;
				//console.log(s_con);
				var s_date=<?php echo json_encode($lastthirtydates) ?>;
				//console.log(s_date);
				var ctx = document.getElementById("line-chart");
				var myChart = new Chart(ctx, {
                 type: 'line',
                 data: {
                    labels:s_date,
                 datasets: [{
                     label: 'subscriber statistics last 30 days',
					data:s_con,
					 backgroundColor: " #993366"
        }]
    },
	options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true,
				steps: 5,
              stepValue: 5,
            max: 20
            }
        }]
    }
}    
});

var ctx = document.getElementById("pie-chart");
var validInvalid=<?php echo json_encode($countvalidinvalid) ?>;
var myChart = new Chart(ctx, {
                 type: 'pie',
                 data : {
                datasets: [{
                data: validInvalid,
                backgroundColor:['#ff0000','#006600']
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Invalid Emails',
        'Valid Emails'
    ]
}   
});
</script>