#

tail -200 /var/log/apache2/error.log > l_apache.txt
tail -200 /var/log/mysql/error.log > l_mariadb.txt
tail -200 /var/log/mail.log > l_mail.txt
tail -200 /var/log/messages > l_mess.txt