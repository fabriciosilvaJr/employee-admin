# 🧑‍💼 Sistema de Funcionários - CodeIgniter 3


## 🚀 Funcionalidades

- Login com autenticação
- CRUD completo de funcionários (criar, listar, editar, excluir)
- Operações AJAX sem recarregar página
- Interface responsiva com Bootstrap 5
- Ambiente Docker completo

## 🔧 Tecnologias

- PHP 7.4 + CodeIgniter 3
- PostgreSQL 13
- Bootstrap 5 + jQuery
- Docker + Docker Compose

## ⚙️ Como Executar

### 1. Clone o repositório
```bash
git clone https://github.com/SEU-USUARIO/employee-admin.git
cd employee-admin
```

### 2. Suba os containers
```bash
docker-compose up -d
```

### 3. Acesse a aplicação
```
http://localhost:8080
```

**Login padrão:**
- Email: `admin@example.com`
- Senha: `123456`

## 📁 Estrutura Principal

```
├── application/
│   ├── controllers/    # Auth, Dashboard, Employees
│   ├── models/         # User_model, Employee_model
│   └── views/          # Telas de login, dashboard e CRUD
├── sql/
│   └── migrate.sql     # Criação automática das tabelas
├── docker-compose.yml
├── Dockerfile
└── .htaccess
```

## 🗄️ Banco de Dados

**Tabelas criadas automaticamente:**
- `users` - Usuários do sistema
- `employees` - Funcionários (nome, email, cargo, salário, data de admissão)



## ✅ Checklist do Teste Técnico

- [x] Tela de login com autenticação
- [x] CRUD completo de funcionários
- [x] PostgreSQL com migração automática
- [x] Bootstrap + jQuery com AJAX
- [x] Docker + docker-compose
- [x] Código versionado no GitHub

---

**Desenvolvido como teste técnico**
