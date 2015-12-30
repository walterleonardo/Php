<?php
	function request($var){
		if(!($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)))
		{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		     
		    die("Couldn't create socket: [$errorcode] $errormsg \n");
		}
		 
		echo "Socket created \n";
		 
		//Connect socket to remote server
		if(!socket_connect($sock , '127.0.0.1' , 5000))
		{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		     
		    die("Could not connect: [$errorcode] $errormsg \n");
		}
		 
		echo "Connection established \n";
		 
		//$message = "ESTE ES MI MENSAJE \n";
		 $message = "PSFILTER |$var";
		//Send the message to the server
		if( ! socket_send ( $sock , $message , strlen($message) , 0))
		{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		     
		    die("Could not send data: [$errorcode] $errormsg \n");
		} else {
		echo "Message send successfully \n";
		 }
		
		while ($buffer = socket_read($sock,2045)) {
			//echo "ESTO DEVUELVE SERVER: $buffer";
			break;
		}
		socket_close($sock);
		return $buffer;
	}
?>