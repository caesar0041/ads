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
	
CREATE PROCEDURE AuthenticateUser(IN p_username VARCHAR(50))
BEGIN
    SELECT user_id, username, pw, role, full_name
    FROM users
    WHERE username = p_username;
END //

CREATE PROCEDURE UpdateUser(
    IN p_user_id INT,
    IN p_username VARCHAR(50),
    IN p_first_name VARCHAR(50),
    IN p_last_name VARCHAR(50),
    IN p_password VARCHAR(255)
)
BEGIN
    UPDATE users
    SET username = p_username,
        fname = p_first_name,
        lname = p_last_name,
        pw = p_password,
        updated_at = NOW()
    WHERE user_id = p_user_id;
END //

CREATE PROCEDURE AddProduct(
    IN p_product_name VARCHAR(255),
    IN p_description TEXT,
    IN p_quantity INT,
    IN p_category VARCHAR(255),
    IN p_image VARCHAR(255)
)
BEGIN
    INSERT INTO products (product_name, description, quantity, category, image)
    VALUES (p_product_name, p_description, p_quantity, p_category, p_image);
END //

CREATE PROCEDURE UpdateProduct(
    IN p_product_id INT,
    IN p_product_name VARCHAR(255),
    IN p_description TEXT,
    IN p_quantity INT,
    IN p_category VARCHAR(255),
    IN p_image VARCHAR(255)
)
BEGIN
    UPDATE products
    SET product_name = p_product_name,
        description = p_description,
        quantity = p_quantity,
        category = p_category,
        image = p_image
    WHERE product_id = p_product_id;
END //

CREATE PROCEDURE DeleteProduct(IN p_product_id INT)
BEGIN
    DELETE FROM products
    WHERE product_id = p_product_id;
END //

DELIMITER ;
call authenticateuser('josepheanne5001');

show index from users;
