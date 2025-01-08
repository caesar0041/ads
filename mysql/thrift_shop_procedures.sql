use thrift_shop;
-- stored procedure
show procedure status;
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

CREATE PROCEDURE AuthenticateUser(
    IN p_username VARCHAR(50),
    IN p_password VARCHAR(255),
    OUT p_user_id INT
)
BEGIN
    SELECT user_id INTO p_user_id
    FROM users
    WHERE username = p_username AND pw = p_password;
END //

DELIMITER ;
