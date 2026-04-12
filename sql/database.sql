-- Criação do Banco de Dados
CREATE DATABASE IF NOT EXISTS e_escolar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE e_escolar;

-- 1. Tabela de Planos (SaaS Core)
CREATE TABLE planos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    limite_alunos INT DEFAULT 0,
    valor_mensal DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. Tabela de Escolas (Tenants)
CREATE TABLE escolas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plano_id INT,
    nome VARCHAR(100) NOT NULL,
    cnpj VARCHAR(20) UNIQUE,
    subdominio VARCHAR(50) UNIQUE,
    status ENUM('ativo', 'inativo', 'pendente') DEFAULT 'ativo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (plano_id) REFERENCES planos(id)
) ENGINE=InnoDB;

-- 3. Tabela de Usuários (Multi-Tenant)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    escola_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nivel ENUM('superadmin', 'admin', 'secretaria', 'professor', 'aluno') NOT NULL,
    foto VARCHAR(255) DEFAULT 'sem-foto.jpg',
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (escola_id) REFERENCES escolas(id) ON DELETE CASCADE,
    UNIQUE KEY uk_email_escola (email, escola_id)
) ENGINE=InnoDB;

-- Índices para performance SaaS
CREATE INDEX idx_escola_usuario ON usuarios(escola_id);