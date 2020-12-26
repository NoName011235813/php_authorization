insert into products
(name, num, unit_of_m, cost)
values 
	('коврик для мыши', 200, 'шт.', 1000),
	('инструмент', 1500, 'шт.', 2000),
	('монитор', 1300, 'шт.', 20000),
	('калькуляторы', 500, 'шт.', 150),
	('клавиатуры', 4000, 'шт.', 2000),
	('мыши', 4000, 'шт.', 500);

insert into seller
(s_address, phone, name)
values
	('Адрес 1', '0987654321', 'Компания 1'),
	('Адрес 2', '0654321789', 'Компания 2'),
	('Адрес 3', '0989452158', 'Компания 3'),
	('Адрес 4', '0354056452', 'Компания 4'),
	('Адрес 5', '0987535481', 'Компания 5');

insert into supply
(seller_id, product_id, delivery_date, product_num, bank_account, s_markup)
values
	(1, 1, '2000/01/01', 200, '123452255452', 200),
	
	(1, 3, '2000/03/01', 100, '242542452524', 200),
	(1, 4, '2000/04/01', 200, '543245354345', 200),
	(1, 5, '2000/05/01', 400, '453453453452', 200),
	(1, 6, '2000/06/01', 700, '453453453345', 200),

	(2, 1, '2000/01/01', 100, '453545345345', 100),
	
	(2, 3, '2000/03/01', 200, '123732438325', 200),
	(2, 4, '2000/04/01', 100, '345343543422', 200),
	(2, 5, '2000/05/01', 200, '444787272782', 200),
	(2, 6, '2000/06/01', 100, '125234523472', 200),

	(3, 1, '2000/01/01', 200, '453245387353', 300),
	
	(3, 3, '2000/03/01', 200, '737837378378', 200),
	(3, 4, '2000/04/01', 200, '578375787833', 200),
	(3, 5, '2000/05/01', 100, '135278325237', 200),
	(3, 6, '2000/06/01', 200, '575782737833', 200),

	(4, 1, '2000/01/01', 100, '151031035050', 500),
	
	(4, 3, '2000/03/01', 100, '151031035050', 200),
	(4, 4, '2000/04/01', 200, '151031035050', 200),
	(4, 5, '2000/05/01', 100, '151031035050', 200),
	(4, 6, '2000/06/01', 200, '151031035050', 200),

	(5, 1, '2000/07/01', 200, '151031035050', 200),
	(1, 1, '2000/01/01', 400, '151031035050', 300),
	(2, 1, '2000/01/01', 200, '151031035050', 400),
	(3, 1, '2000/01/01', 100, '151031035050', 50),
	(4, 1, '2000/01/01', 200, '151031035050', 200),
	(1, 1, '2000/01/01', 50, '151031035050', 100),
	(1, 1, '2000/01/01', 200, '15103103505', 100),

	(2, 2, '2001/02/01', 200, '123213212177', 200),
	(1, 2, '2001/02/01', 300, '245245245152', 200),
	(5, 2, '2001/07/01', 200, '151031035050', 500),
	
	(3, 2, '2000/02/01', 100, '345387354237', 200),
	(4, 2, '2000/02/01', 200, '151031035050', 200);