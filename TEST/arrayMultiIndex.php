<?php
	//explode first dimension of the array to create an array of rows
	$data = "2|env|2|1|5,6,7|6|4,5,6|7,8,9|2~2#3#4#5~0~0,2~2#3#4#5~0~0|2~3~4,1,string,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,string,string,2,3,4,5,0,DATE|0,1~2~3,1~2~3,String|string,string,string";
	$outerARR = explode("|", $data);
	$innerHotelIds = explode(",",$outerARR[4]);
	$innerHotelIds = explode(",",$outerARR[4]);
	$innerHotelIds = explode(",",$outerARR[4]);
	$innerHotelIds = explode(",",$outerARR[4]);
	$innerHotelIds = explode(",",$outerARR[4]);
	
	
	
	
	
	
	$arrayIndex = array(
	'customerId' => $outerARR[0],
	'environment' => $outerARR[1],
	'requestSource' => $outerARR[2],
	'passengerNationality' => $outerARR[3],
	'hotelIds' => $outerARR[4],
	'cityId' => $outerARR[5],
	'channelTypes' => $outerARR[6],
	'channels' => $outerARR[7],
	'channelWithAutomapping' => $outerARR[8],
	'roomOccupancies' => $outerARR[9],
	'hotelFilter' => $outerARR[10],
	'roomFilter' => $outerARR[11]
	);
	
	
	
	
	
	
	
	print_r($arrayIndex);
	$arrString = implode("|",$arrayIndex);
	echo "ARRAY: $arrString";

?>