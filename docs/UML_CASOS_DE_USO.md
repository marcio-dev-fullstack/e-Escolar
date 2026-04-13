# Diagrama de Casos de Uso

```mermaid
graph TD
    SA[Super Admin SaaS] -->|Gerenciar| ASSIN(Assinaturas)
    GE[Gestor Escolar] -->|Matricular| ALUNO(Alunos)
    PR[Professor] -->|Lançar| NOTA(Notas/Faltas)
    AL[Aluno/Pai] -->|Visualizar| BOL(Boletim)

