<?php
	//explode first dimension of the array to create an array of rows
	$data = "2|env|2|1|5,6,7|6|4,5,6|7,8,9|2~2#3#4#5~0~0,2~2#3#4#5~0~0|2~3~4,1,string,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,2~3~4,string,string,2,3,4,5,0,DATE|0,1~2~3,1~2~3,String|string,string,string";
	$outerARR = explode("|", $data);

	$arr = array();

	//iterate through the newly created array
	
	foreach ($outerARR as $arrvalue) {

	    //explode this row into columns
	    $innerARR = explode(",", $arrvalue);
	
		//explode this row into columns
		foreach ($innerARR as $innervalue) {
			if (substr_count($innervalue, '~') > 0) {
			    //explode this row into columns
			    $moreinnerARR = explode("~", $innervalue);
			
			foreach ($moreinnerARR as $moreinnervalue) {
						if (substr_count($moreinnervalue, '#') > 0) {
						    //explode this row into columns
						    $moremoreinnerARR = explode("#", $moreinnervalue);
							$moreinnerARR[] = $moremoreinnerARR;
						}
					}
				$innerARR[] = $moreinnerARR;
			}
		}
		
		
	    //add the newly created array of columns to the output array as a new index
	    $arr[] = $innerARR;
	}
	
	
	print_r ($arr);
	
	
	function joinr($join, $value, $lvl=0)
	{
	    if (!is_array($join)) return joinr(array($join), $value, $lvl);
	    $res = array();
	    if (is_array($value)&&sizeof($value)&&is_array(current($value))) { // Is value are array of sub-arrays?
	        foreach($value as $val)
	            $res[] = joinr($join, $val, $lvl+1);
	    }
	    elseif(is_array($value)) {
	        $res = $value;
	    }
	    else $res[] = $value;
	    return join(isset($join[$lvl])?$join[$lvl]:"", $res);
	}

	$arrString = joinr(array("|", ",", "~"), $arr);
	echo "ARRAY: $arrString";

?>