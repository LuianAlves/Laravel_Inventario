<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instalação do Projeto ...

 #Instalando o Composer:
 
     $ composer install --no-scripts
     
#Copie o arquivo .env.example

    $ cp .env.example .env

#Crie uma key para o projeto

    $ php artisan key:generate

#Configurar o o arquivo .env com base no seu Banco de Dados


#Execute as migrations

    $ php artisan migrate --seed
    
<hr>

#Acesse a Tabela 'extras' no Banco de Dados e adicione um valor Default na Coluna 'vat' para ser calculado o imposto sobre os produtos, utilizei como exemplo o valor '5'.
