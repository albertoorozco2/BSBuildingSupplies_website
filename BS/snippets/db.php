<?php 
try{
	$host = 'localhost';
	$dbname = 'bsbulding';
	$user = 'root';
	$pass = '';
	$DBH = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
	}catch (PDOException $e) {echo “ERROR”;



	}?>