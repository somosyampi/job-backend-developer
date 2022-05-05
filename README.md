<p align="center"><a href="https://yampi.com.br" target="_blank"><img src="https://icons.yampi.me/svg/brand-yampi.svg" width="400"></a></p>

# Teste prático para Back-End Developer
***

Boas vindas pessoa desenvolvedora.

Este é o teste que nós, aqui da Yampi, usamos para avaliar tecnicamente todas as pessoas que estão participando do processo seletivo para a vaga de Back-End.

**Faça um fork desse projeto para iniciar o desenvolvimento. PRs não serão aceitos.**

### Configuração do ambiente
***

**Para configuração do ambiente é necessário ter o Docker instalado na máquina.**

Dentro da pasta do projeto rode o seguinte comando: `docker-compose up -d`.

Criar o arquivo `.env` baseado no arquivo `.env.example`.

Após criar o arquivo `.env` será necessário acessar o container da aplicação para rodar alguns comandos de configuração do Laravel.

Para acessar o container use o comando `docker exec -it yampi_test_app sh`.

Após acessar o cotainer será necessário rodar os seguintes comandos:

- `composer install`
- `php artisan key:generate`
- `php artisan migrate`

Após rodar esses comandos seu ambiente estara pronto para começar o teste.


### Funcionalidades a serem implementadas
***

O sistema terá a função de gerenciar os produtos de um loja virtual, desta forma será necessário que o sitema tenha as seguintes funcionalidades:

##### CRUD produtos

O sistema deverá realizar as principais operações para o gerenciamento de um catálogo de produtos, sendo elas:
- Criação
- Atualização
- Exclusão

O produto deve ter a seguinte estrutura:

Campo       | Tipo      | Obrigatório   | Pode se repetir
----------- | :------:  | :------:      | :------:
id          | int       | true          | false
name        | string    | true          | false        
price       | float     | true          | true
decription  | text      | true          | true
category    | string    | true          | true
image_url   | url       | false         | true

Os endpoints de criação e atualização devem seguir o seguinte formato de payload:
~~~javascript
{
    "name": "product name",
    "price": 109.95,
    "description": "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...",
    "category": "test",
    "image": "https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg"
}
~~~

##### Buscas de produtos

Para realizar a manutenção de um catálogo de produtos é necessário que o sistema tenha algumas buscas, sendo elas:

- Busca pelos campos name e category (trazer resultados que batem com ambos os campos).
- Busca por categoria.
- Busca de produtos com e sem imagem.
- Buscar um produto pelo seu ID único.

##### Importação de produtos de uma API externa

Para agilizar o aumento do catálogo de produtos é importante que o sistema seja capaz de importar produtos já cadastrados em outro serviço, sendo assim o sistema deverá ter as seguintes funcionalidades:

- Rota para a importação de um produto, ex: `./products/import/{id}`
- Comando artisan para efetuar a importação, ex: `php artisan products:import {id}`

Utilizar a seguinte API para importação dos produtos: `https://fakestoreapi.com/docs`

