-- --------------------------------------------------------------------------------------------------
-- ---------------------------------------- Sample Queries ------------------------------------------
-- --------------------------------------------------------------------------------------------------

-- Query for storing a new Company 
INSERT INTO company (company_name)
VALUES ("Hotel California");

INSERT INTO company (company_name)
VALUES ("Howard Resorts");

INSERT INTO company (company_name)
VALUES ("Paris Luxury Hotels");

INSERT INTO company (company_name)
VALUES ("Beta");

-- Query for creating a new customer record. 
INSERT INTO customer (username, passwd)
VALUES ("queen","latifa");

INSERT INTO customer (username, passwd)
VALUES ("brown","fox");

INSERT INTO customer (username, passwd)
VALUES ("foo","bar");

-- Querying a customers password based on username.
SELECT passwd 
FROM   customer
WHERE  customer.username = "foo";

-- Query for creating an admin.
INSERT INTO admin (username, passwd, employer)
VALUES ("eagles","welcome", "Beta");

INSERT INTO admin (username, passwd, employer)
VALUES ("ralph","lauren", "Howard Resorts");

INSERT INTO admin (username, passwd, employer)
VALUES ("john","life", "Paris Luxury Hotels");

-- Query for finding the admin for a Company
SELECT  admin.username
FROM    admin
WHERE   admin.employer = "Beta";

-- Query for finding the Company for an Admin
SELECT  admin.employer
FROM    admin
WHERE   admin.username = "Ralph";

-- Query for adding a hotel for a given Company
INSERT INTO hotel (x_cord, y_cord, company)
VALUES (0,0, "Howard Resorts");

INSERT INTO hotel (x_cord, y_cord, company)
VALUES (0,2, "Howard Resorts");

-- Query for finding the parent company for a given hotel.
SELECT  hotel.company
FROM    hotel
WHERE   hotel.x_cord = 0 AND hotel.y_cord = 0;

-- Query for adding rooms to a Hotel.
INSERT INTO room (room_num, x_cord, y_cord, class, price)
VALUES (1,0,0, "Deluxe", 999);

INSERT INTO room (room_num, x_cord, y_cord, class, price)
VALUES (2,0,0, "Deluxe", 999);

INSERT INTO room (room_num, x_cord, y_cord, class, price)
VALUES (8,0,0, "Free", 0);

-- Query for finding all the rooms that belong to a particular Hotel.
SELECT* 
FROM    room
WHERE   room.x_cord = 0 AND room.y_cord = 0;

-- Query for finding all the rooms for a given hotel where the price is less that $x
SELECT* 
FROM    room
WHERE   room.x_cord = 0 AND room.y_cord = 0 AND room.price < 1500;

-- Query for registering a customer

INSERT INTO customer (username, passwd)
VALUES ("Jillian", "chips");

INSERT INTO customer (username, passwd)
VALUES ("John", "Bleh");

-- Query for Creating a reservation  
-- Requires customer_username, start date, end date and room(s) 
-- Working solution, can be improved. 

START TRANSACTION;
	SET @res = -1; 
    SET @username = "Jillian";
    SET @room   = 2; 
    SET @x_cord = 0;
    SET @y_cord = 0; 
    SET @start_date = Date("2019-04-01");
    SET @end_date   = Date("2019-04-02");
    
	INSERT INTO reservation (res_start, res_end) 
	VALUES (DATE(@start_date), DATE(@end_date));

    SELECT @res := LAST_INSERT_ID();
    
	INSERT INTO reservation_has_customer(customer_username, reserveration_id) 
	VALUES (@username, @res);
    
    INSERT INTO room_has_reservation(res_id, room_num, x_cord, y_cord)
    VALUES(@res, @room, @x_cord , @y_cord);
    
 COMMIT;
SELECT* FROM customer;

-- Query for Finding all reservations before date()
-- Query for Finding all reservations after date()
-- Query for Finding all reservations on date() i.e. all checked in reservations.




ALTER TABLE reservation_has_customer
Change reserveration_id reservation_id int(11);

describe reservation_has_customer;