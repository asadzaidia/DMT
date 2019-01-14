<?php
include('functions/function.php');
include('connection/conn.php');
// $pass="asadzaidi323232";
// //encrypting Password
// 	$encrypted_txt = encrypt_decrypt1('encrypt', $pass);
// 	$more=encrypt_decrypt2('encrypt', $encrypted_txt);
	
// 	echo "encrypted text 2 applies ".$more;

// 	 $dec_txt=encrypt_decrypt2('decrypt',$more);
	
// 	 $plain=encrypt_decrypt1('decrypt',$dec_txt);

// 	 echo "plain ".$plain;

// $string="OK asad OK 7 OK 7";
// echo $valid=substr_count($string,"OK");
// echo $invalid=substr_count($string,"7");


//finding dates of last seven days and saving it into an array.
$lastsevendates=array();

$m = date("m"); $de= date("d"); $y= date("Y");
for($i=6; $i>=0; $i--){
	$lastsevendates[] =date('Y-m-d', mktime(0,0,0,$m,($de-$i),$y)); 
	
}

//query to get data

$query=" 
select Count(campaign_id) as counts,date(start_date) as dates from campaigns where segment_id=30 
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

echo "Count of campaigns of last sevendays<br/>";

//printing to check things
for($i=0;$i<=6;$i++){
	echo $lastsevendates[$i]."  ".$count[$i]."<br/>"; 
}



//********************************************************************************** */
//this is for subscriber getting per day

//finding dates of last 30 days and saving it into an array.
$lastthirtydates=array();

$m = date("m"); $de= date("d"); $y= date("Y");
for($i=29; $i>=0; $i--){
	$lastthirtydates[] =date('Y-m-d', mktime(0,0,0,$m,($de-$i),$y)); 
	
}


//query to find count of subscribers on last 30 days 
$query2=" 
select Count(EID) as subscribers,date(registerdates) as dates from email_type
where segment_id=27 and 
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
echo "<br/><br/>
Subscribers count 30 days<br/>";
//printing to check things
for($i=0;$i<=29;$i++){
	echo $lastthirtydates[$i]."  ".$countsubscribers[$i]."<br/>"; 
}








?>

<script type='text/javascript'>
<?php

$php_array = array();
for($i=0;$i<=6;$i++){
	 $php_array[$i]=$count[$i];
}
$js_array=json_encode($php_array);

echo "var countarray = ". $js_array . ";\n";
?>
</script>



<script>
	console.log(countarray);
</script>


