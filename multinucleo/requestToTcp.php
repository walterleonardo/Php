<?php
	function request($var){
		//////////////////////////////
		/////////////VARs/////////////
		//////////////////////////////

		$address = "192.168.0.178";
		$port = 10003;
		$debug = false;
		$demoInfo="PSFILTER |164|prod|1|Y|14,24,34,44,54,64|||||1~5#5#10~N~N,2~2#3#6~N~N||\r\n";
		//////////////////////////////
		//////////////////////////////
		//////////////////////////////
		
		if(!($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)))
		{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		     
		    die("Couldn't create socket: [$errorcode] $errormsg \n");
		}
		 
		if ($debug) echo "Socket created \n";
		 
		//Connect socket to remote server
		if(!socket_connect($sock , $address , 10003))
		{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		     
		    die("Could not connect: [$errorcode] $errormsg \n");
		}
		 
		if ($debug) echo "Connection established \n";
		 
		//$message = "ESTE ES MI MENSAJE \n";
		 $message = "PSFILTER |$var\r\n";
		//$message = $demoInfo;
		//Send the message to the server
		if( ! socket_send ( $sock , $message , strlen($message) , 0))
		{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		     
		    die("Could not send data: [$errorcode] $errormsg \n");
		} else {
		if ($debug) echo "Message send successfully \n";
		 }
		 
		
		/*echo "Leyendo la respuesta:\n\n";
		$buf = 'Este es mi buffer.';
		if (false !== ($bytes = socket_recv($sock, $buf, 2048, MSG_WAITALL))) {
		    echo "Leídos $bytes bytes desde socket_recv(). Cerrando el socket...";
		} else {
		    echo "socket_recv() falló; razón: " . socket_strerror(socket_last_error($sock)) . "\n";
		}
		socket_close($sock);

		echo $buf . "\n";
		*/
		
		while ($buf = socket_read($sock,2045)) {
			//echo "ESTO DEVUELVE SERVER: $buffer";
			break;
		}
		socket_close($sock);
		return $buf;
	}
?>