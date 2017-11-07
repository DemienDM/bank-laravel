#!/usr/bin/env bash

#== Import script args ==

github_token=$(echo "$1")

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

info "Configure composer"
composer config --global github-oauth.github.com ${github_token}
echo "Done!"

info "Install plugins for composer"
composer global require "fxp/composer-asset-plugin:^1.2.0" --no-progress

info "Install codeception"
composer global require "codeception/codeception=2.0.*" "codeception/specify=*" "codeception/verify=*" --no-progress
echo 'export PATH=/home/vagrant/.config/composer/vendor/bin:$PATH' | tee -a /home/vagrant/.profile

info "Install project dependencies"
cd /var/www
composer --no-progress --prefer-dist install

info "Create bash-alias 'app' for vagrant user"
echo 'alias app="cd /var/www"' | tee /home/vagrant/.bash_aliases

info "Enabling colorized prompt for guest console"
sed -i "s/#force_color_prompt=yes/force_color_prompt=yes/" /home/vagrant/.bashrc

info "generate autoload files"
composer dump-autoload

info "Set the application key"
php artisan key:generate

info "Create DB"
php artisan migrate

info "Fill DB"
php artisan db:seed

info "Calculate the commission"
php artisan deposit-calculate:commission

info "Calculate the interest"
php artisan deposit-calculate:interest

info "Add Cron job"
(crontab -u vagrant -l; echo "* * * * * php /var/www/artisan schedule:run >> /dev/null 2>&1" ) | crontab -u vagrant -
