# Use an official Ubuntu runtime as a parent image

FROM ubuntu:latest

# Set the working directory to /app

WORKDIR /app

# Install Apache and PHP

RUN apt-get update && \
\
    apt-get -y install apache2 php libapache2-mod-php php-mysql && \
\
    apt-get clean && \
\
    rm -rf /var/lib/apt/lists/*

# Install MySQL

RUN apt-get update && \
\
    apt-get -y install mysql-server && \
\
    apt-get clean && \
\
    rm -rf /var/lib/apt/lists/*

# Copy the PHP files to /var/www/html directory
RUN rm -r /var/www/html
COPY html /var/www/

# Expose port 80 for Apache and port 3306 for MySQL

EXPOSE 80

EXPOSE 3306

# Start Apache and MySQL services

CMD ["/bin/bash", "-c", "/etc/init.d/mysql start && apache2ctl -D FOREGROUND"]