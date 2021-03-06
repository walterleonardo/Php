<?php
/* Allow the script to hang around waiting for connections. */
set_time_limit(5);
/* Turn on implicit output flushing so we see what we're getting
* as it comes in. */
ob_implicit_flush();
$address = '127.0.0.1';
$port = 10001;
if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
} else {
	echo "Socket CREATED\n";
}

if (socket_bind($sock, $address, $port) === false) {
echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
} else {
	echo "Socket Binded\n";
}
if (socket_listen($sock, 5) === false) {
echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
} else {
	echo "Socket Listen and waiting\n";
}


do {
	if (($msgsock = socket_accept($sock)) === false) {
		echo "socket_accept() failed: reason1: " . socket_strerror(socket_last_error($sock)) . "\n";
		break;
	} else {
		echo "Socket ACCEPT CONNECTION\n";
	}
        
	do {
		if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
			echo "socket_read() failed: reason2: " . socket_strerror(socket_last_error($msgsock)) . "\n";
			break 2;
		}
	$talkback = "SERVER: Message received-> '$buf' \n";
	socket_write($msgsock, $talkback, strlen($talkback));
	echo "$buf \n";
	} while (true);

	socket_close($msgsock);
	
} while (true);
socket_close($sock);
?>