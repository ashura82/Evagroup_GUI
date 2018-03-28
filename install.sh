#!/bin/bash


echo "Installation des differents Packages [En cours]"
apt-get install apt-transport-https -y > /dev/null 2>&1
wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg > /dev/null 2>&1
sh -c 'echo "deb https://packages.sury.org/php/ stretch main" > /etc/apt/sources.list.d/php.list' > /dev/null 2>&1
apt-get update > /dev/null 2>&1
apt-get upgrade -y > /dev/null 2>&1
apt-get install apache2 apt-transport-https ca-certificates php7.1-apcu php7.1-bcmath php7.1-cli php7.1-curl php7.1-fpm php7.1-gd php7.1-intl php7.1-mcrypt php7.1-mysql php7.1-soap php7.1-xml php7.1-zip php7.1-mbstrin git -y > /dev/null 2>&1
service apache2 restart > /dev/null 2>&1
echo "Installation des differents Packages       [OK]"

echo "Configuration Apache                 [En cours]"
a2enmod proxy_fcgi setenvif > /dev/null 2>&1
a2enconf php7.1-fpm > /dev/null 2>&1
a2enmod rewrite > /dev/null 2>&1
systemctl restart apache2  > /dev/null 2>&1

rm -rf /var/www/html/ > /dev/null 2>&1
git clone https://github.com/ashura82/Evagroup_GUI /opt/gui > /dev/null 2>&1
cd /opt/gui > /dev/null 2>&1

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" > /dev/null 2>&1
php composer-setup.php --filename=composer.phar > /dev/null 2>&1
php -r "unlink('composer-setup.php');" > /dev/null 2>&1
php composer.phar install > /dev/null 2>&1

cp .env.example .env > /dev/null 2>&1
chmod 777 -R storage bootstrap/cache > /dev/null 2>&1
php artisan key:generate > /dev/null 2>&1
mv /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf.bak > /dev/null 2>&1
cp /opt/gui/resources/files/apache2/000-default.conf /etc/apache2/sites-available/000-default.conf > /dev/null 2>&1

echo "Entrer l'IP du reverse proxy : "
read ip
echo "Entrer le port du reverse proxy : "
read port

sed -i "s/API_IP=192.168.10.44/API_IP=$ip/g" /opt/gui/.env
sed -i "s/API_PORT=8010/API_PORT=$port/g" /opt/gui/.env

systemctl restart apache2 > /dev/null 2>&1
if [ $? -ne 0 ]
then
	echo "Configuration Apache                      [NOK]"
fi
echo "Configuration Apache                       [OK]"
