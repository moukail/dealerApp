#!/bin/bash
echo "-------------------------------------------------------------------"
echo "-                              test                               -"
echo "-------------------------------------------------------------------"

mkdir data/tmpuploads
chmod 0777 -R data/tmpuploads
composer update
composer development-disable
composer development-enable
php public/index.php orm:schema-tool:update --dump-sql --force
/usr/sbin/apache2ctl -D FOREGROUND