FROM ubuntu:trusty

# Install base packages
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && \
	apt-get install -yq git && \
    apt-get -yq install \
        curl \
        apache2 \
        libapache2-mod-php5 \
        php5-mysql \
        php5-gd \
        php5-curl \
        php-pear \
        php-apc && \
    rm -rf /var/lib/apt/lists/*
RUN sed -i "s/variables_order.*/variables_order = \"EGPCS\"/g" /etc/php5/apache2/php.ini
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add image configuration and scripts


RUN a2enmod rewrite

# Configure /app folder with sample app
RUN mkdir -p /app && rm -fr /var/www/html && ln -s /app /var/www/html

WORKDIR /app

RUN git clone https://github.com/imshashank/OAC-API.git

#sed -i 's/localhost/open-academia.org/g' /app/OAC_WEB_API/rest/db.php >> /app/OAC-API/rest/db.php

RUN chown -R www-data:www-data /app/* && \
	chown -R www-data:www-data /app/OAC-API/*

WORKDIR /etc/apache2/sites-available/

ADD run.sh /run.sh
RUN chmod 755 /*.sh

ADD open-academia.conf /etc/apache2/sites-available/open-academia.conf

RUN a2ensite open-academia.conf

RUN service apache2 restart

EXPOSE 80
WORKDIR /app
CMD ["/run.sh"]



#docker build -t imshashank/oac-web-api .

#docker run -i -t 

#docker run -i -t ubuntu:12.04 /bin/bash

#docker run -i -t -p 80:80 imshashank/oac-web-api /bin/bash

#sudo apt-get install libapache2-mod-auth-mysql php5-mysql


#sudo docker run -i -p 3306:3306 -e MYSQL_PASS="OCLC_123"  -v /mnt1/db/:/home -e STARTUP_SQL="/home/schema.sql" tutum/mysql /bin/bash

