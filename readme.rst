# 🧑‍💼 Employee Admin – CodeIgniter 3 + PostgreSQL + Docker

Aplicação desenvolvida como parte de um **teste técnico** para vaga de desenvolvedor.  
O sistema realiza **login de usuários** e o **CRUD completo de funcionários**, utilizando **CodeIgniter 3**, **PostgreSQL** e **Bootstrap** — tudo executando em containers **Docker**.



## 🚀 Funcionalidades

- 🔐 **Login e autenticação** de usuários (com controle de sessão)
- 🧾 **CRUD completo de funcionários** (criar, listar, editar e excluir)
- ⚡ **Interface responsiva** com Bootstrap 5
- 🔄 **Requisições AJAX/jQuery** sem recarregar a página
- 💬 **Feedback com Toasts Bootstrap**
- ❌ **Confirmação de exclusão com modal**
- 🐳 **Ambiente 100% containerizado com Docker e PostgreSQL**
- 🛠️ **Migração automática** do banco de dados via `migrate.sql`
- 🔁 **Redirecionamento automático para login** caso o usuário não esteja autenticado

## 🧱 Tecnologias Utilizadas

| Tecnologia | Descrição |

| **PHP 7.4 + Apache** | Backend e servidor web |
| **CodeIgniter 3.x** | Framework PHP MVC |
| **PostgreSQL 18** | Banco de dados relacional |
| **Bootstrap 5.3** | Framework CSS para layout responsivo |
| **jQuery 3.7.1** | Manipulação DOM e AJAX |
| **Docker & Docker Compose** | Containerização e orquestração |
| **DBeaver (opcional)** | Visualização do banco de dados |


## ⚙️ Como Rodar o Projeto

### 1️⃣ Clonar o repositório
```bash
git clone https://github.com/SEU-USUARIO/employee-admin.git
cd employee-admin
