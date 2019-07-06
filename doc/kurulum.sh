#!/bin/bash

echo "calisiyor"

apt-get update
apt-get install -y -qq apache2
apt-get install -y -qq php7.0

:>/etc/apache2/mods-available/dir.conf
echo "<IfModule mod_dir.c>
	DirectoryIndex index.html index.cgi index.pl index.php index.xhtml index.htm
      </IfModule>" > /etc/apache2/mods-available/dir.conf
	
apt-get install -y -qq php7.0-cli
apt-get install libapache2-mod-php7.0

a2enmod ssl
a2enmod rewrite
a2enmod suexec
a2enmod include

systemctl restart apache2

echo "birazdan mysql icin root sifresi belirlemeniz gerekecek"

apt-get install -y -qq mysql-server
apt-get install -y -qq php7.0-mysql
apt-get install -y -qq php-mysql

stty -echo
echo "Mysql sifreniz(yazarken gozukmez)"
read password
stty echo

mysql -u root -p$password -Bse "CREATE DATABASE vulsite"

mysql -u root -p$password vulsite < data.sql

mysql -u root -p$password -Bse "GRANT ALL PRIVILEGES ON vulsite.* To 'testkullanici'@'localhost' IDENTIFIED BY 'testkullanicisifre'"

cp * /var/www/html/
chmod -R 765 /var/www/html/*

systemctl restart apache2

xdg-open http://localhost

echo "bitti"
echo "acilmadiysa tarayicinizda 127.0.0.1 adresine gidin"

