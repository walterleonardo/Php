<?php
	$array1    = array(
	"a" => "",
	"b" => "", 
	"c" => "",
	"d" => ""
	);
	$array2    = array("a" => "asda","b" => "green");
	$resultado1 = array_diff($array2, $array1);
	$resultado2 = array_diff_assoc($array1, $array2);
	$resultado3 = array_intersect($array1, $array2);
	$resultado4 = array_intersect_assoc($array1, $array2);

	echo "DIFERENCIAS:\n";
	print_r($resultado1);
	print_r($resultado2);
	print_r($resultado3);
	print_r($resultado4);
	
	
	$cesta = array_replace_recursive($array1, $array2);
	print_r($cesta);
?>