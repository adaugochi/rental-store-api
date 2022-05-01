<h1 align="center">
    <a href="https://macadaa.herokuapp.com/" target="_blank">
        Rental Store
    </a>
</h1>

<p align="center">
    <a href="https://laravel.com/docs/8.x/installation">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"  width="100" alt="License">
    </a>
</p>

## About
The store rents out books and equipment to users.

## Features
- ERD for the database. Located `project_directory/public/images/ERD.png`
- Endpoints
- Postman collection. Located `project_directory/public/RentalStore.postman_collection.json`
- Check Logs. Command to run is seen below
```bash
php artisan check:logs
```

## Requirements
- PHP 7.4
- composer

## Clone
You have to clone this repo using either `HTTPS` or `SSH`

- HTTPS
```bash
git clone https://github.com/adaugochi/rental-store-api.git
```

- SSH
```bash
git clone git@github.com:adaugochi/rental-store-api.git
```

## Install Dependencies
#### Composer Dependencies
```bash
composer install
```

## Virtual Host Setup (optional)

*Windows*
[Link 1](http://foundationphp.com/tutorials/apache_vhosts.php)
[Link 2](https://www.kristengrote.com/blog/articles/how-to-set-up-virtual-hosts-using-wamp)

*Mac*
[Link 1](http://coolestguidesontheplanet.com/set-virtual-hosts-apache-mac-osx-10-9-mavericks-osx-10-8-mountain-lion/)
[Link 2](http://coolestguidesontheplanet.com/set-virtual-hosts-apache-mac-osx-10-10-yosemite/)

*Debian Linux*
[Link 1](https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-14-04-lts)
[Link 2](http://www.unixmen.com/setup-apache-virtual-hosts-on-ubuntu-15-04/)

Sample Virtual Host Config for Apache
```apache
<VirtualHost *:80>
    ServerAdmin admin@example.com
    DocumentRoot "<WebServer Root Dir>/rental-store-api/public"
    ServerName local.manup.com
    <Directory <WebServer Root Dir>/rental-store-api/public>
       AllowOverride all
       Options -MultiViews
      Require all granted
    </Directory>
</VirtualHost>
```

## Environment Variables
Make a copy of `.env.example` to `.env` in the env directory.

## Setup Database

#### Create Database
```sql
CREATE DATABASE rental_store;
```

### Migration
```bash
php artisan migrate
```

### Specify Path
```bash
php artisan migrate --path=database/migrations/filename.php
```

### Seeding
```bash
php artisan db:seed --class=UserRentSeeder
```

## Starting the Application
You can run the application in development mode by running this command from the project directory:
```bash
php artisan serve
```

## Author of README.md
- Adaa Mgbede <adaamgbede@gmail.com>

## Credits
- Adaa Mgbede <adaamgbede@gmail.com>
