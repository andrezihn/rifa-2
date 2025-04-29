CREATE DATABASE rifa;

USE rifa;

-- Tabela de campanhas
CREATE TABLE campanhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    descricao TEXT,
    total_cotas INT,
    preco DECIMAL(10,2),
    host_nome VARCHAR(100),
    host_whatsapp VARCHAR(20)
);

-- Tabela de cotas
CREATE TABLE cotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero INT,
    campanha_id INT,
    status ENUM('disponivel', 'reservada', 'comprada') DEFAULT 'disponivel',
    comprador_nome VARCHAR(100),
    comprador_contato VARCHAR(20),
    comprovante_path VARCHAR(255),
    FOREIGN KEY (campanha_id) REFERENCES campanhas(id)
);
