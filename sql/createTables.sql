CREATE DATABASE IF NOT EXISTS nomedobanco;
USE nomedobanco;

CREATE TABLE carros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(255),
    marca VARCHAR(255),
    descricao TEXT,
    preco_aluguel DECIMAL(10, 2),
    categoria VARCHAR(50),
    disponivel BOOLEAN DEFAULT TRUE
);

CREATE TABLE alugueis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    carro_id INT,
    data_inicio DATETIME,
    data_fim DATETIME,
    FOREIGN KEY (carro_id) REFERENCES carros(id)
);
