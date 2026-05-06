# Unitimes

> Aplicação web para alunos acompanharem horários de aula e controlarem faltas por disciplina.

Desenvolvido como projeto acadêmico da disciplina de **Engenharia de Software**, com foco em organização e gestão de projetos via [Taiga](https://taiga.io).

---

## Índice

- [Sobre o projeto](#-sobre-o-projeto)
- [Funcionalidades](#-funcionalidades)
- [Tecnologias](#-tecnologias)
- [Estrutura do banco de dados](#-estrutura-do-banco-de-dados)
- [Como rodar o projeto](#-como-rodar-o-projeto)
- [Dados de teste](#-dados-de-teste)
- [Estrutura de pastas](#-estrutura-de-pastas)
- [Equipe](#-equipe)

---

## Sobre o projeto

O **Unitimes** resolve um problema simples e cotidiano: alunos que perdem o controle das próprias faltas e só descobrem o problema quando já é tarde.

O aluno se cadastra, escolhe a sua turma, e o sistema já exibe a grade de horários completa sem precisar cadastrar nada manualmente. A partir daí, ele pode registrar e remover faltas por disciplina, receber alertas quando estiver próximo do limite e visualizar um dashboard com o status geral das suas frequências.

As turmas, disciplinas e horários são cadastrados pelo administrador e ficam disponíveis para todos os alunos daquela turma.

---

## Funcionalidades

### Para o aluno
- [x] Cadastro com escolha de turma
- [x] Login e logout
- [x] Visualização da grade semanal de horários
- [x] Visualização da sala de cada aula
- [x] Adicionar falta em uma disciplina
- [x] Remover falta de uma disciplina
- [x] Alerta amarelo ao atingir 75% do limite de faltas
- [x] Alerta vermelho ao atingir o limite (risco de reprovação)
- [x] Dashboard com resumo de todas as disciplinas

### Para o administrador
- [x] Cadastrar nova aula/disciplina
- [x] Editar aula existente
- [x] Excluir aula

---

## Tecnologias

| Camada      | Tecnologia              |
|-------------|-------------------------|
| Back-end    | PHP 8.x / Laravel 10.x  |
| Banco       | MySQL                   |
| Front-end   | Blade Templates         |
| Estilização | Tailwind CSS            |
| Versionamento | Git + GitHub          |

---

## Estrutura do Banco de Dados

```
turmas
├── id
└── nome

aulas
├── id
├── nome
├── professor (nullable)
├── dia_semana
├── horario_inicio
├── horario_fim
├── sala
├── carga_horaria
├── limite_faltas
└── turma_id (FK)

users
├── id
├── name
├── email
├── password
├── is_admin
└── turma_id (FK)

faltas
├── id
├── user_id (FK)
├── aula_id (FK)
└── quantidade
```

---

## Como rodar o projeto

### Pré-requisitos

- PHP >= 8.1
- Composer
- MySQL rodando localmente
- Node.js (opcional — apenas se quiser compilar assets)

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/unitimes.git
cd unitimes
```

### 2. Instale as dependências

```bash
composer install
```

### 3. Configure o ambiente

```bash
cp .env.example .env
php artisan key:generate
```

Edite o arquivo `.env` com suas credenciais do banco:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=unitimes
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Crie o banco e rode as migrations com seed

```bash
php artisan migrate --seed
```

> Isso cria todas as tabelas e popula o banco com turmas, disciplinas e um usuário administrador de teste.

### 5. Inicie o servidor

```bash
php artisan serve
```

Acesse no navegador: [http://localhost:8000](http://localhost:8000)

---

## Dados de Teste

Os seeds criam os seguintes dados automaticamente:

### Turmas disponíveis
- ADS — 1º Semestre
- ADS — 2º Semestre
- SI — 3º Semestre

### Usuário administrador
| Campo  | Valor                  |
|--------|------------------------|
| E-mail | admin@unitimes.com     |
| Senha  | password               |

> Com o usuário admin, é possível acessar o painel de gerenciamento de aulas em `/admin/aulas`.

### Para testar como aluno
Acesse `/register`, preencha os dados e escolha uma turma. A grade de horários já estará disponível.

---

## Estrutura de Pastas

```
unitimes/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── GradeController.php
│   │   │   ├── FaltaController.php
│   │   │   └── AulaController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Turma.php
│       ├── Aula.php
│       └── Falta.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── TurmaSeeder.php
│       ├── AulaSeeder.php
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── dashboard.blade.php
│       ├── grade.blade.php
│       └── aulas/
│           ├── index.blade.php
│           ├── create.blade.php
│           └── edit.blade.php
└── routes/
    └── web.php
```

---

## Equipe

| Membro           | Função principal                                  |
|------------------|---------------------------------------------------|
| Gabriel Vinicius | Back-end, Laravel, banco de dados, regras de negócio |
| Leonardo         | Views Blade, layout, estilização Tailwind          |
| João             | Testes manuais, documentação, ajustes visuais     |
| Gabriel Colares  | Layout, apresentação, README, apoio nas views     |

---

## Gestão do Projeto

O projeto foi planejado e acompanhado via **Taiga**, com:

- Backlog estruturado em épicos e user stories
- 2 sprints de 7 dias cada
- Tasks atribuídas por membro de acordo com o nível técnico
- Critérios de aceitação definidos para cada entrega

---

<p align="center">
  Projeto acadêmico — Engenharia de Software
</p>
