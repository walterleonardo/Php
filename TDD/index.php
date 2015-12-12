<?php
	   require_once 'CuentaBancaria.php'; 
	   class   CuentaBancaria_Test   extends   
	   {
			 public   function   testBalanceIncialEsCero ( )
			 {
					$this -> cb = new CuentaBancaria();
					$this -> assertEquals ( 0 ,   $this -> cb -> getBalance ( ) ) ;
			 }
	   }
?>