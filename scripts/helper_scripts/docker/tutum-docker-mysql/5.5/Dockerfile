FROM ubuntu:trusty
MAINTAINER Fernando Mayo <fernando@tutum.co>, Feng Honglin <hfeng@tutum.co>

# Install packages
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && \
  apt-get -yq install mysql-server-5.5 pwgen && \
  rm -rf /var/lib/apt/lists/*

# Remove pre-installed database
RUN rm -rf /var/lib/mysql/*

# Add MySQL configuration
ADD my.cnf /etc/mysql/conf.d/my.cnf
ADD mysqld_charset.cnf /etc/mysql/conf.d/mysqld_charset.cnf

# Add MySQL scripts
ADD import_sql.sh /import_sql.sh
ADD run.sh /run.sh
RUN chmod 755 /*.sh

# Exposed ENV
ENV MYSQL_USER corpus
ENV MYSQL_PASS OCLC_123

# Replication ENV
ENV REPLICATION_MASTER **False**
ENV REPLICATION_SLAVE **False**
ENV REPLICATION_USER replica
ENV REPLICATION_PASS replica

# Add VOLUMEs to allow backup of config and databases
VOLUME  ["/etc/mysql", "/var/lib/mysql"]

EXPOSE 3306
CMD ["/run.sh"]


#docker run -d -p 3306:3306 -e MYSQL_PASS="OCLC_123" tutum/mysql
#docker build -t tutum/mysql
#docker run -d -p 3306:3306 -e MYSQL_PASS="mypass"
#docker run -d -v /tmp:/tmp tutum/mysql /bin/bash -c "/import_sql.sh corpus OCLC_123 /Library/WebServer/Documents/oclc_project/db/corpus.sql"

#/usr/local/mysql/bin/mysql -u corpus -p -h 172.17.0.16



