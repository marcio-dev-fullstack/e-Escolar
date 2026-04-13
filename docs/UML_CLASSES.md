# Diagrama de Classes 

Este diagrama descreve a estrutura de objetos do sistema e as relações de dependência entre os módulos principais, respeitando a arquitetura Multi-Tenant.

```mermaid
classDiagram
    class Escola {
        +int id
        +string nome
        +string cnpj
        +string subdominio
        +bool ativo
        +configurarPainel()
    }

    class Usuario {
        +int id
        +int escola_id
        +string nome
        +string email
        +string senha
        +string nivel
        +login()
        +recuperarSenha()
    }

    class Curso {
        +int id
        +int escola_id
        +string nome
        +string modalidade
    }

    class Turma {
        +int id
        +int escola_id
        +int curso_id
        +string nome
        +string ano_letivo
        +string turno
    }

    class Matricula {
        +int id
        +int escola_id
        +int aluno_id
        +int turma_id
        +date data_matricula
        +string status
        +gerarContrato()
    }

    class Financeiro {
        +int id
        +int escola_id
        +int matricula_id
        +decimal valor
        +date vencimento
        +string status_pagamento
        +registrarPagamento()
    }

    Escola "1" -- "*" Usuario : possui
    Escola "1" -- "*" Curso : oferece
    Curso "1" -- "*" Turma : contém
    Turma "1" -- "*" Matricula : vincula
    Usuario "1" -- "*" Matricula : como_aluno
    Matricula "1" -- "*" Financeiro : gera