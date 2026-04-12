classDiagram
    class Escola {
        +int id
        +string nome
        +string cnpj
        +string token_api
        +bool status_assinatura
    }

    class Usuario {
        +int id
        +int escola_id
        +string nome
        +string nivel (ADM, PROF, ALUNO)
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