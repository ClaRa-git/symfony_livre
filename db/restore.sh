#!/usr/bin/sh

mariadb livres -uroot -psuperAdmin < /root/init.sql
echo "Restauration terminée"
