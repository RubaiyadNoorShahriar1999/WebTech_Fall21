-- Create Database
CREATE DATABASE lab5task1;
-- Create table name products
CREATE TABLE products(
    p_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    p_name VARCHAR(50) NOT NULL,
    p_bp FLOAT(10, 2) NOT NULL,
    p_sp FLOAT(10, 2) NOT NULL
);