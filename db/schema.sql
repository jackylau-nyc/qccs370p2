CREATE TABLE IF NOT EXISTS customer (
    PRIMARY KEY (username),
    username	varchar(32)   NOT NULL UNIQUE,
    passwd		varchar(255)  NOT NULL 
);

CREATE TABLE IF NOT EXISTS company (
	PRIMARY KEY (company_name),
    company_name varchar (18) NOT NULL UNIQUE 
); 

CREATE TABLE IF NOT EXISTs admin (
    PRIMARY KEY (username),
    username	varchar(32)    NOT NULL UNIQUE,
    passwd		varchar(255)   NOT NULL,
	employer    varchar (18)   NOT NULL UNIQUE ,
    CONSTRAINT  fk_employed_by FOREIGN KEY (employer)
		REFERENCES  company(company_name)
);
-- Types of room and their cardinality will be stored and derived from room table. 
CREATE TABLE IF NOT EXISTS hotel (
    PRIMARY KEY (x_cord, y_cord),
	x_cord  INT NOT NULL CHECK (x_cord >= 0 AND x_cord < 100), 
    y_cord  INT NOT NULL CHECK (y_cord >= 0 AND Y_cord < 100),
    address varchar(32)  NOT NULL UNIQUE, 
    company varchar (18) NOT NULL,
	CONSTRAINT  fk_belongs_to FOREIGN KEY (company)
		REFERENCES  company(company_name)
); 

CREATE TABLE IF NOT EXISTS room ( -- Weak Entity Set, Depends on hotel for identification
	PRIMARY KEY (room_id, x_cord, y_cord),
    room_num INT NOT NULL,
	x_cord   INT NOT NULL CHECK (x_cord >= 0 AND x_cord < 100), 
    y_cord   INT NOT NULL CHECK (y_cord >= 0 AND Y_cord < 100),
	class 	 varchar (12) NOT NULL, -- Potential Enum field: expensive, cheap, etc.
    price Decimal(10, 2) NOT NULL,
	CONSTRAINT fk_hotel_location FOREIGN KEY (x_cord, y_cord) 
		REFERENCES hotel(x_cord, y_cord) 
) 

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
