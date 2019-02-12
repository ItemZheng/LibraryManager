create table book(
	bno char(8) primary key,
	category varchar(40) not null,
	title  varchar(40) not null,
	press  varchar(30) not null,
	year int,
	author varchar(20) not null,
	price decimal(7,2),
	total int,
	stock int,
	check(year > 0),
	check(price > 0),
	check(total >= 0),
	check(stock >= 0)
);

create table card(
	cno char(7) primary key,
	name varchar(10) not null,
	department varchar(40) not null,
	type char(1),
	check(type in('T', 'G', 'U', 'O'))
);

create table admin(
	admin_id char(8) primary key,
	password varchar(20) not null,
	name varchar(10) not null,
	phone_num varchar(13),
	check(Len(password) > 6)
);

create table borrow(
cno char(7),
bno char(8),
admin_id char(8),
borrow_date  datetime,
return_date  datetime,
foreign key(cno) references card(cno) on update cascade on delete cascade,
foreign key(bno) references book(bno) on update cascade,
foreign key(admin_id) references admin(admin_id) on update cascade
);