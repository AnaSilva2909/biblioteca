CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;

CREATE TABLE livros (
    id INT(11) AUTO_INCREMENT PRIMARY KEY, 
    titulo VARCHAR(100) NOT NULL,         
    autor VARCHAR(100) NOT NULL,           
    ano INT(4) NOT NULL                   
);