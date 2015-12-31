<?php
	function checkRequest($array) {
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



$arrayIndexMandatory = array(
'customerId' => true,
'environment' => true,
'requestSource' => true,
'passengerNationality' => true,
'hotelIds' => false,
'cityId' => false,
'channelTypes' => false,
'channels' => false,
'channelWithAutomapping' => false,
'roomOccupancies' => array(	
						array(
							"adults" => true,
							"children" => false,
							"twin" => true,									"extraBed" => true
							)
						),
'hotelFilter' => array(
					"children" => false,
					"luxury" => true,
					"location" => false,
					"locationId" => false,
					"amenitie" => false,
					"leisure" => false,
					"business" => false,
					"hotelPreference" => false,
					"chain" => false,
					"attraction" => false,
					"hotelName" => false,
					"builtYear" => false,
					"renovationYear" => false,
					"floors" => false,
					"noOfRooms" => false,
					"fireSafety" => true,
					"lastUpdated" => true
					),
'roomFilter' => array(
					"suite" => true,
					"chain" => false,
					"chain" => false,
					"hotelName" => false
					)
);
		
		
		$foo =serialize($arrayIndexType);
		$bar =serialize($arrayIndexMandatory);
		
		echo "$foo\n";
		echo "$bar\n";
		//////////////////////////////
		//////////////////////////////
		//////////////////////////////			
				$i=0;
				foreach ($check as $checkNeed) {	
					if ($checkNeed) {
						if ( $arrayOriginal[$i]=="") {
							echo "Array general ERROR in position $i \n";
							return false;
						}
					}
					$i++;
				}
				$i=0;
				//print_r(array_values($arrRO));
				//echo "\n";
				
				foreach ($arrRO as $arrROinterior) {
					$arrROfinal = explode('~',$arrROinterior);
					$x=0;
					foreach ($checkRO as $checkNeed) {
						if ($checkNeed) {
							if ( $arrROfinal[$x]==""  || count($arrROfinal) != $checkQRO) {
								echo count($arrROfinal);
								echo "Room Occupancy ERROR in position $i or incomplete variable  \n";
								return false;
							}
						}
					$x++;
					}
				$i++;
				}
				
				
				
				
				$i=0;
				foreach ($checkHF as $checkNeed) {	
					if ($checkNeed) {
						if ( $arrHF[$i]=="" || count($arrHF) != $checkQHF ) {
							echo "Hotel Filter ERROR in position $i or incomplete variable  \n";
							return false;
						}
					}
					$i++;
				}
				$i=0;
				foreach ($checkRF as $checkNeed) {	
					if ($checkNeed) {
						if ( $arrRF[$i]=="" || count($arrRF) != $checkQRF) {
							echo "Room Filter ERROR in position $i or incomplete variable  \n";
							return false;
						}
					}
					$i++;
				}
				return true;
	}
	
	
///
//VERIFY IF WE RECEIVE ALL THE MANDATORY VALUES
	function checkAnswer($array) {
					$arrayOriginal = explode('|',$array);
					$check = [true,true,true,true,true];
					$checkQ = 5;
					$arrCount = count($arrayOriginal);
					//echo "ag = $checkQ $arrCount \n";
					if ($arrCount != $checkQ) {
						//echo "Incomplete response";
						return false;
					} 				
					$i=0;
					foreach ($check as $checkNeed) {	
						if ($checkNeed) {
							if ( $arrayOriginal[$i]=="" && is_numeric($arrayOriginal[$i])) {
								echo "Answer ERROR in position $i \n";
								return false;
							}
						}
						$i++;
					}
		unset($array);
		unset($check);
		unset($checkQ);
		unset($arrCount);
		unset($checkNeed);
		unset($arrayOriginal);
		return true;
		}
///



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
		
?>