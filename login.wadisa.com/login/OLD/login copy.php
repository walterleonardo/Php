<?php
session_start();
require "../config/config.php"; //Connection Script, include in every file! 
//Check to see if the user is logged in. 
if (isset($_SESSION['username'])) {
    header('location: http://www.buhonet.es/es/home/index.php'); //isset check to see if a variables has been 'set' 
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
            header("location: http://www.buhonet.es/es/home/index.php");
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
