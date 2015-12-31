<?php
	include_once("getVarPSFILTER_string.php");
	$debug=false;
	$requestfromSUPPLIER="164|prod|1|1|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||";
	$requestConverted="PSFILTER |164|prod|1|Y|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||";
	//DATA CONVERTED FROM ORIGIN
	$data="2|env|2|1|5,6,7|6|4,5,6|7,8,9|2,3,4|2~2#3#4#5~0~0,3~4#5#6#7~1~1|2~3~4,1,string,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,string,string,2,3,4,5,0,DATE|0,1~2~3,1~2~3,String|string,string,string";
	$data1="164|prod|1|1|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||";
	$demoInfo="PSFILTER |164|prod|1|Y|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||";
	
		$outerARR = explode("|", $data);
		$innerHotelIds = explode(",",$outerARR[4]);
		$innerChannelTypes = explode(",",$outerARR[6]);
		$innerChannel = explode(",",$outerARR[7]);
		$innerChannelWithAutomapping = explode("~",$outerARR[8]);
		$innerRoomOccupancies = explode(",",$outerARR[9]);
		$innerHotelFilter = explode(",",$outerARR[10]);
		$innerRoomFilter = explode(",",$outerARR[11]);
		
		foreach ($innerRoomOccupancies as $value) {
			$folders = explode("~",$value);
			//$array_need[$folders[hotelids]] = $folders[0];
			//$array_need[$folders[0]][$folders[1]][$folders[2]][roomData][] = $folders[4];
			//$array_need[$folders[0]][$folders[1]][$folders[2]][hotelCodeOriginal] = $folders[5];
			
		}
		$innerRoomOccupancies = $folders;
		
		
		$arrayIndex = array(
		'customerId' => $outerARR[0],
		'environment' => $outerARR[1],
		'requestSource' => $outerARR[2],
		'passengerNationality' => $outerARR[3],
		'hotelIds' => array(2,3,4),
		'cityId' => $outerARR[5],
		'channelTypes' => array(2,3,4),
		'channels' => array(2,3,4),
		'channelWithAutomapping' => array(2,3,4),
		'roomOccupancies' => array(
								"adults" => 2,
								"children" => array(2,3,4),
								"twin" => 0,									"extraBed" => 0
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
		

		print_r($arrayIndex);
		$arrString = implode("|",$arrayIndex);
		echo "ARRAY: $arrString\n";

	$answer = callPrefilter($arrString);
	//print_r($answer);
	

	
?>