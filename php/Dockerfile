FROM php:7.4-cli
COPY . /usr/src/gilded-rose-php
WORKDIR /usr/src/gilded-rose-php
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Install git
RUN apt-get update
RUN yes | apt-get install git
RUN apt-get install zip unzip
