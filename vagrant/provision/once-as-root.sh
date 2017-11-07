#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive

#== Import script args ==

timezone=$(echo "$1")

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

apt-get install python-software-properties
LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php -y

info "Set config for MySQL"

MYSQL_ROOT_PASSWORD='vagrant'

echo "mysql-server mysql-server/root_password password $MYSQL_ROOT_PASSWORD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $MYSQL_ROOT_PASSWORD" | debconf-set-selections

echo "Done!"

info "Configure locales"
update-locale LC_ALL="C"
dpkg-reconfigure locales

info "Configure timezone"
echo ${timezone} | tee /etc/timezone
dpkg-reconfigure --frontend noninteractive tzdata

info "Update OS software"
apt-get update
apt-get upgrade -y

info "Install additional software"
apt-get install -y git nginx vim mc mysql-server php7.1-curl php7.1-cli php7.1-intl php7.1-fpm php7.1-xml php7.1-mbstring php7.1-imagick php7.1-mysql

info "Enabling site configuration"
cp /var/www/vagrant/nginx/app.conf /etc/nginx/sites-available/app.conf
ln -s /etc/nginx/sites-available/app.conf /etc/nginx/sites-enabled/app.conf
echo "Done!"

info "Create 'env' config file"
cp -rf /var/www/.env.example /var/www/.env

info "Configure MySQL"
sed -i "s/.*bind-address.*/#bind-address = 127.0.0.1/" /etc/mysql/my.cnf
echo "Done!"

info "Configure PHP"
sed -i "s/.*date.timezone.*/date.timezone = $timezone/" /etc/php/7.1/fpm/php.ini
sed -i "s/.*date.timezone.*/date.timezone = $timezone/" /etc/php/7.1/cli/php.ini
echo "Done!"

info "Initailize databases for MySQL"
mysql -uroot -p$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE bank DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci; GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '$MYSQL_ROOT_PASSWORD' WITH GRANT OPTION;"
echo "Done!"

info "Install composer"
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer