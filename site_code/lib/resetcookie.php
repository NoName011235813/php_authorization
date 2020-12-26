<?php
	header('Content-Type: text/html; charset=utf-8');

	// Функция что очищает куки
	function resetcookies() {
		setcookie('id', '', time()+60*60*24*30, '/');
		setcookie('hash', '', time()+60*60*24*30, '/', null, null, true);
		setcookie('status', '', time()+60*60*24*30, '/');
	}
?>