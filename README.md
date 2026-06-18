# TaskFlow
### Gerenciador de Produtividade Pessoal

---

## Descrição da Aplicação

O **TaskFlow** é uma aplicação web focada no gerenciamento simples e eficiente de tarefas diárias. Desenvolvido como projeto prático acadêmico, o sistema permite que usuários criem contas de forma segura, organizem seus objetivos diários através de um CRUD funcional, alternem o status de conclusão das demandas e eliminem registros obsoletos.

> **Público-alvo:** Estudantes e profissionais que buscam uma ferramenta ágil e direta para organização pessoal.

---

## Módulos da Disciplina Aplicados

Para a construção desta aplicação, foram selecionados e aplicados de maneira prática os seguintes **5 módulos** da ementa:

| # | Módulo | Aplicação no Projeto |
|---|--------|----------------------|
| 1 | **Roteamento e Ciclo de Vida de uma Request** | Configuração de rotas web seguras agrupadas por middleware e isolamento da lógica de negócios no `TaskController` |
| 2 | **Views com Blade** | Renderização SSR com diretivas condicionais (`@if`), loops (`@foreach`) e exibição dinâmica de dados |
| 3 | **Forms e Validação de Requisições** | Classe customizada `StoreTaskRequest` com validação campo a campo e preservação de dados via `old()` |
| 4 | **Autenticação de Usuários** | Integração do Laravel Breeze para login, registro, sessões e proteção de rotas via middleware `auth` |
| 5 | **Migrações e Relacionamentos** | Migrations para versionamento do banco e relacionamento 1-N via Eloquent ORM (`User hasMany Task` / `Task belongsTo User`) |

---

## Configuração e Execução Local

Siga o passo a passo abaixo em um ambiente **Linux (Ubuntu)** para clonar, configurar e rodar o projeto localmente.

### Pré-requisitos

- PHP >= 8.1
- Composer
- Node.js & NPM

---

### Passo 1 — Clonar o Repositório

```bash
git clone https://github.com/paulosrgf/TaskFlow.git
cd TaskFlow
```

### Passo 2 — Instalar Dependências PHP

```bash
composer install
```

### Passo 3 — Configurar Variáveis de Ambiente

```bash
cp .env.example .env
```

> **Nota:** Por padrão, o Laravel já vem configurado para utilizar `DB_CONNECTION=sqlite`, eliminando a necessidade de subir servidores de banco de dados externos.

### Passo 4 — Gerar a Chave da Aplicação

```bash
php artisan key:generate
```

### Passo 5 — Preparar o Banco de Dados (SQLite)

```bash
touch database/database.sqlite
php artisan migrate
```

### Passo 6 — Instalar e Compilar Dependências Front-End

```bash
npm install
npm run build
```

### Passo 7 — Inicializar o Servidor Local

```bash
php artisan serve
```

 Acesse a aplicação em: **[http://localhost:8000](http://localhost:8000)**

---

---

## Tecnologias Utilizadas

- **Laravel** — Framework PHP
- **Laravel Breeze** — Autenticação
- **Blade** — Template Engine
- **SQLite** — Banco de Dados
- **Tailwind CSS** — Estilização
