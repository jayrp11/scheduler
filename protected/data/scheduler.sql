create database scheduler;

use scheduler;


drop table sub_schedules;
drop table resources;
drop table schedules;

create table schedules (
  id int not null auto_increment primary key,
  s_date date not null,
  theme varchar(50) not null
);

create table resources (
  id int not null auto_increment primary key,
  type varchar(20) not null,
  name varchar(50) not null
);

create table sub_schedules (
  id int not null auto_increment primary key,
  schedule_id int not null,
  start_time timestamp not null,
  end_time timestamp not null,
  title varchar(50),
  presenter varchar(50),
  lead varchar(50), /* this should be replaced by foreign key */

  foreign key (schedule_id) references schedules(id) on delete cascade
);

/* Seed Data */
insert into schedules(s_date, theme) values('2013-10-06', 'Shajanand Charitra');
insert into schedules(s_date, theme) values('2013-10-13', 'Shatriji Maharaj Jivan Charitra');
insert into schedules(s_date, theme) values('2013-10-20', 'Yogi Vani');
insert into schedules(s_date, theme) values('2013-10-27', 'Shanti Shanti Shanti');

insert into sub_schedules(schedule_id, start_time, end_time, title, lead, presenter) 
			values(1, '2013-10-27 04:30:00', '2013-10-27 04:40:00', 'Dhun', 'Test Lead - 1', 'Test Presenter - 1');

select * from schedules;
select * from sub_schedules;

SET FOREIGN_KEY_CHECKS=0; 
truncate schedules;
SET FOREIGN_KEY_CHECKS=1;


