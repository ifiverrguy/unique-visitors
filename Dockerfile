FROM php:7.3.6-fpm-alpine3.9

RUN apk add --no-cache bash

EXPOSE 9000

# Remove inital
WORKDIR /var/www
RUN rm -rf /var/www/html