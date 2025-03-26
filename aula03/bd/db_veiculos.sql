CREATE DATABASE db_veiculos;
USE db_veiculos;

CREATE TABLE veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(100) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    ano INT NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);