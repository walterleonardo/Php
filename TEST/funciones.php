<?php
	//CHeck si el array es multidimencional
	function is_multi($a) {
	    $rv = array_filter($a,'is_array');
	    if(count($rv)>0) return true;
	    return false;
	}
	
	
?>