<?php

function convertAnswerStringToArray($string) {
	$arrayAnswer = explode("|||",$string);
	//Delete incorrect data
		unset($arrayAnswer[0]);

		//print_r($arrayAnswer);

		foreach($arrayAnswer as $array_values)
		{
		        if($array_values)
		        {
		            $folders =  explode(",", $array_values);
		            $array_need[$folders[0]][$folders[1]][$folders[2]][cityCode] = $folders[3];
					$array_need[$folders[0]][$folders[1]][$folders[2]][roomData][] = $folders[4];
					$array_need[$folders[0]][$folders[1]][$folders[2]][hotelCodeOriginal] = $folders[5];	        }
		 }

		return $array_need;
}

function convertRequestArrayToString($array) {
	
}

?>