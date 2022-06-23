About this project
------------
This project is about Getting used to Symfony. Creating a website for renting cars. 

#### Requirements
- OS: Ubuntu 20.04. [Install Ubuntu](https://phoenixnap.com/kb/install-ubuntu-20-04)
- PHP : v8.0 or higher. [Install PHP](https://nextgentips.com/2022/01/31/how-to-install-php-8-1-on-ubuntu-20-04/?noamp=mobile)
- MySQL : v8.0. [Install MySQL](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04)
- Composer : v2.3.7.[Install Composer](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04)
- Nginx : v1.18.0. [Install Nginx](https://www.digitalocean.com/community/tutorials/how-to-install-nginx-on-ubuntu-20-04)

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
$ cd SymfonyCarForRent/

$ composer install
``` 

Usage
------------
 - Method 1:

You can see [How to configure a Web Server for Symfony](https://symfony.com/doc/current/setup/web_server_configuration.html) with Nginx
- Method 2:
```sh  
$ symfony server:start
```   
Then simply browse to the address [localhost:8000](http://localhost:8000/) in your browser


- API:
```sh  
$ php bin/console lexik:jwt:generate-keypair
``` 

## Authors

- [@ntsanq](https://www.github.com/ntsanq)
