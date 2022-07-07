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
- [ ] Criar produto
- [x] Ler produto
- [ ] Atualizar produto
- [x] Deletar produto
- [x] Busca pelos campos name e category (trazer resultados que batem com ambos os campos)
- [x] Busca por uma categoria específica
- [x] Busca de produtos com e sem imagem
- [x] Buscar um produto pelo seu ID único

## Testar aplicação

1. Criar o arquivo .env: `cp .env.example .env` 
2. Acesse o container: `docker exec -it yampi_test_app sh` 
3. Comandos para criar base da aplicação: `composer install && php artisan key:generate && php artisan migrate`
4. Importar produtos `php artisan products:import`
5. Importar produto especifico `php artisan products:import --id=11`
6. Importar produto já importado `php artisan products:import --id=11`
7. Busca pelos campos **name** e category: `curl -X GET "http://localhost:8000/api/v1/products?search=mens" | json_pp`
8. Busca pelos campos name e **category**: `curl -X GET "http://localhost:8000/api/v1/products?search=jewelery" | json_pp`
9.  Busca por uma categoria específica: `curl -X GET "http://localhost:8000/api/v1/products?category=electronics" | json_pp`
10. Busca de produtos com imagem: `curl -X GET "http://localhost:8000/api/v1/products?includes=image" | json_pp`
11. Buscar um produto pelo seu ID único: `curl -X GET "http://localhost:8000/api/v1/products/6" | json_pp`


