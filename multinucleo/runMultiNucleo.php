<?php
//include("checkMandatory.php");//-/
//include('requestToTcp.php');//-/
//include("translater.php");//-/
//include("convertTo.php");//-/-/
include('functionsMultiNucleo.php');

function callPrefilter($arrData) {
$debug=false;

// CHECK MANDATORY VALUES in IF
	if (checkMandatory($arrData)){
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
		///$arrayIndexAfterBool = convertBolleans($arr);
		if (convertBollean($arr)){
			if ($debug) echo "previous REQUEST TO BOOLEAN 1\n";
			$arrayIndexAfterBool=$arr;
		} else {
			return "ERROR in BOOLEAN CONVERTION";
		}
		if ($debug) echo "VALOR A ENVIAR convertido booleanos\n";
		if ($debug) print_r($arrayIndexAfterBool);
		//CONVERT ARRAY MULTIDIMENSIONAL TO STRING with FORMAT
		$arrConverted2String = convertRequestArrayToString(array('|',',','~','#'),$arrayIndexAfterBool);
		if ($debug) echo "VALOR A ENVIAR convertido a string\n";
		if ($debug) echo $arrConverted2String;
		if ($debug) echo "\n";
		//SEND REQUEST TO SERVER
		$answer = requestTCP($arrConverted2String);
		if ($debug) echo "ANSWER AFTER ANYTHING  $answer \n";
		//IF CHECKANSWER SAY TRUE THE ANSWER IS CORRECT FORMATED
		if (checkAnswer($answer)){
			//CHECK IF ALL THE VALUE ARE INCLUDED
			$answerChecked = $answer;
		} else{
			if ($debug) echo "ERROR in ANSWER \n";
			if ($debug) echo "INCOMPLET REQUEST \n";
			return $answer;
		}
	    //echo "RESPUESTA DESDE SERVIDOR: $arrString";
	if ($debug) echo "VALOR RECIBIDO en STRING: \n". $answerChecked . "\n";
	//AFTER TO ANSWER CONVERT STRING TO ARRAY MULTIDIMENSIONAL
	$answerArray = convertAnswerStringToArray($answerChecked);
	if ($debug) echo "VALOR RECIBIDO en ARRAY: \n";
	if ($debug) print_r($answerArray);
	if ($debug) echo "\n";
	unset($arr);
	unset($arrBase);
	unset($arrData);
	unset($answer);
	unset($debug);
	unset($answerChecked);
	return $answerArray;
	unset($answerArray);
} else {
	echo "INCOMPLET REQUEST \n";
	return "ERROR\n";
}
}
?>