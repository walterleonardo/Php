<?php
	include('getVarPSFILTER.php');
	$debug=false;
	//$requestfromSUPPLIER='164|prod|1|1|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||';
	//$requestConverted='PSFILTER |164|prod|1|Y|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||';
	//DATA CONVERTED FROM ORIGIN
	//$data='2|env|2|1|5,6,7|6|4,5,6|7,8,9|2,3,4|2~2#3#4#5~0~0,3~4#5#6#7~1~1|2~3~4,1,string,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,string,string,2,3,4,5,0,DATE|0,1~2~3,1~2~3,String|string,string,string';
	//$data1='164|prod|1|1|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||';
	//$demoInfo='PSFILTER |164|prod|1|Y|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||';
	//$message="PSFILTER |164|prod|1|Y|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||\r\n";
	
//CREATION OF A EXAMPLE REQUEST FULL COMPLETED
/*
$arrayIndex = array(
'customerId' => 2,
'environment' => 'string',
'requestSource' => 2,
'passengerNationality' => 1,
'hotelIds' => array(2,3,4),
'cityId' => 2,
'channelTypes' => array(2,3,4),
'channels' => array(2,3,4),
'channelWithAutomapping' => array(2,3,4),
'roomOccupancies' => array(	array(
						'adults' => 2,
						'children' => array(2,3,4),
						'twin' => 0,									'extraBed' => 0
						),array(
						'adults' => 3,
						'children' => array(2,5,4),
						'twin' => 1,									'extraBed' => 0
						),array(
						'adults' => 4,
						'children' => array(2,7,4),
						'twin' => 0,									'extraBed' => 1
						)
				),
'hotelFilter' => array(
					'children' => array(2,3,4),
					'luxury' => 2,
					'location' => 'string',
					'locationId' => array(2,3,4),
					'amenitie' => array(2,3,4),
					'leisure' => array(2,3,4),
					'business' => array(2,3,4),
					'hotelPreference' => array(2,3,4),
					'chain' => array(2,3,4),
					'attraction' => 'string',
					'hotelName' => 'string',
					'builtYear' => 2,
					'renovationYear' => 2,
					'floors' => 2,
					'noOfRooms' => 2,
					'fireSafety' => 2,
					'lastUpdated' => 'DATE'
					),
					
'roomFilter' => array(
					'suite' => 1,
					'roomAmentie' => array(2,3,4),
					'roomId' => array(2,3,4),
					'hotelName' => 'string'
					)
);
*/
//REAL EXAMPLE OF ARRAY
$arrayIndex = array(
'customerId' => 164,
'environment' => 'prod',
'requestSource' => 1,
'passengerNationality' => 1,
'hotelIds' => array(14,24,34,44,54,64),
//'cityId' => "",
//'channelTypes' => "",
//'channels' => array(2,3,4),
//'channelWithAutomapping' => array(2,3,4),
'roomOccupancies' => array(	array(
						'adults' => 1,
						'children' => array(5,5,10),
						'twin' => 0,									'extraBed' => 0
						),array(
						'adults' => 2,
						'children' => array(2,3,6),
						'twin' => 0,									'extraBed' => 0
						)
				),
);
		//$arrayIndexAfterBool = convertBolleans($arrayIndex);

echo "#################################\n";
echo "ANSWER FROM SERVER: \n";
$answer = callPrefilter($arrayIndex);
print_r($answer);
echo "#################################\n";
?>