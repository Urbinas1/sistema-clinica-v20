<?php
session_start();

if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
	header('location: ../proyecto-base/index.php');   
}

	include '0-conn.php';
	$sql = "SELECT * FROM usuarios WHERE id = '".$_SESSION['admin']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();

	//include '00_funciones.php';

