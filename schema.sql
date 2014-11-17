CREATE DATABASE sharedvoice;

CREATE USER 'share'@'localhost' IDENTIFIED BY 'voice';
GRANT ALL ON hydra.* TO 'share'@'localhost';
FLUSH PRIVILEGES;

USE sharedvoice;

CREATE TABLE users (
    id INT(12) NOT NULL auto_increment PRIMARY KEY,
    twitter_name VARCHAR(256) NOT NULL,
    twitter_id VARCHAR(128) NOT NULL,
    oauth_token VARCHAR(256) NOT NULL, 
    oauth_secret VARCHAR(256),
    INDEX(`twitter_id`),
    INDEX(`id`)
) ENGINE InnoDB;