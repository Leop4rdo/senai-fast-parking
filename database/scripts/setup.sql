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
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE,
    name VARCHAR(80) NOT NULL,
    email VARCHAR(320) NOT NULL ,
    phone_number VARCHAR(16) NOT NULL,
    password VARCHAR(32)
);

# VEHICLE COLOUR ->
CREATE TABLE IF NOT EXISTS vehicle_colour (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE,
    name VARCHAR(30) NOT NULL UNIQUE
);

# VEHICLE MODEL -> 
CREATE TABLE vehicle_model (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE,
    name VARCHAR(50)
); 

# VEHICLE TYPE -> 
CREATE TABLE vehicle_type (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE,
    name VARCHAR(50) NOT NULL UNIQUE,
    price DOUBLE NOT NULL
);

# PARKING SPOT ->
CREATE TABLE parking_spot (
	id INT UNSIGNED NOT NULL PRIMARY KEY UNIQUE,
    name VARCHAR(10) NOT NULL,
    vehicle_type_id INT UNSIGNED NOT NULL,
    
    CONSTRAINT FK_vehicle_type_id 
    FOREIGN KEY (vehicle_type_id) 
    REFERENCES vehicle_type(id)
);

# VEHICLE IN OUT ->

# VEHICLE ->

# UTIL CODE ->
show tables;
DESC vehicle_type;



