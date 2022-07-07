<p align="center"><a href="https://yampi.com.br" target="_blank"><img src="https://icons.yampi.me/svg/brand-yampi.svg" width="200"></a></p>

# Teste prático para Back-End Developer

## Checklist
- [x] Fork no projeto
- [x] Configurar o docker
- [x] Rodar comandos no container
- [x] Remover rota web e welcome page
- [x] Criar Migration e Model do produto
- [x] Renomear a coluna de descrição do produto, pois copiei do readme e esta escrito 'de~~s~~cription'
- [x] Criar comando Artisan para importar produtos `php artisan products:import`
- [x] Importar produtos
- [x] Criar produto
- [x] Ler produto
- [x] Atualizar produto
- [x] Deletar produto
- [x] Busca pelos campos name e category (trazer resultados que batem com ambos os campos)
- [x] Busca por uma categoria específica
- [x] Busca de produtos com e sem imagem
- [x] Buscar um produto pelo seu ID único
- [x] Revisão

## Testar aplicação

1. Criar o arquivo .env: 

    ```sh
    cp .env.example .env
    ```

2. Acesse o container: 
   
    ```sh
    docker exec -it yampi_test_app sh
    ```

3. Comandos para criar base da aplicação: 

    ```sh
    composer install
    php artisan key:generate
    php artisan migrate
    ```

4. Importar produtos

    ```sh
    php artisan products:import
    ```

5. Importar produto especifico

    ```sh
    php artisan products:import --id=11
    ```

6. Importar produto já importado 
    
    ```sh
    php artisan products:import --id=11
    ```

7. Sair do docker

    ```sh
    exit
    ```

8.  Busca pelos campos **name** e category: 

    ```sh
    curl --request GET \
    --url http://localhost:8000/api/v1/products?search=mens \
    --header 'Accept: application/json' | json_pp
    ```

9.  Busca pelos campos name e **category**:

    ```sh
    curl --request GET \
    --url http://localhost:8000/api/v1/products?search=jewelery \
    --header 'Accept: application/json' | json_pp
    ```

10. Busca por uma categoria específica:

    ```sh
    curl --request GET \
    --url http://localhost:8000/api/v1/products?category=electronics \
    --header 'Accept: application/json' | json_pp
    ```

11. Busca de produtos com imagem:

    ```sh
    curl --request GET \
    --url http://localhost:8000/api/v1/products?category=electronics&includes=image \
    --header 'Accept: application/json' | json_pp
    ```

12. Buscar um produto pelo seu ID único:

    ```sh
    curl --request GET \
    --url http://localhost:8000/api/v1/products/1 \
    --header 'Accept: application/json' | json_pp
    ```

13. Criar produto:

    ```sh
    curl --request POST \
    --url http://localhost:8000/api/v1/products \
    --header 'Accept: application/json' \
    --header 'Content-Type: application/json' \
    --data '{
        "name": "New product",
        "price": 150.95,
        "description": "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...",
        "category": "new",
        "image": "https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg"
    }' | json_pp
    ```

14. Atualizar produto: 

    ```sh
    curl --request PUT \
    --url http://localhost:8000/api/v1/products/2 \
    --header 'Accept: application/json' \
    --header 'Content-Type: application/json' \
    --data '{
        "name": "New product renamed"
    }' | json_pp
    ```

15. Deletar produto: 

    ```sh
    curl --request DELETE \
    --url http://localhost:8000/api/v1/products/1 \
    --header 'Accept: application/json'
    ```

16. Listar todos os produtos: 

    ```sh
    curl --request GET \
    --url http://localhost:8000/api/v1/products?limit=20 \
    --header 'Accept: application/json'  | json_pp
    ```

*** 

Muito obrigado pela oportunidade. 

Tentei ao máximo seguir os padrões utilizados em [https://docs.yampi.com.br/](https://docs.yampi.com.br/)

Qualquer dúvida estarei a disposição 🤙
