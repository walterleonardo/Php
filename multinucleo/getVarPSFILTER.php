<?php
include_once("checkMandatory.php");
include_once("requestToTcp.php");
include_once("translater.php");


$requestfromSUPPLIER="2|env|2|1|5,6,7|6|4,5,6|7,8,9|2~2#3#4#5~0~0,2~2#3#4#5~0~0|2~3~4,1,string,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,string,string,2,3,4,5,0,DATE|0,1~2~3,1~2~3,String|string,string,string";

$requestfromSUPPLIER="2|env|2|1|5,6,7|6|4,5,6|7,8,9|2~2#3#4#5~0~0,2~2#3#4#5~0~0|2~3~4,1,string,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,string,string,2,3,4,5,0,DATE|0,1~2~3,1~2~3,String|string,string,string";


$checkQ = 12;

callPrefilter($requestfromSUPPLIER);


function callPrefilter($arr) {
// Delimiter Message with |
	
	
	if (checkRequest($arr)){
		//echo "ARRAY: $arrString\n";
		echo "VALOR A ENVIAR sin convertir	$arr\n";
		$arr = transRequest($arr);
		echo "VALOR A ENVIAR convertido		$arr\n";
		$answer = request($arr);

		if (checkAnswer($answer)){
			$answer = transResponse($answer);
			$answerChecked = $answer;
		} else{
			$answerChecked = $answer;
		}
		
		//$arrString = implode("|", $arrAnswer);
	    //echo "RESPUESTA DESDE SERVIDOR: $arrString";
		
	}
	
	echo $answerChecked;
	return $answerChecked;
}
	
?>