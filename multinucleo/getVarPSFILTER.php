<?php
include("checkMandatory.php");//-/
include("requestToTcp.php");//-/
include("translater.php");//-/
include("convertTo.php");//-/-/

function callPrefilter($arrData) {
$debug=false;

// INCLUR CHEQUEO DE MANDATORY EN ESTE TRUE
	if (true){
		//CREATION OF ARRAY BASE WITH BLANK VALUES
		$arrBase = array(
		'customerId' => '',
		'environment' => '',
		'requestSource' => '',
		'passengerNationality' => '',
		'hotelIds' => '',
		'cityId' => '',
		'channelTypes' => '',
		'channels' => '',
		'channelWithAutomapping' => '',
		'roomOccupancies' => '',
		'hotelFilter' => '',
		'roomFilter' => ''
		);
		//FILL ARRAY BASE WITH DATA
		$arr = array_replace_recursive($arrBase, $arrData);
		if ($debug) echo "VALOR A ENVIAR sin convertir\n";
		if ($debug) print_r($arr);
		//CONVERT ALL THE BOOL FROM INT TO STRING Y or N
		$arrayIndexAfterBool = convertBolleans($arr);
		if ($debug) echo "VALOR A ENVIAR convertido booleanos\n";
		if ($debug) print_r($arr);
		//CONVERT ARRAY MULTIDIMENSIONAL TO STRING with FORMAT
		$arrConverted2String = convertRequestArrayToString(array('|',',','~','#'),$arrayIndexAfterBool);
		if ($debug) echo "VALOR A ENVIAR convertido a string\n";
		if ($debug) echo $arr;
		if ($debug) echo "\n";
		//SEND REQUEST TO SERVER
		$answer = request($arrConverted2String);
		//IF CHECKANSWER SAY TRUE THE ANSWER IS CORRECT FORMATED
		if (checkAnswer($answer)){
			if ($debug) echo "VALOR RECIBIDO sin convertir a array\n";
			if ($debug) echo $answer;
			if ($debug) echo "\n";
			//CHECK IF ALL THE VALUE ARE INCLUDED
			$answerChecked = $answer;
		} else{
			$answerChecked = $answer;
		}
	    //echo "RESPUESTA DESDE SERVIDOR: $arrString";
	}
	if ($debug) echo $answerChecked;
	//AFTER TO ANSWER CONVERT STRING TO ARRAY MULTIDIMENSIONAL
	$answerArray = convertAnswerStringToArray($answerChecked);
	unset($arr);
	unset($arrBase);
	unset($arrData);
	unset($answer);
	unset($debug);
	unset($answerChecked);
	return $answerArray;
	unset($answerArray);
}
?>