<?php
	header('Content-Type: text/html; charset=utf-8');

	// Соединяет с сервером и выбирает БД
	function getConnection() {
		
		$con = mysqli_connect('localhost:3306', 'site_user', 'anypassword') or die("Соединение с сервером не удалось установить");

		mysqli_select_db($con, 'warehouse') or die("Не удалось соединиться с БД");

		return $con;
	}
?>