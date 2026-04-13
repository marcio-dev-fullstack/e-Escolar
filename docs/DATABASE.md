# Dicionário de Dados - e-Escolar SaaS

## Estratégia de Inquilinos (Tenants)
Para garantir que a Escola A não veja os dados da Escola B, utilizamos o campo `escola_id` em todas as tabelas transacionais.

## Tabelas do Sistema

### 1. Núcleo (SaaS)
* **planos**: Define as regras de negócio e limites (alunos, espaço em disco).
* **escolas**: Tabela mestre dos inquilinos.

### 2. Administrativo
* **usuarios**: Cadastro único com níveis de acesso (Admin, Professor, Aluno, Secretaria).
* **cursos**: Definição das modalidades de ensino.

### 3. Acadêmico
* **turmas**: Vínculo entre curso, período e ano letivo.
* **matriculas**: Onde a "mágica" acontece: liga o aluno à turma e gera o financeiro.

### 4. Relacionamento (Mermaid)

```mermaid
erDiagram
    ESCOLAS ||--o{ USUARIOS : "possui"
    ESCOLAS ||--o{ TURMAS : "organiza"
    TURMAS ||--o{ MATRICULAS : "contém"
    USUARIOS ||--o{ MATRICULAS : "aluno_inscrito"