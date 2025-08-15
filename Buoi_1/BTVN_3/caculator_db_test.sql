CREATE DATABASE calculator_db_copy;
USE calculator_db_copy;

CREATE TABLE calculation_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    operation VARCHAR(50) NOT NULL,
    num1 DOUBLE NOT NULL,
    num2 DOUBLE NOT NULL,
    result VARCHAR(100) NOT NULL,
    timestamp DATETIME NOT NULL
);

CREATE TABLE query_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    query_type VARCHAR(50) NOT NULL,
    number DOUBLE NOT NULL,
    result VARCHAR(50) NOT NULL,
    timestamp DATETIME NOT NULL
);