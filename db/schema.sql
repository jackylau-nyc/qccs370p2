CREATE TABLE IF NOT EXISTS customer (
    PRIMARY KEY (username),
    username    varchar(64)    NOT NULL UNIQUE,
    passwd      varchar(255)   NOT NULL 
);

CREATE TABLE IF NOT EXISTS company (
    PRIMARY KEY (company_name),
    company_name varchar (64) NOT NULL UNIQUE 
); 
-- 1 Company => 1 Admin only. 
CREATE TABLE IF NOT EXISTs admin (
    PRIMARY KEY (username),
    username    varchar(64)    NOT NULL UNIQUE,
    passwd      varchar(255)   NOT NULL,
	employer    varchar (64)   NOT NULL UNIQUE, 
    CONSTRAINT  fk_employed_by FOREIGN KEY (employer)
		REFERENCES  company(company_name)
);
-- Physical Franchise Instance 
CREATE TABLE IF NOT EXISTS hotel (
    PRIMARY KEY (x_cord, y_cord),
    x_cord  INT NOT NULL CHECK (x_cord >= 0 AND x_cord < 100), 
    y_cord  INT NOT NULL CHECK (y_cord >= 0 AND Y_cord < 100),
    company varchar (64) NOT NULL, -- Also serves as the hotel 'name' attribute.
	CONSTRAINT  fk_belongs_to FOREIGN KEY (company)
		REFERENCES  company(company_name)
); 

CREATE TABLE IF NOT EXISTS room ( 
	PRIMARY KEY (room_num, x_cord, y_cord),
    room_num INT NOT NULL,
	x_cord   INT NOT NULL CHECK (x_cord >= 0 AND x_cord < 100), 
    y_cord   INT NOT NULL CHECK (y_cord >= 0 AND Y_cord < 100),
	class 	 varchar (32) NOT NULL, -- Potential Enum field: expensive, cheap, etc.
    price    Decimal(10, 2) NOT NULL,
	CONSTRAINT fk_hotel_location FOREIGN KEY (x_cord, y_cord) 
		REFERENCES hotel(x_cord, y_cord) 
);

CREATE TABLE IF NOT EXISTS reservation(
	PRIMARY KEY(res_id),
	res_id INT auto_increment NOT NULL ,
    res_start Date,
    res_end Date
);
-- --------------------------------------------------------------------------------------------------
-- ---------------------------------------- Junction Tables -----------------------------------------
-- --------------------------------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS room_has_reservation(
	primary key(res_id, room_num, x_cord, y_cord),
    res_id   INT NOT NULL, 
    room_num INT NOT NULL,
	x_cord   INT NOT NULL CHECK (x_cord >= 0 AND x_cord < 100), 
    y_cord   INT NOT NULL CHECK (y_cord >= 0 AND Y_cord < 100),
	CONSTRAINT fk_reserved_room FOREIGN KEY (room_num, x_cord, y_cord) 
		REFERENCES room(room_num, x_cord, y_cord),
	CONSTRAINT fk_reservation FOREIGN KEY (res_id) 
		REFERENCES reservation(res_id) 
);

CREATE TABLE IF NOT EXISTS reservation_has_customer(
	PRIMARY KEY(customer_username, reservation_id),
    customer_username varchar(64)   NOT NULL, 
    reservation INT NOT NULL,
	CONSTRAINT fk_customer_reservation FOREIGN KEY (reserveration_id) 
		REFERENCES reservation(res_id),
	CONSTRAINT fk_reserved_for_customer FOREIGN KEY (customer_username) 
		REFERENCES customer(username) 
);
-- --------------------------------------------------------------------------------------------------
-- --------------------------------------------- Notes ----------------------------------------------
-- --------------------------------------------------------------------------------------------------

-- To-do
-- CREATE TABLE IF NOT EXISTS reservation (
--     PRIMARY KEY (res_ID), -- Each Reservation Instantiation is unique
--     res_id INT NOT NULL auto_increment,
--     customer	varchar(128)   NOT NULL,
--     hotel 		varchar (18) NOT NULL,
-- ); 
-- Availabiity info will be derivable from reservations.
-- Optional Tables: 
-- class table for hotel rooms. May contain info about amenities etc. 
-- transaction: will come in handy if prices can be changed. Otherwise, costs will be calculated 
-- 		on the fly. 

