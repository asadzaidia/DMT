<?php
include('functions/function.php');
$pass="asadzaidi323232";
//encrypting Password
	$encrypted_txt = encrypt_decrypt1('encrypt', $pass);
	$more=encrypt_decrypt2('encrypt', $encrypted_txt);
	
	echo "encrypted text 2 applies ".$more;

	 $dec_txt=encrypt_decrypt2('decrypt',$more);
	
	 $plain=encrypt_decrypt1('decrypt',$dec_txt);

	 echo "plain ".$plain;


?>