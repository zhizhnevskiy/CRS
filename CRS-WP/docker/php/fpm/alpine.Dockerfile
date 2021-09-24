########################################################################################################################
# BASE
########################################################################################################################
ARG PHP_VERSION=7.4.15

FROM php:${PHP_VERSION}-fpm-alpine as base

RUN set -xeu \
	#
    # these packages will not be removed in the "clean up" step
    && apk add --no-cache \
        p7zip bash shadow \
    #
	# Dependencies for php extensions and extensions itself:
	#
    # installing build deps
    # (these packages might be removed in the "clean up" step, but only if they are not needed for php extensions)
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS shadow \
        freetype-dev \
        gpgme-dev \
        icu-dev \
        imagemagick-dev \
        imap-dev \
        krb5-dev \ 
        libjpeg-turbo-dev  \
        libmcrypt-dev \
        libpng-dev  \
        libxml2-dev \
        libxslt-dev \
        libzip-dev \
        openssl-dev \ 
        tidyhtml-dev \
        yaml-dev \
        zlib-dev \
    #
    # update pecl channels
    && pecl update-channels \
    # pecl
    && pecl install apcu gnupg imagick mcrypt redis yaml \
    && docker-php-ext-enable apcu gnupg imagick mcrypt redis yaml \
    # sources
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \    
    && docker-php-ext-install -j$(nproc) bcmath gd intl imap mysqli opcache pdo_mysql soap tidy xsl zip \
    #
    # Creating work dirs
    #
    # make sure all dirs are exists
    && rm -rf /var/www \
    && /usr/bin/install -m 0775 -o www-data -g www-data -d \
        /var/www/ \
        /var/www/src \
        /var/www/logs \
        /var/www/data \
        /var/www/.composer \
    # make sure home dir of www-data is "/var/www/"
    && usermod -d /var/www www-data \
    #
    # Clean up
    #
    # install persistent packages to avoid removing
    && ( \
        ( find /usr/local -type f -executable; find "$(php-config --extension-dir)" -type f ) \
          | sort -u \
          | xargs -n 1 -r ldd 2>/dev/null \
          | awk '/=>/ { print $(NF-1) }' \
          | sort -u \
          | xargs -r apk info --who-owns \
          | cut -d" " -f5 \
          | sort -u \
          | sed -r 's/-[0-9\.a-z_]+-r\d+$//' \
          | sort -u \
    ) | xargs -r apk add --no-cache \
    # remove .build-deps
    && apk del --no-network .build-deps \
    # remove pecl cache
    && rm -rf /tmp/pear ~/.pearrc \
    # remove php tests
    && rm -rf /usr/local/lib/php/test \
    # remove php docs
    && rm -rf /usr/local/lib/php/doc

#
# Scripts build time
#
COPY ./scripts/runtime/* /usr/local/bin/

WORKDIR /var/www

ENTRYPOINT ["docker-php-entrypoint-base"]

CMD ["php-fpm"]

########################################################################################################################
# DEVELOPMENT
########################################################################################################################

#
# Mailhog
#
# see: https://github.com/mailhog/mhsendmail
#
FROM golang:alpine as mailhog

RUN set -xe \
    && apk add --no-cache git \
    && go get github.com/mailhog/mhsendmail

#
# gosu
#
# see: https://github.com/tianon/gosu
#
FROM golang:alpine as gosu

RUN set -xe \
    && apk add --no-cache git \
    && go get github.com/tianon/gosu

#
# Development image
#
FROM base as development

#
# Scripts build time
#
COPY ./scripts/build/* /usr/local/bin/

#
# Mailhog
#
COPY --from=mailhog /go/bin/mhsendmail /usr/sbin/mhsendmail

#
# gosu
#
COPY --from=gosu /go/bin/gosu /usr/sbin/gosu

RUN set -xeu \
    # installing persistent packages
    && apk add --no-cache git python3 openssh-client shadow bash \
    #
	# Dependencies for php extensions and extensions itself:
	#
	&& apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    # tideways/php-xhprof-extension
    && git clone https://github.com/tideways/php-xhprof-extension.git /tmp/tideways_xhprof \
    && docker-php-ext-install -j$(nproc) /tmp/tideways_xhprof \
    && rm -rf /tmp/tideways_xhprof \
    # xdebug
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    #
    # php.ini
    && cp "${PHP_INI_DIR}/php.ini-development" "${PHP_INI_DIR}/php.ini" \
    # composer
    && docker-php-install-composer \
    #
    # Clean up
    #
    # install persistent packages to avoid removing
    && ( \
        ( find /usr/local -type f -executable; find "$(php-config --extension-dir)" -type f ) \
          | sort -u \
          | xargs -n 1 -r ldd 2>/dev/null \
          | awk '/=>/ { print $(NF-1) }' \
          | sort -u \
          | xargs -r apk info --who-owns \
          | cut -d" " -f5 \
          | sort -u \
          | sed -r 's/-[0-9\.a-z_]+-r\d+$//' \
          | sort -u \
    ) | xargs -r apk add --no-cache \
    # remove .build-deps
    && apk del --no-network .build-deps \
    # remove pecl cache
    && rm -rf /tmp/pear ~/.pearrc \
    # remove php tests
    && rm -rf /usr/local/lib/php/test \
    # remove php docs
    && rm -rf /usr/local/lib/php/doc

#
# Scripts runtime
#
COPY ./scripts/runtime/* /usr/local/bin/

ENTRYPOINT ["docker-php-entrypoint-dev"]

CMD ["php-fpm"]
