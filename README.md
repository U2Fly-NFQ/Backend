<p align="center"><a href="https://symfony.com" target="_blank">
    <img src="https://symfony.com/logos/symfony_black_02.svg">
</a></p>

**Symfony** is a **PHP framework** for web and console applications and a set
of reusable **PHP components**. Symfony is used by thousands of web
applications and most of `the popular PHP projects` .

About this project
------------
This project is about Getting used to Symfony. Creating a website for renting cars. 

### Requirements
- OS: Ubuntu 20.04. [Install Ubuntu](https://phoenixnap.com/kb/install-ubuntu-20-04)
- PHP : v8.0 or higher. [Install PHP](https://nextgentips.com/2022/01/31/how-to-install-php-8-1-on-ubuntu-20-04/?noamp=mobile)
- MySQL : v8.0. [Install MySQL](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04)
- Composer : v2.3.7. Install Composer [Install Composer](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04)

Set up
------------
Clone this project:
```sh  
$ git clone https://github.com/ntsanq/SymfonyCarForRent.git
``` 

Install Symfony CLI:
```sh  
$ echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | sudo tee /etc/apt/sources.list.d/symfony-cli.list

$ sudo apt update

$ sudo apt install symfony-cli
```  

Install the project's dependency into vendor:
```sh  
$ composer install
``` 

Installing packages:
```sh  
$ composer require logger

$ composer require annotations

$ composer require twig

$ composer require symfony/expression-language

$ composer require sensio/framework-extra-bundle
``` 


Usage
------------
```sh  
$ symfony server:start
```   
Then browse to the address [localhost:8000](http://localhost:8000/) in your browser

## Authors

- [@ntsanq](https://www.github.com/ntsanq)
