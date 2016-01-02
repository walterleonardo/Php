<?php
include('runMultiNucleo.php');
$debug=false;
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
'roomOccupancies' => array(	array(
						'adults' => 1,
						'children' => array(5,5,10),
						'twin' => 1,									'extraBed' => 0
						),array(
						'adults' => 2,
						'children' => array(2,3,6),
						'twin' => 0,									'extraBed' => 0
						)
				),
);

echo "#################################\n";
$answer = callPrefilter($arrayIndex);
print_r($answer);
//
//echo "$answer \n";
echo "#################################\n";
?>