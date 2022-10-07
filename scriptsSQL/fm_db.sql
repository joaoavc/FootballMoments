# Create data base fm - BestOfFootball
CREATE DATABASE IF NOT EXISTS `fm` CHARACTER SET utf8 COLLATE utf8_unicode_ci;

# Create user accessing from localhost
CREATE USER 'fm'@'localhost' IDENTIFIED BY 'secret';

# Create user accessing from remote hosts
CREATE USER 'fm'@'%' IDENTIFIED BY 'secret';

# Grant usages
GRANT USAGE ON * . * TO 'fm'@'localhost' IDENTIFIED BY 'secret' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;
GRANT USAGE ON * . * TO 'fm'@'%' IDENTIFIED BY 'secret' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

# Grant privileges
GRANT ALL PRIVILEGES ON `fm` . * TO 'fm'@'localhost';
GRANT ALL PRIVILEGES ON `fm` . * TO 'fm'@'%';




