<?php
//Imprimir lo que traen todas las variable globales
print_r($_REQUEST); //Imprime correctamente
print_r($_POST); //No imprime
print_r($_GET); // Imprime correctamente
 
?>
<html>
<head>
<title>MundoGeek - GET, POST, REQUEST</title>
</head>
<body>
<form action="" method="GET">
<h1> Mi script </h1>
<input type="text" name="input_name" value=""/>
<input type="submit" name="submit_button" value="Enviar"/>
</form>
</body>
</html>