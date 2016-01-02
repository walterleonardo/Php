	<?php
	 
	//Reduce errors
	error_reporting(~E_WARNING);
	$output = "OK |||0,1007,16564,44,44,CAL341000,1001|||0,1007,16564,64,54,CAL132100,1001|||1,1007,16564,44,2414345,CAL341000,3|||1,1007,16564,44,2413875,CAL341000,3|||1,1007,16564,64,2415005,CAL132100,3\r\n";
	//Create a UDP socket
	if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	     
	    die("Couldn't create socket: [$errorcode] $errormsg \n");
	}
	 
	echo "Socket created \n";
	 
	// Bind the source address
	if( !socket_bind($sock, "0.0.0.0" , 10003) )
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	     
	    die("Could not bind socket : [$errorcode] $errormsg \n");
	}
	 
	echo "Socket bind OK \n";
	 
	//Do some communication, this loop can handle multiple clients
	while(1)
	{
	    echo "Waiting for data ... \n";
	     
	    //Receive some data
	    $r = socket_recvfrom($sock, $buf, 2048, 0, $remote_ip, $remote_port);
	    echo "received: \n";
		echo "$remote_ip : $remote_port\n" . $buf . "\n";
	    $buf = "$output\r\n";
		echo "send: \n";
		echo $buf . "\n";
		$len = strlen($buf);
	    //Send back the data to the client
	    socket_sendto($sock, $buf , $len, 0 , $remote_ip , $remote_port);
	}
	 
	socket_close($sock);
?>