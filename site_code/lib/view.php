<?php 
	header('Content-Type: text/html; charset=utf-8');

	// Вывод таблицы

	// Проверка сессии
	include('/check.php');

	// Параметр выбора таблицы
	$answer = $_GET['table'];

	// С целью безопасности ограничены возможные значения параметра
	switch ($answer) {
		// Выборка запроса
		case 't1':
			$query = '
				select name as "Название",
						num as "Колво", 
						unit_of_m as "Единица измерения", 
						cost as "Цена"
				from products
			';
			$newtitle = 'Товары';
			break;
		
		case 't2':
			$query = '
				select 
					s_address as "Адрес", 
					phone as "Телефон", 
					name as "Название"
				from
					seller
			';
			$newtitle = 'Поставщики';
			break;

		case 't3':
			$query = '
				select
					s.name as "Компания", 
					p.name as "Продукт", 
					sp.delivery_date as "Дата поставки", 
					sp.product_num as "Кол-во", 
					sp.bank_account as "Номер карты", 
					sp.s_markup as "Наценка"
				from
					seller s, supply sp, products p
				where sp.product_id = p.id
				  and sp.seller_id = s.id
			';
			$newtitle = 'Поставки';
			break;

		case 't4':
			if ($_COOKIE['status'] == 1) {
				$query = ' select * from users';
				$newtitle = 'Пользователи';
			} else
				$query = false;
				

			break;

		default:
			$query = false;
			break;
	}

	// Если щзапросы выбран
	if (!$query)
		die("Неизвестное значение");

	// Установка соединения
	//$con = getConnection(); 

	// Названия столбцов
	$tableHeader = mysqli_query($con, $query . " limit 1")
		or die("Ошибка при выполнении запроса");
	
	// Содержимое таблиц
	$tableRows = mysqli_query($con, $query);

	$header = mysqli_fetch_assoc($tableHeader)
		or die("Произошла ошибка при выгрузке таблицы");

?>

	
<html>
<head>
	<? echo "<title>$newtitle</title>"; ?>
</head>

<body>
	<table border="1" width="750px" cellspacing="0" align="center" bgcolor="white">
		<tbody>
			<tr>
				<?php

					// Заголовок таблицы
					foreach ($header as $key => $value)
						echo "<td>$key</td>";

					echo "</tr>";

					// Содержимое таблицы
					while($row = mysqli_fetch_row($tableRows)) {
						echo "<tr>";

						foreach ($row as $value)
							echo "<td>$value</td>";

						echo "</tr>";
					}
		
				?>
			</tbody>
		</table>
	</body>
</html>

