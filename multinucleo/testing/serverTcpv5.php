<?php
error_reporting(E_ALL);

/* Allow the script to hang around waiting for connections. */
set_time_limit(0);

/* Turn on implicit output flushing so we see what we're getting
* as it comes in. */
ob_implicit_flush();

$address = '127.0.0.1';
$port = 10003;

if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
}

if (socket_bind($sock, $address, $port) === false) {
    echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
}
else 
  echo 'Socket ' . $address . ':' . $port . " has been opened\n";

if (socket_listen($sock, 5) === false) {
    echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
}
else 
   echo "Listening for new clients..\n";

   $client_id = 0;
do {
    if (($msgsock = socket_accept($sock)) === false) {
        echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
        break;
    }
    else {
        $client_id += 1;
      echo "Client #" .$client_id .": Connect\n";
    }
      
    /* Send instructions. */
    $msg = "\nWelcome to the PHP Test Server. \n" .
        "To quit, type 'quit'. To shut down the server type 'shutdown'.\n";
    socket_write($msgsock, $msg, strlen($msg));
$cur_buf = '';
    do {
        if (false === ($buf = socket_read($msgsock, 2048))) {
            echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($msgsock)) . "\n";
            break 2;
        }
        if ($buf == "\r\n") {
        if ($cur_buf == 'quit') {
            echo 'Client #' .$client_id .': Disconnect' . "\n";
            break;
        }
        if ($cur_buf == 'shutdown') {
            socket_close($msgsock);
            break 2;
        }
        //else {
       $talkback = "Unknown command: " . str_replace("\r\n", '\r\n', $cur_buf) ."\n";
       socket_write($msgsock, $talkback, strlen($talkback));
       // }
        echo 'Client #' .$client_id .': ' . $cur_buf . "\n"; 
        $cur_buf = '';
        }
        else $cur_buf .= $buf;
    } while (true);
    socket_close($msgsock);
} while (true);

socket_close($sock);
?>