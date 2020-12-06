-- NOTE add the 12%VAT in the list-price Unit Price is in Dollars


CREATE DATABASE IF NOT EXISTS miniAppInventory;
CREATE TABLE IF NOT EXISTS suppliers(
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255) NOT NULL,
date TIMESTAMP 
);
CREATE TABLE IF NOT EXISTS categories (
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255) NOT NULL,
date TIMESTAMP 
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
CREATE TABLE IF NOT EXISTS sales (
id INT(11) NOT NULL PRIMARY KEY,
qty INT(11) NOT NULL, -- products.qtyOnHand + newstocks.qty
listPrice DOUBLE(11, 2) NOT NULL, -- products.UPrice + products.percentMargin + 12%VAT
date TIMESTAMP
);
CREATE TABLE IF NOT EXISTS orders (
id INT(11) NOT NULL PRIMARY KEY,
userID INT(11) NOT NULL,
qty INT(11) NOT NULL,
listPrice DOUBLE(11, 2) NOT NULL, -- products.UPrice + products.percentMargin + 12%VAT
accountID INT(11) NOT NULL,
state INT(1) NOT NULL,-- 1. done, 2. processing, 3. pending, 4. cancelled
date TIMESTAMP 
); 
CREATE TABLE IF NOT EXISTS accounts(
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    recoveryKey varchar(255) NOT NULL,
    questionKey varchar(255) NOT NULL,
    accountType int(1) NOT NULL-- 1. user, 2. encoder, 3. senior stafff, 4. system admin
);


---LOGS____________________________
CREATE TABLE IF NOT EXISTS categorieslogs (
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255) NOT NULL,
accountID INT(11) NOT NULL,
activity INT(11) NOT NULL,
date TIMESTAMP 
);

CREATE TABLE IF NOT EXISTS supplierslogs(
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255) NOT NULL,
accountID INT(11) NOT NULL,
activity INT(11) NOT NULL,
date TIMESTAMP 
);

CREATE TABLE IF NOT EXISTS productslogs(
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255) NOT NULL, 
catID int(11) NOT NULL,
supID int(11) NOT NULL,
forsale boolean NOT NULL,
qtyOnHand INT(11) NOT NULL,
UPrice DOUBLE(11, 2) NOT NULL,
percentMargin DOUBLE(11, 2) NOT NULL,
accountID INT(11) NOT NULL,
activity INT(11) NOT NULL,
date TIMESTAMP 
);
CREATE TABLE IF NOT EXISTS newstocks (
id INT(11) NOT NULL PRIMARY KEY,
qty INT(11) NOT NULL,
UPrice DOUBLE(11, 2) NOT NULL,
accountID INT(11) NOT NULL,
date TIMESTAMP 
);
CREATE TABLE IF NOT EXISTS saleslogs (
id INT(11) NOT NULL PRIMARY KEY,
salesID INT(11) NOT NULL,
qty INT(11) NOT NULL, -- products.qtyOnHand + newstocks.qty
listPrice DOUBLE(11, 2) NOT NULL, -- products.UPrice + products.percentMargin + 12%VAT
accountID INT(11) NOT NULL,
activity INT(1) NOT NULL,--1. create, 2. edit, 3. delete
date TIMESTAMP
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


INSERT INTO sales (id,qty, listPrice)
VALUES (1, 10, 110.109),(2, 15,110.109), (3,20,110.109);


-- Need to insert the list price + 12%VAT inlcuded
INSERT INTO orders (id,userID, qty, listPrice,accountID, state)
VALUES (1, 1, 10, 110.109, 1, 4),(2, 2, 15,110.109, 1, 1), (3, 3,20,110.109, 1, 2);
INSERT INTO newstocks(id, qty, UPrice, accountID)
VALUES  (1,10, 98.95,1), (2,20,98.75,1), (3,15,101.50,1), (4,20,150.10,1);

INSERT INTO accounts(username, password, recoveryKey, questionKey, accountType)
VALUES("zedek", "1234","cycling","What do you want to do?",  4  );
-- logs


INSERT INTO supplierslogs (name, accountID, activity) 
VALUES ("ABC", 1, 1), ("XYZ", 1, 1),("PQR", 1, 1);

INSERT INTO categorieslogs (name, accountID, activity)
VALUES ("Mobile", 1, 1), ("Laptop", 1, 1);

INSERT INTO productslogs ( name, catID, supID, forsale, qtyOnHand, UPrice, percentMargin, accountID, activity)
VALUES 
    ("Nokia",1,1,1, 120,99.99,10, 1, 1),
    ( "O+",1,1,1, 100,98.75,10, 1, 1),
    ( "Dell",2,2,1, 50,100,12, 1, 1),
    ( "Apple",1,1,1, 80,150,15, 1, 1),
    ( "Hale",1,2,1, 30,95,9, 1, 1);



INSERT INTO saleslogs (salesID,qty, listPrice, accountID, activity)
VALUES (1, 10, 110.109,1, 1),(2, 15,110.109,1, 1), (3,20,110.109,1, 1);





        
