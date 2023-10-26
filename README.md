# Locadora-Teste-LabsIf

LabsIF : sistema para gerenciamento de uma locadora de carros 

# Sumário
- [Estrutura de pastas](#estrutura-de-pastas)
- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Para requisições](#para-requisições)
- [Rotas](#rotas)
  - [Cadastrar novo carro](#cadastrar-um-novo-carro)
  - [Listar todos os carros](#listar-todos-os-carros)
  - [Obter Detalhes de um Carro Específico](#obter-detalhes-de-um-carro-específico)
  - [Atualizar Detalhes de um Carro](#atualizar-detalhes-de-um-carro)
  - [Excluir um carro](#excluir-um-carro)
  - [Alugar um carro](#alugar-um-carro)
  - [Listar Carros Disponíveis para Aluguel](#listar-carros-disponíveis-para-aluguel)
- [Licença](#licença)
  
  --------------

# Estrutura de pastas
- carro/: Contém os arquivos relacionados a operações de carros.
- alugueis/: Contém os arquivos relacionados a operações de aluguéis.
- config/: Contém os arquivos de configuração do banco de dados ou outras configurações do sistema.
- vendor/: Contém as bibliotecas de terceiros e dependências do projeto.
- index.php: Arquivo principal que gerencia as rotas e operações do seu sistema.

# Pré-requisitos
- PHP instalado (v 8.1.24)
- Servidor web configurado para executar PHP
- Banco de dados MySQL

# Instalação
- Clone o repositório
- Navege até o diretório do projeto 
- Configure o projeto
  
# Configuração
- Crie um banco de dados MySQL 
```SQL
CREATE DATABASE nomedobanco;
```
- Crie as tabelas necessarias presentes em `/sql/createTables.sql`
- Configure o arquivo com suas credenciais `database-exemple.php` presente na pasta config e atualize o nome do arquivo para `database.php`
- Execute o servidor PHP embutido: `php -S localhost:8000`
  
# Para requisições
- Para as requisições pode-se utilizar algum aplicativo como [Postman](https://www.postman.com/) ou extensões como [ThunderClient](https://marketplace.visualstudio.com/items?itemName=rangav.vscode-thunder-client). Ou se preferir pode-se utilizar o arquivo `requests.http` (lembre-se de adapta-lo caso necessário)

# Rotas
### Cadastrar um Novo Carro

Cadastra um novo carro no sistema.

- **URL:** `/carros`
- **Método:** `POST`
- **Corpo da Requisição:**
    ```json
    {
        "modelo": "Nome do Modelo",
        "marca": "Nome da Marca",
        "descricao": "Descrição detalhada do carro.",
        "preco_aluguel": 100.50,
        "categoria": "Categoria do Carro"
    }
    ```

#### Parâmetros do Corpo da Requisição

- `modelo` (string, obrigatório): Nome do modelo do carro.
- `marca` (string, obrigatório): Nome da marca do carro.
- `descricao` (string, obrigatório): Descrição detalhada do carro.
- `preco_aluguel` (float, obrigatório): Preço de aluguel do carro.
- `categoria` (string, obrigatório): Categoria do carro.

#### Resposta de Sucesso

- **Código:** 201 Created
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Carro cadastrado com sucesso!",
        "carro_id": 123
    }
    ```
  
#### Resposta de Erro

- **Código:** 400 Bad Request
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Campos obrigatórios ausentes."
    }
    ```

- **Código:** 500 Internal Server Error
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Erro ao cadastrar o carro: Mensagem de erro específica."
    }
    ```
-------------------

### Listar Todos os Carros

Lista todos os carros disponíveis no sistema.

- **URL:** `/carros`
- **Método:** `GET`

#### Parâmetros da Requisição

Nenhum parâmetro é necessário para esta solicitação.

#### Resposta de Sucesso

- **Código:** 200 OK
- **Exemplo de Resposta:**
    ```json
    [
        {
            "id": 1,
            "modelo": "Nome do Modelo",
            "marca": "Nome da Marca",
            "descricao": "Descrição detalhada do carro.",
            "preco_aluguel": 100.50,
            "categoria": "Categoria do Carro"
        },
        {
            "id": 2,
            "modelo": "Outro Modelo",
            "marca": "Outra Marca",
            "descricao": "Outra descrição detalhada do carro.",
            "preco_aluguel": 120.75,
            "categoria": "Categoria do Carro"
        }
    ]
    ```

#### Resposta de Erro

- **Código:** 404 Not Found
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Nenhum carro encontrado."
    }
    ```

- **Código:** 500 Internal Server Error
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Erro ao buscar carros: Mensagem de erro específica."
    }
    ```
    -------------------

### Obter Detalhes de um Carro Específico

Obtém detalhes de um carro específico com base no seu ID.

- **URL:** `/carros/{id}`
- **Método:** `GET`

#### Parâmetros da Requisição

- **id** (obrigatório) - O ID único do carro que você deseja obter detalhes.

#### Resposta de Sucesso

- **Código:** 200 OK
- **Exemplo de Resposta:**
    ```json
    {
        "id": 1,
        "modelo": "Nome do Modelo",
        "marca": "Nome da Marca",
        "descricao": "Descrição detalhada do carro.",
        "preco_aluguel": 100.50,
        "categoria": "Categoria do Carro"
    }
    ```

#### Resposta de Erro

- **Código:** 404 Not Found
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Carro não encontrado."
    }
    ```

- **Código:** 400 Bad Request
- **Exemplo de Resposta:**
    ```json
    {
        "message": "ID do carro não fornecido ou inválido."
    }
    ```

- **Código:** 500 Internal Server Error
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Erro ao buscar detalhes do carro: Mensagem de erro específica."
    }
    ```
    -------------------

### Atualizar Detalhes de um Carro

Atualiza os detalhes de um carro existente com base no seu ID.

- **URL:** `/carros/{id}`
- **Método:** `PUT`
- **Corpo da Requisição:** JSON com os campos a serem atualizados.

#### Parâmetros da Requisição

- **id** (obrigatório) - O ID único do carro que você deseja atualizar.

#### Corpo da Requisição

- **modelo** (opcional) - Novo nome do modelo do carro.
- **marca** (opcional) - Nova marca do carro.
- **descricao** (opcional) - Nova descrição detalhada do carro.
- **preco_aluguel** (opcional) - Novo preço de aluguel do carro.
- **categoria** (opcional) - Nova categoria do carro.

**Nota:** Pelo menos um dos campos (modelo, marca, descricao, preco_aluguel, categoria) deve ser fornecido para atualizar o carro.

#### Resposta de Sucesso

- **Código:** 200 OK
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Carro atualizado com sucesso!"
    }
    ```

#### Resposta de Erro

- **Código:** 400 Bad Request
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Nenhum dado para atualizar fornecido."
    }
    ```

- **Código:** 404 Not Found
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Carro não encontrado."
    }
    ```

- **Código:** 500 Internal Server Error
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Erro ao atualizar o carro: Mensagem de erro específica."
    }
    ```
-------------------

### Atualizar Detalhes de um Carro

Atualiza os detalhes de um carro existente com base no seu ID.

- **URL:** `/carros/{id}`
- **Método:** `PUT`
- **Corpo da Requisição:** JSON com os campos a serem atualizados.

#### Parâmetros da Requisição

- **id** (obrigatório) - O ID único do carro que você deseja atualizar.

#### Corpo da Requisição

- **modelo** (opcional) - Novo nome do modelo do carro.
- **marca** (opcional) - Nova marca do carro.
- **descricao** (opcional) - Nova descrição detalhada do carro.
- **preco_aluguel** (opcional) - Novo preço de aluguel do carro.
- **categoria** (opcional) - Nova categoria do carro.

**Nota:** Pelo menos um dos campos (modelo, marca, descricao, preco_aluguel, categoria) deve ser fornecido para atualizar o carro.

#### Resposta de Sucesso

- **Código:** 200 OK
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Carro atualizado com sucesso!"
    }
    ```

#### Resposta de Erro

- **Código:** 400 Bad Request
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Nenhum dado para atualizar fornecido."
    }
    ```

- **Código:** 404 Not Found
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Carro não encontrado."
    }
    ```

- **Código:** 500 Internal Server Error
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Erro ao atualizar o carro: Mensagem de erro específica."
    }
    ```

--------------------

### Excluir um Carro

Exclui um carro existente com base no seu ID.

- **URL:** `/carros/{id}`
- **Método:** `DELETE`

#### Parâmetros da Requisição

- **id** (obrigatório) - O ID único do carro que você deseja excluir.

#### Resposta de Sucesso

- **Código:** 200 OK
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Carro excluído com sucesso!"
    }
    ```

#### Resposta de Erro

- **Código:** 404 Not Found
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Carro não encontrado."
    }
    ```

- **Código:** 500 Internal Server Error
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Erro ao excluir o carro: Mensagem de erro específica."
    }
    ```
---------------

### Alugar um Carro

Aluga um carro disponível por um período de tempo específico.

- **URL:** `/carros/alugar`
- **Método:** `POST`

#### Corpo da Requisição

Forneça um objeto JSON no corpo da requisição contendo as seguintes informações:

- **carro_id** (obrigatório) - O ID único do carro que você deseja alugar.
- **data_inicio** (obrigatório) - Data de início do período de aluguel no formato YYYY-MM-DD.
- **data_fim** (obrigatório) - Data de término do período de aluguel no formato YYYY-MM-DD.

Exemplo de Corpo da Requisição:
```json
{
    "carro_id": 1,
    "data_inicio": "2023-10-31",
    "data_fim": "2023-11-10"
}
```
#### Resposta de Sucesso

- **Código:** 200 OK
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Carro alugado com sucesso!"
    }
    ```

#### Resposta de Erro

- **Código:** 400 Bad Request
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Carro não disponível para o período solicitado."
    }
    ```

- **Código:** 500 Internal Server Error
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Erro ao alugar o carro: Mensagem de erro específica."
    }
    ```
---------------

### Listar Carros Disponíveis para Aluguel

Obtém uma lista de carros que estão disponíveis para aluguel.

- **URL:** `/carros/disponiveis`
- **Método:** `GET`

#### Parâmetros de Consulta

Nenhum parâmetro é necessário para esta requisição.

#### Resposta de Sucesso

- **Código:** 200 OK
- **Exemplo de Resposta:**
    ```json
    [
        {
            "id": 1,
            "modelo": "Modelo do Carro",
            "marca": "Marca do Carro",
            "descricao": "Descrição do Carro",
            "preco_aluguel": 100.00,
            "categoria": "Categoria do Carro"
        },
        {
            "id": 2,
            "modelo": "Outro Modelo",
            "marca": "Outra Marca",
            "descricao": "Outra Descrição",
            "preco_aluguel": 120.00,
            "categoria": "Categoria do Carro"
        }
    ]
    ```

#### Resposta de Erro

- **Código:** 500 Internal Server Error
- **Exemplo de Resposta:**
    ```json
    {
        "message": "Erro ao obter carros disponíveis: Mensagem de erro específica."
    }
    ```

---------------

## Licença

Este projeto está licenciado sob a [Licença MIT](LICENSE) - veja o arquivo [LICENSE](LICENSE) para detalhes.
