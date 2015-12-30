<?php
	function transRequest($request) {
		$arrayOriginal = explode('|',$request);
		$arrRO = explode(',',$arrayOriginal[8]);
		$arrHF = explode(',',$arrayOriginal[9]);
		$arrRF = explode(',',$arrayOriginal[10]);
		$arrAF = explode(',',$arrayOriginal[11]);
		$check = [true,true,true,true,false,false,false,false,false,true,false,false];
		$type = ["int","string","int","bool","array","int","array","array","array","array","array","array"];
		$checkRO = [true,false,true,true];
		$typeRO = ["int","array","bool","bool"];
		$checkHF = [false,true,false,false,false,false,false,false,false,false,false,false,false,false,false,true,true];
		$typeHF = ["array","bool","string","array","array","array","array","array","array","string","string","int","int","int","int","bool","date"];
		$checkRF = [true,false,false,false];
		$typeRF = ["bool","array","array","string"];
		
		$checkQ = 5;
		$arrCount = count($arrayOriginal);
		
		
		$i=0;
		foreach ($check as $checkNeed) {	
			if ($checkNeed) {
				if ( $arrayOriginal[$i]=="") {
					$arrayOriginal[$i]="X";
					}
				}
				if ( $type[$i] == "bool") {
						if ($arrayOriginal[$i]=="0") {
							$arrayOriginal[$i]="N";
						} else if ($arrayOriginal[$i]=="1") {
							$arrayOriginal[$i]="Y";
						} else {
							echo "Array original ERROR in BOOL VALUE POSITION $i \n";
							return false;		
						}
				}
			$i++;
		}
		
		$i=0;
		/*print_r(array_values($arrRO));
		foreach ($arrRO as $arrROinterior) {
			$arrROfinal = explode('~',$arrROinterior);
			$x=0;
			print_r(array_values($arrROfinal));
		foreach ($checkRO as $checkNeed) {	
			if ($checkNeed) {
				if ( $arrROfinal[$i]=="") {
					$arrROfinal[$i]="X";
					}
			}
			if ( $typeRO[$i] == "bool") {
				print_r($arrROfinal[$i]);
						if ($arrROfinal[$i]=="0") {
							$arrROfinal[$i]="N";
						} else if ($arrROfinal[$i]=="1") {
							$arrROfinal[$i]="Y";
						} else {
							echo "Array RO ERROR in BOOL VALUE POSITION $i \n";
							return false;		
						}
			}
			$i++;
		}
		$x++;
		}
		 */
		$arrayOriginal[8]=implode('~',$arrRO);
		$request = implode('|', $arrayOriginal);
		
		
		//CONVERT VALUES FOR RoomOccupancy
		/*
		$i=0;
				foreach ($checkRO as $checkNeed) {	
					if ($checkNeed) {
						if ( $arrRO[$i]=="") {
							$arrRO[$i]="X";
							}
						}
						if ( $typeRO[$i] == "bool") {
								if ($arrRO[$i]=="0") {
									$arrRO[$i]="N";
								} else if ($arrRO[$i]=="1") {
									$arrRO[$i]="Y";
								} else {
									echo "ERROR in BOOL VALUE POSITION arrayOriginal[$i] \n";
									return false;		
								}
						}
					$i++;
				}
				$arrayOriginal[8]=implode('~',$arrRO);
				

				//CONVERT VALUES FOR RoomOccupancy
				$i=0;
						foreach ($checkRO as $checkNeed) {
							if ($checkNeed) {
								if ( $arrRO[$i]=="") {
									$arrRO[$i]="X";
									}
								}
								if ( $typeRO[$i] == "bool") {
										if ($arrRO[$i]=="0") {
											$arrRO[$i]="N";
										} else if ($arrRO[$i]=="1") {
											$arrRO[$i]="Y";
										} else {
											echo "ERROR in BOOL VALUE POSITION arrayOriginal[$i] \n";
											return false;
										}
								}
							$i++;
						}
						*/
				$arrayOriginal[8]=implode('~',$arrRO);
				$request = implode('|', $arrayOriginal);

	return $request;
	}


	function transResponse($response) {
		$arrayOriginal = explode('|',$response);
		$check = [true,true,true,true,true];
		$checkQ = 5;
		$arrCount = count($arrayOriginal);

			
	return $response;
	}

?>