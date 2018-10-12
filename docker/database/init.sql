CREATE USER 'anketa'@'localhost' IDENTIFIED BY 'docker';
GRANT ALL PRIVILEGES ON *.* TO 'anketa'@'localhost' WITH GRANT OPTION;
CREATE USER 'anketa'@'%' IDENTIFIED BY 'docker';
GRANT ALL PRIVILEGES ON *.* TO 'anketa'@'%' WITH GRANT OPTION;
