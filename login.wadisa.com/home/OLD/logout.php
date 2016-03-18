<?php 
session_start(); 
require "../config/config.php"; 
session_destroy(); 
//echo "You have successfully logged out. <a href='login.php'> Click here </a> to login!"; 
header ("location: ../login/index.php");
?>