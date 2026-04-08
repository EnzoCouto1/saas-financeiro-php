# 📊 SaaS Financeiro & Gestão de Comandas

Um sistema web completo, focado na gestão financeira, controle de comandas e gerenciamento automático de estoque. Projetado para otimizar a operação de caixas e o atendimento em bares, restaurantes e pesqueiros, garantindo agilidade no lançamento de produtos e segurança no controle de caixa.

## 🚀 Principais Funcionalidades

- **Gestão de Comandas (Conta Aberta):** Criação rápida de comandas por cliente ou mesa. Visualização dinâmica em painel Kanban (Abertas vs. Fechadas recentemente).
- **Lançamento Rápido:** Interface otimizada com menu suspenso alimentado pelo cardápio, calculando totais em tempo real via JavaScript.
- **Cardápio Digital:** Cadastro de produtos com preço fixo e categorização inteligente (Bebidas, Porções, etc.).
- **Controle de Estoque Automático:** Baixa instantânea no banco de dados ao lançar um item na comanda e devolução automática ao estoque em caso de exclusão/cancelamento do item.
- **Fechamento de Conta:** Registro detalhado com suporte a múltiplas formas de pagamento (PIX, Dinheiro, Cartões, Fiado).
- **Segurança de Dados:** Transações isoladas por ID da Empresa (Multitenancy básico) e proteção de credenciais via variáveis de ambiente (.env).

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP (Arquitetura MVC - Model, View, Controller)
- **Banco de Dados:** PostgreSQL (Relacional, com chaves estrangeiras e deleção em cascata)
- **Frontend:** HTML5, CSS3, JavaScript (Vanilla) e Bootstrap 5
- **Controle de Versão:** Git & GitHub

## ⚙️ Pré-requisitos e Como Rodar Localmente

Para rodar este projeto na sua máquina, você precisará ter instalado:
- Um servidor local como XAMPP, WAMP ou o próprio servidor embutido do PHP.
- PostgreSQL e pgAdmin para o banco de dados.

### Passos para Instalação:

1. Clone o repositório no seu terminal:
git clone https://github.com/EnzoCouto1/saas-financeiro-php

2. Configure o Banco de Dados:
- Abra o seu pgAdmin e crie um banco de dados chamado `saas_financeiro`.
- Rode os scripts SQL fornecidos para criar as tabelas de empresas, usuarios, categorias, produtos, clientes e transacoes.

3. Configure as Variáveis de Ambiente:
- Na raiz do projeto, renomeie o arquivo `.env.example` para `.env`.
- Abra o arquivo `.env` e insira as credenciais reais do seu banco de dados PostgreSQL. (Nota: O arquivo `.env` está protegido pelo `.gitignore` e não subirá para o repositório público).

4. Inicie o Servidor:
- Pelo terminal, na pasta raiz do projeto, inicie o servidor embutido com o comando:
php -S localhost:8000
- Acesse http://localhost:8000/public/login.php no seu navegador.

## 👨‍💻 Autor

Desenvolvido por **Enzo Augusto do Couto**
*Engenheiro de Computação*

---
*Este projeto foi construído com foco em resolver problemas reais de logística, controle de inventário e gestão financeira em estabelecimentos comerciais de alto fluxo.*