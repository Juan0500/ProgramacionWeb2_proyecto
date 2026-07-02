CREATE DATABASE IF NOT EXISTS db_users;
USE db_users;

CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    idade INT NOT NULL,
    pontuacao DECIMAL(10,2) NOT NULL
);

INSERT INTO usuario (nome, idade, pontuacao) VALUES
('Emacel Ulares', 21, -450),
('Marcos Schlick', 21, 100000),
('Bruno Fofito', 21, 80),
('Santi Iago', 21, 300),
('Uilliao Meireles', 22, 650);