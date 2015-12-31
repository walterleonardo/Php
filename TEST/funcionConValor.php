<?php
	
	
	$a = 22;
	echo "valor de a antes de  la funcion $a \n";
	
	x($a);
	//LLAMANDOLA CON EL & MODIFICA EL VALOR ORIGINAL Y NO CREA UNA VARIABLE COPIA PARA EL TRABAJO, NO HACE FALTA EL RETURN
	function x(&$a) {
		$a++;
	}
	
	echo "valor de a despues de  la funcion $a \n";
	unset($a);
	
	echo "valor de a despues del unset $a \n";
?>