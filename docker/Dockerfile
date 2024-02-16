FROM php:8.2.2

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

WORKDIR /app

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions zip xdebug sockets gd pgsql pdo_pgsql && \
    docker-php-ext-enable sockets xdebug gd pgsql pdo_pgsql && \
    rm -f /usr/local/bin/install-php-extensions

ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

COPY ./docker/php.ini /usr/local/etc/php/conf.d/php.ini

EXPOSE 8000
CMD composer install && symfony server:start