<?php 
session_start();  //Must Start a session. 
require "../config/config.php"; //Connection Script, include in every file! 
//Check to see if the user is logged in. 
//'isset' check to see if a variables has been 'set' 
$val3=$val1+$val2;
if(isset($_SESSION['username'])){ 
   //header("location: http://www.buhonet.es/es/home/index.php"); 
    echo "DONE";
    return true;
}
// Check for empty fields
if(empty($_POST['user'])  		||
   empty($_POST['pass']) 		||
   empty($_POST['rpass']) 		||
   empty($_POST['sec'])	||
   !filter_var($_POST['user'],FILTER_VALIDATE_EMAIL))
   {
	echo "COMPLETE LOS CAMPOS";
	return false;
   }
	
$user = $_POST['user'];
$pass = $_POST['pass'];
$rpass = $_POST['rpass'];
$sec = $_POST['sec'];
$code = $_POST['code'];

// El mensaje
$mensaje = "
<html>
<head>
<title>BUHONET</title>
</head>
<body>
<h1>Se ha registrado en $empresa</h1>
<p>Ahora quedan unos simples pasos...</p>

<li>
Para poder disfrutar de nuestros servicios puede buscar ayuda en los manuales para cada tipo de dispositivos o navegador <a href=\"http://buhonet.es/es/doc\">LINKs</a>
</li>
<li>
También puede contactarnos por mail presionando el siguiente <a href=\"mailto:admin@wadisa.com?subject='ayuda de config $empresa'\">LINK</a>
</li>
<br>
<li>
Si lo prefiere puede intentar configurar usted mismo las opciones del navegador con los siguientes valores:
</li>
<ul>
<li>
Su usuario y clave creada en nuestra web.
</li>
<li>
El nombre del servidor <b>$empresa</b> o <b>wadisa.com</b>
</li>
<li>
El numero de puerto TCP necesario <b>8080</b>
</li>
</ul>
<br>
<br>
<br>
<br><br>
<p>
Muchas gracias por preocuparse por la seguridad de internet.
</p>

</body>
</html>
";


// Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
$mensaje = wordwrap($mensaje, 70, "\r\n");
$cabeceras = 'From: admin@wadisa.com' . "\r\n" . 'Reply-To: admin@wadisa.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

   $md5_pass = md5($pass);
   //Prevent MySQL Injections 
   $user  = stripslashes($user); 
   $pass  = stripslashes($pass); 
   $rpass = stripslashes($rpass);
   $code = stripslashes($code);
   $md5_pass = stripslashes($md5_pass);
   $user  = mysqli_real_escape_string($con, $user); 
   $pass  = mysqli_real_escape_string($con, $pass); 
   $rpass = mysqli_real_escape_string($con, $rpass);
   $code = mysqli_real_escape_string($con, $code);
   $md5_pass = mysqli_real_escape_string($con, $md5_pass);
   //Check to see if the user left any space empty! 
  // echo $sec;
   //echo "----";
   //echo $val3;
if($sec != $val3) 
{ 
echo "ERROR EN LA VERIFICACIÓN DE LA SUMA";
return false;
} 


//Check too see if the user's Passwords Matches! 
if($pass != $rpass) 
{ 
echo "LAS CLAVES SON DIFERENTES";
return false;
}


//Query the DB 
$query = mysqli_query($con,"SELECT * FROM users WHERE USERNAME = '$user'") or die("Can not query the TABLE!"); 
//Count the number of rows. If a row exist, then the username exist! 
$row = mysqli_num_rows($query); 
if($row == 1) 
{ 
 
echo "LA DIRECCIÓN DE CORREO SE ENCUENTRA EN USO";
return false;
}  

/*if (!empty($_POST['code'])){
 //Query the DB correct code
 $query = mysqli_query($con,"SELECT * FROM PROMOS_buhonet WHERE CODE = '$code'") or die("Can not query the TABLE!"); 
 
 while ($obj = $query->fetch_object()) {
            $enable.=$obj->ENABLE;
            $dias.=$obj->DIAS; 
            $vencimiento.=$obj->ACTIVEUPTO;
            $cantidad.=$obj->CANTIDAD;
        }
 
 //Count the number of rows. If a row exist, then the username exist! 
 //$row = mysqli_num_rows($query1); 
 //if($row == 0)
 //echo $vencimiento;
 $dia = date("Y-m-d");
if($vencimiento < $dia)
{ 
echo "DISCOUNT OR INVITATION CODE OUT DATE.";
//echo $dia;
return false;
}

 if($enable!=1)
 { 
     
echo "DISCOUNT OR INVITATION CODE INVALID.";
return false;
 }
 
 $cantidad--;
 $add = mysqli_query($con,"UPDATE PROMOS_buhonet SET CANTIDAD = '$cantidad' WHERE CODE = '$code'") or die("Can't Insert! ");

 
             
 }else{
	         $dias=1; 
        }
        
       // echo "$dias";  
         
 //           $add = mysqli_query($con,"INSERT INTO SUBSCRIBERS_buhonet (id, USERNAME,USERPASSWORD, MD5USERPASSWORD, ENABLE, CONCURRENCIA, PPTP, WEBCONTROL,CODE,ACTIVEUPTO) VALUES (null,'$user','$pass','$md5_pass','1','5','1','1','$code',CURDATE())") or die("Can't Insert! ");
//            mail("admin@wadisa.com","nuevo usuario","Existe un nuevo usuario en el servicio BUHONET con nombre $user") ;
//para el envío en formato HTML 
*/
$add = mysqli_query($con,"INSERT INTO users (id, USERNAME,USERPASSWORD, MD5USERPASSWORD, ENABLE, CONCURRENCIA, PPTP, WEBCONTROL,CODE,ACTIVEUPTO) VALUES (null,'$user','$pass','$md5_pass','1','5','1','1','$code',DATE_ADD( CURDATE(), INTERVAL '$dias' DAY ))") or die("ERROR CON LA BASE DE DATOS");



$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//dirección del remitente 
$headers .= "From: $empresa <admin@wadisa.com>\r\n"; 
//direcciones que recibián copia 
$headers .= "Bcc: admin@buhonet.es\r\n"; 

			mail($user,"Registro en $empresa", $mensaje, $headers);
            //header("location: ../publicidad/cuenta.php");   
            echo "DONE";
return true;  

?>