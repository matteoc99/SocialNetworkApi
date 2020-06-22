# Laravel setup guide

**Server Setup**

```
sudo apt update
apt upgrade
sudo apt install php7.4-fpm php7.4-mbstring php7.4-xmlrpc php7.4-soap php7.4-gd php7.4-xml php7.4-cli php7.4-zip composer nginx
sudo apt-get install php7.4-mysql
sudo apt install mysql-server
install node and npm:  https://nodejs.org/en/
```
**UFW**

```
sudo ufw allow http
sudo ufw allow https
sudo ufw allow ssh
sudo ufw allow 2222/tcp
sudo ufw allow ftp

sudo ufw enable
ufw deny 3306
sudo ufw default deny incoming

sudo ufw default allow outgoing

```
**Services**

```
service mysql start
service nginx start

systemctl enable mysql
systemctl enable nginx
```

**MySql**
```
1. create a user with root privileges
2. create a database for the project 
3. restart mysql
```
**GIT setup**
```
mkdir /var/www/retronet.backend
cd /var/www/retronet.backend
git init 
git remote add origin https://github.com/matteoc99/SocialNetworkApi.git
```
**php.ini**
```
vim /etc/php/7.3/fpm/php.ini
change or uncomment: 
    memory_limit = 256M
    upload_max_filesize = 64M
    cgi.fix_pathinfo=0 :793
```
**nginx setup**
```
cp /etc/nginx/nginx.conf /etc/nginx/nginx.conf.backup-original
server_tokens off; ← uncomment lines
server_names_hash_bucket_size 64; ← uncomment lines



mkdir -p /var/www/matteocosi.it/html

vim /etc/nginx/sites-available/retronet.backend
past the following: 
    server {
            listen 80;
            listen [::]:80;
            root /var/www/retronet.backend/public;
            index index.php index.html index.htm index.nginx-debian.html;
    
            server_name matteocosi.it www.matteocosi.it;
    
            location / {
                    try_files $uri $uri/ /index.php?$query_string;
            }
    
            location ~ \.php$ {
                    try_files $uri /index.php =404;
                    fastcgi_split_path_info ^(.+\.php)(/.+)$;
                    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                    fastcgi_pass unix:/var/run/php/php7.3-fpm.sock;
                    fastcgi_index index.php;
                    include fastcgi_params;
            }
    }
alternatively paste into the default site

ln -s /etc/nginx/sites-available/retronet.backend /etc/nginx/sites-enabled/

nginx -t    
nginx -s reload
(to test if nginx is fine)
```
**Laravel setup**

```
cd /var/www/retronet.backend
git pull origin master
composer install
configure the .env file with database name, user, password, etc.
php artisan key:generate
git pull origin master
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
php artisan migrate
```
