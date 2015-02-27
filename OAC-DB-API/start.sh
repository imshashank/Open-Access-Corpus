#!/bin/bash
/usr/bin/mysqld_safe &
sleep 5
mysql -u"admin" -p"OCLC_123" < "/schema.sql"
apt-get -y install python-mysqldb
python /builder.py
