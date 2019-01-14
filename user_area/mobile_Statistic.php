<?php
//valid and invalid contacts
$invalid_contacts=array();
$valid_contacts=array();
$count_valid_invalid_contacts=array();

$query = "select Number from mobile_type where segment_id=$s_id";
$result = mysqli_query($conn,$query);
$MobileList = array();
while($row = mysqli_fetch_assoc($result)) { 
  $MobileList[] = $row['Number']; 
}

foreach($MobileList as $m){
    if(strlen($m)>12){
        $invalid_contacts[]=$m;
    }elseif(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $m)){
        $invalid_contacts[]=$m;
      }else{
        $valid_contacts[]=$m;

    }
    
  }
  $count_valid_invalid_contacts[]=sizeof($invalid_contacts);
  $count_valid_invalid_contacts[]=sizeof($valid_contacts);



$sid_crypted=url_crypt($s_id,'e');

$mlastsevendates=array();
$m = date("m"); $de= date("d"); $y= date("Y");
 for($i=6; $i>=0; $i--){
  $mlastsevendates[] =date('Y-m-d', mktime(0,0,0,$m,($de-$i),$y)); 

}

foreach($mlastsevendates as $m){
    debug_to_console($m);
}

 //query to get data

 $query=" 
 select Count(campaign_id) as counts,date(start_date) as dates from campaigns where segment_id=$s_id
 and date(start_date) BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 DAY) AND CURDATE()
 group by date(start_date)
 ";

 $run1=mysqli_query($conn,$query);
 $mcount=array();

 while($rows=mysqli_fetch_array($run1)){
 $mcounts=$rows['counts'];
 $mdates=$rows['dates'];
 //matching dates of counts and saving on that particular index
 for($i=0;$i<=6;$i++){
 if($mdates==$mlastsevendates[$i]){
   $mcount[$i]=$mcounts;
}

}
}

//saving 0 on dates where there is no count
for($i=0;$i<=6;$i++){
if(empty($mcount[$i])){
$mcount[$i]=0;
}
else{
continue;
}
}

$mcount1=array();
$mtotal_count=0;
for($i=0;$i<=6;$i++)
{
$mcount1[$i]=$mcount[$i];
$mtotal_count=$mtotal_count+$mcount1[$i];
}

//********************************************************************************** */
//finding dates of last 30 days and saving it into an array.
$mlastthirtydates=array();

$m = date("m"); $de= date("d"); $y= date("Y");
for($i=29; $i>=0; $i--){
$mlastthirtydates[] =date('Y-m-d', mktime(0,0,0,$m,($de-$i),$y)); 

}


//query to find count of subscribers on last 30 days 
$query2=" 
select Count(MID) as subscribers,date(registerdate) as dates from mobile_type
where segment_id=$s_id and 
date(registerdate) BETWEEN DATE_SUB(CURDATE(),INTERVAL 29 DAY) AND CURDATE()
group by date(registerdate)
";

$mrun2=mysqli_query($conn,$query2);
$mcountsubscribers=array();

while($rows=mysqli_fetch_array($mrun2)){
$msubscribers=$rows['subscribers'];
$mdates=$rows['dates'];
//matching dates of counts and saving on that particular index
for($i=0;$i<=29;$i++){
if($mdates==$mlastthirtydates[$i]){
$mcountsubscribers[$i]=$msubscribers;
}
}
}
//saving 0 on dates where there is no count
for($i=0;$i<=29;$i++){
if(empty($mcountsubscribers[$i])){
$mcountsubscribers[$i]=0;
}
else{
continue;
}
}


$mcount2=array();
$mtotal_Subscriber=0;
for($i=0;$i<=29;$i++)
{
$mcount2[$i]=$mcountsubscribers[$i];
$mtotal_Subscriber=$mtotal_Subscriber+$mcount2[$i];
}

echo" <h2>CAMPAIGN STATISTICS LAST 7 DAYS <span class='badge' style='padding:0.9%;'>$mtotal_count</span></h2>
<hr>
<canvas id='mbar' width='800' height='250'></canvas>
<br>
<br>
<h2>SUBSCRIBER STATISTICS LAST 30 DAYS <span class='badge' style='padding:0.9%;'> $mtotal_Subscriber</span></h2>
<hr>
<canvas id='mline' width='800' height='250'></canvas>
<h2>VALID AND INVALID NUMBERS CONTACTS</h2>
				<hr>
                <canvas id='pie-chart' width='800' height='250'></canvas> 
                <br>
                <center><a href='viewsegment.php?a=$sid_crypted' 
                class='btn btn-info btn-lg' style='border-radius:0px;'>View Details</a></center>";



?>


<script>
	var mcon=<?php echo json_encode($mcount1) ?>;
				
				var mdate=<?php echo json_encode($mlastsevendates) ?>;
			
				var ctx = document.getElementById("mbar");
				var myChart = new Chart(ctx, {
                 type: 'bar',
                 data: {
                    labels:mdate,
                 datasets: [{
                     label: 'campaign statistics last 7 days',
					 backgroundColor: " #993366",
                     data:mcon
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
	            var mscon=<?php echo json_encode($mcount2) ?>;
	
				var msdate=<?php echo json_encode($mlastthirtydates) ?>;
			
				var ctx = document.getElementById("mline");
				var myChart1 = new Chart(ctx, {
                 type: 'line',
                 data: {
                    labels:msdate,
                 datasets: [{
                     label: 'subscriber statistics last 30 days',
					data:mscon,
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
var validInvalid=<?php echo json_encode($count_valid_invalid_contacts) ?>;
var myChart = new Chart(ctx, {
                 type: 'pie',
                 data : {
                datasets: [{
                data:validInvalid,
                backgroundColor:['#ff0000','#006600']
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Invalid Contacts',
        'Valid Contacts'
    ]
}   
});




		
				</script>
