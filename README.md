# Memory [![Build Status](https://travis-ci.org/thinkingmedia/memory.svg)](https://travis-ci.org/thinkingmedia/memory) [![Code Climate](https://codeclimate.com/github/thinkingmedia/memory/badges/gpa.svg)](https://codeclimate.com/github/thinkingmedia/memory)

This is a mobile-friendly multi-player game of [Memory](http://en.wikipedia.org/wiki/Concentration_%28game%29) built on the LAMP stack with AngularJS on the front-end.

See a working demo at: [memory.thinkingmedia.ca](http://memory.thinkingmedia.ca)

## Why?

It's a sample project that I can provide to companies that request a working sample of my work. The project represents what I can build in **2 work days** given just a simple concept. Everything is built from the ground up and was designed to showcase the following technical skills.

- Use of a MVC framework (this project uses CakePHP 3.x)
- Implementation of a REST API.
- Front-end interactions using AngularJS.
- SASS compiled CSS files.
- Responsive mobile friendly design.
- Concurrent operation with multiple players.
- Something that would be fun to play with.

# Unit Tests

**n/a** [![Test Coverage](https://codeclimate.com/github/thinkingmedia/memory/badges/coverage.svg)](https://codeclimate.com/github/thinkingmedia/memory)

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
    
# Project Dependencies

This project requires the following to work.

- Latest LAMP stack `sudo apt-get install lamp-server^`
- The Apache2 mod_rewrite module must be enabled.
- PHP must have `intl` installed `sudo apt-get install php5-intl`
- If you don't have access to MySQL root user. See the `sql/create.sql` as a guide for creating the database.
