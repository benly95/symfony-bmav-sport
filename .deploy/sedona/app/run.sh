#!/bin/bash

#make install-wait-for-it

echo "\033[30;48;5;82m > Wait to MySQL ready -------------------------------------------------------- \033[0m"; \
#wait-for-it $MYSQL_HOST:$MYSQL_PORT -s -t 500 -- echo "        >  MySQL is ready"

echo "\033[30;48;5;82m > Install project -------------------------------------------------------- \033[0m"; \
composer install
#make install
echo "\033[30;48;5;82m > Install project done -------------------------------------------------------- \033[0m"; \

[ -d var/cache ] || mkdir -p var/cache && \
[ -d var/log ] || mkdir -p var/log && \
chmod -R 777 var/cache var/log
