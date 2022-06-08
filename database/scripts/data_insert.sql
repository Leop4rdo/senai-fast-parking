
/********************************************************\
	fastparking project database data insert script
    
    authors   :  Leonardo Antunes, Gabriel Gomes
    version   :  1.0
    creation  :  27/05/22
\********************************************************/

use db_fastparking;

# CUSTOMER ->
INSERT INTO customer ( name, email, cpf, phone_number, password ) VALUES 
	('John Doe', 'johndoe@gmail.com', "444.333.222-11", '11963677923', 'senha123'),
    ('Jane Doe', 'janedow@gmail.com', "555.444.333-22", '11963677923', 'senha123'),
    ('Carlos Armandes', 'armandescarlos@gmail.com', "666.555.444-33", '11963677923', 'senha123'),
    ('Julia Jefferson', 'juliajeff@gmail.com', "777.666.555-44", '11963677923', 'senha123'),
    ('Davie Mccree', 'thedavie@gmail.com', "888.777.666-55", '11963677923', 'senha123'),
    ('Frank Fisher', 'frankfisher@gmail.com', "999.888.777-66", '11963677923', 'senha123'),
    ('Mary Martin', 'marymartin@gmail.com', "111.222.333-444", '11963677923', 'senha123');

# VEHICLE TYPE -> 
INSERT INTO vehicle_type  (	name, price ) VALUES
	('carro', 10.00), ('moto', 5.00),
	('van', 15.00), ('ônibus', 20.00),
	('avião', 50.00);

# PARKING SPOT ->
INSERT INTO parking_spot ( name, vehicle_type_id ) VALUES ('A-1', 1),
	('A-2', 1), ('A-3', 2), ('A-4', 1), ('A-5', 3), ('A-6', 3), ('A-7', 5), ('A-8', 1), 
    ('A-9', 4), ('A-10', 1), ('B-1', 1), ('B-2', 1), ('B-3', 5), ('B-4', 1), ('B-5', 3),
	('B-6', 1), ('B-7', 2), ('B-8', 1), ('B-9', 4), ('B-10', 1);
    

# VEHICLE COLOUR ->
INSERT INTO vehicle_colour  (name) VALUES	 					
	('preto'), ('cinza'), ('branco'), ('vermelho'),
	('azul'), ('amarelo'), ('verde'),('roxo'),
	('rosa');




# VEHICLE MODLE -> 
INSERT INTO vehicle_model  ( name ) VALUES ("outro"),
	('Corsa.'), ('Celta'), ('Onix'), ('Prisma'), ('cobalt'),
    ('Punto'), ('Siena'), ('Uno'), ('Palio'), ('Mobi'), ('Toro'),
    ('Strada'), ('Idea'), ('GOL'), ('FOX'), ('UP'), ('Savero'),
    ('Voyage'), ('Fusca'), ('Ecosport'), ('Fiesta'), ('Sandero'),
    ('Logan'), ('Clio'), ('Duster'), ('Kwid'), ('Captur'), ('HB20'),
    ('I30'), ('Tucson'), ('Corolla'), ('Hilux'), ('Etios'), ('Fit'),
    ('Civic'), ('Citroen'), ('Audi'), ('Jeep'), ('Peugeot');


# VEHICLE -> 
<<<<<<< HEAD
INSERT INTO vehicle (
					 plate,
                     vehicle_colour_id,
                     vehicle_type_id,
                     vehicle_model_id,
                     customer_id
                     )
VALUES				(
					 'BGSD-123',
                     1,
                     2,
                     6,
                     1
                    ),
                    (
					 'AAAA-321',
                     4,
                     3,
                     4,
                     1
                    ),
                    (
					 'BBBB-321',
                     5,
                     5,
                     8,
                     1
                    ),
                    (
					 'CCCC-321',
                     7,
                     1,
                     3,
                     1
                    ),
                    (
					 'DDDD-321',
                     2,
                     1,
                     2,
                     1
                    ),
                    (
					 'EEEE-321',
                     6,
                     1,
                     1,
                     3
                    );

show tables;

desc vehicle;
select * from vehicle;
                            
=======
INSERT INTO vehicle ( plate, vehicle_colour_id, vehicle_type_id, vehicle_model_id, customer_id ) VALUES				
	( 'BGSD-123', 1, 2, 6, 1 ),
	( 'AAAA-321', 4, 3, 4, 1 ),
    ( 'BBBB-321', 5, 5, 8, 1 ),
    ( 'CCCC-321', 7, 1, 3, 1 ),
	( 'DDDD-321', 2, 1, 2, 1 ),
	( 'EEEE-321', 6, 1, 1, 3 );
                            
select * from customer;
>>>>>>> 43515148826524dabe8d924c9f86b65ecc02ffe3
