<?php
///
//CHECK MANDATORY VALUES
function checkMandatory(&$array) {
	$debug=true;
	if (!isset($array[customerId])) {
	if ($debug) echo "WE NEED [customerId]\n";
	return false;
	}
	if (!isset($array[environment])) {
	if ($debug) echo "WE NEED [environment]\n";
	return false;
	}
	if (!isset($array[requestSource])) {
	if ($debug) echo "WE NEED [requestSource]\n";
	return false;
	}
	if (!isset($array[passengerNationality])) {
	if ($debug) echo "WE NEED [passengerNationality]\n";
	return false;
	}
	if (!isset($array[roomOccupancies])) {
	if ($debug) echo "WE NEED [roomOccupancies]\n";
	return false;
	} else {
		foreach ($array[roomOccupancies] as $key => $value) {
			if (!array_key_exists('adults', $value) || !array_key_exists('twin', $value) || !array_key_exists('extraBed', $value)) {
				if ($debug) echo "WE NEED [roomOccupancies][$key][VARs]\n";
				return false;
			}
		}
	}
	if (isset($array[hotelFilter])) {
			if (!array_key_exists('luxury', $value) || !array_key_exists('fireSafety', $value) || !array_key_exists('lastUpdate', $value)) {
				if ($debug) echo "WE NEED [hotelFilter][VARs]\n";
				return false;
			}
	}
	if (isset($array[roomFilter])) {
			if (!array_key_exists('suite', $value)) {
				if ($debug) echo "WE NEED [roomFilter][VARs]\n";
				return false;
			}
	}
	unset($debug);
	unset($debug);
	return true;
}
///
///
//VERIFY IF WE RECEIVE ALL THE MANDATORY VALUES
function checkAnswer(&$array) {
	$debug=false;
	if (preg_match('/OK/',$array)){
	$arrayOriginal = explode('|',$array);
	$check = [true,true,true,true,true];
	$checkQ = 5;
	if ($debug) print_r($arrayOriginal);
	unset($arrayOriginal[0]);
	foreach ($arrayOriginal as $value) {
		$arrInternal=explode(",",$value);
		if (count($arrInternal) != $checkQ){
			if ($debug) echo "ARRAY INTERNAL NOT HAVE 5 VALUES\n";
			return false;
		}
	}
	unset($array);
	unset($check);
	unset($checkQ);
	unset($debug);
	unset($arrCount);
	unset($checkNeed);
	unset($arrayOriginal);
	return true;
	} else {
		return false;
	}
}
///
///
//CONVERT ANSWER STRING TO ARRAY
function convertAnswerStringToArray($string) {
	$arrayAnswer = explode("|",$string);
	//Delete incorrect data
	unset($arrayAnswer[0]);
	foreach($arrayAnswer as $array_values)
	{
	        if($array_values)
	        {
	            	$folders =  explode(",", $array_values);
	            	$array_need[$folders[0]][$folders[1]][$folders[2]][cityCode] = $folders[3];
					$array_need[$folders[0]][$folders[1]][$folders[2]][roomData][] = $folders[4];
					$array_need[$folders[0]][$folders[1]][$folders[2]][hotelCodeOriginal] = $folders[5];	        }
	 }
	unset($string);
	unset($arrayAnswer);
	unset($array_values);
	unset($folders);
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
	unset($glues);
	unset($array);
	unset($val);
	unset($g);
	unset($c);
	unset($i);
	return $out;
	unset($out);
}
///
///
function convertBollean(&$array) {
	$debug= false;
	if ($debug) echo "REQUEST TO BOOLEAN 1\n";
		if (isset($array[passengerNationality])) {
			if ($debug) echo "REQUEST TO BOOLEAN 2\n";
			if (is_numeric($array[passengerNationality])){
					$valueint = (int)$array[passengerNationality];
					if ($valueint == "1") {
						$out = Y;
					} else if ($valueint == "0") {
						$out = N;
					} else {
						return false;	
					}
			} else {
				return false;
			}
		$array[passengerNationality] = $out;
		}
		
		if (isset($array[roomFilter][suite])) {
					if (is_numeric($array[roomFilter][suite])){
							$valueint = (int)$array[roomFilter][suite];
							if ($valueint == "1") {
								$out = Y;
							} else if ($valueint == "0") {
								$out = N;
							} else {
								return false;	
							}
					} else {
						return false;
					}
		$array[roomFilter][suite] = $converted;
		}
		
		if (isset($array[roomOccupancies])) {
			foreach ($array[roomOccupancies] as $key => $roomOccupancies) {
					foreach ($roomOccupancies as $key2 => $value) {
						//echo "$key -->  $value \n";
						if (($key2 === 'twin') || ($key2 === 'extraBed')) {
							//echo "CONVERTIR A BOOL\n";
							if (is_numeric($value)){
									$valueint = (int)$value;
									if ($valueint == "1") {
										$out = Y;
									} else if ($valueint == "0") {
										$out = N;
									} else {
										return false;									}
									$array[roomOccupancies][$key][$key2]=$out;
								} else {
									return false;
								}
						//echo "$converted \n";
						//echo "$arrayIndex[roomOccupancies][$i][$key] \n";
						}
					}
			}
		}
		unset($array);
		unset($converted);
		unset($key);
		unset($roomOccupancies);
		unset($key2);
		unset($value);
		unset($arrayIndex);
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
	function request($var){
		//////////////////////////////
		/////////////VARs/////////////
		//////////////////////////////
		$address = "192.168.0.178";
		$port = 10003;
		$debug = false;
		$message = "PSFILTER |$var\r\n";
		//$message = $demoInfo;
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
		/*echo "Leyendo la respuesta:\n\n";
		$buf = 'Este es mi buffer.';
		if (false !== ($bytes = socket_recv($sock, $buf, 2048, MSG_WAITALL))) {
		    echo "Leídos $bytes bytes desde socket_recv(). Cerrando el socket...";
		} else {
		    echo "socket_recv() falló; razón: " . socket_strerror(socket_last_error($sock)) . "\n";
		}
		socket_close($sock);

		echo $buf . "\n";
		*/
		while ($buf = socket_read($sock,2045)) {
			//echo "ESTO DEVUELVE SERVER: $buffer";
			break;
		}
		socket_close($sock);
		if ($debug) echo "Respuesta ---> $buf \n";
		unset($message);
		unset($address);
		unset($port);
		unset($debug);
		unset($sock);
		return $buf;
		//unset($buf);

	}
///

?>