## Sistema-ipra
>>>>>>> 126d2919ac595eb0ebb81a48326073597d5211fd

Eh um sistema open source que pode ser usado para coleita de dados para o calculo de valor patrimonial.
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
- docker exec -it ipra_form_app php artisan migrate --seed

Acessar shell do container
- docker exec -it ipra_form_app bash



# Para Producao  execute os comandos 
#
	-> docker-compose -f docker-compose.prod.yml build --no-cache



#
	-> docker-compose -f docker-compose.prod.yml up -d


#
	-> docker exec -it container_name bash
	
# run composer install command inside app container
	root@Container_id:/var/www# composer install
	root@Container_id:/var/www# php artisan key:generate
	
# run this command and copy the generated APP_KEY to the .env file  Variable APP_KEY;
	root@Container_id:/var/www# cat .env | grep APP_KEY
	
# inside .env  
	APP_KEY = ADD_GENERATED_APP_KEY
	
# return inside the container  to execute the below commands
# run this command to clear all the cache
	root@Container_id:/var/www# php artisan config:clear
								php artisan cache:clear
								php artisan route:clear
								php artisan view:clear
								php artisan optimize
								
								
# outside the container run those command 
 -> docker-compose -f docker-compose.prod.yml down
 -> docker-compose -f docker-compose.prod.yml up -d --build
 
 -> docker exec -it container_name bash -lc "php artisan config:clear && php artisan cache:clear && php artisan optimize"
 
 
 
 # run this docker command to create databases tables and  seed them
 -> docker exec -it ipra_form_app bash -lc "php artisan migrate --seed"

								
	
