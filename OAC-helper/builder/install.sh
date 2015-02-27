echo "Installing MySQL 5.0.."
sudo apt-get install -qqy debconf-utils
cat << EOF | debconf-set-selections
mysql-server-5.0 mysql-server/root_password password OAC_123
mysql-server-5.0 mysql-server/root_password_again password OAC_123
mysql-server-5.0 mysql-server/root_password seen true
mysql-server-5.0 mysql-server/root_password_again seen true
EOF
/usr/bin/apt-get -y install mysql-server-5.0 mysql-server

echo "importing mysql schema"

mysql -u root -pOAC_123 corpus < schema.sql

echo "getting the lasest corpus from web"

#wget <url>

echo "Populatin the DB"
python builder.py

echo "the database is ready for use"

echo "installing apache2"

echo "moving file to /var/www/OAC API"
#mkdir /var/www/OAC
echo "Starting the API"
