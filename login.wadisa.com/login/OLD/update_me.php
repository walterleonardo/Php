<?php
//session_start();  //Must Start a session. 
require "../config/config.php"; //Connection Script, include in every file! 
//Check to see if the user is logged in. 

// Check for empty fields
if(empty($_POST['email']) 		||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$email_address = $_POST['email'];
	
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
$query = mysqli_query($con,"SELECT * FROM SUBSCRIBERS_wificounter_update WHERE USERNAME = '$user'") or die("Can not query the TABLE!"); 
//Count the number of rows. If a row exist, then the username exist! 
$row = mysqli_num_rows($query); 
if($row == 1) 
{ 
 
echo "LA DIRECCIÓN DE CORREO SE ENCUENTRA EN USO";
return false;
}  

if (!empty($_POST['code'])){
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
 
 
$add = mysqli_query($con,"INSERT INTO SUBSCRIBERS_wificounter_update (id, USERNAME) VALUES (null,'$user') or die("ERROR CON LA BASE DE DATOS");



$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//dirección del remitente 
$headers .= "From: BUHONET <admin@buhonet.es>\r\n"; 
//direcciones que recibián copia 
$headers .= "Bcc: admin@buhonet.es\r\n"; 

			mail($user,"Lista de distribucion de $empresa", $mensaje, $headers);
            
            echo "DONE";
return true;  
	
?>