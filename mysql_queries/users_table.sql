create table statuses(
	id int not null auto_increment,
	primary key(id),

	name varchar(10) not null
);

insert into statuses
(name)
values ('admin'), ('user');

create table users(
	user_id int unsigned not null auto_increment,
	primary key(user_id),

	user_status int not null default 2,
	index(user_status),
	foreign key (user_status) references statuses(id),

	user_login varchar(30) not null,
	user_password varchar(32) not null,
	user_salt varchar(6) not null,
	user_hash varchar(32) not null default "",
	user_ip int unsigned not null default 0
);
