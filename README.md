# super-zapatos

VAGRANT CONFIGURATION TESTED ON OSX 10.11.6

# Vagrant + Puppet base

This is the base configuration of the project, using Puphpet

## Requirements:
* Have installed ruby [RVM](http://rvm.io/)

* Download and Install the latest version of [VirtualBox](https://www.virtualbox.org/wiki/Downloads). If you have Virtual Box already installed, please make sure you update the version to at least 4.3.6

* Download their Extension Pack [at the same link](https://www.virtualbox.org/wiki/Downloads).

* Download and Install latest version [Vagrant](http://www.vagrantup.com/downloads.html). If you already have an older version o vagrant please uninstall it using "gem uninstall vagrant" before attempting to install the new one.

## Set Up

To install Vagrant Hostmaster just open __Terminal__ application and type:

    vagrant plugin install vagrant-hostsupdater

Clone the entire project.

    git clone https://github.com/hangarcr/sh-premiumip-webapp.git

Start vagrant:

    vagrant up

Everytime you do a __vagrant up__ your computer password could be requested in order to modify your __/etc/hosts__ file.

After *vagrant up* you can access on the browser the following url: super-zapatos-backpack.dev

## Notes

You can edit the IP value, just open __config.yaml__ located in puphet folder and edit the following line:

    private_network: 192.168.56.110

You can connect SSH to the VM server using:

    vagrant ssh

To shutdown the VM server just type:

    vagrant halt

You can get rid of the VM server using the command:

    vagrant destroy

## Create vendor folder

Laravel needs vendor folder to works
To create vendor folder connect via ssh:

	vagrant ssh

Go to project folder:

	cd /var/www/super-zapatos/
Run composer command:

	composer install

Create database schema if doesn't exists

    mysql -uroot -123
    create database super_zapatos;
    exit

Run migrations

    php artisan migrate

Run seeds

    php artisan db:seed


##Project Files

All the files are located on 

	./backend/project/super-zapatos

.env database connection could need:

	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=super_zapatos
	DB_USERNAME=root
	DB_PASSWORD=123

This Project was created with [Backpack](https://backpackforlaravel.com/) as Admin GUI.

##JSON Services

You can visit [POSTMAN DOCS](https://documenter.getpostman.com/view/2611029/superzapatos/6n8wrAA) in order to check the services docs.
	
	http://super-zapatos-backpack.dev/services/stores
	http://super-zapatos-backpack.dev/services/articles
	http://super-zapatos-backpack.dev/services/stores/:id/articles

Notes: Remember replace :id by a current id of existing store

##XML Services

You can visit [POSTMAN DOCS](https://documenter.getpostman.com/view/2611029/superzapatos/6n8wrAA) in order to check the services docs.

	http://super-zapatos-backpack.dev/api/services/stores
	http://super-zapatos-backpack.dev/api/services/articles
	http://super-zapatos-backpack.dev/api/services/stores/:id/articles

Notes: Remember replace :id by a current id of existing store

##HTTP AUTH Credentials:

You can find the HTTP Credentials on BasicAuthJsonMiddleware or BasicAuthXMLMiddleware

##Admin Tool

URL: /admin
Credentials: You can find the credentials on SuperZapatosDevTablesSeeder.php

#PHPUnit

If you want to run phpunit, you can use
	
	./vendor/bin/phpunit

