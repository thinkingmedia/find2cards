# Memory [![Build Status](https://travis-ci.org/thinkingmedia/memory.svg)](https://travis-ci.org/thinkingmedia/memory) [![Code Climate](https://codeclimate.com/github/thinkingmedia/memory/badges/gpa.svg)](https://codeclimate.com/github/thinkingmedia/memory)

# Unit Tests

[![Test Coverage](https://codeclimate.com/github/thinkingmedia/memory/badges/coverage.svg)](https://codeclimate.com/github/thinkingmedia/memory)

# Install Guide

These instructions are for a freely installed Ubuntu server. Such as those found on DigitalOcean cloud hosting platform. The instructions are intended to fast-track the configuring and running of the game, but are as a guide only. They do not include any security steps required to secure the server.

## Install LAMP

Install and configure the LAMP stack server for Ubuntu. If you already have PHP/Apache/MySQL installed, then skip the related steps in these instructions.

    $ sudo apt-get update
    $ sudo apt-get install lamp-server^
    
Enable the `rewrite_mod` for Apache.
    
    $ cd /etc/apache2/mods-enabled
    $ ln -s ../mods-available/rewrite.load rewrite.load
    
## Configure PHP
    
PHP must have `ext-intl` installed for this source code to work.

    $ sudo apt-get install php5-intl
    
## Configure Apache

Add a new website config for Apache to run the game.

    $ sudo nano /etc/apache2/sites-available/memory.conf
    
Create the following virtual host configuration for Apache. We will be using Git to install the game to `/var/memory` on the server.

> Note: Replace the domain `memory.thinkingmedia.ca` with your own DNS or localhost.

    <VirtualHost *>
        ServerName memory.thinkingmedia.ca
        DocumentRoot /var/memory/webroot
        
        <Directory /var/memory>
            Options FollowSymLinks
            AllowOverride all
            Require all granted
        </Directory>
        
        ErrorLog ${APACHE_LOG_DIR}/error.memory.log
        CustomLog ${APACHE_LOG_DIR}/access.memory.log combined
    </VirtualHost>
    
Enable the new Apache virtual host

    $ sudo ln -s /etc/apache2/sites-available/memory.conf /etc/apache2/sites-enabled/memory.conf
    
Restart the Apache2 server

    $ sudo service apache2 restart
    
> Note: Apache will complain that the web root doesn't exist. That's done in the next step.

## Install Git

To download the source code you will need Git.

    $ apt-get install -y git
   
Now install the game to `/var/memory` (or a location of your choice)

    $ git clone https://github.com/thinkingmedia/memory /var/memory
    
You need to change the owner of the files to `www-data` so that Apache can access the folder.

    $ sudo chown -R www-data:www-data /var/memory

## Install Database

The game uses a MySQL database to track game history, match making and users. To create the database you'll need the root password for MySQL.

    $ cd /var/memory/sql
    $ ./create.sh <password>
    $ ./import.sh

> Note: You don't have to recreate the database later. If the SQL files are updated just run `./import.sh` again, but your old **data** will be lost.

## Install Development Tools

You will need the following to make changes to this project:

- `composer` for PHP components.
- `npm` for NodeJS modules.
- `bower` for front-end libraries.
- `grunt` for building front-end components.
- `SASS` for front-end CSS libraries.

## Composer Components

All the PHP libraries required by this project are installed via `composer`.

Here's a quick way to install `composer`.

    $ sudo curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

Now install the components for the game.
    
    $ cd /var/memory
    $ composer install
    
## Bower Components

To use `bower` you will need to install NodeJS and NPM.

    $ curl -sL https://deb.nodesource.com/setup | sudo bash -
    $ sudo apt-get install -y nodejs
    $ sudo npm install -g bower
    $ cd /var/memory
    $ bower install
