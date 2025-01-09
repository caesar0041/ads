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

create table if not exists products(
	product_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    product_name varchar(255) NOT NULL,
    description text NOT NULL,
    quantity int default 0,
    category varchar(255), 
    image varchar(255)
);

create table if not exists cart(
	cart_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id int NOT NULL,
    product_id int NOT NULL,
    quantity int,
    foreign key (user_id) references users(user_id),
    foreign key (product_id) references products(product_id)
);

create table if not exists orders(
	order_id int not null primary key auto_increment,
    cart_id int not null,
    total_price decimal(10,2) not null,
    status enum('Pending', 'Completed', 'Cancelled') default 'Pending',
    province varchar(255) NOT NULL,
    municipality varchar(255) NOT NULL,
    street varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    zip_code varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
    foreign key (cart_id) references cart(cart_id)
);

create table if not exists audit_trail_logs(
	id int not null primary key auto_increment,
    user_id int not null,
    login datetime,
    logout datetime,
    created_at datetime default current_timestamp,
    foreign key(user_id) references users(user_id)
);

CREATE TABLE IF NOT EXISTS audit_trails_product (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    action varchar(255) NOT NULL,
    performed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE IF NOT EXISTS audit_trails_order (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    order_id INT NOT NULL,
    action varchar(255) NOT NULL,
    performed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (order_id) REFERENCES orders(order_id)
);

CREATE TABLE IF NOT EXISTS audit_trail_customer (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    action varchar(255) NOT NULL,
    performed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);




show tables;