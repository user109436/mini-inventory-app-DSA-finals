-- NOTE add the 12%VAT in the list-price Unit Price is in Dollars


CREATE DATABASE IF NOT EXISTS miniAppInventory;

CREATE TABLE IF NOT EXISTS suppliers(
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255) NOT NULL 
);

CREATE TABLE IF NOT EXISTS categories (
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255) NOT NULL 
);


CREATE TABLE IF NOT EXISTS products(
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255) NOT NULL, 
catID int(11) NOT NULL,
supID int(11) NOT NULL,
forsale boolean NOT NULL,
qtyOnHand INT(11) NOT NULL,
UPrice DOUBLE(11, 2) NOT NULL,
percentMargin DOUBLE(11, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS newstocks (
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
qty INT(11) NOT NULL,
UPrice DOUBLE(11, 2) NOT NULL
);
CREATE TABLE IF NOT EXISTS sales (
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
qtyOnHand INT(11) NOT NULL, -- products.qtyOnHand + newstocks.qty
listPrice DOUBLE(11, 2) NOT NULL -- products.UPrice + products.percentMargin + 12%VAT
);

CREATE TABLE IF NOT EXISTS orders (
id INT(11) NOT NULL PRIMARY KEY,
userID INT(11) NOT NULL,
qty INT(11) NOT NULL,
listPrice DOUBLE(11, 2) NOT NULL -- products.UPrice + products.percentMargin + 12%VAT
); 


-- Insert Data____________________

INSERT INTO suppliers (name) 
VALUES ("ABC"), ("XYZ"),("PQR");


INSERT INTO categories (name)
VALUES ("Mobile"), ("Laptop");

INSERT INTO products (name, catID, supID, forsale, qtyOnHand, UPrice, percentMargin)
VALUES 
    ("Nokia",1,1,1, 120,99.99,10),
    ("O+",1,1,1, 100,98.75,10),
    ("Dell",2,2,1, 50,100,12),
    ("Apple",1,1,1, 80,150,15),
    ("Hale",1,2,1, 30,95,9);

INSERT INTO newstocks(qty, UPrice)
VALUES  (10, 98.95), (20,98.75), (15,101.50), (20,150.10);


-- Need to insert the list price + 12%VAT inlcuded
INSERT INTO orders (id,userID, qty)
VALUES (1, 1, 10),(2, 1, 15), (3, 1,20);


        
