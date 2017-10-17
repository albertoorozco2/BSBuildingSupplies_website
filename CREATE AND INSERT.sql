
CREATE DATABASE bsbulding;
CREATE TABLE bsbulding.users
(
u_id int NOT NULL AUTO_INCREMENT UNIQUE,
u_firstname VARCHAR(255),
u_surname VARCHAR(255),
u_addre VARCHAR(255),
u_email VARCHAR(255),
u_tel VARCHAR(255),
u_username VARCHAR(255)UNIQUE,
u_pass VARCHAR(255),
u_type VARCHAR(255),
CONSTRAINT user_pk PRIMARY KEY (u_id, u_username)
);

CREATE TABLE bsbulding.products
(
p_id int NOT NULL UNIQUE,
p_name VARCHAR(255)UNIQUE,
p_description VARCHAR(255),
p_price DECIMAL(9,2),
p_stock int,
CONSTRAINT products_pk PRIMARY KEY (p_id, p_name)
);

CREATE TABLE bsbulding.orders
(
o_id int NOT NULL UNIQUE,
o_status VARCHAR(255),
u_username VARCHAR(255),
o_items VARCHAR(255),
o_total VARCHAR(255),
o_details VARCHAR(255),

FOREIGN KEY (u_username) 
REFERENCES users(u_username)

);

CREATE TABLE bsbulding.cart
(
c_id int NOT NULL AUTO_INCREMENT UNIQUE,
u_username VARCHAR(255),
p_id int NOT NULL,
p_name VARCHAR(255),
c_quantity int,
c_price DECIMAL(9,2),
c_total DECIMAL(9,2),
FOREIGN KEY (u_username) 
REFERENCES users(u_username),
FOREIGN KEY (p_id, p_name) 
REFERENCES products(p_id, p_name)
);


INSERT INTO bsbulding.products (p_id, p_name, p_price, p_description, p_stock)
VALUES (644, 'Hammer', 2.90, 'One BlackSpur Hammer', 100);
INSERT INTO bsbulding.products (p_id, p_name, p_price, p_description, p_stock)
VALUES (2311, 'Sand', 5.10, 'One 25KG bag of sand', 100 );
INSERT INTO bsbulding.products (p_id, p_name, p_price, p_description, p_stock) 
VALUES (244, 'Cement', 5.20, '25KG bag of cement', 100);
INSERT INTO bsbulding.products (p_id, p_name, p_price, p_description, p_stock) 
VALUES (233, 'Copper Pipe', 45.00, '25FT of copper pipe 1/2 inch', 100);
INSERT INTO bsbulding.products (p_id, p_name, p_price, p_description, p_stock) 
VALUES (8665, 'Bathroom sink', 250, 'One complete bathroom ink', 100);

INSERT INTO bsbulding.users(u_username, u_pass, u_type) 
VALUES ('admin', '4046c642308728564821e02501179846', 'admin');

INSERT INTO bsbulding.users(u_username, u_pass, u_type) 
VALUES ('user', '23c7b81d7742583be62e4641efa81620', 'user');


INSERT INTO bsbulding.users(u_username, u_pass, u_type) 
VALUES ('staff', '0855660fc4e2cf0a7b6184599b7360f8', 'staff');


INSERT INTO bsbulding.users(u_username, u_pass, u_type) 
VALUES ('deliver', '953335612c081540da1e439d27c2f32a', 'deliver');
