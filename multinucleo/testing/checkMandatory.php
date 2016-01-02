<?php
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
/*
function checkRequestType($array) {
		//////////////////////////////
		/////////////VARs/////////////
		//////////////////////////////
	$arrayIndexType = array(
	'customerId' => "integer",
	'environment' => "string",
	'requestSource' => "integer",
	'passengerNationality' => "boolean",
	'hotelIds' => "array",
	'cityId' => "integer",
	'channelTypes' => "array",
	'channels' => "array",
	'channelWithAutomapping' => "array",
	'roomOccupancies' => array(												array(
								"adults" => "integer",
								"children" => "array",
								"twin" => "boolean",							"extraBed" => "boolean"
								),
							array(
								"adults" => "integer",							"children" => "array",
								"twin" => "boolean",							"extraBed" => "boolean"
								)
							),
	'hotelFilter' => array(
						"children" => "array",
						"luxury" => "integer",
						"location" => "string",
						"locationId" => "array",
						"amenitie" => "array",
						"leisure" => "array",
						"business" => "array",
						"hotelPreference" => "array",
						"chain" => "array",
						"attraction" => "string",
						"hotelName" => "string",
						"builtYear" => "integer",
						"renovationYear" => "integer",
						"floors" => "integer",
						"noOfRooms" => "integer",
						"fireSafety" => "integer",
						"lastUpdated" => "DATE"
					),
	'roomFilter' => array(
						"suite" => "integer",
						"chain" => "array",
						"chain" => "array",
						"hotelName" => "string"
						)
);
*/
	
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


/*
	function isArray($value) {
		return is_array($value);
	}
	
	function isInteger($value) {
		return is_numeric($value);	
	}
	
	function isString($value) {
		return is_string($value);	
	}
	
	function checkType($value) {
		if ($value == "") {
			$out = false;
			return $out;
		}
	     switch ($value) {
	        case is_array($value):
				$out = "array";
				break;
			case is_numeric($value):
				$out = "integer";
				break;
		 	case is_string($value):
				$out = "string";
				break;
			case $value == true:
			case $value == false:
	        case $value == 1:
			case $value == 0:
	        case strtolower($value) == 'y':
	        case strtolower($value) == 'n':
	            $out = "boolean";
	            break;
	        default: $out = false;
	    }
	    return $out;	
	}
	
	
	function isBool($value) {
		if ($value == "") {
			$out = false;
			return $out;
		}
		     switch ($value) {
		        case $value == true:
				case $value == false:
		        case $value == 1:
				case $value == 0:
		        case strtolower($value) == 'y':
		        case strtolower($value) == 'n':
		            $out = true;
		            break;
		        default: $out = false;
		    }
		    return $out;	
		}
		
		*/
		
?>