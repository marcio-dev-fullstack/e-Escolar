sequenceDiagram
    participant U as Usuário
    participant L as Sistema de Login
    participant DB as Banco de Dados
    participant S as Sessão/Tenant

    U->>L: Envia Email e Senha
    L->>DB: Busca Usuário + escola_id
    DB-->>L: Retorna Dados e Status da Escola
    alt Escola Ativa
        L->>S: Define $_SESSION['escola_id']
        L->>S: Define $_SESSION['user_level']
        L-->>U: Redireciona para Dashboard da Unidade
    else Escola Inadimplente/Inativa
        L-->>U: Exibe Mensagem de Bloqueio
    end