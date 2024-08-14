<?php

$ambiente = 2; //  1 : produccion  , 2 : desarrollo
$dbname = "cat1921ajs_bd_base";

if ($ambiente == 1) {
	$servername = "68.66.224.58";
	$username = "cat1921ajs_bd_base";
	$password = "f3H,Ux&%L#t;";	
	error_reporting(E_ALL);	
	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset($conn, "utf8");
	if ($conn->connect_errno) {
		echo "Nuestro sitio experimenta fallos....01x";
		exit();
	}else{	
		//echo "conexion exitosa";
	}
}


if ($ambiente == 2) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	error_reporting(E_ALL);	
	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset($conn, "utf8");
	if ($conn->connect_errno) {
		echo "Nuestro sitio experimenta fallos....01x";
		exit();
	}else{	
		//echo "conexion exitosa";
	}
}
