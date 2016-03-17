<?php 
session_start();  //Must Start a session. 
require "../config/config.php"; //Connection Script, include in every file! 
//Check to see if the user is logged in. 

if(isset($_SESSION['username'])){  
//'isset' check to see if a variables has been 'set' 
if(isset($_POST['user']) ||
	isset($_POST['address']) ||
	isset($_POST['phone']) ||
	isset($_POST['nas']) ||
	isset($_POST['nas1']) ||
	isset($_POST['nas2']) ||
	isset($_POST['nas3']) ||
	isset($_POST['nas4']) ||
	isset($_POST['nas5']) ||
	isset($_POST['code'])){ 
   //Actualizacion de cuenta

$user = $_POST['user'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$nas = $_POST['nas'];
$nas1 = $_POST['nas1'];
$nas2 = $_POST['nas2'];
$nas3 = $_POST['nas3'];
$nas4 = $_POST['nas4'];
$nas5 = $_POST['nas5'];
$code = $_POST['code'];

   //Prevent MySQL Injections 
   $user  = stripslashes($user); 
   $user  = mysqli_real_escape_string($con, $user); 
   //Check to see if the user left any space empty!          

$query = mysqli_query($con,"SELECT * FROM users WHERE USERNAME = '$user'") or die("Can not query the TABLE!"); 
          
         //Count the number of rows. If a row exist, then the username exist! 
         $row = mysqli_num_rows($query); 
         if($row == 1) 
         { 
$add = mysqli_query($con,"UPDATE users SET ADDRESS = '$address', mac0 = '$nas',mac1 = '$nas1',mac2 = '$nas2',mac3 = '$nas3',mac4 = '$nas4',mac5 = '$nas5', PHONE = '$phone', CODE = '$code' WHERE USERNAME = '$user'") or die("Can't Insert! ");
      echo "DONE";
	  return true;     

}

}      



}else{ 
   //echo "Please <a href='login.php'>Log In </a> to view the content on this page!"; 
   header ("location: index.php");
} 
?> 
