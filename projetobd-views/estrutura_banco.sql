CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nivel ENUM('adm', 'tec') NOT NULL
);

CREATE TABLE tecnico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE categoria ( -- add descricao
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE equipamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);

CREATE TABLE servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2)
);

CREATE TABLE manutencao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tecnico_id INT NOT NULL,
    servico_id INT NOT NULL,
    equipamento_id INT NOT NULL,
    data_criacao DATE,
    data_fim DATE,
    FOREIGN KEY (tecnico_id) REFERENCES usuario(id),
    FOREIGN KEY (servico_id) REFERENCES servico(id),
    FOREIGN KEY (equipamento_id) REFERENCES equipamento(id),
    CHECK ((SELECT nivel FROM usuario WHERE id = tecnico_id) = 'tec')
);