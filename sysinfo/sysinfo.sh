#!/bin/sh

tail -200 /var/log/apache2/error.log > l_apache.txt 2>/dev/null
tail -200 /var/log/mysql/error.log > l_mariadb.txt 2>/dev/null
tail -200 /var/log/mail.log > l_mail.txt 2>/dev/null
tail -200 /var/log/messages > l_mess.txt 2>/dev/null
#
