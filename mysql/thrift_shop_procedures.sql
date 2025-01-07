use thrift_shop;
-- stored procedure
DELIMITER //

CREATE PROCEDURE AuthenticateUser(IN p_username VARCHAR(50))
BEGIN
    SELECT * FROM users WHERE username = p_username;
END //


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
