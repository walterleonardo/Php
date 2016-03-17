<?php 
session_start();  //Must Start a session. 
require "../config/config.php"; //Connection Script, include in every file! 
//Check to see if the user is logged in. 
//'isset' check to see if a variables has been 'set' 
$val3=$val1+$val2;
if(isset($_SESSION['username'])){ 
   header("location: http://www.buhonet.es/home/index.php"); 
}
//Check to see if the user click the button 
if(isset($_POST['submit'])) 
{ 
// El mensaje
$mensaje = "
<html>
<head>
<title>BUHONET</title>
</head>
<body>
<h1>Se ha registrado en BUHONET</h1>
<p>Ahora quedan unos simples pasos...</p>

<li>
Para poder disfrutar de nuestros servicios puede buscar ayuda en los manuales para cada tipo de dispositivos o navegador <a href=\"http://buhonet.es/doc\">LINKs</a>
</li>
<li>
Tambien puede contactarnos por mail presionando el siguiente <a href=\"mailto:admin@buhonet.es?subject='ayuda de config BUHONET'\">LINK</a>
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
El nombre del servidor <b>buhonet.es</b> o <b>wadisa.com</b>
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
$cabeceras = 'From: admin@buhonet.es' . "\r\n" . 'Reply-To: admin@wadisa.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
   //Variables from the table 
   $user  = $_POST['user']; 
   $pass  = $_POST['pass']; 
   $rpass = $_POST['rpass'];
   $sec = $_POST['sec'];
   $md5_pass = md5($pass);
   //Prevent MySQL Injections 
   $user  = stripslashes($user); 
   $pass  = stripslashes($pass); 
   $rpass = stripslashes($rpass);
   $md5_pass = stripslashes($md5_pass);
   $user  = mysqli_real_escape_string($con, $user); 
   $pass  = mysqli_real_escape_string($con, $pass); 
   $rpass = mysqli_real_escape_string($con, $rpass);
   $md5_pass = mysqli_real_escape_string($con, $md5_pass);
   //Check to see if the user left any space empty! 
  // echo $sec;
   //echo "----";
   //echo $val3;
   if ($user == "" || $pass == "") {
        ?>
        <script type="text/javascript">
            alert("Completa los campos de Email y Clave");
        </script>
        <?php
    }
    if(!check) 
        { ?>
        <script type="text/javascript">
            alert( "Las claves son diferentes.");
        </script>
    <?php }
    
   if($sec != $val3) 
        { ?>
        <script type="text/javascript">
            alert( "Pregunta de seguridad erronea..." );
        </script>
    <?php 
    //echo "$sec";
    
        }
    
   else 
   { 
      //Check too see if the user's Passwords Matches! 
    if($pass != $rpass) 
        { ?>
        <script type="text/javascript">
            alert( "Las claves son diferentes.");
        </script>
    <?php }
      //CHECK TO SEE IF THE USERNAME IS TAKEN, IF NOT THEN ADD USERNAME AND PASSWORD INTO THE DB 
      else 
      { 
   
         //Query the DB 
         $query = mysqli_query($con,"SELECT * FROM SUBSCRIBERS_buhonet WHERE USERNAME = '$user'") or die("Can not query the TABLE!"); 
          
         //Count the number of rows. If a row exist, then the username exist! 
         $row = mysqli_num_rows($query); 
         if($row == 1) 
         { ?>
        <script type="text/javascript">
            alert( "Ese mail se encuentra en uso..." );
        </script>
    <?php  } 
          
         //ADD THE USERNAME TO THE DB 
         else 
         { 
            $add = mysqli_query($con,"INSERT INTO SUBSCRIBERS_buhonet (id, USERNAME,USERPASSWORD, MD5USERPASSWORD, ENABLE, CONCURRENCIA, PPTP, WEBCONTROL,ACTIVEUPTO) VALUES (null,'$user','$pass','$md5_pass','1','1','1','1',CURDATE())") or die("Can't Insert! ");
//            mail("admin@wadisa.com","nuevo usuario","Existe un nuevo usuario en el servicio BUHONET con nombre $user") ;
//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//dirección del remitente 
$headers .= "From: BUHONET <admin@buhonet.es>\r\n"; 
//direcciones que recibián copia 
$headers .= "Bcc: admin@buhonet.es\r\n"; 

			mail($user,"Registro en BUHONET", $mensaje, $headers);
            header("location: ../publicidad/cuenta.php"); 
         } 
          
          
      }       

   } 
    
} 
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>BUHONET</title>
        <meta name="description" content="Seguridad y Filtrado de Contenido" />
        <meta name="keywords" content="buhonet,control parental, web control, vpn, tuneles, seguridad, internet, sistemas de control, parental control" />
        <meta name="author" content="Wadisa" />
        <link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico"> 
        <link rel="icon" type="image/gif" href="../imagenes/buhogif32x32.gif" />
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <link rel="icon" type="image/vnd.microsoft.icon" href="../imagenes/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="../css/jquery.jscrollpane.custom.css" />
        <link rel="stylesheet" type="text/css" href="../css/bookblock.css" />
        <link rel="stylesheet" type="text/css" href="../css/custom.css" />

        <script src="../js/inicio.js"></script>

    </head>
    <body>
        <div id="container" class="container">	

            <div class="menu-panel">
                <h3> BUHONET.es</h3>
                <ul id="menu-toc" class="menu-toc">
                    <li class="menu-toc-current"><a href="#item1">Registro Usuario</a></li>
                </ul>
                <div>
                    <a href="../index.php"><img src="../imagenes/volver_flecha.png"></a> 
                </div>
            </div>

            <div class="bb-custom-wrapper">
                <div id="bb-bookblock" class="bb-bookblock">
                    <div class="bb-item" id="item1">
                        <div class="content">
                            <div class="scroller">
                                <h1><img STYLE="position:absolute; top:50px; left:600px; width:80px; height:60px" src="../imagenes/buhogif.gif">BUHONET</h1>
                                <h3>ACCESO & REGISTRO</h3><br>
                                <br>
                                <br>
                                <div id="register-wrapper">
                                     <div id="div2">
                                          <div id="div3">
                                    <table width="300" align="center" cellpadding="0" cellspacing="1" border="1px solid black"> 

                                        <tr> 
                                        <form name="register" method="post" action="http://www.buhonet.es/login/registro.php"> 
                                            <td> 

                                                <table width="100%" border="1" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF"> 

                                                    <tr> 
                                                        <td colspan="1"><strong><center><label for="usn">Registro </label></center></strong></td> 
                                                    </tr> 
                                                    <tr> 
                                                        <td width="40%"><label for="usn">Email </label></td> 
                                                        <td width="20%"></td> 
                                                        <td width="40%"><input name="user" type="email" required autofocus autocapitalize="off" autocorrect="off" id="user"></td> 
                                                    </tr> 

                                                    <tr> 
                                                        <td><label for="usn">Clave </label></td> 
                                                        <td></td> 
                                                        <td><input name="pass" type="password" required id="pass"></td> 
                                                    </tr> 

                                                    <tr> 
                                                        <td><label for="usn">Repite la clave </label></td> 
                                                        <td></td> 
                                                        <td><input name="rpass" type="password" required id="rpass"></td> 
                                                    </tr> 
                                                    <tr> 
                                                        <td></td> 
                                                        <td></td> 
                                                        <td></td> 
                                                    </tr> 
                                                    <tr> 
                                                        <td><label for="usn">Acepta <a href="http://buhonet.es/publicidad/condiciones.php" target="_blank">condiciones</a></label></td> 
                                                        <td></td> 
                                                        <td><input type="checkbox" id="check" title="Required to proceed" required name="term"></td> 
                                                    </tr> 
                                                    <tr> 
                                                        <td><label for="usn">Pregunta </label></td> 
                                                        <td></td> 
                                                        <td><input name="sec" type="text" required id="sec" value="¿Suma <?php echo $val1?>+<?php echo $val2?>?"></td> 
                                                    </tr>
                                                    <tr> 
                                                        <td></td> 
                                                        <td></td> 
                                                        <td></td> 
                                                    </tr> 
                                                    <tr> 
                                                         
                                                        <td><input type="button" name="Cancelar" value="Cancelar" onclick="location.href='http://www.buhonet.es/index.php'"></td> 
                                                        <td></td>
                                                        <td><input type="submit" name="submit" value="Registro"></td> 
                                                    </tr> 

                                                </table> 
                                            </td> 
                                        </form> 
                                        </tr> 
                                    </table> 
                                       </div> 
                                         </div> 
                                </div>      
                            </div>
                            </br>
                            </br>
                            </br>
<center><h4>BUHONET es una empresa del grupo WADISA     </h4> <a href="http://buhonet.es/publicidad/condiciones.php">Condiciones del servicio</a></center>
                            
                        </div>

                    </div>
                </div>
                <span id="tblcontents" class="menu-button">Table of Contents</span>

            </div>

        </div><!-- /container -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.mousewheel.js"></script>
        <script src="../js/jquery.jscrollpane.min.js"></script>
        <script src="../js/jquerypp.custom.js"></script>
        <script src="../js/jquery.bookblock.js"></script>
        <script src="../js/page.js"></script>
        <script src="../js/validar.js"></script>


        <script>
            $(function() {

                Page.init();

            });
        </script>
        <div style="clear:both;"></div>
    </body>
</html>
