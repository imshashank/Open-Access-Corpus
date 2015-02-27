#/bin/bash

if [ ! -f /var/lib/mysql/ibdata1 ]; then

    mysql_install_db

    /usr/bin/mysqld_safe &
    sleep 10s

    echo "GRANT ALL ON *.* TO corpus@'%' IDENTIFIED BY 'OCLC_123' WITH GRANT OPTION; FLUSH PRIVILEGES" | mysql

	sleep 5
	echo "CREATE DATABASE corpus" | mysql
	echo "corpus < /Library/WebServer/Documents/oclc_project/db/corpus.sql" | mysql

    killall mysqld
    sleep 10s
fi

/usr/bin/mysqld_safe