sequenceDiagram
    participant U as Usuário
    participant L as Login
    participant DB as Banco de Dados
    participant S as Sessão

    U->>L: Credenciais
    L->>DB: Valida escola_id
    DB-->>L: Ok
    alt Escola Ativa
        L->>S: Define $_SESSION['escola_id']
        L-->>U: Redireciona para Dashboard
    else Escola Inativa
        L-->>U: Exibe Mensagem de Bloqueio
    end