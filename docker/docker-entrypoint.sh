#!/bin/bash
echo "-------------------------------------------------------------------"
echo "-                              test                               -"
echo "-------------------------------------------------------------------"

composer update
composer development-disable
composer development-enable
php public/index.php orm:schema-tool:update --dump-sql --force