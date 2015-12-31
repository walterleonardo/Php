<?php
	//CHeck si el array es multidimencional
	function is_multi($a) {
	    $rv = array_filter($a,'is_array');
	    if(count($rv)>0) return true;
	    return false;
	}
	


//RECORRER MATRIZ MULTIDIMENSIONAL HE IMPRIMIRLA
function recorreArrayMulti($arrayIndex) {
	

foreach ($arrayIndex as $clave1level => $value1level) {
	if (is_array($value1level)) {
		echo $clave1level . "=>";
		echo "\n";
		foreach ($value1level as $clave2level => $value2level) {
			if (is_array($value2level)) {
				echo "\t\t";
				echo $clave2level . "=>";
				echo "\n";
					foreach ($value2level as $clave3level => $value3level) {
						if (is_array($value3level)) {
							echo "\t\t\t";
							echo $clave3level . "=>";
							echo "\n";
								foreach ($value3level as $clave4level => $value4level) {
									echo "\t\t\t";
									echo $clave4level . "=>" . $value4level;
									echo "\n";
								}
						} else {
							echo "\t\t";
								echo $clave3level . "=>" . $value3level;
								echo "\n";
						}		
					}
			} else {
				echo "\t";
				echo $clave2level . "=>" . $value2level;
				echo "\n";
			}
		}
	} else {
		echo $clave1level . "=>" . $value1level;
		echo "\n";
	}
}
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

echo int2bool("13");

?>
