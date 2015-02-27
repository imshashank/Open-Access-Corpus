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
#ADD my.cnf /etc/mysql/conf.d/my.cnf
#ADD mysqld_charset.cnf /etc/mysql/conf.d/mysqld_charset.cnf


#RUN dpkg-divert --local --rename --add /sbin/initctl
#RUN ln -s /bin/true /sbin/initctl

#RUN echo "deb http://archive.ubuntu.com/ubuntu precise main universe" > /etc/apt/sources.list
#RUN apt-get update
#RUN apt-get upgrade -y

#RUN apt-get -y install mysql-server
#RUN apt-get -y install mysql-server-5.5 libapache2-mod-auth-mysql php5-mysql

RUN sed -i -e"s/^bind-address\s*=\s*127.0.0.1/bind-address = 0.0.0.0/" /etc/mysql/my.cnf

ADD ./startup.sh /opt/startup.sh

EXPOSE 3306

CMD ["/bin/bash", "/opt/startup.sh"]