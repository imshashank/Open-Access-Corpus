#!/bin/bash
chown www-data:www-data /app -R
source /etc/apache2/envvars
service start apache2
exec apache2 -D FOREGROUND
