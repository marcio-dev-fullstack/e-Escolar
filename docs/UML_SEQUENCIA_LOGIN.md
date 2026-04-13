sequenceDiagram
    participant U as Usuario
    participant L as Login
    participant DB as Banco
    U->>L: Credenciais
    L->>DB: Valida escola_id
    DB-->>L: Ok
    L->>U: Redireciona