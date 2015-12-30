<?php
	//explode first dimension of the array to create an array of rows
	$data = "2|env|2|1|5,6,7|6|4,5,6|7,8,9|2~2#3#4#5~0~0,2~2#3#4#5~0~0|2~3~4,1,string,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,string,string,2,3,4,5,0,DATE|0,1~2~3,1~2~3,String|string,string,string";
	$outerARR = explode("|", $data);
	$innerHotelIds = explode(",",$outerARR[4]);
	$innerchannelTypes = explode(",",$outerARR[6]);
	$innerchannels = explode(",",$outerARR[7]);
	$innerHotelIds = explode(",",$outerARR[4]);
	$innerroomFilter = explode(",",$outerARR[11]);
	
	
	
	
	
	
	$arrayIndex = array(
	'customerId' => $outerARR[0],
	'environment' => $outerARR[1],
	'requestSource' => $outerARR[2],
	'passengerNationality' => $outerARR[3],
	'hotelIds' => $innerHotelIds,
	'cityId' => $outerARR[5],
	'channelTypes' => $innerchannelTypes,
	'channels' => innerchannels,
	'channelWithAutomapping' => $outerARR[8],
	'roomOccupancies' => $outerARR[9],
	'hotelFilter' => $outerARR[10],
	'roomFilter' => $innerroomFilter
	);
	
	
	
	
	print_r($arrayIndex["hotelIds"]);
	echo "###############";
	
	print_r($arrayIndex);
	$arrString = implode("|",$arrayIndex);
	//echo "ARRAY: $arrString \n";
	//echo $arrayIndex["hotelIds"];
echo $arrayIndex["customerId"]|$arrayIndex["environment"]|$arrayIndex["requestSource"]|$arrayIndex["passengerNationality"]|$arrayIndex["hotelIds"]|$arrayIndex["cityId"]|$arrayIndex["channelTypes"]|$arrayIndex["channels"]|$arrayIndex["channelWithAutomapping"]|$arrayIndex["roomOccupancies"]|$arrayIndex["hotelFilter"]|$arrayIndex["roomFilter"];
?>