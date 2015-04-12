# Memory [![Build Status](https://travis-ci.org/thinkingmedia/find2cards.svg)](https://travis-ci.org/thinkingmedia/find2cards) [![Code Climate](https://codeclimate.com/github/thinkingmedia/find2cards/badges/gpa.svg)](https://codeclimate.com/github/thinkingmedia/find2cards)

This is a multi-player game of [Concentration](http://en.wikipedia.org/wiki/Concentration_%28game%29) built on the LAMP stack with AngularJS on the front-end.

See a working demo at: [www.find2cards.com](http://www.find2cards.com)

## Why?

It's a sample project that I can provide to companies that request a working sample of my work. Everything is built from the ground up and was designed to showcase the following technical skills.

- Use of a MVC framework (this project uses CakePHP 3.x)
- Implementation of a JSON API.
- Front-end interactions using AngularJS.
- SASS compiled CSS files.
- Concurrent operation with multiple players.
- Something that would be fun to play with.

# Install Guide

Quick Start Guide. I'll add more details shortly. Fork this project, deploy and enjoy.

    $ git clone http://github/<username>/find2cards find2cards
    $ cd find2cards
    $ composer install
    $ bower install
    $ cd sql
    $ ./create.sh <mysql_root_password>
    $ ./import.sh
    $ cd ..
    $ touch config/hybridauth.secret.php
    
There is also a `deploy.sh` to update a production server with latest from Git (*warning: It erases the database*).
    
# Project Dependencies

This project requires the following to work.

- Latest LAMP stack `sudo apt-get install lamp-server^`
- The Apache2 mod_rewrite module must be enabled.
- PHP must have `intl` installed `sudo apt-get install php5-intl`
- If you don't have access to MySQL root user. See the `sql/create.sql` as a guide for creating the database.
