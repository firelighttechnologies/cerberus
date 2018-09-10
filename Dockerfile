FROM php:5.6-apache
ENV TERM xterm
RUN apt-get update && apt-get install -y \
    wget \
    git \
    unzip \
    nano \
&& rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY composer-install.sh /var/composer-install.sh
RUN chmod +x /var/composer-install.sh \
    && /var/composer-install.sh \
    && mv composer.phar /usr/local/bin/composer
#RUN composer require lcobucci/jwt "3.2"
RUN a2enmod rewrite
#ADD public/* /var/www/html/
WORKDIR /var/www/html/
RUN wget https://github.com/mudmin/UserSpice43dev/archive/master.zip \
    && unzip master.zip \
    && cp -R /var/www/html/UserSpice43dev-master/* /var/www/html/ \
    && rm -Rf /var/www/html/UserSpice43dev-master \
    && rm master.zip \
    && rm -Rf /var/www/html/install \
    COPY init.php /var/www/html/users/init.php \
    RUN chmod 644 /var/www/html/users/init.php
