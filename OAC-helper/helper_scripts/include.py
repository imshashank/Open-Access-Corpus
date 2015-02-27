#DB Details
DB_HOST = 'localhost'
DB_NAME= 'corpus'
DB_USER = 'root'
DB_PASS= ''


'''
/Library/WebServer/Documents/oclc_project/db/corpus_fulldb.sql

docker run -d -p 3307:3306 -e MYSQL_PASS="OCLC_123" tutum/mysql

    sudo docker run -d -v /tmp:/tmp tutum/mysql /bin/bash -c "/import_sql.sh root OCLC_123 /Library/WebServer/Documents/oclc_project/db/corpus_fulldb.sql"

    sudo docker run -d -v /path/in/host:/var/lib/mysql -e STARTUP_SQL="/Library/WebServer/Documents/oclc_project/db/corpus_fulldb.sql" tutum/mysql


/usr/local/mysql/bin/mysql -u root -p -h localhost:3307 

docker exec -it 19dbfcc877f2 bash
'''