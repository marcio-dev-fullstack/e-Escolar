#### `docs/UML_SEQUENCIA_LOGIN.md`
```markdown
# Fluxo de Autenticação Multi-Tenant

```mermaid
sequenceDiagram
    participant U as Usuário
    participant L as Login
    participant DB as Banco de Dados
    participant S as Sessão

    U->>L: Credenciais
    L->>DB: Valida escola_id
    DB-->>L: Ok
    alt Ativa
        L->>S: Define $_SESSION['escola_id']
        L-->>U: Redireciona
    else Inativa
        L-->>U: Mensagem Bloqueio
    end