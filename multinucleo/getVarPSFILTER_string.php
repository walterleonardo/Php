<?php
include_once("checkMandatory_string.php");
include_once("requestToTcp.php");
include_once("translater_string.php");
include_once("convertTo.php");
$demoInfo="164|prod|1|Y|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||";
	
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
		//echo "ARRAY: $arrString\n";
		if ($debug) echo "VALOR A ENVIAR sin convertir	$arr\n";
		$arr = transRequest($arr);
		if ($debug) echo "VALOR A ENVIAR convertido		$arr\n";
		$answer = request($arr);
		if ($debug) echo $requestConverted;

		if (checkAnswer($answer)){
			$answer = transResponse($answer);
			$answerChecked = $answer;
		} else{
			$answerChecked = $answer;
		}
		
		//$arrString = implode("|", $arrAnswer);
	    //echo "RESPUESTA DESDE SERVIDOR: $arrString";
	}
	if ($debug) echo $answerChecked;
	
	$answerArray = convertAnswerStringToArray($answerChecked);
	
	return $answerArray;
}
?>