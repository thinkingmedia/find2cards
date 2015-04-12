#!/bin/sh

git pull
composer --no-interaction install
bower --allow-root install
cd sql
./import.sh
cd ..
chown -R www-data:www-data *
