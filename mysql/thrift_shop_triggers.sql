use thrift_shop;
-- triggers
delimiter //

-- audit_trail_logs
CREATE TRIGGER after_user_login
AFTER INSERT ON users
FOR EACH ROW
BEGIN
    INSERT INTO audit_trail_logs (user_id, login, created_at)
    VALUES (NEW.user_id, NOW(), NOW());
END;

CREATE TRIGGER before_user_logout
BEFORE UPDATE ON users
FOR EACH ROW
BEGIN
    IF OLD.role = 'customer' THEN
        INSERT INTO audit_trail_logs (user_id, logout)
        VALUES (OLD.user_id, TIMEOUT());
end;

-- Triggers for audit trail tables

-- Trigger for audit_trails_product to track CRUD actions on products
CREATE TRIGGER after_product_action
AFTER INSERT OR UPDATE OR DELETE ON products
FOR EACH ROW
BEGIN
    IF ACTION = 'INSERT' THEN
        INSERT INTO audit_trails_product (product_id, action, performed_at)
        VALUES (NEW.product_id, 'Created new product', NOW());
    ELSEIF ACTION = 'UPDATE' THEN
        INSERT INTO audit_trails_product (product_id, action, performed_at)
        VALUES (NEW.product_id, 'Updated information', NOW());
    ELSEIF ACTION = 'DELETE' THEN
        INSERT INTO audit_trails_product (product_id, action, performed_at)
        VALUES (OLD.product_id, 'Deleted product', NOW());
    END IF;
END;

-- Trigger for audit_trails_order to track order actions (Place, Cancel, Mark Completed)
CREATE TRIGGER after_order_action
AFTER INSERT OR UPDATE ON orders
FOR EACH ROW
BEGIN
    IF ACTION = 'INSERT' THEN
        INSERT INTO audit_trails_order (user_id, order_id, action, performed_at)
        VALUES (NEW.user_id, NEW.order_id, 'Place Order', NOW());
    ELSEIF ACTION = 'UPDATE' THEN
        IF NEW.status = 'Cancelled' THEN
            INSERT INTO audit_trails_order (user_id, order_id, action, performed_at)
            VALUES (NEW.user_id, NEW.order_id, 'Cancel Order', NOW());
        ELSEIF NEW.status = 'Completed' THEN
            INSERT INTO audit_trails_order (user_id, order_id, action, performed_at)
            VALUES (NEW.user_id, NEW.order_id, 'Mark Completed', NOW());
        END IF;
    END IF;
END;

-- Trigger for audit_trail_customer to track profile CRUD actions
CREATE TRIGGER after_customer_profile_action
AFTER INSERT OR UPDATE OR DELETE ON users
FOR EACH ROW
BEGIN
    IF ACTION = 'INSERT' THEN
        INSERT INTO audit_trail_customer (user_id, action, performed_at)
        VALUES (NEW.user_id, 'Created new account', NOW());
    ELSEIF ACTION = 'UPDATE' THEN
        INSERT INTO audit_trail_customer (user_id, action, performed_at)
        VALUES (NEW.user_id, 'Updated user information', NOW());
    ELSEIF ACTION = 'DELETE' THEN
        INSERT INTO audit_trail_customer (user_id, action, performed_at)
        VALUES (OLD.user_id, 'Deleted account', NOW());
    END IF;
END;




delimiter ;

show triggers;