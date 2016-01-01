<?php
///
//CONVERT ANSWER STRING TO ARRAY
function convertAnswerStringToArray($string) {
	$arrayAnswer = explode("|||",$string);
	//Delete incorrect data
	unset($arrayAnswer[0]);
	foreach($arrayAnswer as $array_values)
	{
	        if($array_values)
	        {
	            	$folders =  explode(",", $array_values);
	            	$array_need[$folders[0]][$folders[1]][$folders[2]][cityCode] = $folders[3];
					$array_need[$folders[0]][$folders[1]][$folders[2]][roomData][] = $folders[4];
					$array_need[$folders[0]][$folders[1]][$folders[2]][hotelCodeOriginal] = $folders[5];	        }
	 }
	unset($string);
	unset($arrayAnswer);
	unset($array_values);
	unset($folders);
	return $array_need;
	unset($array_need);
}
///

///
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
	unset($glues);
	unset($array);
	unset($val);
	unset($g);
	unset($c);
	unset($i);
    return $out;
	unset($out);
}
///



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
		unset($delimiter);
		unset($d);
        return $string;
		unset($string);
    }
	unset($delimiter);
	unset($string);
	unset($d);
	unset($tmp);
	unset($o);
    return $out;
	unset($out);
}

///
//CONVERT TO BOOLEAN WOORK WITH INT2BOOL
function convertBolleans($array) {
		$arrayIndex = $array;
		if (isset($arrayIndex[passengerNationality])) {
			$converted = int2bool($arrayIndex[passengerNationality]);
			$arrayIndex[passengerNationality] = $converted;
		}
		if (isset($arrayIndex[roomFilter][suite])) {
		$converted = int2bool($arrayIndex[roomFilter][suite]);
		$arrayIndex[roomFilter][suite] = $converted;
		}
		if (isset($arrayIndex[roomOccupancies])) {
			foreach ($arrayIndex[roomOccupancies] as $key => $roomOccupancies) {
					foreach ($roomOccupancies as $key2 => $value) {
						//echo "$key -->  $value \n";
						if (($key2 === 'twin') || ($key2 === 'extraBed')) {
							//echo "CONVERTIR A BOOL\n";
							$converted = int2bool($value);
						$arrayIndex[roomOccupancies][$key][$key2] = $converted;
						//echo "$converted \n";
						//echo "$arrayIndex[roomOccupancies][$i][$key] \n";
						}
					
					}
			}
		}
		
		unset($array);
		unset($converted);
		unset($key);
		unset($roomOccupancies);
		unset($key2);
		unset($value);
		return $arrayIndex;
		unset($arrayIndex);
}
///
///
//CONVERT INTEGER IN BOOLEAN
function int2bool($value) {
	if (is_numeric($value)){
		$valueint = (int)$value;
		if ($valueint == "1") {
			$out = Y;
		} else if ($valueint == "0") {
			$out = N;
		} else {
			return "NO-BOOL";	
		}
		unset($valueint);
		unset($value);
		return $out;
		unset($out);
	} else {
		unset($value);
		return "NO-BOOL";	
	}
	return "NO-BOOL";
}
///
?>