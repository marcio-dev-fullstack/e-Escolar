# Sistema Escolar SAAS - Gestão Inteligente

![PHP Version](https://img.shields.io/badge/php-8.2%2B-blue.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)
![Database](https://img.shields.io/badge/db-MySQL%208.0-orange.svg)

## Descrição
Este sistema é uma plataforma **Multi-Tenant** projetada para gerenciar múltiplas instituições de ensino de forma independente em uma única base de código. Ideal para redes de ensino ou oferta de software como serviço.

## Módulos do Sistema
1.  **SaaS Core:** Gestão de planos, escolas contratantes e limites de usuários.
2.  **Secretaria:** Matrículas, transferências e documentos oficiais.
3.  **Acadêmico:** Diário de classe, lançamento de notas/faltas e boletins.
4.  **Financeiro:** Cobranças via PIX/Boleto, contas a pagar e fluxo de caixa.
5.  **Comunicação:** Integração com APIs de WhatsApp para notificações.

## 🛠 Stack Tecnológica
- **Backend:** PHP 8.2 (Arquitetura Orientada a Objetos - POO).
- **Banco de Dados:** MySQL com isolamento por `escola_id`.
- **Frontend:** Bootstrap 5, AdminLTE, JavaScript vanilla.
- **Relatórios:** DomPDF para geração de documentos.

## Estrutura de Diretórios
- `/app`: Lógica de negócio (Classes, Controllers, Models).
- `/public`: Entry point do sistema, CSS, JS e Imagens.
- `/docs`: Diagramas UML e especificações técnicas.
- `/sql`: Scripts de migração e estrutura do banco.

---
**Desenvolvido por Márcio Rodrigues de Oliveira**