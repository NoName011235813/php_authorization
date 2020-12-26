<?php
	header('Content-Type: text/html; charset=utf-8');
	// Выход из системы

	include('/resetcookie.php');

	resetcookies();

	header('Location: /lib/login.php');

?>
