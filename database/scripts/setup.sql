/********************************************************\
	fastparking project database setup script
    
    authors   :  Leonardo Antunes, Gabriel Gomes
    version   :  1.0
    creation  :  25/05/22
\********************************************************/

CREATE DATABASE IF NOT EXISTS db_fastparking;

use db_fastparking;

# CUSTOMER ->
CREATE TABLE customer (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    email VARCHAR(320) NOT NULL ,
    cpf VARCHAR(20) not null unique,
    phone_number VARCHAR(16) NOT NULL,
    password VARCHAR(32)
);

# VEHICLE COLOUR ->
CREATE TABLE IF NOT EXISTS vehicle_colour (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL UNIQUE
);

# VEHICLE MODEL -> 
CREATE TABLE vehicle_model (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE AUTO_INCREMENT,
    name VARCHAR(50)
); 

# VEHICLE TYPE -> 
CREATE TABLE vehicle_type (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    price DOUBLE NOT NULL
);

# PARKING SPOT ->
CREATE TABLE parking_spot (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE AUTO_INCREMENT,
    name VARCHAR(10) NOT NULL,
    vehicle_type_id INT UNSIGNED NOT NULL,
    
    CONSTRAINT FK_parking_spot__vehicle_type_id 
    FOREIGN KEY (vehicle_type_id) 
    REFERENCES vehicle_type(id)
);

# VEHICLE ->
CREATE TABLE vehicle (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE AUTO_INCREMENT,
    plate VARCHAR(10),
    vehicle_colour_id INT UNSIGNED NOT NULL,
    vehicle_type_id INT UNSIGNED NOT NULL,
    vehicle_model_id INT UNSIGNED NOT NULL,
    customer_id INT UNSIGNED NOT NULL,
	
    CONSTRAINT FK_vehicle__vehicle_colour_id
    FOREIGN KEY (vehicle_colour_id)
    REFERENCES vehicle_colour(id),
    
    CONSTRAINT FK_vehicle__vehicle_model_id
    FOREIGN KEY (vehicle_model_id)
    REFERENCES vehicle_model(id),
    
    CONSTRAINT FK_vehicle__vehicle_type_id
    FOREIGN KEY (vehicle_type_id)
    REFERENCES vehicle_type(id),
    
    CONSTRAINT FK_vehicle__customer_id
    FOREIGN KEY (customer_id)
    REFERENCES customer(id)
);

# VEHICLE_IN_OUT ->
CREATE TABLE vehicle_in_out (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE AUTO_INCREMENT,
    total_price DOUBLE UNSIGNED,
    entrance_time DATETIME NOT NULL,
    exit_time DATETIME,
    vehicle_id INT UNSIGNED NOT NULL,
    parking_spot_id INT UNSIGNED NOT NULL,
    
    CONSTRAINT FK_vehicle_in_out__vehicle_id
    FOREIGN KEY (vehicle_id)
    REFERENCES vehicle(id),
    
    CONSTRAINT FK_vehicle_int_out__parking_spot_id
    FOREIGN KEY (parking_spot_id)
    REFERENCES parking_spot(id)
);

# UTIL CODE ->
show tables;
DESC parking_spot;
select * from parking_spot;



