# [WARNING THIS PROJECT REACHED HIS EOL!]
# Project Manager
## Whats that?
This is a project manager programmed in PHP. I programmed this for the AusbildungsFit Doit in Vienna but I also want to share it with the public to work better on it.
## How it works!
First you need a webserver, which you install with this command:
```
sudo curl -sSL https://packages.sury.org/php/README.txt | sudo bash -x
sudo apt install php8.1 apache2 -y
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer self-update
```
Then install a MySQL database with phpMyAdmin a tutorial you can find here:
https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-20-04

When you have set everything, create a database. When you have created the database import the "database.sql" file into the database.

Now open the config.php which is in the "src" folder and change the respective data with the data you selected.

## You want to improve the code and contribute to further development?

If you want to help with the development then fork the project and change the code as you like (but please follow the rules)

## You have questions?
Then you can contact me there:
* E-Mail: rology@satowa-network.eu
* E-Mail: dev@kitsune.exposed
