Foi ultilizado no desafio:
1) Uso de services para a regra de negocio que foi proposto pelo desafio
2) Uso de repositories para trabalhar com toda camada de banco de dados
3) Uso de resource para trabalhar com todo retorno da api
4)  Uso de validations, para as validações de todos os campos 

***

Para rodar o projeto com as atualizações, entre no docker com o comando ```docker exec -it yampi_test_app sh ```

Dentro do container rode o seguinte comando para gerar a nova tabela no banco

``` php artisan migrate ```

***



## Endpoints:

1) Criação:

    1) ```POST``` - ```/api/product```
         ```
          {
             "name": "Produto 1",
             "price": 12.2,
             "category": "categoria-teste",
             "description": "descrição"
          }
         ``` 

2) Atualização: 

    1) ```PUT``` - ```/api/product/{id}```
         ```
          {
             "name": "Produto 1",
             "price": 12.2,
             "category": "categoria-teste",
             "description": "descrição"
          }
         ``` 


3) Exclusão:
   1)  ```DELETE``` - ```/api/product/{id}```


4) Buscas:
   1) Buscar todos os produtos:```GET``` - ``` /api/product```
   2) Buscar por name e category: ``` GET``` - ``` /api/product?name=&category=``` 
   3) Buscar categoria especifica: ``` GET``` - ``` /api/product?category=``` 
   4) Buscar produto com ou sem imagem: ``` GET``` - ``` /api/product?image=``` 
   5) Buscar produto por ID: ``` GET``` - ``` /api/product?id=``` 

***

O comando para a busca dos produtos é:

``` php artisan import:product ```

E um produto especifico é:

``` php artisan import:product --id=123```
