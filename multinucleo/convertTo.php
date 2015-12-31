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
//CONVERT ARRAY MULTIDIMENSIONAL TO STRING
//INCLUDE IN GLUES THE SIGN TO SEPARATE VALUES by EXAMPLE array("|",",","~","#")
function convertRequestArrayToString(array $glues, array $array) {
	 			$out = "";
			    $g = array_shift($glues);
			    $c = count($array);
			    $i = 0;
			    foreach ($array as $val){
			        if (is_array($val)){
			            $out .= convertRequestArrayToString($glues,$val);
			        } else {
			            $out .= (string)$val;
			        }
			        $i++;
			        if ($i<$c){
			            $out .= $g;
			        }
			    }
			    return $out;
}

// CONVERT STRING TO ARRAY
//DELIMITER NEED THE SEPARATOR SIGN THAT HAVE THE TEXT
function multi_explode(array $delimiter,$string){
		    $d = array_shift($delimiter);
		    if ($d!=NULL){
		        $tmp = explode($d,$string);
		        foreach ($tmp as $key => $o){
		            $out[$key] = multi_explode($delimiter,$o);
		        }
		    } else {
		        return $string;
		    }
		    return $out;
		}
		
		
//CONVERT INTEGER IN BOOLEAN
function int2bool($value) {
	if (is_numeric($value)){
		$valueint = (int)$value;
		if ($valueint == "1") {
			$out = Y;
		} else if ($valueint == "0") {
			$out = N;
		} else {
			return "NO BOOL";	
		}
		return $out;
	} else {
		return "NO BOOL";	
	}
}

?>