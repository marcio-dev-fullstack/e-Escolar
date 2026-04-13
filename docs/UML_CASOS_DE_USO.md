```mermaid
graph TD
    SA[Super Admin SaaS] -->|Gerenciar| ASSIN(Assinaturas)
    GE[Gestor Escolar] -->|Matricular| ALUNO(Alunos)
    PR[Professor] -->|Lançar| NOTA(Notas/Faltas)
    AL[Aluno/Pai] -->|Visualizar| BOL(Boletim)

#### No ficheiro `docs/DATABASE.md`:
```markdown
```mermaid
erDiagram
    ESCOLAS ||--o{ USUARIOS : "possui"
    ESCOLAS ||--o{ TURMAS : "organiza"
    TURMAS ||--o{ MATRICULAS : "contém"

