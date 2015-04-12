/**
 * Important: If you change the username or localhost it will break imports for all TRIGGERS.
 * They are defined for only for 'find2cards'@'localhost'
 *
 * If you make changes to the schema make sure those changes are made with the
 * 'find2cards'@'localhost' identifier. Otherwise the export.sh script will create SQL files
 * that won't import on other servers. (i.e. don't make changes using root).
 *
 * If you are using MySQL WorkBench. Create a connection using the 'find2cards'@'localhost' user
 * and use that connection to modify the database.
 */
CREATE DATABASE `find2cards`;
CREATE USER 'find2cards'@'localhost' IDENTIFIED BY 'ghdqbUEo3svfQ8qTObPr';
GRANT ALL ON `find2cards`.* TO 'find2cards'@'localhost';
