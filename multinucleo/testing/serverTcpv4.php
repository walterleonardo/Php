#!/usr/bin/env php
<?php
error_reporting(E_ALL);

/* Permitir al script esperar para conexiones. */
set_time_limit(0);

/* Activar el volcado de salida implícito, así veremos lo que estamo obteniendo
* mientras llega. */
ob_implicit_flush();

$address = '127.0.0.1';
$port = 10003;
$write = null;
$except = null;
//$talkback = "OK ... $input\n";
//$talkback = "ERR \"Error Description\"\n";
//$talkback = "OK |||2,3,4,5,6|aasd,asdasd|||2,3,4,5,6|aasd,asdasd|||2,3,4,5,6|aasd,asdasd|||\n\r";
//$talkback = "OK |||0,1011,GT;043583,364,A02|sadasd,907435|||0,1012,GT;043583,365,A02|sadasd1,907436|||0,1011,GT;043583,365,A02|sadasd1,907437\n\r";
//$talkback = "OK |||0,1006,16564,34,1892845|||0,1007,16564,44,44|||0,1007,16564,44,2414345|||0,1007,16564,44,2413875|||0,1007,16564,54,2411005|||0,1007,16564,64,2415005|||0,1007,16564,64,54|||0,1013,16564,34,1892845|||0,1649,16564,34,1892845|||0,1689,16564,34,1892845|||0,1709,16564,34,1892845|||1,1006,16564,34,1892845|||1,1007,16564,44,2414345|||1,1007,16564,44,2413875|||1,1007,16564,54,2411005|||1,1007,16564,64,2415005|||1,1013,16564,34,1892845|||1,1649,16564,34,1892845|||1,1689,16564,34,1892845|||1,1709,16564,34,1892845\r\n";
//$talkback = "OK |0,1006,16564,34,1892845|0,1007,16564,44,44|0,1007,16564,44,2414345|0,1007,16564,44,2413875|0,1007,16564,54,2411005|0,1007,16564,64,2415005|0,1007,16564,64,54|0,1013,16564,34,1892845|0,1649,16564,34,1892845|0,1689,16564,34,1892845|0,1709,16564,34,1892845|1,1006,16564,34,1892845|1,1007,16564,44,2414345|1,1007,16564,44,2413875|1,1007,16564,54,2411005|1,1007,16564,64,2415005|1,1013,16564,34,1892845|1,1649,16564,34,1892845|1,1689,16564,34,1892845|1,1709,16564,34,1892845\r\n";
$talkback = "OK |||0,1007,16564,44,44,CAL341000,1001|||0,1007,16564,64,54,CAL132100,1001|||1,1007,16564,44,2414345,CAL341000,3|||1,1007,16564,44,2413875,CAL341000,3|||1,1007,16564,64,2415005,CAL132100,3\r\n";




if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    echo "socket_create() ERROR: detail: " . socket_strerror(socket_last_error()) . "\n";
}

if (socket_bind($sock, $address, $port) === false) {
    echo "socket_bind() ERROR: detail: " . socket_strerror(socket_last_error($sock)) . "\n";
}

if (socket_listen($sock, 5) === false) {
    echo "socket_listen() ERROR: detail: " . socket_strerror(socket_last_error($sock)) . "\n";
} else {
	echo "SERVER ONLINE\n";
	echo "waiting... \n";
}

//clients array
$clients = array();

do {
    $read = array();
    $read[] = $sock;
    
    $read = array_merge($read,$clients);
    // Set up a blocking call to socket_select
    if(socket_select($read, $write, $except, $tv_sec = 5) < 1)
    {
            //SocketServer::debug("Problem blocking socket_select?");
        continue;
    }
    
    // Handle new Connections
    if (in_array($sock, $read)) {        
        
        if (($msgsock = socket_accept($sock)) === false) {
            echo "socket_accept() ERROR: detail: " . socket_strerror(socket_last_error($sock)) . "\n";
            break;
        }
        $clients[] = $msgsock;
        $key = array_keys($clients, $msgsock);
        /* Enviar instrucciones. */
        $msg = "\n MULTINUCLEO. \n" .
        "You are the client nº: {$key[0]}\n" .
        "By exit write 'quit'. By close the server write 'shutdown'.\n";
        socket_write($msgsock, $msg, strlen($msg));
        
    }
    
    // Handle Input
    foreach ($clients as $key => $client) { // for each client        
        if (in_array($client, $read)) {
            if (false === ($buf = socket_read($client, 2048))) {
                echo "socket_read() ERROR: detail: " . socket_strerror(socket_last_error($client)) . "\n";
                break 2;
            }
            if (!$buf = trim($buf)) {
                continue;
            }
            if ($buf == 'quit') {
                unset($clients[$key]);
                socket_close($client);
                break;
            }
            if ($buf == 'shutdown') {
                socket_close($client);
                break 2;
            }
            //$talkback = "Client {$key}: say '$buf'.\n";
			$talkback = "OK |||0,1007,16564,44,44,CAL341000,1001|||0,1007,16564,64,54,CAL132100,1001|||1,1007,16564,44,2414345,CAL341000,3|||1,1007,16564,44,2413875,CAL341000,3|||1,1007,16564,64,2415005,CAL132100,3\r\n";
            socket_write($client, $talkback, strlen($talkback));
            echo "Client {$key}: say '$buf'.\n";
        }
        
    }        
} while (true);

socket_close($sock);
?>