#!/bin/bash
apt-get update
/usr/bin/mysqld_safe &
sleep 5
mysql -u"admin" -p"OCLC_123" < "/schema.sql"
apt-get -y install python-mysqldb
apt-get install -y tar \
                   git \
                   curl \
                   nano \
                   wget \
                   dialog \
                   net-tools
                   build-essential
apt-get install -y python python-dev python-distribute python-pip

python /builder.py