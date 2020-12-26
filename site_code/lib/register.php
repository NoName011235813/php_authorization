<?php
	header('Content-Type: text/html; charset=utf-8');

	// Функция генерирования случайных символьных последовательностей
	include("/generateCode.php");

	// Соединение с сервером
	include("/connect.php");
	$con = getConnection();

	// Если кнопка была нажата
	if (isset($_POST["submit"])) {

		$login = trim($_POST['login']);
		$password = trim($_POST['password']);

		// Массив ошибок
		$err = array();

		// ПРОверкм значений
		if (!preg_match("/^[a-zA-Z0-9]+$/", $login))
			$err[] = "Логин содержит неправильные символы";

		if (!preg_match("/^[a-zA-Z0-9]+$/", $password))
			$err[] = "Пароль содержит неправильные символы";
		
		if ((strlen($login) < 3) or (strlen($login) > 30))
			$err[] = "Логин должен быть длиннее 3 символов и короче 30";


		// Проверка подтверждения пароля
		if ($_POST["password"] != $_POST["rep_password"])
			$err[] = "Пароли не совпадают";


		// Проверка на уникальность логинаы
		$query = mysqli_query($con, "select * from users where user_login = '$login'");

		if (mysqli_num_rows($query) > 0) 
			$err[] = "Пользователь с таким логином уже существует";


		// Если ошибок не найдено
		if (count($err) == 0) {

			// Соль для хеширования
			$salt = generateCode(6);

			// Отправляем данные нового пользователя
			mysqli_query($con, "insert into users 
								(user_login, user_password, user_salt, user_ip)
								 values ('$login', '" . md5($salt . $password) . "', '$salt', inet_aton('" . $_SERVER['REMOTE_ADDR'] . "'))")
				or die(mysqli_error($con));

			// Перенаправляем на страницу авторизации
			header("Location: /lib/login.php");

		} else {
			// Ошибки найдены, их вывод
			print "При регистрации возникли следующие ошибки: <br>";
			foreach ($err as $error)
				print $error . "<br>";
		}

	}
	


?>
<html>
	<header>
		<title>Регистрация</title>
	</header>


	<form method="POST">
		<table border="0" align="center">
			<tbody>
				<tr>
					<td>
						Логин: 
					</td>

					<td>
						<input name="login" type="text" required />
					</td>
				</tr>
				
				<tr>
					<td>
						Пароль: 
					</td>

					<td>
						<input name="password" type="password" required />
					</td>
				</tr>

				<tr>
					<td>
						Повторите пароль: 
					</td>

					<td>
						<input name="rep_password" type="password" required />
					</td>
				</tr>
				
				<tr>
					<td align="center" colspan="2">
						<input name="submit" type="submit" value="Зарегистрироваться" />
					</td>
				</tr>
			
			</tbody>
		</table>
	</form>

</html>