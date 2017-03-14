#!/bin/bash
echo "-------------------------------------------------------------------"
echo "-                              test                               -"
echo "-------------------------------------------------------------------"

#mkdir data/tmpuploads
chmod 0777 -R data/uploads
composer update
composer development-disable
composer development-enable
php public/index.php orm:schema-tool:update --dump-sql --force
/usr/bin/apachectl -D FOREGROUND