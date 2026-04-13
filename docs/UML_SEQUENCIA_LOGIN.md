# Diagrama de Sequência - Autenticação Multi-Tenant

```mermaid
sequenceDiagram
    autonumber
    participant U as Usuário
    participant L as Sistema de Login
    participant DB as Banco de Dados (MySQL)
    participant S as Sessão (PHP $_SESSION)

    U->>L: Informa Email, Senha e Subdomínio
    L->>DB: SELECT * FROM usuarios WHERE email = ? AND escola_id = ?
    DB-->>L: Retorna Hash da Senha e Status da Escola
    
    alt Credenciais Inválidas ou Escola Inativa
        L-->>U: Exibe "Acesso Negado ou Conta Bloqueada"
    else Autenticação Sucesso
        L->>S: Grava escola_id, usuario_id e nivel_acesso
        L-->>U: Redireciona para Dashboard da Unidade
    end