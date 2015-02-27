FROM ubuntu:trusty

# Install packages
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && \
  apt-get -y install wget && \
  apt-get -yq install mysql-server-5.5 pwgen && \
  rm -rf /var/lib/apt/lists/*

# Remove pre-installed database
RUN rm -rf /var/lib/mysql/*

#RUN wget https://s3-us-west-2.amazonaws.com/oclc/ENGLISH.Nov24.2014.pytext.zip && \
#  chmod 777 /ENGLISH.Nov24.2014.pytext.zip && \
#  mkdir /corpus && \
#  chmod 777 /corpus && \
#  unzip ENGLISH.Nov24.2014.pytext.zip -d /corpus/ && \
#  rm ENGLISH.Nov24.2014.pytext.zip && \
#  mv /corpus/corpus.pytext /corpus.pytext


# Add MySQL configuration
ADD my.cnf /etc/mysql/conf.d/my.cnf
ADD mysqld_charset.cnf /etc/mysql/conf.d/mysqld_charset.cnf

# Add MySQL scripts
#ADD import_sql.sh /import_sql.sh
ADD run.sh /run.sh
ADD start.sh /start.sh
RUN chmod 755 /*.sh

# Exposed ENV
ENV MYSQL_USER admin
ENV MYSQL_PASS OCLC_123


# Replication ENV
ENV REPLICATION_MASTER **False**
ENV REPLICATION_SLAVE **False**
ENV REPLICATION_USER replica
ENV REPLICATION_PASS replica



RUN wget https://raw.githubusercontent.com/imshashank/OAC-DB-API/master/schema.sql && \
	chmod 755 /schema.sql
	
# Add VOLUMEs to allow backup of config and databases
#VOLUME  ["/etc/mysql", "/var/lib/mysql"]

EXPOSE 3306
CMD ["/run.sh"]


#ADD schema.sql /schema.sql

CMD ["/start.sh"]


#RUN /usr/bin/mysqld_safe & && \
#  sleep 5 && \
#  mysql -u"admin" -p"OCLC_123" < "/schema.sql" && \
#  apt-get -y install python-mysqldb && \
#  python /builder.py


#docker run -d -p 3306:3306 -e MYSQL_PASS="OCLC_123" -v /mnt1/db/:/home/  -e STARTUP_SQL="/home/schema.sql" tutum/mysql

#sudo docker run -d -p 3306:3306 -e MYSQL_PASS="OCLC_123"  -v /mnt1/:/home -e STARTUP_SQL="/home/schema.sql" tutum/mysql



