-- select * from help_topic where name like "%create%user%";

drop table if exists customer;

create table customer(
customer_id int auto_increment not null,
customer_name varchar(30) not null,
external_id int null comment "Such as Wechat Union ID, Alibaba ID",
phone_no varchar(15) null,
credit int not null default 0,
total_break_contact_num int not null default 0,
consecutive_break_contact_num int not null default 0,
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (customer_id),
index customerI1(customer_name)
)
engine=InnoDB;


drop table if exists merchant;
create table merchant(
merchant_id int auto_increment not null,
merchant_name varchar(100) not null,
address varchar(200) null,
phone_no varchar(15) not null,
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (merchant_id),
index merchantI1(merchant_name)
)
engine=InnoDB;

drop table if exists employee;

create table employee(
employee_id int auto_increment not null,
employee_name varchar(30) not null,
stage_name varchar(30) not null,
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (employee_id),
index employeeI1(employee_name)
)
engine=InnoDB;

drop table if exists employment;

create table employment(
employment_id int auto_increment not null,
merchant_id int not null,
employee_id int not null,
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (employment_id),
index employmentI1(merchant_id, employee_id)
)
engine=InnoDB;
/*
drop table if exists job;

create table job(
job_id int auto_increment not null,
job_name varchar(30) not null,
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (job_id),
unique index jobI1(job_name)
)
engine=InnoDB;

drop table if exists role;

create table role(
role_id int auto_increment not null,
employment_id int not null,
job_id int not null,
skill_level_id int not null default 1,
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (role_id),
unique index roleI1(employment_id, job_id)
)
engine=InnoDB;
*/
drop table if exists skill_level;

create table skill_level(
skill_level_id int auto_increment not null,
skill_level_name varchar(30) not null,
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (skill_level_id),
unique index roleI1(skill_level_name)
)
engine=InnoDB;

drop table if exists service;

create table service(
service_id int auto_increment not null,
service_name varchar(30) not null,
service_minutes int not null,
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (service_id),
unique index serviceI1(service_name)
)
engine=InnoDB;

drop table if exists shelf;

create table shelf(
shelf_id int auto_increment not null,
merchant_id int not null,
service_id int not null,
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (shelf_id),
unique index shelfI1(merchant_id, service_id)
)
engine=InnoDB;

drop table if exists skill;

create table skill(
skill_id int auto_increment not null,
shelf_id int not null,
employment_id int not null,
skill_level_id int not null default 1, 
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (skill_id),
unique index skillI1(shelf_id, employment_id),
unique index skillI2(employment_id, shelf_id)
) comment "what kind of service can an employee provides",
engine=InnoDB;

drop table if exists reservation;

create table reservation(
reservation_id int auto_increment not null,
customer_id int not null,
merchant_id int not null,
employee_id int default -1 not null,
start_time datetime not null,
end_time datetime not null,
reservation_status_id int not null, 
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (reservation_id),
index reservationI1(customer_id, merchant_id, employee_id, start_time)
)
engine=InnoDB;

drop table if exists reservation_status;

create table reservation_status(
reservation_status_id int auto_increment not null,
reservation_status_name varchar(30) not null,
entry_datetime datetime default now() not null,
entry_id int not null,
primary key (reservation_status_id),
unique index reservation_statusI1(reservation_status_name)
)
engine=InnoDB;


drop table if exists history_reservation;

create table history_reservation(
reservation_id int,
customer_id int not null,
merchant_id int not null,
employee_id int not null,
start_time datetime not null,
end_time datetime not null,
reservation_status_id int not null, 
entry_datetime datetime not null,
entry_id int not null,
primary key (reservation_id),
index reservationI1(customer_id, merchant_id, employee_id, start_time)
)
engine=InnoDB;
