<?php
///
//CHECK MANDATORY VALUES
function checkMandatory(&$array) {
	$debug=false;
	if (!isset($array['customerId'])) {
	if ($debug) echo "WE NEED [customerId]\n";
	return false;
	}
	if (!isset($array['environment'])) {
	if ($debug) echo "WE NEED [environment]\n";
	return false;
	}
	if (!isset($array['requestSource'])) {
	if ($debug) echo "WE NEED [requestSource]\n";
	return false;
	}
	if (!isset($array['passengerNationality'])) {
	if ($debug) echo "WE NEED [passengerNationality]\n";
	return false;
	}
	if (!isset($array['roomOccupancies'])) {
	if ($debug) echo "WE NEED [roomOccupancies]\n";
	return false;
	} else {
		foreach ($array['roomOccupancies'] as $key => $value) {
			if (!array_key_exists('adults', $value) || !array_key_exists('twin', $value) || !array_key_exists('extraBed', $value)) {
				if ($debug) echo "WE NEED [roomOccupancies][$key][VARs]\n";
				return false;
			}
		}
	}
	if (isset($array['hotelFilter'])) {
			if (!isset($array['hotelFilter']['luxury'])) {
				if ($debug) echo "WE NEED [hotelFilter][luxury]\n";
				return false;
			}
			if (!isset($array['hotelFilter']['fireSafety'])) {
				if ($debug) echo "WE NEED [hotelFilter][fireSafety]\n";
				return false;
			}
			if (!isset($array['hotelFilter']['lastUpdated'])) {
				if ($debug) echo "WE NEED [hotelFilter][lastUpdated]\n";
				return false;
			}
	}
	if (isset($array['roomFilter'])) {
			if (!isset($array['roomFilter']['suite'])) {
				if ($debug) echo "WE NEED [roomFilter][suite]\n";
				return false;
			}
	}
	unset($debug);
	return true;
}
///
///
//VERIFY IF WE RECEIVE ALL THE MANDATORY VALUES
function checkAnswer(&$array) {
	$debug=false;
	if (preg_match('/OK/',$array)){
	$arrayOriginal = explode('|||',$array);
	$check = [true,true,true,true,true,true,true];
	$checkQ = 7;
	if ($debug) print_r($arrayOriginal);
	unset($arrayOriginal[0]);
	foreach ($arrayOriginal as $value) {
		$arrInternal=explode(",",$value);
		if (count($arrInternal) != $checkQ){
			if ($debug) echo "ARRAY INTERNAL NOT HAVE 5 VALUES\n";
			return false;
		}
	}
	unset($arrInternal,$check,$checkQ,$debug,$arrCount,$checkNeed,$arrayOriginal);
	return true;
	} else {
		return false;
	}
}
///
///
//CONVERT ANSWER STRING TO ARRAY
function convertAnswerStringToArray($string) {
	$arrayAnswer = explode("|||",$string);
	//Delete incorrect data
	unset($arrayAnswer[0]);
	foreach($arrayAnswer as $array_values)
	{
	        if($array_values)
	        {
	            	$folders =  explode(",", $array_values);
	            	$array_need[$folders[0]][$folders[1]][$folders[2]]['cityCode'] = $folders[3];
					$array_need[$folders[0]][$folders[1]][$folders[2]]['roomData'][] = $folders[4];
					$array_need[$folders[0]][$folders[1]][$folders[2]]['hotelCodeOriginal'] = $folders[5];
					$array_need[$folders[0]][$folders[1]][$folders[2]]['roomCodeOriginal'] = $folders[6];	        }
	 }
	unset($folders,$string,$arrayAnswer,$array_values);
	return $array_need;
	unset($array_need);
}
///

///
//CONVERT ARRAY MULTIDIMENSIONAL TO STRING
//INCLUDE IN GLUES THE SIGN TO SEPARATE VALUES by EXAMPLE array("|",",","~","#")
function convertRequestArrayToString(array $glues, array $array) {
	$out = "";
    $g = array_shift($glues);
    $c = count($array);
    $i = 0;
    foreach ($array as $val){
        if (is_array($val)){
            $out .= convertRequestArrayToString($glues,$val);
        } else {
            $out .= (string)$val;
        }
        $i++;
        if ($i<$c){
            $out .= $g;
        }
    }
	unset($i,$c,$g,$val,$array,$glues);
	return $out;
	unset($out);
}
///
///
function convertBollean(&$array) {
	$debug= false;
	if ($debug) echo "REQUEST TO BOOLEAN 1\n";
		if (isset($array['passengerNationality'])) {
			if ($debug) echo "REQUEST TO BOOLEAN 2\n";
			if (is_numeric($array['passengerNationality'])){
					$valueint = (int)$array['passengerNationality'];
					if ($valueint == '1') {
						$out = 'Y';
					} else if ($valueint == '0') {
						$out = 'N';
					} else {
						return false;	
					}
			} else {
				return false;
			}
		$array['passengerNationality'] = $out;
		}
		
		if (isset($array['roomFilter']['suite'])) {
					if (is_numeric($array['roomFilter']['suite'])){
							$valueint = (int)$array['roomFilter']['suite'];
							if ($valueint == '1') {
								$out = 'Y';
							} else if ($valueint == '0') {
								$out = 'N';
							} else {
								return false;	
							}
					} else {
						return false;
					}
		$array['roomFilter']['suite'] = $out;
		}
		
		if (isset($array['roomOccupancies'])) {
			foreach ($array['roomOccupancies'] as $key => $roomOccupancies) {
					foreach ($roomOccupancies as $key2 => $value) {
						//echo "$key -->  $value \n";
						if (($key2 === 'twin') || ($key2 === 'extraBed')) {
							//echo "CONVERTIR A BOOL\n";
							if (is_numeric($value)){
									$valueint = (int)$value;
									if ($valueint == '1') {
										$out = 'Y';
									} else if ($valueint == '0') {
										$out = 'N';
									} else {
										return false;									}
									$array['roomOccupancies'][$key][$key2]=$out;
								} else {
									return false;
								}
						//echo "$converted \n";
						//echo "$arrayIndex[roomOccupancies][$i][$key] \n";
						}
					}
			}
		}
		unset($arrayIndex,$value,$key2,$roomOccupancies,$key,$converted,$array);
		return true;
}
///
///
/*
//TRANSFORM ANSWER TO ARRAY
	function transResponse($response) {
		$arrayOriginal = explode('|',$response);
		$check = [true,true,true,true,true];
		$checkQ = 5;
		$arrCount = count($arrayOriginal);
	return $response;
	}
///
*/
///
function requestTCP($var){
	//////////////////////////////
	/////////////VARs/////////////
	//////////////////////////////
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ob_implicit_flush();
	set_time_limit(0);
	$address = "192.168.0.178";
	$port = 10003;
	$debug = false;
	$seconds = 3;
	$message = "PSFILTER |$var\r\n";
	//$message="PSFILTER |164|prod|1|Y|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||\r\n";
	//////////////////////////////
	//////////////////////////////
	//////////////////////////////
	if(!($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	    die("Couldn't create socket: [$errorcode] $errormsg \n");
	}
	if ($debug) echo "Socket created \n";
	//Connect socket to remote server
	socket_set_option($sock, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 5, 'usec' => 0));
	socket_set_option($sock, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 5, 'usec' => 0));
	if(!socket_connect($sock , $address , 10003))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	    die("Could not connect: [$errorcode] $errormsg \n");
	}
	if ($debug) echo "Connection established \n";
	//Send the message to the server
	if( !socket_send ( $sock , $message , strlen($message) , 0))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	     
	    die("Could not send data: [$errorcode] $errormsg \n");
	} else {
	if ($debug) echo "Message send successfully \n";
	 }
	
	while ($buf = socket_read($sock,2048,PHP_NORMAL_READ)) {
		if ($debug) echo "Answer from server: $buffer";
		break;
	}
	//IF NEED QUIT TO CLOSE SOCKET ENABLE IT
	/*
	$message = "QUIT\r\n";
	if( !socket_send ( $sock , $message , strlen($message) , 0))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	     
	    die("Could not send data: [$errorcode] $errormsg \n");
	} else {
	if ($debug) echo "Message QUIT send successfully \n";
	}
	*/
	socket_close($sock);
	unset($message,$address,$port,$seconds,$debug,$sock,$errorcode,$errormsg);
	return $buf;
	unset($buf);
}
///

///
//Function for use UDP servers
function requestUDP($var) {
	//Reduce errors
	error_reporting(E_ALL);
	$server = '192.168.0.178';
	$port = 10003;
	if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	    die("Couldn't create socket: [$errorcode] $errormsg \n");
	}
	//Communication loop
	while(1)
	{
	    //Take some input to send
	    //echo 'Enter a message to send : ';
	    //$input = fgets(STDIN);
	    $input = "PSFILTER |$var\r\n";
	    //Send the message to the server
	    if( ! socket_sendto($sock, $input , strlen($input) , 0 , $server , $port))
	    {
	        $errorcode = socket_last_error();
	        $errormsg = socket_strerror($errorcode);
	        die("Could not send data: [$errorcode] $errormsg \n");
	    }
	    //Now receive reply from server and print it
	    if(socket_recv ( $sock , $buf , 2048 , MSG_WAITALL ) === FALSE)
	    {
	        $errorcode = socket_last_error();
	        $errormsg = socket_strerror($errorcode);
	        die("Could not receive data: [$errorcode] $errormsg \n");
	    }
	    break;
	}
	return $buf;
}
///

?>