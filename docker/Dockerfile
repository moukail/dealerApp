FROM moukail/centos7-apache2.4-php5.6

RUN echo "xdebug.remote_enable=1" >> /etc/php/5.6/apache2/conf.d/20-xdebug.ini \
 && echo "xdebug.remote_host=172.16.10.160" >> /etc/php/5.6/apache2/conf.d/20-xdebug.ini \
 && echo "xdebug.remote_port=9000" >> /etc/php/5.6/apache2/conf.d/20-xdebug.ini \
 && echo "xdebug.profiler_enable=1" >> /etc/php/5.6/apache2/conf.d/20-xdebug.ini \
 && echo "xdebug.profiler_output_dir=/var/www/profiling" >> /etc/php/5.6/apache2/conf.d/20-xdebug.ini \
 && echo "xdebug.idekey=PHPSTORM" >> /etc/php/5.6/apache2/conf.d/20-xdebug.ini \
 && echo "xdebug.remote_autostart=1" >> /etc/php/5.6/apache2/conf.d/20-xdebug.ini

EXPOSE 80

#ADD public /var/www/site

WORKDIR /var/www

ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

CMD /usr/bin/apachectl -D FOREGROUND
