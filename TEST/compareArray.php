<?php
$arrayIndex= array(
		"customerId" => 2,
		'environment' => "string",
		'requestSource' => 2,
		'passengerNationality' => 0,
		'hotelIds' => array(2,3,4),
		'cityId' => 2,
		'channelTypes' => array(2,3,4),
		'channels' => array(2,3,4),
		'channelWithAutomapping' => array(2,3,4),
		'roomOccupancies' => array(	array(
								"adults" => 2,
								"children" => array(2,3,4),
								"twin" => 0,									"extraBed" => 0
								),array(
								"adults" => 3,
								"children" => array(2,5,4),
								"twin" => 1,									"extraBed" => 0
								)
						),
		'hotelFilter' => array(
							"children" => array(2,3,4),
							"luxury" => 2,
							"location" => "string",
							"locationId" => array(2,3,4),
							"amenitie" => array(2,3,4),
							"leisure" => array(2,3,4),
							"business" => array(2,3,4),
							"hotelPreference" => array(2,3,4),
							"chain" => array(2,3,4),
							"attraction" => "string",
							"hotelName" => "string",
							"builtYear" => 2,
							"renovationYear" => 2,
							"floors" => 2,
							"noOfRooms" => 2,
							"fireSafety" => 2,
							"lastUpdated" => "DATE"
							),
							
		'roomFilter' => array(
							"suite" => 2,
							"chain" => array(2,3,4),
							"chain" => array(2,3,4),
							"hotelName" => "string"
							)
		);
		

function convertBool() {
	$value = $arrayIndex[passengerNationality];
	$arrayIndex[passengerNationality] = int2bool($value);
	
	foreach ($arrayIndex[roomOccupancies] as $key => $value) {
		echo "$key --> $value";
	}
	
}

foreach ($arrayIndex[roomOccupancies] as $key => $roomOccupancies) {
		foreach ($roomOccupancies as $key2 => $value) {
			//echo "$key -->  $value \n";
			if (($key2 === 'twin') || ($key2 === 'extraBed')) {
				echo "CONVERTIR A BOOL\n";
				$converted = int2bool($value);
			$arrayIndex[roomOccupancies][$key][$key2] = $converted;
			echo "$converted \n";
			echo "$arrayIndex[roomOccupancies][$i][$key] \n";
			}
		
		}
	}
	
	
//CONVERT INTEGER IN BOOLEAN
function int2bool($value) {
	if (is_numeric($value)){
		$valueint = (int)$value;
		if ($valueint == "1") {
			$out = Y;
		} else if ($valueint == "0") {
			$out = N;
		} else {
			return "NO BOOL";	
		}
		return $out;
	} else {
		return "NO BOOL";	
	}
}




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
		






/*//COMPARE CON MANDATORY
	foreach ($arrayIndex as $clave1level => $value1level) {
		if (is_array($value1level)) {
			echo $clave1level . "=>";
			echo "\n";
			foreach ($value1level as $clave2level => $value2level) {
				if (is_array($value2level)) {
					echo "\t\t";
					echo $clave2level . "=>";
					echo "\n";
						foreach ($value2level as $clave3level => $value3level) {
							if (is_array($value3level)) {
								echo "\t\t\t";
								echo $clave3level . "=>";
								echo "\n";
									foreach ($value3level as $clave4level => $value4level) {
										if ($arrayIndexMandatory[$clave1level][$clave2level][$clave3level][$clave4level] && !isset($value4level)){
											echo "ERROR clave [$clave1level][$clave2level][$clave3level][$clave4level] necesaria";
											return false;
										}
										echo "\t\t\t";
										echo $clave4level . "=>" . $value4level;
										echo "\n";
									}
							} else {
								if ($arrayIndexMandatory[$clave1level][$clave2level][$clave3level] && !isset($value3level)){
									echo "ERROR clave [$clave1level][$clave2level][$clave3level] necesaria";
									return false;
								}
								echo "\t\t";
									echo $clave3level . "=>" . $value3level;
									echo "\n";
							}		
						}
				} else {
					if ($arrayIndexMandatory[$clave1level][$clave2level] && !isset($value2level)){
									echo "ERROR clave [$clave1level][$clave2level] necesaria";
									return false;
								}
					echo "\t";
					echo $clave2level . "=>" . $value2level;
					echo "\n";
				}
			}
		} else {
			if ($arrayIndexMandatory[$clave1level] && !isset($value1level)){
				echo "ERROR clave [$clave1level] necesaria";
				return false;
			}
			echo $clave1level . "=>" . $value1level;
			echo "\n";
		}
	}
	
//COMPARE CON TYPE
foreach ($arrayIndex as $clave1level => $value1level) {
		if (is_array($value1level)) {
			echo $clave1level . "=>";
			echo "\n";
			foreach ($value1level as $clave2level => $value2level) {
				if (is_array($value2level)) {
					echo "\t\t";
					echo $clave2level . "=>";
					echo "\n";
						foreach ($value2level as $clave3level => $value3level) {
							if (is_array($value3level)) {
								echo "\t\t\t";
								echo $clave3level . "=>";
								echo "\n";
									foreach ($value3level as $clave4level => $value4level) {
										if ($arrayIndexMandatory[$clave1level][$clave2level][$clave3level][$clave4level] && !isset($value4level)){
											echo "ERROR clave [$clave1level][$clave2level][$clave3level][$clave4level] necesaria";
											return false;
										}
										echo "\t\t\t";
										echo $clave4level . "=>" . $value4level;
										echo "\n";
									}
							} else {
								if ($arrayIndexMandatory[$clave1level][$clave2level][$clave3level] && !isset($value3level)){
									echo "ERROR clave [$clave1level][$clave2level][$clave3level] necesaria";
									return false;
								}
								echo "\t\t";
									echo $clave3level . "=>" . $value3level;
									echo "\n";
							}		
						}
				} else {
					if ($arrayIndexMandatory[$clave1level][$clave2level] && !isset($value2level)){
									echo "ERROR clave [$clave1level][$clave2level] necesaria";
									return false;
								}
					echo "\t";
					echo $clave2level . "=>" . $value2level;
					echo "\n";
				}
			}
		} else {
			if ($arrayIndexMandatory[$clave1level] && !isset($value1level)){
				echo "ERROR clave [$clave1level] necesaria";
				return false;
			}
			echo $clave1level . "=>" . $value1level;
			echo "\n";
		}
	}



	function checkType($value) {
			if ($value == "") {
				$out = "ERROR";
				return $out;
			}
		     switch ($value) {
				case $value == true:
				case $value == false:
		        case $value == 1:
				case $value == 0:
		        case strtolower($value) == 'y':
		        case strtolower($value) == 'n':
		            $out = "boolean";
		            break;
		        case is_array($value):
					$out = "array";
					break;
				case is_numeric($value):
					$out = "integer";
					break;
			 	case is_string($value):
					$out = "string";
					break;
		        default: $out = false;
		    }
		    return $out;	
		}
*/

/*echo typeof_if_query("$arrayIndex[passengerNationality]");
echo typeof_if_query("$arrayIndex[customerId]");
echo typeof_if_query("$arrayIndex[environment]");
echo typeof_if_query("$arrayIndex[hotelIds]");

echo $arrayIndex[passengerNationality];
echo $arrayIndex[customerId];
echo $arrayIndex[environment];
echo $arrayIndex[hotelIds];
*/
//print_r($arrayIndex);
				function typeof_if_query($var) {
				   
				  if (is_object($var))
				    return "object";

				  if (is_resource($var))
				    return "resource";
				  
				  if ((bool)$var === $var)
				      return "bool";

				  if ((float)$var === $var)
				    return "float";

				  if ((int)$var === $var)
				    return "int";

				  if ((string)$var === $var)
				    return "string";

				  if (null === $var)
				    return "null";

				  return "unknown";
				}

			//print_r($foo);
			//print_r($bar);
			
			
print_r($arrayIndex);
?>