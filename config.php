<?php 

	#mysql_connect('localhost','root','') or die('cannot connect to the server');

	#mysql_select_db('my_practice') or die('cannot connect database');

	$host = 'localhost';
	$dbname = 'fit_ems';
	$dbuser = 'root';
	$dbpassword = '';


	try{
		$pdo = new PDO("mysql:host={$host};dbname={$dbname};",$dbuser,$dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}

	catch(PDOException $exception){
		echo "Connection Error :" .$exception->getMessage();
	}



 ?>