FROM nginx:latest

RUN export TERM=linux

RUN apt-get update && apt-get upgrade -y --force-yes && apt-get install -y wget curl

RUN echo "deb http://packages.dotdeb.org wheezy-php56 all" >> /etc/apt/sources.list.d/dotdeb.list && \
    echo "deb-src http://packages.dotdeb.org wheezy-php56 all" >> /etc/apt/sources.list.d/dotdeb.list && \
    wget http://www.dotdeb.org/dotdeb.gpg -O- | apt-key add -

RUN apt-get update && apt-get install -y php5-fpm php5-common php5-cli php5-mysql

RUN curl -sS https://getcomposer.org/installer | php; \
    mv composer.phar /usr/sbin/composer

RUN curl -L https://phar.phpunit.de/phpunit-5.7.phar -o phpunit && \
    mv phpunit /usr/sbin/phpunit && \
    chmod +x /usr/sbin/phpunit

COPY ./dockerfiles/php/php.ini /etc/php5/fpm/php.ini
COPY ./dockerfiles/php/php-fpm.conf /etc/php5/fpm/php-fpm.conf
RUN  rm -f /etc/php5/fpm/pool.d/*
COPY ./dockerfiles/php/dvpst.conf /etc/php5/fpm/pool.d/dvpst.conf

COPY ./dockerfiles/nginx/default.conf /etc/nginx/vhost.d/default.conf
COPY ./dockerfiles/nginx/fastcgi.conf /etc/nginx/fastcgi.conf
COPY ./dockerfiles/nginx/nginx.conf /etc/nginx/nginx.conf

ADD . /var/www/dvpst

WORKDIR /var/www/dvpst

RUN composer install

RUN mkdir -p /var/lib/php/session && \
    mkdir -p /var/log/nginx/log && \
    mkdir -p /var/log/php5-fpm && \
    mkdir -p logs

CMD bash -c './wait.sh && nginx && /usr/sbin/php5-fpm -F'
