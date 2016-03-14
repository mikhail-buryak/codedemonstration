#!/bin/bash

echo "BUILD SUCCESSFUL"

mkdir -p -m 0700 /root/.ssh
echo -e "Host *\n\tStrictHostKeyChecking no\n" >> /root/.ssh/config

if [[ "$ERRORS" != "1" ]] ; then
  sed -i -e "s/error_reporting =.*=/error_reporting = E_ALL/g" /etc/php/7.0/fpm/php.ini
  sed -i -e "s/display_errors =.*/display_errors = On/g" /etc/php/7.0/fpm/php.ini
fi

chown -Rf www-data.www-data /usr/share/nginx/html/
echo "Permission set"

# Start supervisord and services
/usr/bin/supervisord -n -c /etc/supervisord.conf
