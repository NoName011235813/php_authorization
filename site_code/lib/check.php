<?php
	header('Content-Type: text/html; charset=utf-8');

	include('/resetcookie.php');
	// Соединение с БД
	include('/connect.php');
	$con = getConnection();

	// Если значения куки установлены
	if (isset($_COOKIE['id']) and isset($_COOKIE['hash']) and isset($_COOKIE['status'])) {

		// Выполняем запрос на данные пользователя ид которого хранится в куки
		$query = mysqli_query($con, "select *, inet_ntoa(user_ip) as user_ip from users where user_id =" . $_COOKIE['id'])
			or die (mysqli_error($con));

		// Если пользователей не найдено -> авторизация
		if (mysqli_num_rows($query) == 0) {
			resetcookies();
			header("Location: /lib/login.php");
			exit;
		} 

		// Набор данных из результата выборки
		$data = mysqli_fetch_assoc($query);

		// Если хеши не совпадают или ип не совпадают или если аккаунт был создан через консоль администратора
		if (($_COOKIE['hash'] != $data['user_hash']) or ($_SERVER['REMOTE_ADDR'] != $data['user_ip']) or ($data['user_ip'] == '0')) {
				
			// Очистка и перенапрвление
			resetcookies();

			header("Location: /lib/login.php");
		} else 
			setcookie('status', $data['user_status'], time()+60*60*24*30, '/');

	} else 
		// Если что-то отсутствует перенаправление на авторизацию
		header('Location: /lib/login.php');

?>