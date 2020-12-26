<?php
	header('Content-Type: text/html; charset=utf-8');

	// Проверка наличия действующей сессии
	include('/lib/check.php');

	// Запрос - список таблиц
	$query = mysqli_query($con, 'show tables');
?>

<html>
	<header>
		<title>Главная форма</title>
	</header>

	<body>
		
		<table border="0" align="center">
			<tbody>

				<!--Заголовок-->
				<tr>
					<td align="center">
						<p>Таблицы</p>
					</td>
				</tr>

				<!--Вывод списка таблиц-->
				<?
					// Определение настоящих названий таблиц
					$tables = array (
						'products' => 'Товары',
						'seller' => 'Поставщики',
						'supply' => 'Поставки'
					);

					// Вывод списка таблиц
					$i = 1;
					while($row = mysqli_fetch_row($query)) {

						$tableName = $tables[$row[0]];

						// Если имя таблицы определено, вывести
						if (!empty($tableName)) {
							echo "
								<tr> 
									<td align=\"center\">
										<a href='/lib/view.php?table=t$i'>$tableName</a>
									</td>
								</tr>
							";

							$i++;
						}
					}

					if ($_COOKIE['status'] == 1)
						echo "
							<tr>
								<td align=\"center\">
									<a href='/lib/view.php?table=t$i'>Пользователи</a>
								</td>
							</tr>
						";
				?> 

				<!--Ссылка выхода из таблицы-->
				<tr>
					<td align="center">
						<a href="/lib/logout.php">Выход</a>	
					</td>
				</tr>
			</tbody>
		</table>

	</body>
</html>