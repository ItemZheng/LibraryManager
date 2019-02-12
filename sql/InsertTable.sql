insert into admin values('2332', 'xx980926', 'zyh', '18868102513');
insert into admin values('2602', 'xx980926', 'xcl', '18868105130');

insert into book values('bno1','计算机','SQL Server 2008完全学习手册','清华出版社',2001,'郭郑州',79.80,5,3);
insert into book values('bno2','计算机','程序员的自我修养','电子工业出版社',2013,'俞甲子',65.00,5,5);
insert into book values('bno3','教育','做新教育的行者','福建教育出版社',2002,'高云鹏',25.00,3,2);
insert into book values('bno4','教育','做孩子眼中有本领的父母','电子工业出版社',2013,'高云鹏',23.00,5,5);
insert into book values('bno5','英语','实用英文写作','高等教育出版社',2008,'庞继贤',33.00,3,2);


insert into card values('cno1','张三','计算机学院','U');
insert into card values('cno2','李四','农学院','U');
insert into card values('cno3','王五','计算机学院','T');
insert into card values('cno4','朱六','计算机学院','G');
insert into card values('cno5','延七','经济学院','O');
insert into card values('cno6','凤姐','经济学院','O');


insert into borrow values('cno1','bno1','2332','2010-6-4','2010-6-10');
insert into borrow values('cno1','bno2','2602','2010-6-5','2010-6-10');
insert into borrow values('cno2','bno2','2332','2010-7-4','2010-7-10');
insert into borrow values('cno3','bno3','2602','2010-8-4','2010-8-10');
insert into borrow values('cno4','bno4','2332','2010-9-4','2010-9-10');
