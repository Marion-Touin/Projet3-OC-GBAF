<?php
session_start();
	$_SESSION = array ();
	session_destroy();
	//renvoyeb vers la page de connexion
	header("Location: connexion.php");
?>
