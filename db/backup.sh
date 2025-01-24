#!/usr/bin/sh
mariadb-dump livres -uroot -psuperAdmin > /root/init.sql
echo "Sauvegarde terminée"