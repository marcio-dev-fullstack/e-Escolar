---

### 2. Arquivo: `docs/UML_CLASSES.md`
```markdown
# Diagrama de Classes - Arquitetura de Dados

```mermaid
classDiagram
    class Escola {
        +int id
        +string nome
        +string cnpj
        +bool status_assinatura
    }

    class Usuario {
        +int id
        +int escola_id
        +string nome
        +string nivel
        +auth()
    }

    class Turma {
        +int id
        +int escola_id
        +string nome
        +string periodo
    }

    class Matricula {
        +int id
        +int aluno_id
        +int turma_id
        +datetime data_inicio
    }

    Escola "1" -- "*" Usuario : possui
    Escola "1" -- "*" Turma : possui
    Usuario "1" -- "*" Matricula : aluno_vinculado
    Turma "1" -- "*" Matricula : possui_inscritos