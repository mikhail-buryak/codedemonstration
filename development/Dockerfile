FROM ubuntu:14.04.4
MAINTAINER Mikhail Buryak <buryak.mikhail@gmail.com>

RUN usermod -u 1000 www-data

# Surpress Upstart errors/warning
RUN dpkg-divert --local --rename --add /sbin/initctl
RUN ln -sf /bin/true /sbin/initctl

# Let the conatiner know that there is no tty
ENV DEBIAN_FRONTEND noninteractive

# Update base image
# Add sources for latest nginx
# Install software requirements

RUN apt-get update && \
apt-get upgrade -y
RUN locale-gen en_US.UTF-8
RUN export LANG=en_US.UTF-8
RUN export LC_ALL=en_US.UTF-8
RUN apt-get -y install software-properties-common
RUN LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt-get update

RUN BUILD_PACKAGES="supervisor nginx php7.0-fpm git php-apc php7.0-curl vim php7.0-mbstring php7.0-zip php7.0-gd php7.0-intl php7.0-mcrypt php7.0-sqlite php7.0-tidy php7.0-xmlrpc php7.0-xsl php7.0-mysql php7.0-ldap pwgen curl libcurl3 libcurl3-dev nodejs" && \
apt-get -y install $BUILD_PACKAGES && \
apt-get remove --purge -y software-properties-common && \
apt-get autoremove -y && \
apt-get clean && \
apt-get autoclean

ADD ./nginx.conf /etc/nginx/nginx.conf

RUN php5enmod mcrypt

RUN sed -i -e "s/;listen.mode = 0660/listen.mode = 0750/g" /etc/php/7.0/fpm/pool.d/www.conf && \
find /etc/php/7.0/cli/conf.d/ -name "*.ini" -exec sed -i -re 's/^(\s*)#(.*)/\1;\2/g' {} \;

RUN mkdir /run/php
RUN touch /run/php/php7.0-fpm.sock

VOLUME ["/usr/share/nginx/html"]

# add test PHP file
ADD ./app /usr/share/nginx/html/app
RUN chown -Rf www-data.www-data /usr/share/nginx/html

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN composer install -d /usr/share/nginx/html/app --prefer-source --no-interaction
RUN ls -la /usr/share/nginx/html/app

# nginx site conf
RUN rm -Rf /etc/nginx/conf.d/* && \
rm -Rf /etc/nginx/sites-available/default && \
mkdir -p /etc/nginx/ssl/
ADD ./nginx-site.conf /etc/nginx/sites-available/default.conf
RUN ln -s /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/default.conf

ADD ./supervisord.conf /etc/supervisord.conf
ADD ./start.sh /start.sh
RUN chmod 755 /start.sh

EXPOSE 443
EXPOSE 80
EXPOSE 25
