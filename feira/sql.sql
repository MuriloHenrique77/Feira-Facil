-- Criação do Banco de Dados
CREATE DATABASE feira_produtores;
USE feira_produtores;

-- Criação da Tabela 'produtores'
CREATE TABLE produtores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    descricao TEXT,
    imagem VARCHAR(255)
);


-- Criação da Tabela 'produtos'
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produtor_id INT,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    imagem VARCHAR(255),
    FOREIGN KEY (produtor_id) REFERENCES produtores(id)
);
