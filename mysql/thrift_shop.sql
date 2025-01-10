create database if not exists thrift_shop;
use thrift_shop;

-- tables
drop table users;
create table if not exists users(
    user_id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
        username varchar(50) NOT NULL,
        fname varchar(50) NOT NULL,
        lname varchar(50) NOT NULL,
        pw varchar(50) NOT NULL,
        role varchar(10) default 'customer',
        created_at datetime default NOW(),
        updated_at datetime default NOW(),
        full_name varchar(101) GENERATED ALWAYS AS (CONCAT(fname, ' ', lname)) STORED
);

-- superadmin
INSERT INTO users (user_id, username, fname, lname, pw, role) VALUES (1001 ,'admin', 'admin', 'user', 'admin123', 'admin');
update users set username = 'admin' where user_id = 1001;
SELECT * FROM USERS;
-- truncate users;
update users set role='admin' where user_id=1001;
alter table users auto_increment=5001;


<<<<<<< HEAD

insert into users (username, fname, lname, role, pw) values ('admin','admin','user','admin','$2y$10$8V7R3TcmP3v3RjaftEeVK.cuSO3Z0kUxhdCce3bwPcI8llXQ5tv9O');
select * from users;
delete from users where user_id=1;
show tables;
=======
call authenticateuser('josepheanne5001');
alter table users modify column pw varchar(255);
>>>>>>> ab6b7776f16c30853541eecc1d14d3a6ad623bdf
