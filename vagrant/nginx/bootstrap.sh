#!/usr/bin/env bash

sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

apt-get update
apt-get -y install git mysql-server \
    unzip \
    curl \
    nginx \
    php7.0 \
    php-xml \
    php-mysql \
    php-fpm

sed -i "s/^bind-address/#bind-address/" /etc/mysql/my.cnf
mysql -u root -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root' WITH GRANT OPTION; FLUSH PRIVILEGES; SET GLOBAL max_connect_errors=10000;"
mysql -u root -proot -e "CREATE DATABASE dealerapp;"
sudo /etc/init.d/mysql restart

cp /vagrant/vagrant/nginx/default.conf /etc/nginx/sites-available/default

if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi


if [ -e /usr/bin/composer ]; then
    /usr/bin/composer self-update
else
    curl -sS https://getcomposer.org/installer \
      | php -- --install-dir=/usr/bin --filename=composer
fi

cd /vagrant
composer update

service nginx restart
service php7.0-fpm restart

echo "** [ZF] Run the following command to install dependencies, if you have not already:"
echo "    vagrant ssh -c 'composer install'"
echo "** [ZF] Visit http://192.168.1.100 in your browser for to view the application **"
