<?php
// dejamos en cero para que la conexion acepte la conexiones a ese y esta nunca se cierre
set_time_limit(0);
 
// creamos el array que contiene la informacion que queremos buscar
$contenido = array('banano' => 10, 'manzana' => 18, 'peras' => 50);
// la ip del servidor en la cual se va a crear el socket
$ip = '127.0.0.1';
// el puerto por el cual escuchara peticiones
$puerto = '10003';
 
/* CREANDO EL SOCKET 
AF_INET sirve para especifcar el protocolo en que se basara la conexion (AF_INET - AF_INET6 - AF_UNIX)
SOCK_STREAM indica como se enviaran y recibiran los bytes en la conexion
*/
$socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
// vinculamos el puerto a la IP
socket_bind($socket, $ip, $puerto) or die ('No se puede vincular el puerto a la IP');
// en caso de error lo mostramos para saber que pasa
echo socket_strerror(socket_last_error());
// hacemos el que socket escuche peticiones
socket_listen($socket);
 
while(1){
    // aceptamos la conexion que nos entre
    $cliente[++$i] = socket_accept($socket);
    // leemos la informacion que nos envian
    $input = socket_read($cliente[$i], 1024);
    // quitamos espacios y saltos de linea de lo que se lee
    $ticker = ereg_replace("[ \t\r\n]", "", $input);
    // escribimos lo que recibimos
    echo "Ticker: $ticker \n\r";
    
    if(array_key_exists($ticker, $contenido)){
        // ahora si buscamos la informacion que leimos en el socket
        // dentro del array de contenido
        $precio = $contenido[$ticker];
    }else{
        // si no existe pues le decimos que lo que
        // busco no esta dentro del contenido
        $precio = "No se encontro el ticket\n\r";
    }
    // escribimos los resultados que encontramos dentro del
    // array en el socket para que el cliente los lea
    socket_write($cliente[$i], $precio . "\n\r", 1024);
    // cerramos la conexion de ese cliente
    socket_close($cliente[$i]);
}
// cerramos la conexion global
socket_close($socket);
?>