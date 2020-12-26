<?php
	header('Content-Type: text/html; charset=utf-8');

	// Функция для создания случайной строки
	include("/generateCode.php");	

	// Соединение с БД
	include('/connect.php');
	$con = getConnection();
	
	// Если кнопка была нажатат
	if (isset($_POST["submit"])) {

		// Значения из полей бзе пробелов
		$login = trim($_POST['login']);
		$password = trim($_POST['password']);

		// Проверка на остутствие спец символов
		if (preg_match("/^[a-zA-Z0-9]+$/", $login) and preg_match("/^[a-zA-Z0-9]+$/", $password)) {

			// Поиск пользователя с данным логиномы
			$query = mysqli_query($con, "select * from users where user_login = '$login'");

			// Если пользователь найден
			if (mysqli_num_rows($query) != 0) {

				// Набор данных о пользователе из запроса
				$data = mysqli_fetch_assoc($query);

				// Проверка соответствия паролей
				if (md5($data['user_salt'] . $password) == $data["user_password"]) {

					// Новый хэш
					$hash = generateCode(10);

					// Отправка нового хэша и нового ип адреса
					mysqli_query($con, "update users 
										set user_hash = '$hash',
											user_ip = inet_aton('" . $_SERVER['REMOTE_ADDR'] . "') 
										 where user_id = " . $data['user_id'])

						or die (mysqli_error($con) . " 000 " .  "update users 
										set user_hash = '$hash',
											user_ip = inet_aton('" . $_SERVER['REMOTE_ADDR'] . "') 
										 where user_id = " . $data['user_id']);

					// Сохранение новых куки
					setcookie('id', $data['user_id'], time()+60*60*24*30, '/');
					setcookie('hash', $hash, time()+60*60*24*30, '/', null, null, true);
					setcookie('status', $data['user_status'], time()+60*60*24*30, '/');

					// Перенапрвление
					header("Location: /index.php");

				} else 
					// Пароли не совпадают
					print "Вы ввели неправильный логин или пароль, проверьте пожалуйста свои данные";

			} else
				// Пользователи не найдены
				print "Вы ввели неправильный логин или пароль, проверьте пожалуйста свои данные";


		} else {
			// Логин или пароль содержат недопустимые символы
			print "Вы ввели неправильный логин или пароль, проверьте пожалуйста свои данные<br>";
		}

	}

?>
<html>
	<header>
		<title>Авторизация</title>
	</header>

	<form method="POST">
		<table border="0" align="center">
			<tbody>
				<tr>
					<td align="center" colspan="2">
						Вход
					</td>
				</tr>
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
					<td align="center" colspan="2">
						<input name="submit" type="submit" value="Войти" />
					</td>
				</tr>

				<tr>
					<td align="center" colspan="2">
						<a href="/lib/register.php">Регистрация</a>
					</td>
				</tr>
			
			</tbody>
		</table>
	</form>
</html>