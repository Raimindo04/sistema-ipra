## Sistema-ipra
>>>>>>> 126d2919ac595eb0ebb81a48326073597d5211fd

Eh um sistema opensouce que pode ser usado para coleita de dados para o calculo de valor patrimonial.
NB: Assume-se que ja tenha o docker instalado.

## Como instalar
Clonar o repositorio do github

- git clone https://github.com/Raimindo04/sistema-ipra.git
- cd sistema-ipra

Criar e configurar o arquivo
- cp .env.example .env

## para correr em ambiente de desenvolvimento

Construir e subir os containers

- docker-compose up -d --build



Gerar chave da aplicação
- docker exec -it ipra_form_app php artisan key:generate

Rodar migrations
docker exec -it ipra_form_app php artisan migrate --seed

Acessar shell do container
docker exec -it ipra_form_app bash



# Para Producao  execute os comandos 
Gere a build otimizada para construir e subir os containers:
docker-compose -f docker-compose.prod.yml up -d --build

Gerar chave da aplicação
docker exec -it ipra_form_app php artisan key:generate

Rodar migrations
docker exec -it ipra_form_app php artisan migrate --seed --force

Acessar shell do container
docker exec -it ipra_form_app bash

(Opcional) Gere cache Laravel para máxima performance:
docker exec -it ipra_form_app php artisan optimize
