<?php
session_start();
require "../config/config.php"; //Connection Script, include in every file! 
//Check to see if the user is logged in. 
if (isset($_SESSION['username'])) {
    header('location: http://www.buhonet.es/home/index.php'); //isset check to see if a variables has been 'set' 
}
if (isset($_POST['submit'])) {
    //Variables from the table 
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $md5_pass = md5($pass); 
    //Prevent MySQL Injections 
    $user = stripslashes($user);
    $pass = stripslashes($pass);
    $md5_pass = stripslashes($md5_pass);
    $user = mysqli_real_escape_string($con, $user);
    $pass = mysqli_real_escape_string($con, $pass);
    $md5_pass = mysqli_real_escape_string($con, $md5_pass);
    //Check to see if the user left any space empty! 
    if ($user == "" || $pass == "") {
        ?>
        <script type="text/javascript">
            alert("Completa los campos de Email y Clave");
        </script>
        <?php
    } else {
        $query = mysqli_query($con, "SELECT * FROM SUBSCRIBERS_buhonet WHERE USERNAME = '$user' AND USERPASSWORD = '$pass'") or die("Can not query DB.");
        $count = mysqli_num_rows($query);
        while ($obj = $query->fetch_object()) {
            $vencimiento.=$obj->ACTIVEUPTO;
            $enable.=$obj->ENABLE; 
            $vpn.=$obj->PPTP;
            $wc.=$obj->WEBCONTROL;
            $creacion.=$obj->TIME_STAMP;
	    $concurrencia.=$obj->CONCURRENCIA;

        }
        if ($count == 1) {
            //YES WE FOUND A MATCH! 
            $_SESSION['username'] = $user; //Create a session for the user! 
            $_SESSION['vencimiento'] = $vencimiento; //Create a session for the user!
            $_SESSION['creacion'] = $creacion; //Create a session for the user! 
            $_SESSION['enable'] = $enable; //Create a session for the user! 
            $_SESSION['vpn'] = $vpn; //Create a session for the user! 
            $_SESSION['wc'] = $wc; //Create a session for the user!
	    $_SESSION['concurrencia'] = $concurrencia; //Create a session for the user!  
            header("location: http://www.buhonet.es/home/index.php");
        } else {
            ?>
            <script type="text/javascript">
                alert("Error en el email o en la clave.");
            </script>
            <?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
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

<!--        <SCRIPT LANGUAGE="JavaScript">

function popup(URL) {
day = new Date();
var w = 500;
var h = 400;
var left = (screen.width / 2)  - (w / 2);
var top  = (screen.height / 2) - (h / 2);
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=no,scrollbars=no,copyhistory=no,directories=no,location=no,status=no,statusbar=no,menubar=no,resizable=no,width='+w+',height='+h+',top='+top+',left='+left);");
}

</script>
-->
    </head>
    <body>
        <div id="container" class="container">	

            <div class="menu-panel">
                <h3> BUHONET.es</h3>
                <ul id="menu-toc" class="menu-toc">
                    <li class="menu-toc-current"><a href="#item1">Acceso Usuario</a></li>
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
                                <div id="login-wrapper">
                                    <form name="register" method="post" action="http://www.buhonet.es/login/index.php">
                                        <table width="300" align="center" cellpadding="0" cellspacing="10" border="1px solid black"> 
                                            <tr> 
                                                <td> 
                                                    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF"> 
                                                        <tr> 
                                                            <td colspan="3"><strong><center><label for="usn">Acceso a su cuenta</label></center></strong></td> 
                                                        </tr> 
                                                        <tr> 
                                                            <td width="78"><label for="usn">Email </label></td> 
                                                            <td></td>
                                                            <td width="294"><input name="user" type="email" required autofocus autocapitalize="off" autocorrect="off" id="user"></td> 
                                                        </tr> 
                                                        <tr> 
                                                            <td><label for="usn">Clave </label></td> 
                                                            <td></td> 
                                                            <td><input name="pass" type="password" required id="pass"></td> 
                                                        </tr> 
                                                        <tr>
                                                            <td></td>
                                                            <td></td>  
                                                            <td><input type="submit" name="submit" value="Acceso"></td>
                                                        </tr>
							 <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td><input type="button" name="register" value="Recuperar clave" onClick="location.href='http://www.buhonet.es/login/recuperar.php'"></td>
                                                            </tr>
 
                                                            <tr> 
                                                            <td></td>
                                                            <td></td>
                                                            <td><input type="button" name="register" value="Registro" onClick="location.href='http://www.buhonet.es/login/registro.php'"></td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>
                                                    </table> 
                                                </td> 
                                            </tr> 
                                         
                                        </table> 
                                        <br>
<br>
<br>
                                    </form> 
<br>
<br>
<br>
                                </div>    
                            </div>
                            <center><h4>BUHONET es una empresa del grupo WADISA     </h4> <a href="http://buhonet.es/publicidad/condiciones.php">Condiciones del servicio</a></center>
                        </div>
                        
                    </div>
                    

                </div>
                <span id="tblcontents" class="menu-button"></span>
<br>
<br>
<br>
<br>
            </div>
<br>
<br>
<br>
<br>
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
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.walii.es/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="http://piwik.walii.es/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
    </body>
</html>
