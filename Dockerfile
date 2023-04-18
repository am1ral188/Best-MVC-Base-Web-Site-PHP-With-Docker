# Use an official Ubuntu runtime as a parent image

FROM ubuntu

ENV DEBIAN_FRONTEND=noninteractive

ENV APACHE_RUN_USER www-data

ENV APACHE_RUN_GROUP www-data

ENV APACHE_LOG_DIR /var/log/apache2

ENV APACHE_PID_FILE /var/run/apache2/apache2.pid

ENV APACHE_RUN_DIR /var/run/apache2

ENV APACHE_LOCK_DIR /var/lock/apache2
# Install MySQLash 
RUN apt-get update;
RUN apt-get update && apt-get install -y apache2

RUN apt update
RUN apt-get install mariadb-server mariadb-client -y;
RUN apt install php8.1 -y; apt-get install php-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath -y
RUN apt-get install libapache2-mod-php php-mysql -y;
# Copy the PHP files to /var/www/html directo
RUN rm -r /var/www/html
COPY html /var/www/html
WORKDIR /var/www/html
RUN a2enmod rewrite
RUN /etc/init.d/apache2 restart
RUN chmod 644 ./.htaccess
COPY custom.conf /etc/apache2/conf-available/
RUN a2enconf custom && \
\
    a2enmod rewrite


RUN rm -rf /var/lib/apt/lists/*
RUN apt-get clean

EXPOSE 80
EXPOSE 3306



RUN mkdir /img_prof

VOLUME /img_prof
# Start Apache and MySQL service /etc/init.d/mariadb start &&
CMD ["/bin/bash", "-c",   '/etc/init.d/mariadb start&&mysql --execute="CREATE USER \'admin1234\'@localhost IDENTIFIED BY \'6dm15_zxcvbnbvcx\';"&& mysql --execute="GRANT ALL PRIVILEGES ON *.* TO \'admin1234\'@\'localhost\' WITH GRANT OPTION;"&& mysql --execute="FLUSH PRIVILEGES;"&&/etc/init.d/apache2 start&&bash']
