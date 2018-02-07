truncate table customer;
truncate table merchant;
truncate table employee;
truncate table employment;
truncate table skill_level;
truncate table service;
truncate table shelf;

insert into customer(
customer_name,
external_id,
phone_no,
entry_id)
values("customer 1", 1, "18888888888", 1), ("customer 2", 2, "16888888888", 1);

insert into merchant(merchant_name,
address,
phone_no,
entry_id
)
values("北艺", "XXXX", "11111111111", 1), ("克丽缇娜", "YYYYY", "11111111111", 1);

insert into employee(employee_name,
stage_name,
entry_id
)
values("Andy Ji", "Andy", 1), ("employee 2", "春花", 1), ("employee 3", "秋月", 1), ("employee 4", "何时", 1), ("employee 5", "了", 1), ("employee 6", "往事知多少", 1);

insert into employment(
merchant_id,
employee_id,
entry_id)
values(1, 2, 1), (1, 3, 1), (1, 6, 1), (2, 3, 1), (2, 4, 1), (2, 5, 1);

/*
insert into job(job_name,
entry_id
)
values('发型师', 1), ('按摩师', 1), ('店长', 1), ('禅洗', 1), ('高级禅洗', 1);

insert into role(
employment_id,
job_id,
entry_id)
values(1,4,1),(2,2,1),(2,3,1),(3,2,1),(4,3,1),(5,4,1),(6,5,1);
*/
insert into skill_level(
skill_level_name,
entry_id)
values('一级技师', 1),('二级技师', 1),('三级技师', 1),('四级技师', 1),('五级技师', 1),('六级技师', 1),('七级技师', 1),('八级技师', 1),('九级技师', 1),('十级技师', 1),('十一级技师', 1),('十二级技师', 1);

insert into service(
service_name,
service_minutes,
entry_id)
values('按摩', 60, 1), ('禅洗', 30, 1), ('高级禅洗', 45, 1);

insert into shelf(
merchant_id,
service_id,
entry_id)
values(1,1,1),(2,1,1),(2,2,1),(2,3,1);

insert into skill(
shelf_id,
employment_id,
entry_id)
values(1,1,1),(1,3,1),(2,5,1),(2,6,1),(3,5,1),(4,6,1);

insert into reservation_status(
reservation_status_name,
entry_id)
values('正常', 1), ('迟到', 1), ('爽约', 1), ('取消', 1), ('完成', 1);
