FROM ubuntu
#install php
RUN apt-get update
RUN apt-get install -y apache2
RUN apt-get install -y php5 libapache2-mod-php5 php5-mcrypt
RUN apt-get install -y build-essential
RUN apt-get install -y libreadline-gplv2-dev libncursesw5-dev libssl-dev libsqlite3-dev tk-dev libgdbm-dev libc6-dev libbz2-dev


#install python and pip
RUN apt-get install -y libsqlite3-dev
RUN apt-get install -y sqlite3 # for the command-line client
RUN apt-get install -y bzip2 libbz2-dev
RUN apt-get install -y wget
RUN wget http://www.python.org/ftp/python/3.3.5/Python-3.3.5.tar.xz
RUN tar xJf ./Python-3.3.5.tar.xz
RUN cd ./Python-3.3.5
RUN ./configure --prefix=/opt/python3.3
RUN ake && sudo make install
RUN echo 'alias py="/opt/python3.3/bin/python3.3"' >> .bashrc

#install rewuirements for scripts
RUN apt-get install -y python-mysqldb
RUN apt-get install -y python-pip
RUN pip install -U pip
RUN apt-get install -y python-dev libmysqlclient-dev
RUN pip install MySQL-python

RUN apt-get install -y python-stdnum
RUN pip install mechanize
RUN pip install pytz

RUN service apache2 restart
EXPOSE 80


