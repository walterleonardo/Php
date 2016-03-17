<?php 
session_start();  //Must Start a session. 
require "../config/config.php"; //Connection Script, include in every file! 
//Check to see if the user is logged in. 

if(isset($_SESSION['username'])){  
//'isset' check to see if a variables has been 'set' 
if(isset($_POST['user']) ||
	isset($_POST['pass']) ||
	isset($_POST['passa']) ||
	isset($_POST['rpassa'])){ 
   //Cambio de clave
   
$user = $_POST['user'];
$pass = $_POST['pass'];
$passa = $_POST['passa'];
$rpassa = $_POST['rpassa'];



 $md5_pass = md5($pass);
   //Prevent MySQL Injections 
   $user  = stripslashes($user); 
   $pass  = stripslashes($pass); 
   $passa = stripslashes($passa);
   $rpassa = stripslashes($rpassa);
   $md5_pass = stripslashes($md5_pass);
   $md5_passa = stripslashes($md5_passa);
   $user  = mysqli_real_escape_string($con, $user); 
   $pass  = mysqli_real_escape_string($con, $pass);
   $passa  = mysqli_real_escape_string($con, $passa);
   $rpassa = mysqli_real_escape_string($con, $rpassa);
   $md5_pass = mysqli_real_escape_string($con, $md5_pass);
   $md5_passa = mysqli_real_escape_string($con, $md5_passa);

    if($passa != $rpassa) 
        { 
    echo "LAS CLAVES SON DIFERENTES";
	return false;
	 }
	 
	 
	 $query = mysqli_query($con, "SELECT * FROM SUBSCRIBERS_buhonet WHERE USERNAME = '$user' AND USERPASSWORD = '$pass'") or die("Can not query DB.");
        $count = mysqli_num_rows($query);
        
        if ($count == 1) {
	 $add = mysqli_query($con,"UPDATE SUBSCRIBERS_buhonet SET USERPASSWORD = '$passa', MD5USERPASSWORD = '$md5_passa' WHERE USERNAME = '$user'") or die("Can't Insert! ");
      echo "DONE";
	  return true;
}
       echo "Clave antigua incorrecta.";
	  return false; 
  
  }

}else{ 
   //echo "Please <a href='login.php'>Log In </a> to view the content on this page!"; 
   header ("location: http://www.buhonet.es/es/login/index.php");
} 
?> 
