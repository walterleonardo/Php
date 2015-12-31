<?php
	function checkRequest($array) {
		//////////////////////////////
		/////////////VARs/////////////
		//////////////////////////////
				$arrayOriginal = explode('|',$array);
				$arrRO = explode(',',$arrayOriginal[8]);
				$arrHF = explode(',',$arrayOriginal[9]);
				$arrRF = explode(',',$arrayOriginal[10]);
				$arrAF = explode(',',$arrayOriginal[11]);

				
				$check = [true,true,true,true,false,false,false,false,true,false,false,false];
				$checkRO = [true,false,false,false];
				$checkHF = [false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];
				$checkRF = [false,false,false,false];
				$checkAF = [true,false,false,false];

				$checkQ = 12;
				$checkQRO = 4;
				$checkQHF = 17;
				$checkQRF = 4;
				$arrCount = count($arrayOriginal);
				$arrROCount = count($arrRO);
				$arrHFCount = count($arrHF);
				$arrRFCount = count($arrRF);
				//echo "ag = $checkQ $arrCount \n";
				//echo "ro = $checkQRO $arrROCount \n";
				//echo "hf = $checkQHF $arrHFCount \n";
				//echo "rf = $checkQRF $arrRFCount \n";
				
		//////////////////////////////
		//////////////////////////////
		//////////////////////////////
		
				if ($arrCount != $checkQ) {
					echo "Incomplete command";
					return false;
				} 				
				$i=0;
				foreach ($check as $checkNeed) {	
					if ($checkNeed) {
						if ( $arrayOriginal[$i]=="") {
							echo "Array general ERROR in position $i \n";
							return false;
						}
					}
					$i++;
				}
				$i=0;
				//print_r(array_values($arrRO));
				//echo "\n";
				
				foreach ($arrRO as $arrROinterior) {
					$arrROfinal = explode('~',$arrROinterior);
					$x=0;
					foreach ($checkRO as $checkNeed) {
						if ($checkNeed) {
							if ( $arrROfinal[$x]==""  || count($arrROfinal) != $checkQRO) {
								echo count($arrROfinal);
								echo "Room Occupancy ERROR in position $i or incomplete variable  \n";
								return false;
							}
						}
					$x++;
					}
				$i++;
				}
				
				
				
				
				$i=0;
				foreach ($checkHF as $checkNeed) {	
					if ($checkNeed) {
						if ( $arrHF[$i]=="" || count($arrHF) != $checkQHF ) {
							echo "Hotel Filter ERROR in position $i or incomplete variable  \n";
							return false;
						}
					}
					$i++;
				}
				$i=0;
				foreach ($checkRF as $checkNeed) {	
					if ($checkNeed) {
						if ( $arrRF[$i]=="" || count($arrRF) != $checkQRF) {
							echo "Room Filter ERROR in position $i or incomplete variable  \n";
							return false;
						}
					}
					$i++;
				}
				return true;
	}
	
	
	
	function checkAnswer($array) {

					$arrayOriginal = explode('|',$array);
					$check = [true,true,true,true,true];
					$checkQ = 5;
					$arrCount = count($arrayOriginal);
					//echo "ag = $checkQ $arrCount \n";

					
					
					if ($arrCount != $checkQ) {
						//echo "Incomplete response";
						return false;
					} 				
					$i=0;
					foreach ($check as $checkNeed) {	
						if ($checkNeed) {
							if ( $arrayOriginal[$i]=="" && is_numeric($arrayOriginal[$i])) {
								echo "Answer ERROR in position $i \n";
								return false;
							}
						}
						$i++;
					}
		return true;
		}
?>