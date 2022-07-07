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
- [ ] Criar produtos
- [ ] Ler produtos
- [ ] Atualizar produtos
- [ ] Deletar produtos
- [ ] Busca pelos campos name e category (trazer resultados que batem com ambos os campos)
- [ ] Busca por uma categoria específica
- [ ] Busca de produtos com e sem imagem
- [ ] Buscar um produto pelo seu ID único

## Testar aplicação

1. Criar o arquivo .env: `cp .env.example .env` 
1. Acesse o container: `docker exec -it yampi_test_app sh` 
2. Comandos para criar base da aplicação: `composer install && php artisan key:generate && php artisan migrate`
3. Importar produtos `php artisan products:import`
4. Importar produto especifico `php artisan products:import --id=11`
5. Importar produto já importado `php artisan products:import --id=11`
