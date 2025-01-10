use thrift_shop;
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

show triggers;