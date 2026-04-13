-- Criação do Banco (Execute no pgAdmin ou psql)
-- CREATE DATABASE e_escolar;

-- 1. Tabela de Planos
CREATE TABLE planos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    limite_alunos INTEGER DEFAULT 0,
    valor_mensal NUMERIC(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabela de Escolas (Tenants)
CREATE TABLE escolas (
    id SERIAL PRIMARY KEY,
    plano_id INTEGER REFERENCES planos(id),
    nome VARCHAR(100) NOT NULL,
    cnpj VARCHAR(20) UNIQUE,
    subdominio VARCHAR(50) UNIQUE,
    status VARCHAR(20) DEFAULT 'ativo', -- Postgres não usa ENUM da mesma forma que MySQL nativamente
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabela de Usuários
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    escola_id INTEGER NOT NULL REFERENCES escolas(id) ON DELETE CASCADE,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nivel VARCHAR(20) NOT NULL,
    foto VARCHAR(255) DEFAULT 'sem-foto.jpg',
    last_login TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT uk_email_escola UNIQUE (email, escola_id)
);

-- Índices de performance SaaS
CREATE INDEX idx_escola_usuario ON usuarios(escola_id);

-- Tabela de Turmas
CREATE TABLE turmas (
    id SERIAL PRIMARY KEY,
    escola_id INTEGER NOT NULL REFERENCES escolas(id) ON DELETE CASCADE,
    nome VARCHAR(50) NOT NULL,
    ano_letivo INTEGER NOT NULL,
    turno VARCHAR(20) NOT NULL, -- Matutino, Vespertino, Noturno
    status VARCHAR(20) DEFAULT 'aberta',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Vínculo (Alunos na Turma)
CREATE TABLE matriculas (
    id SERIAL PRIMARY KEY,
    escola_id INTEGER NOT NULL REFERENCES escolas(id) ON DELETE CASCADE,
    aluno_id INTEGER NOT NULL REFERENCES alunos(id) ON DELETE CASCADE,
    turma_id INTEGER NOT NULL REFERENCES turmas(id) ON DELETE CASCADE,
    data_matricula DATE DEFAULT CURRENT_DATE,
    CONSTRAINT uk_aluno_turma UNIQUE (aluno_id, turma_id) -- Impede duplicidade
);

CREATE INDEX idx_turmas_escola ON turmas(escola_id);
