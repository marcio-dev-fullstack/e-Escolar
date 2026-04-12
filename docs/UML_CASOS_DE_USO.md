# Diagrama de Casos de Uso

```mermaid
useCaseDiagram
    actor "Super Admin (SaaS)" as SA
    actor "Gestor Escolar" as GE
    actor "Professor" as PR
    actor "Aluno" as AL

    SA --> (Gerenciar Assinaturas das Escolas)
    SA --> (Configurar APIs Globais)
    
    GE --> (Gerenciar Matrículas)
    GE --> (Configurar Financeiro da Unidade)
    
    PR --> (Lançar Notas e Frequência)
    PR --> (Registrar Plano de Aula)
    
    AL --> (Visualizar Boletim e Notas)
    AL --> (Pagar Mensalidades via PIX)