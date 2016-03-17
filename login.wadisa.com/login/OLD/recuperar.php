<?php 
session_start();  //Must Start a session. 
require "../config/config.php"; //Connection Script, include in every file! 
//Check to see if the user is logged in. 
//'isset' check to see if a variables has been 'set' 
$val3=$val1+$val2;
//if(isset($_SESSION['username'])){ 
   //header("location: http://www.buhonet.es/es/home/index.php"); 
//    echo "DONE";
//    return true;
//}
// Check for empty fields
if(empty($_POST['user'])  		||
   empty($_POST['sec'])	||
   !filter_var($_POST['user'],FILTER_VALIDATE_EMAIL))
   {
	echo "COMPLETE LOS CAMPOS";
	return false;
   }

   //Variables from the table 
   $user  = $_POST['user']; 
   $sec = $_POST['sec'];
   //Prevent MySQL Injections 
   $user  = stripslashes($user); 
   $user  = mysqli_real_escape_string($con, $user); 
   //Check to see if the user left any space empty! 
  // echo $sec;
   //echo "----";
   //echo $val3;
    
   if($sec != $val3) 
        { 
        echo "RESPUESTA A LA SUMA INCORRECTA";
	return false;
        }

         //Query the DB 
         $query = mysqli_query($con,"SELECT * FROM users WHERE USERNAME = '$user'") or die("Can not query the TABLE!"); 
          
         //Count the number of rows. If a row exist, then the username exist! 
         $row = mysqli_num_rows($query); 

 while ($obj = $query->fetch_object()) {
            $clave.=$obj->USERPASSWORD;
        }

         if($row == 1) 
         {
   $destinatario = $user;
    $asunto = "$empresa: Mail para recuperar su clave ";
    $cuerpo = "<html><head><title>Solicitud de recuperación de clave</title></head><body><h1>RECUPERAR CLAVE</h1><p><b>Este es un correo de recordatorio de clave para el usuario $user. </b> Su clave es:  $clave</p></body></html>";

//para el envío en formato HTML 
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	//dirección de respuesta, si queremos que sea distinta que la del remitente 
	//$headers .= "Reply-To: $user\r\n"; 
    $headers .= "From: $empresa <admin@wadisa.com>\r\n";
    $headers .= "Bcc: admin@wadisa.com\r\n";

    mail($destinatario, $asunto, $cuerpo, $headers);

	echo "DONE";
	return true;
	} 
	else
	{
	echo "NO HEMOS ENCONTRADO TU MAIL, contacta al administrador del sitio.";
	return false;
	}
         
?>
