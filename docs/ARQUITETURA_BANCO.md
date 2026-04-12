### `docs/ARQUITETURA_BANCO.md`

## Arquitetura de Banco de Dados (SaaS Multi-Tenant)

### 1. Estratégia de Isolamento: Shared Database, Separate Schemas (Lógico)
Para este projeto, utilizaremos um banco de dados único onde o isolamento é feito através da coluna `escola_id`. Esta abordagem oferece o melhor equilíbrio entre custo de manutenção e facilidade de escala para o modelo de curso proposto.

### 2. Regras de Integridade (Golden Rules)
* **Identificador de Tenant:** Toda tabela que contenha dados sensíveis de uma instituição **DEVE** possuir a coluna `escola_id` (INT).
* **Foreign Keys:** Nenhuma operação de `INSERT` ou `UPDATE` deve ser realizada sem validar se o recurso pertence ao `escola_id` da sessão ativa.
* **Soft Deletes:** Utilizaremos a coluna `deleted_at` para evitar perda acidental de dados educacionais históricos.

### 3. Dicionário de Tabelas Principais

#### A. Núcleo SaaS (Gestão de Assinaturas)
| Tabela | Descrição | Principais Campos |
| :--- | :--- | :--- |
| `escolas` | Cadastro das instituições clientes | `id`, `nome`, `cnpj`, `subdominio`, `plano_id`, `status` (Ativo/Inativo) |
| `planos` | Definição de limites do sistema | `id`, `nome`, `limite_alunos`, `valor_mensal`, `recursos_liberados` |

#### B. Gestão de Usuários (Auth)
| Tabela | Descrição | Principais Campos |
| :--- | :--- | :--- |
| `usuarios` | Acesso multi-nível | `id`, **`escola_id`**, `nome`, `email`, `senha` (Hash), `nivel` (admin, prof, aluno, secretaria) |

#### C. Estrutura Acadêmica
| Tabela | Descrição | Principais Campos |
| :--- | :--- | :--- |
| `turmas` | Organização de salas | `id`, **`escola_id`**, `nome`, `ano_letivo`, `turno`, `max_alunos` |
| `disciplinas` | Grade curricular | `id`, **`escola_id`**, `nome`, `carga_horaria` |
| `matriculas` | Vínculo Aluno/Turma | `id`, **`escola_id`**, `aluno_id`, `turma_id`, `data_matricula`, `status` |

#### D. Financeiro e Movimentações
| Tabela | Descrição | Principais Campos |
| :--- | :--- | :--- |
| `mensalidades` | Cobranças geradas | `id`, **`escola_id`**, `matricula_id`, `valor`, `vencimento`, `status_pagamento` |
| `caixa` | Fluxo financeiro da escola | `id`, **`escola_id`**, `descricao`, `tipo` (Entrada/Saída), `valor`, `data` |

### 4. Índices e Performance
Para garantir que a filtragem por escola seja instantânea, todas as tabelas terão índices compostos iniciando pelo `escola_id`:
```sql
CREATE INDEX idx_escola_aluno ON alunos (escola_id, id);
CREATE INDEX idx_escola_turma ON turmas (escola_id, id);
```

### 5. Segurança de Acesso aos Dados
Toda classe DAO (Data Access Object) ou Repository no PHP deverá herdar um método global de filtragem:
```php
// Exemplo de lógica interna
protected function applyTenantFilter($query) {
    return $query . " WHERE escola_id = " . $_SESSION['escola_id'];
}
```
