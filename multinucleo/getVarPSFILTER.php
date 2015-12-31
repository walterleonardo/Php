<?php
include("checkMandatory.php");//-/
include("requestToTcp.php");//-/
include("translater.php");//-/
include("convertTo.php");//-/-/
$debug=false;

function callPrefilter($arr) {
// INCLUR CHEQUEO DE MANDATORY EN ESTE TRUE
	if (true){
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
	unset($answer);
	unset($debug);
	unset($answerChecked);
	return $answerArray;
	unset($answerArray);
}
?>