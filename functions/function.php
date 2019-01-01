<?php
// include('../connection/conn.php');

function trimming($data) {

 			 $data = trim($data);
  			$data = stripslashes($data);
 	 		$data = htmlspecialchars($data);
  			return $data;
            }

            function debug_to_console( $data ) {
                $output = $data;
                if ( is_array( $output ) )
                    $output = implode( ',', $output);
            
                echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
            }
            
function api_generator($sname,$id){
    $key=$id."fypdmtse4thkey".$sname;
    // debug_to_console($key);
    $api_key=sha1($key);

    return $api_key;
}


function encrypt_decrypt1($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'fypdmtse4th';
    $secret_iv = 'asad2233';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function encrypt_decrypt2($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'fypubitse3rd4th';
    $secret_iv = 'khadija2233';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

//function to getid from username

function getID($username){
    //getting id from sp using username
    include('../connection/conn.php');
$sql="CALL getID('$username')";
$results=mysqli_query($conn,$sql);
 while ($row = $results->fetch_assoc()) {
    $id= $row['user_id'];
}
//due to stroed procedure i am clearing buffer
$results->close();
$conn->next_result();

return $id;
}


//for urls
function url_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'asad';
    $secret_iv = 'owl';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}
			
function getUniquenumber(){
    global $conn;
  
$query="select value from uniqueid where uid=10";
$run=mysqli_query($conn,$query);
if($run){
    $value;
    $returnValue;
    while($row=mysqli_fetch_array($run)){
        $value=$row['value'];
        $returnValue=$row['value'];

       
    }
    $value++;


    $query2="update uniqueid set value='$value' where uid=10";
    $run2=mysqli_query($conn,$query2);

    return $returnValue;

}
}

?>