<?php
include("checkMandatory.php");
include("requestToTcp.php");
include("translater.php");
include("convertTo.php");
$demoInfo="164|prod|1|Y|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||";
$debug=false;
//$requestfromSUPPLIER="164|prod|1|1|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||";
//$requestConverted="164|prod|1|Y|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||";
//$requestfromSUPPLIER="2|env|2|1|5,6,7|6|4,5,6|7,8,9|2~2#3#4#5~0~0,2~2#3#4#5~0~0|2~3~4,1,string,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,string,string,2,3,4,5,0,DATE|0,1~2~3,1~2~3,String|string,string,string";

//$requestfromSUPPLIER ="2|env|2|1|5,6,7|6|4,5,6|7,8,9|2~2#3#4#5~0~0,2~2#3#4#5~0~0|2~3~4,1,string,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,string,string,2,3,4,5,0,DATE|0,1~2~3,1~2~3,String|string,string,string";
$checkQ = 12;
//callPrefilter($requestfromSUPPLIER);
function callPrefilter($arr) {
// Delimiter Message with |
	//checkRequest($arr)
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
			$answer = transResponse($answer);
			$answerChecked = $answer;
		} else{
			$answerChecked = $answer;
		}
		
		//$arrString = implode("|", $arrAnswer);
	    //echo "RESPUESTA DESDE SERVIDOR: $arrString";
	}
	if ($debug) echo $answerChecked;
	//AFTER TO ANSWER CONVERT STRING TO ARRAY MULTIDIMENSIONAL
	$answerArray = convertAnswerStringToArray($answerChecked);
	
	return $answerArray;
}
?>