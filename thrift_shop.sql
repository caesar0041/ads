create database thrift_shop;
use thrift_shop;

-- tables
drop table users;
create table if not exists users(
	user_id tinyint PRIMARY KEY AUTO_INCREMENT,
    username varchar(50),
    fname varchar(50),
    lname varchar(50),
    pw varchar(50),
    role varchar(10),
	created_at datetime,
    updated_at datetime
);

INSERT INTO users (username, email, pw) VALUES ('sampleuser', 'sampleuser@example.com', 'password123');

select * from users;

-- stored procedure
DELIMITER //
CREATE PROCEDURE CreateUser(
    IN p_username VARCHAR(50),
    IN p_first_name VARCHAR(50),
    IN p_last_name VARCHAR(50),
    IN p_password VARCHAR(255)
)
BEGIN
    INSERT INTO users (username, fname, lname, pw, created_at)
    VALUES (p_username, p_first_name, p_last_name, p_password, NOW());
END //
DELIMITER ;

-- triggers
delimiter //


create trigger before_update_users
before update on users
for each row
begin
    set new.updated_at = now();
end;
//

delimiter ;

SELECT * FROM USERS;

CALL CreateUser('testuser', 'Test', 'User', 'hashed_password_test');


ALTER TABLE users MODIFY COLUMN pw VARCHAR(255);

