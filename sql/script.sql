CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;

CREATE TABLE livros (
    id INT(11) AUTO_INCREMENT PRIMARY KEY, -- Corrigido: 'AUTO_INCREMENT' deve vir antes de 'PRIMARY KEY'
    titulo VARCHAR(100) NOT NULL,          -- Adicionado 'NOT NULL' para evitar valores nulos
    autor VARCHAR(100) NOT NULL,           -- Adicionado 'NOT NULL' para evitar valores nulos
    ano INT(4) NOT NULL                    -- Adicionado 'NOT NULL' para evitar valores nulos
);