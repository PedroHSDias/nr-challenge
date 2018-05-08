
# nr-challenge

## Tools  
- [MariaDB](https://hub.docker.com/_/mariadb/)
- [Composer](https://getcomposer.org/)
- [Laravel 5.3](https://laravel.com/docs/5.3#installing-laravel)
- [Docker](https://www.docker.com/community-edition#/download) **Used to mount the environment, any server with minimal requirements to run Laravel will be enough**
    - Docker-Compose

## Requeriments
- PHP cURL Enabled
- For Laravel
    - PHP between 5.6.4 & 7.1
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Mbstring PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension
    - Apache mod_rewrite enabled
- For Docker **Optional**
    - Win 10 Pro with Hyper-v support enabled or any distro linux compatible
    
 
## Instalation

Clone this repository in folder root from your server or any folder if use Docker
```
git clone https://github.com/
```
In the folder where you clone the project, run composer to download the Laravel dependencies
```
php composer install
```
or with Docker 
```
docker run --rm -i   -v /$(PWD):/app  composer install --ignore-platform-reqs --no-scripts
```
### Only for docker
Pull images and mount the container
```
docker-compose up -d
```
Docker will use [docker-compose](https://github.com/PedroHSDias/nr-challenge/blob/master/docker-compose.yml) to mount 
By default the [image](https://hub.docker.com/_/php/) used to mount the container not have all requirements for laravel, so it's necessary execute the  following steps:
To see containers id: 
```
docker ps
```
![alt text](https://github.com/PedroHSDias/nr-challenge/blob/master/resources/assets/docker-help-01.PNG)
To instal an enable pdo 
```
docker exec {idContainer} -it docker-php-ext-install pdo_mysql
```
```
docker exec {idContainer} docker-php-ext-enable pdo_mysql
```
To enable apache mod_rewrite
```
docker exec {idContainer} a2enmod rewrite
```
To load changes
```
docker exec {idContainer} /etc/init.d/apache2 reload
```
## Database
Use the script in [create_db.sql](https://github.com/PedroHSDias/nr-challenge/blob/master/create_db.sql) to create a database

Change the DB configuration in [.env](https://github.com/PedroHSDias/nr-challenge/blob/master/.env) to use database

# Now its ready
Access http://localhost/public/ or configure a v-host to folder public in project
    
In first access all in screen its a te name "Raspagem" and a link named "Busca tudo CNPQ"

To execute the crawler just click in "Busca tudo CNPQ", when the aplication will visiti all pages in http://www.cnpq.br/web/guest/licitacoes and get some informations from biddings and save in DB. The files refers appends in this biddings will be save in local host, folder [storage/app/public](https://github.com/PedroHSDias/nr-challenge/tree/master/storage/app/public).
Because the massive amount of information a (currently have more tan 1400 records)  this process can take some minutes.

#The code
The scripts more important in this project can be found in [business](https://github.com/PedroHSDias/nr-challenge/tree/master/app/Business) folder, they can be easily adapted to cli, persist in database and download appends to server are optional
