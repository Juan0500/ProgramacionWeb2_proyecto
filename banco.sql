CREATE DATABASE IF NOT EXISTS db_users;
USE db_users;

-- Tabela: categoria_aura
CREATE TABLE IF NOT EXISTS categoria_aura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    pontuacao_minima INT NOT NULL,
    pontuacao_maxima INT NOT NULL
);

-- Tabela: usuario
CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    pontuacao_atual INT NOT NULL,
    fk_categoria_aura_id INT,
    FOREIGN KEY (fk_categoria_aura_id) REFERENCES categoria_aura(id)
);

-- Tabela: historico_pontuacao
CREATE TABLE IF NOT EXISTS historico_pontuacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motivo VARCHAR(255),
    data_registro DATETIME NOT NULL,
    pontos INT NOT NULL,
    fk_usuario_id INT,
    FOREIGN KEY (fk_usuario_id) REFERENCES usuario(id)
);

-- Tabela: conquista
CREATE TABLE IF NOT EXISTS conquista (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao VARCHAR(255)
);

-- Tabela: usuario_conquista 
CREATE TABLE IF NOT EXISTS usuario_conquista (
    fk_usuario_id INT,
    fk_conquista_id INT,
    PRIMARY KEY (fk_usuario_id, fk_conquista_id),
    FOREIGN KEY (fk_usuario_id) REFERENCES usuario(id),
    FOREIGN KEY (fk_conquista_id) REFERENCES conquista(id)
);

-- Dados iniciais

INSERT INTO categoria_aura (nome, pontuacao_minima, pontuacao_maxima) VALUES
('Aura Negativa', -999999, -1),
('Aura NPC', 0, 100),
('Aura Pura', 101, 500),
('Aura + Ego', 501, 8000),
('Aura Lendária', 8001, 999999);

INSERT INTO usuario (nome, email, senha, pontuacao_atual, fk_categoria_aura_id) VALUES
('Emacel Ulares', 'emacel@tads.com', '123456', -450, 1),
('Marcos Schlick', 'marcos@tads.com', '123456', 100000, 5),
('Bruno Fofito', 'bruno@tads.com', '123456', 80, 2),
('Santi Iago', 'santi@tads.com', '123456', 300, 3),
('Uilliao Meireles', 'uilliao@tads.com', '123456', 650, 4);

INSERT INTO historico_pontuacao (motivo, data_registro, pontos, fk_usuario_id) VALUES
('Cadastro inicial', NOW(), 100, 3),
('Perdeu pontos em desafio', NOW(), -50, 1);

INSERT INTO conquista (nome, descricao) VALUES
('Primeiro Login', 'Usuário acessou o sistema pela primeira vez'),
('Aura Máxima', 'Usuário atingiu mais de 8000 pontos de aura');

INSERT INTO usuario_conquista (fk_usuario_id, fk_conquista_id) VALUES
(2, 1),
(2, 2);