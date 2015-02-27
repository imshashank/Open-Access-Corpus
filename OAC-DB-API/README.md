OAC-DB-API
==========

Usage:

You only need to clone the repo and when inside the repo folder run the dockerfile:

    sudo docker run -d -p 3306:3306 -e MYSQL_PASS="OCLC_123"  -v /<path-to-current-dir>/:/home -e STARTUP_SQL="/home/schema.sql" tutum/mysql

The server will start

Then run

    sudo wget https://s3-us-west-2.amazonaws.com/oclc/ENGLISH.Nov24.2014.pytext.zip
    sudo unzip ENGLISH.Nov24.2014.pytext.zip d ./
    sudo python builder.py

This will do the following:
- Get the image
- Install mysql and add user
- Use schema.sql to create tables and relations
- Download latest corpus version
- use builder.py to populate the database

