FROM ubuntu:16.04
MAINTAINER Ismail Moukafih <info@moukafih.nl>

RUN apt-get update
RUN apt-get -y upgrade

RUN apt-get -y install git \
    unzip \
    curl \
    wget \
    apache2 \
    php7.0 \
    libapache2-mod-php7.0 \
    php-mysql \
    php-gd \
    php-cgi \
    php-cli \
    php-curl \
    php-xdebug \
    php-xml \
    php-zip \
    php-intl \
    php-redis \
    php-mbstring

RUN curl -sS https://getcomposer.org/installer \
      | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod php7.0
RUN a2enmod rewrite

#Set up debugger
#RUN echo "zend_extension=xdebug.so" >> /etc/php/7.0/apache2/conf.d/20-xdebug.ini
RUN echo "xdebug.remote_enable=1" >> /etc/php/7.0/apache2/conf.d/20-xdebug.ini
RUN echo "xdebug.remote_host=192.168.1.13" >> /etc/php/7.0/apache2/conf.d/20-xdebug.ini #Please provide your host (local machine IP)
RUN echo "xdebug.remote_port=9000" >> /etc/php/7.0/apache2/conf.d/20-xdebug.ini #Please provide your host (local machine IP)
RUN echo "xdebug.profiler_enable=1" >> /etc/php/7.0/apache2/conf.d/20-xdebug.ini #Please provide your host (local machine IP)
RUN echo "xdebug.profiler_output_dir=/var/www/profiling" >> /etc/php/7.0/apache2/conf.d/20-xdebug.ini #Please provide your host (local machine IP)
RUN echo "xdebug.idekey=PHPSTORM" >> /etc/php/7.0/apache2/conf.d/20-xdebug.ini
RUN echo "xdebug.remote_autostart=1" >> /etc/php/7.0/apache2/conf.d/20-xdebug.ini

#RUN wget -O - https://packagecloud.io/gpg.key | apt-key add - \
#    && echo "deb http://packages.blackfire.io/debian any main" > /etc/apt/sources.list.d/blackfire.list \
#    && apt-get update \
#    && apt-get install blackfire-php

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/www
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

EXPOSE 80

#ADD public /var/www/site

WORKDIR /var/www

ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

CMD /usr/sbin/apache2ctl -D FOREGROUND