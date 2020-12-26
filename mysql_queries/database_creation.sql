create database warehouse;

use warehouse;

create table products(
	id int not null auto_increment,
	primary key(id),

	name varchar(50) not null,
	num int not null,
	unit_of_m varchar(10) not null,
	cost int not null,
	about text
);

create table seller(
	id int not null auto_increment,
	primary key(id),

	s_address varchar(50) not null,
	phone varchar(12) not null
		check(phone regexp '[0-9]*'),
	name varchar(80) not null
);

create table supply(
	seller_id int not null,
	index(seller_id),
	foreign key (seller_id) references seller(id),

	product_id int not null,
	index(product_id),
	foreign key (product_id) references products(id),

	delivery_date date not null,
	product_num int not null,
	bank_account varchar(15) not null
		check(bank_account regexp '[0-9]*'),
	s_markup int not null
);