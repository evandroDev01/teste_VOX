# Quadro Societário - Backend

Desafio técnico VOX: sistema para cadastro de empresas e seus sócios.

## Descrição do Projeto

Este projeto implementa a parte **backend** do desafio VOX, utilizando **PHP 8.3+**, **Symfony Framework** e **PostgreSQL**.  
O sistema oferece **CRUD de empresas** e **CRUD de sócios**, com as entidades relacionadas corretamente via Doctrine ORM.

## Tecnologias Utilizadas

- PHP 8.3+
- Symfony Framework (última versão LTS)
- PostgreSQL
- Doctrine ORM
- Composer
- Git

## Pré-requisitos

- PHP 8.3 ou superior
- Composer
- PostgreSQL instalado
- Git

## Rodando com Docker

O projeto pode ser executado usando Docker para simplificar a configuração do ambiente.



1. Instale as dependências:

composer install

3. Configure o banco de dados no arquivo .env (ou .env.local):

DATABASE_URL="postgresql://usuario:senha@localhost:5432/quadro_soci?serverVersion=15&charset=utf8"

4. 1. Rodando o projeto

docker-compose up -d

5. Crie o banco de dados:

php bin/console doctrine:database:create

6. Execute as migrations para criar tabelas:

php bin/console doctrine:migrations:migrate


7. Inicie o servidor Symfony:

ao rodar o (docker-compose up -d) - já vai criar os servidores de acesso 


## Estrutura do Projeto

src/
 ├─ Controller/       → Controladores da API (CompanyController, PartnerController)
 ├─ Entity/           → Entidades (Company, Partner)
 ├─ Repository/       → Repositórios para consultas
config/                → Configurações do Symfony
migrations/            → Migrations do Doctrine
public/                → Diretório público do Symfony


## Funcionalidades Implementadas

- CRUD de Empresas

- CRUD de Sócios vinculados a empresas

- API RESTful seguindo boas práticas

- Estrutura organizada e princípios SOLID

- Preparado para consumo de frontend externo (Angular, React, etc.)

# Endpoints da API

1. Empresas

| Método | URL                   | Descrição                |
| ------ | --------------------- | ------------------------ |
| GET    | `/api/companies`      | Listar todas as empresas |
| GET    | `/api/companies/{id}` | Buscar empresa por ID    |
| POST   | `/api/companies`      | Criar nova empresa       |
| PUT    | `/api/companies/{id}` | Atualizar empresa        |
| DELETE | `/api/companies/{id}` | Excluir empresa          |

2. Sócios

| Método | URL                  | Descrição                              |
| ------ | -------------------- | -------------------------------------- |
| GET    | `/api/partners`      | Listar todos os sócios                 |
| GET    | `/api/partners/{id}` | Buscar sócio por ID                    |
| POST   | `/api/partners`      | Criar novo sócio (vinculado a empresa) |
| PUT    | `/api/partners/{id}` | Atualizar sócio                        |
| DELETE | `/api/partners/{id}` | Excluir sócio                          |

# Exemplos de Requisição (Postman / HTTP)

1. Criar Empresa

POST /api/companies
Content-Type: application/json

{
  "name": "Empresa Teste",
  "cnpj": "12.345.678/0001-90",
  "address": "Rua Exemplo, 123"
}

2. Listar Empresas

GET /api/companies


3. Criar Sócio

POST /api/partners
Content-Type: application/json

{
  "name": "João Silva",
  "cpf": "123.456.789-00",
  "company": 1
}


4. Listar Sócios

GET /api/partners


# Observações

- Autenticação e permissionamento não foram implementados (diferenciais do desafio).

- Frontend não implementado, mas a API está pronta para integração.

- Atende aos requisitos mínimos do desafio: CRUD de empresas e sócios com persistência em PostgreSQL.

- O projeto está pronto para testes via Postman ou qualquer cliente HTTP.

# Autor

Contato: evandrom20.aguiar@gmail.com
