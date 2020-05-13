FROM webdevops/php-nginx-dev:alpine-php7

RUN apk add php7-amqp

ENV WEB_DOCUMENT_ROOT=/srv/app/public
ENV DOCUMENT_INDEX=index.php

WORKDIR /srv/app