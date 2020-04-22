CREATE TABLE IF NOT EXISTS customer (
    PRIMARY KEY (username),
    username	varchar(32)   NOT NULL UNIQUE,
    passwd		varchar(255)  NOT NULL
);

CREATE TABLE IF NOT EXISTS hotel (
	PRIMARY KEY (hotel_name), -- Depending on how it will change
    x_cord int NOT NULL CHECK (x_cord >= 0 AND x_cord < 100), 
    y_cord int NOT NULL CHECK (y_cord >= 0 AND Y_cord < 100),
    hotel_name varchar (18) NOT NULL UNIQUE 
); 

CREATE TABLE IF NOT EXISTS franchise (
    PRIMARY KEY (location, parent),
	location 	varchar(50)    NOT NULL, -- may want to transform into calculated field
    parent   	varchar(50)    NOT NULL,
	CONSTRAINT  fk_owned_by FOREIGN KEY (parent)
		REFERENCES  hotel(hotel_name)
		ON DELETE   CASCADE
		ON UPDATE   CASCADE   
); 

CREATE TABLE IF NOT EXISTs hotel_admin (
    PRIMARY KEY (username),
    username	varchar(32)   NOT NULL UNIQUE,
    passwd		varchar(255)   NOT NULL,
	employer    int NOT NULL UNIQUE,
    CONSTRAINT  fk_employed_by FOREIGN KEY (employer)
		REFERENCES  hotel_chain(chain_id)
		ON DELETE   CASCADE
		ON UPDATE   CASCADE    
);


-- To-do
-- CREATE TABLE IF NOT EXISTS reservation (
--     PRIMARY KEY (res_ID),
--     res_id		INT NOT NULL auto_increment,
--     customer	varchar(128)   NOT NULL,
--     hotel 		varchar (18) NOT NULL,
-- );
