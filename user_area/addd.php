<?php
session_start();
header('Content-Type: image/png');
include('../connection/conn.php');
include('../functions/function.php');


if(isset($_GET['code'])){
    // debug_to_console("agaya2!");
    
    $a=$_GET['code'];
    $query="UPDATE email_open_tracking
    set open='1'
    WHERE email_trackcode='$a'";

    $run=mysqli_query($conn,$query);

}
if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off');	}
    header('Pragma: public'); 	// required
    header('Expires: 0');		// no cache
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private',false);
    header('Content-Disposition: attachment; filename="confirm.png"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: '.filesize('confirm.png'));	// provide file size
    readfile('confirm.png');		// push it out
    exit();







?>